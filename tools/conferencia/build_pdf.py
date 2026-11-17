# Monta o PDF de conferência: foto do catálogo Incom (esquerda) × render do OUTBOX (direita).
# Uso: python3 tools/conferencia/build_pdf.py  (lê _ref/incom/renders e _ref/incom/catalogo-incom-2026.pdf)
import fitz, json, os, sys, glob
from PIL import Image, ImageDraw, ImageFont, ImageChops
SP = os.path.abspath(os.path.join(os.path.dirname(os.path.abspath(__file__)), '..', '..'))  # raiz do projeto
REN = os.path.join(SP, '_ref', 'incom', 'renders'); OUT = sys.argv[1] if len(sys.argv) > 1 else os.path.join(SP, 'OUTBOX x Catalogo Incom 2026.pdf')
doc = fitz.open(os.path.join(SP, '_ref', 'incom', 'catalogo-incom-2026.pdf'))
src = open(os.path.join(SP, 'js', 'incom.js')).read()
def arr(name):
    j = src.index('[', src.index('export const ' + name)); return json.JSONDecoder().raw_decode(src[j:])[0]
order = {}
for i, p in enumerate(arr('INCOM_PRODUCTS')): order[f"Incom {p['n']} ({p['c'].lower()})"] = (0, p['pg'], i)
for i, c in enumerate(arr('INCOM_CAPS')): order[f"Incom {c['n']} (tampa de perfume)"] = (1, c['pg'], i)
caps_cat = {f"Incom {c['n']} (tampa de perfume)": c for c in arr('INCOM_CAPS')}
cm = os.path.join(REN, '_caps.json'); caps_mod = json.load(open(cm)) if os.path.exists(cm) else {}
metas = []
for fn in glob.glob(os.path.join(REN, 'Incom*.json')):
    m = json.load(open(fn)); m['img'] = fn[:-5] + '.jpg'
    if os.path.exists(m['img']): metas.append(m)
def key(m):
    o = order.get(m['k']);
    if o: return o
    pg = m.get('pg') or 999; return (0, pg, 999)
metas.sort(key=key)
def font(sz):
    for f in ['/System/Library/Fonts/Supplemental/Arial.ttf', '/System/Library/Fonts/Helvetica.ttc', '/Library/Fonts/Arial.ttf']:
        if os.path.exists(f): return ImageFont.truetype(f, sz)
    return ImageFont.load_default()
F1, F2, F3 = font(40), font(26), font(22)
def trim(im, bg=None, pad=30):
    rgb = im.convert('RGB'); bg = bg or rgb.getpixel((5, 5))
    diff = ImageChops.difference(rgb, Image.new('RGB', rgb.size, bg)).convert('L').point(lambda v: 255 if v > 18 else 0)
    bb = diff.getbbox()
    if not bb: return rgb
    x0, y0, x1, y1 = bb; return rgb.crop((max(0, x0 - pad), max(0, y0 - pad), min(rgb.width, x1 + pad), min(rgb.height, y1 + pad)))
def fit(im, w, h):
    s = min(w / im.width, h / im.height); return im.resize((max(1, int(im.width * s)), max(1, int(im.height * s))), Image.LANCZOS)
PW, PH = 2000, 1250
pages = []
for m in metas:
    pg = m.get('pg')
    if not pg:
        o = order.get(m['k']); pg = o[1] if o else None
    page = Image.new('RGB', (PW, PH), 'white'); d = ImageDraw.Draw(page)
    name = m['k'].replace('Incom ', '')
    d.text((60, 40), name, fill='black', font=F1)
    cat = f"Catálogo Incom 2026 · pág. {pg}" if pg else 'Catálogo Incom 2026'
    d.text((60, 100), cat, fill=(120, 120, 120), font=F3)
    c = caps_cat.get(m['k'])
    if c:  # tampa de perfume: compara a tampa (o frasco do render é genérico, a Incom não faz o vidro)
        D0 = c.get('D') or c['W']; est = ' (profundidade estimada)' if c.get('est') else ''
        fd = f"{c['W']} × {D0} × {c['H']}{est}"; mm = caps_mod.get(m['k'])
        ad = ' × '.join(str(v) for v in mm) if mm else '—'
        d.text((60, PH - 120), f"Tampa no catálogo (L × P × A, mm): {fd}   ·   {c.get('mat','')} · {c.get('term','')}", fill='black', font=F2)
        d.text((60, PH - 80), f"Tampa no OUTBOX: {ad}   ·   frasco do render é genérico (só para apoiar a tampa)", fill='black', font=F2)
    else:
        fd = ' × '.join(str(v) for v in [m.get('fW'), m.get('fD'), m.get('fH')] if v) if m.get('fH') else '—'
        ad = f"{m['W']} × {m['D']} × {m['H']}"
        d.text((60, PH - 120), f"Medidas do catálogo (L × P × A, mm): {fd}", fill='black', font=F2)
        d.text((60, PH - 80), f"Medidas do modelo no OUTBOX (fechado): {ad}" + ('   ·   render aberto' if m.get('aberto') else ''), fill='black', font=F2)
    if m.get('mat'): d.text((1040, 100), str(m['mat'])[:80], fill=(120, 120, 120), font=F3)
    d.line((PW // 2, 150, PW // 2, PH - 150), fill=(220, 220, 220), width=3)
    d.text((60, 150), 'CATÁLOGO', fill=(190, 30, 40), font=F3); d.text((PW // 2 + 40, 150), 'OUTBOX', fill=(190, 30, 40), font=F3)
    box = (PW // 2 - 100, PH - 360)
    if pg:
        p = doc[pg - 1]; r = p.rect
        pix = p.get_pixmap(dpi=150, clip=fitz.Rect(0, r.height * 0.135, r.width * 0.62, r.height * 0.70))
        ci = Image.frombytes('RGB', [pix.width, pix.height], pix.samples)
        ci = fit(trim(ci, pad=40), *box); page.paste(ci, (60 + (box[0] - ci.width) // 2, 190 + (box[1] - ci.height) // 2))
    ri = fit(trim(Image.open(m['img'])), *box); page.paste(ri, (PW // 2 + 40 + (box[0] - ri.width) // 2, 190 + (box[1] - ri.height) // 2))
    pages.append(page)
cover = Image.new('RGB', (PW, PH), 'white'); d = ImageDraw.Draw(cover)
d.text((100, 420), 'OUTBOX × Catálogo Incom 2026', fill='black', font=font(72))
d.text((100, 530), f'Conferência foto do catálogo × modelo 3D — {len(pages)} itens (produtos e tampas de perfume)', fill=(90, 90, 90), font=F2)
d.text((100, 580), 'Modelos em bege (cor base do OUTBOX); compactos, paletas e batons renderizados abertos.', fill=(90, 90, 90), font=F2)
cover.save(OUT, 'PDF', resolution=150, save_all=True, append_images=pages, quality=82)
print(len(pages), 'páginas', os.path.getsize(OUT) // 1024, 'KB')
