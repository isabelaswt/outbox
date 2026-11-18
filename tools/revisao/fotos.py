"""Prepara as fotos da página de Aprovação Incom (revisao.html).

Para cada modelo Incom do OUTBOX (lista em tools/revisao/lista.json, tirada de window.OUTBOX.PRESETS):
- até 5 fotos do site Incom (_ref/incom/site/<slug>/, packshots de fundo liso primeiro), reduzidas;
- a página do catálogo Incom 2026 onde o produto está.
Saída: assets/revisao/fotos/<slug>/N.jpg, assets/revisao/catalogo/pNNN.jpg e assets/revisao/itens.json.
As originais ficam em _ref (fora do git); aqui vão só cópias leves.

uso: python3 tools/revisao/fotos.py
"""
import json, os, re, subprocess, unicodedata, glob
from PIL import Image

ROOT = os.path.dirname(os.path.dirname(os.path.dirname(os.path.abspath(__file__))))
SITE = f'{ROOT}/_ref/incom/site'
OUT = f'{ROOT}/assets/revisao'
PDF = f'{ROOT}/_ref/incom/catalogo-incom-2026.pdf'
norm = lambda s: re.sub(r'[^a-z0-9]+', ' ', unicodedata.normalize('NFD', s.lower()).encode('ascii', 'ignore').decode()).strip()

# Páginas com título repetido ou diferente do nome no catálogo (casadas pela linha e pelas fotos).
FIX = {
    'Incom Sydney (conta-gotas)': ['sydney-60-conta-gotas'], 'Incom Sydney 60 (frascos)': ['sydney-60'],
    'Incom Bulb (conta-gotas)': ['bulb'], 'Incom Bulb (dispensadores)': ['dispensing-bulb'],
    'Incom Dispensing 15 (conta-gotas)': ['dispensing-15-conta-gotas'], 'Incom Dispensing 15 (dispensadores)': ['dispensing-15'],
    'Incom Dispensing 30 (conta-gotas)': ['dispensing-30-2'], 'Incom Dispensing 30 (dispensadores)': ['dispensing-30'],
    'Incom Julie (conta-gotas)': ['julie'], 'Incom Julie (frasnagas)': ['frasnaga-julie'],
    'Incom Dispensing On-Off 100 (dispensadores)': ['dispensing-on-off-100'], 'Incom Dispensing On-Off 120 (dispensadores)': ['dispensing-120'],
    'Incom Dispensing Twist (dispensadores)': ['dispensing-twist'], 'Incom Twist (tampa de perfume)': [],
    'Incom Amsterdam (frascos)': ['amsterdam-200'], 'Incom Apple Blow (frascos)': ['apple', 'apple-2'], 'Incom Chicago (frascos)': ['chicago'],
    'Incom Miami (frascos)': ['miami'], 'Incom New York (frascos)': ['apple-200'], 'Incom Wall (frascos)': ['wall'],
    'Incom Squared (batons)': ['batom-squared'], 'Incom Pote Squared (potes)': ['pote-squared'],
    'Incom Guggen (líquidos labiais)': ['guggen', 'guggen-2'], 'Incom Guggen (máscaras)': ['guggen-2', 'guggen'],
    'Incom Guggen Plus (líquidos labiais)': ['guggen-plus', 'guggen-plus-aplicador-flocado'], 'Incom Guggen Plus (máscaras)': ['guggen-plus-aplicador-flocado', 'guggen-plus'],
    'Incom Oscar (líquidos labiais)': ['oscar-2'], 'Incom Oscar (máscaras)': ['oscar-mascara'],
    'Incom Timeless Plus (líquidos labiais)': ['timeless-plus', 'timeless-plus-2'], 'Incom Timeless Plus (máscaras)': ['timeless-plus-2', 'timeless-plus'],
    'Incom Berlim Plus (máscaras)': ['berlim-plus', 'berlim-plus-2'],
    'Incom Moma (líquidos labiais)': ['new-moma'], 'Incom Moma Tampa Alta (líquidos labiais)': ['new-moma'], 'Incom Moma 2.0 (líquidos labiais)': ['moma-new'],
    'Incom Petit com Haste (frasnagas)': ['frasnaga-petit-haste'], 'Incom Flint (colar abaulado) (tampa de perfume)': ['flint'],
    'Incom New York Deluxe 100 (deluxes)': ['amsterdam'], 'Incom Chubby Stick M (sticks)': ['long-copia'],
}


def base(n):
    n = re.sub(r'^Incom ', '', n); n = re.sub(r' \([^)]*\)$', '', n); n = re.sub(r' · .*$', '', n)
    return re.sub(r' (Abaulada|Tampa Cristal|Tampa Alta)$', '', n)


def photos(slug):
    fs = [f for f in sorted(glob.glob(f'{SITE}/{slug}/*')) if re.search(r'\.(jpe?g|png|webp)$', f, re.I)]
    small = [f for f in fs if re.search(r'-\d+x\d+\.', f)]
    big = [f for f in fs if f not in small and not any(os.path.basename(s).startswith(re.sub(r'\.\w+$', '', os.path.basename(f)) + '-') for s in small)]
    def lisa(f):  # packshot: canto de fundo cinza/branco liso
        try:
            im = Image.open(f).convert('RGB'); im.thumbnail((60, 60)); px = im.getpixel((2, 2))
            return 0 if abs(px[0] - px[1]) < 8 and abs(px[1] - px[2]) < 8 and px[0] > 190 else 1
        except Exception: return 2
    return sorted(small + big, key=lisa)


def save(src, dst, size):
    if os.path.exists(dst): return
    im = Image.open(src).convert('RGB'); im.thumbnail((size, size), Image.LANCZOS)
    os.makedirs(os.path.dirname(dst), exist_ok=True); im.save(dst, 'JPEG', quality=78, optimize=True, progressive=True)


def main():
    L = json.load(open(f'{ROOT}/tools/revisao/lista.json')); idx = json.load(open(f'{SITE}/indice.json'))
    by = {}
    for p in idx: by.setdefault(norm(p.get('titulo', '')), []).append(p['slug'])
    itens = []
    for x in L:
        slugs = FIX.get(x['n'], by.get(norm(base(x['n'])), [])[:1])
        fs = []
        for s in slugs:
            for i, f in enumerate(photos(s)[:5 if len(slugs) == 1 else 3]):
                dst = f'{OUT}/fotos/{s}/{i + 1}.jpg'; save(f, dst, 900); fs.append(os.path.relpath(dst, ROOT))
        pg = x.get('pg'); cat = None
        if pg:
            dst = f'{OUT}/catalogo/p{pg:03d}.jpg'
            if not os.path.exists(dst):
                os.makedirs(os.path.dirname(dst), exist_ok=True); tmp = f'{OUT}/catalogo/_p'
                subprocess.run(['pdftoppm', '-f', str(pg), '-l', str(pg), '-scale-to', '900', '-png', PDF, tmp], check=True)
                png = glob.glob(f'{tmp}*.png')[0]; save(png, dst, 900); os.remove(png)
            cat = os.path.relpath(dst, ROOT)
        itens.append({'k': x['n'], 'nome': re.sub(r'^Incom ', '', re.sub(r' \([^)]*\)$', '', x['n'])), 'linha': x['cat'], 'pg': pg,
                      'variante': x.get('variant') or '', 'site': slugs, 'fotos': fs, 'catalogo': cat})
    json.dump(itens, open(f'{OUT}/itens.json', 'w'), ensure_ascii=False, indent=1)
    print(len(itens), 'itens;', sum(1 for i in itens if i['fotos']), 'com fotos do site')


main()
