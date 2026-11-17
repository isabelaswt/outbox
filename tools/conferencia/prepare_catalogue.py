"""Recorta fotos do PDF de referência e prepara metadados, sem criar o PDF comparativo."""
import json
from pathlib import Path
import fitz
from PIL import Image

ROOT = Path(__file__).resolve().parents[2]
REF = ROOT / '_ref/incom'


def catalogue_data():
    source = (ROOT / 'js/incom.js').read_text()
    def array(name):
        start = source.index('[', source.index('export const ' + name))
        return json.JSONDecoder().raw_decode(source[start:])[0]
    return {'products': array('INCOM_PRODUCTS'), 'caps': array('INCOM_CAPS')}


def prepare():
    data = catalogue_data()
    (REF / 'catalog-data.json').write_text(json.dumps(data, ensure_ascii=False))
    doc = fitz.open(REF / 'catalogo-incom-2026.pdf')
    dest = REF / 'fotos-conferencia'
    dest.mkdir(exist_ok=True)
    clips = {}
    for pg in sorted({r['pg'] for r in data['products'] + data['caps']}):
        page = doc[pg - 1]
        w, h = page.rect.width, page.rect.height
        boxes = []
        for image in page.get_image_info():
            b = fitz.Rect(image['bbox'])
            if b.x0 >= 0 and b.x1 <= w * .6 and b.y0 > h * .13 and b.y1 < h * .73 and b.width * b.height > w * h * .004:
                boxes.append(b)
        if boxes:
            clip = fitz.Rect(boxes[0])
            for box in boxes[1:]:
                clip |= box
            clip = fitz.Rect(clip.x0 - 4, clip.y0 - 4, clip.x1 + 4, clip.y1 + 4)
        else:
            clip = fitz.Rect(0, h * .135, w * .62, h * .70)
        pix = page.get_pixmap(matrix=fitz.Matrix(2, 2), clip=clip)
        Image.frombytes('RGB', [pix.width, pix.height], pix.samples).save(dest / f'pagina-{pg}.jpg', quality=94)
        clips[str(pg)] = list(clip)
    (dest / 'recortes.json').write_text(json.dumps(clips, indent=2))
    print(f'{len(clips)} páginas de referência preparadas.')


if __name__ == '__main__':
    prepare()
