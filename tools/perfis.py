# Uso: python3 tools/perfis.py  (lê os OBJs em _ref/obj/)
# Reconstrói cada produto da Draft como perfis paramétricos do OUTBOX:
# corpo (fatias com meia-largura, meia-profundidade e quadratura), gargalo
# medido e tampa/válvula (perfil + bico). Saída: draft/perfis.json (mm).
import re, json, math, os
import numpy as np
root = os.path.dirname(os.path.dirname(os.path.abspath(__file__)))
# tabela: nome, altura real típica (mm), vidro, peças do corpo / tampa / internas, categoria, giro
table = json.load(open(f'{root}/tools/draft_table.json'))
pn = lambda n: re.sub(r'_Mesh\.?\d*$', '', re.sub(r'-Mesh$', '', n)).replace('.', '').upper()

def hull_area(pts):
    pts = sorted(set(pts))
    if len(pts) < 3: return 0
    cross = lambda o, a, b: (a[0]-o[0])*(b[1]-o[1]) - (a[1]-o[1])*(b[0]-o[0])
    lo, up = [], []
    for p in pts:
        while len(lo) >= 2 and cross(lo[-2], lo[-1], p) <= 0: lo.pop()
        lo.append(p)
    for p in reversed(pts):
        while len(up) >= 2 and cross(up[-2], up[-1], p) <= 0: up.pop()
        up.append(p)
    h = lo[:-1] + up[:-1]
    return abs(sum(h[i][0]*h[(i+1) % len(h)][1] - h[(i+1) % len(h)][0]*h[i][1] for i in range(len(h)))) / 2

def n_from_ratio(r):  # área da superelipse / (4ab) → expoente n
    f = lambda n: math.gamma(1 + 1/n)**2 / math.gamma(1 + 2/n)
    if r <= f(2): return 2.0
    lo, hi = 2.0, 14.0
    if r >= f(hi): return hi
    for _ in range(40):
        mid = (lo + hi) / 2
        (lo, hi) = (mid, hi) if f(mid) < r else (lo, mid)
    return round(lo, 2)

def section(T, y):
    """Pontos (x, z) onde o plano de altura y corta os triângulos T (n×3×3)."""
    out = []
    for a, b in ((0, 1), (1, 2), (2, 0)):
        pa, pb = T[:, a], T[:, b]
        ya, yb = pa[:, 1], pb[:, 1]
        m = ((ya - y) * (yb - y) <= 0) & (ya != yb)
        if not m.any(): continue
        t = ((y - ya[m]) / (yb[m] - ya[m]))[:, None]
        q = pa[m] + t * (pb[m] - pa[m])
        out.append(q[:, [0, 2]])
    return np.concatenate(out) if out else np.zeros((0, 2))

def ridges(Q, cx, cz):
    """Frisos verticais (grip) na seção: (quantidade, profundidade mm) ou (0, 0).
    Raio externo por ângulo, tira a forma lenta e procura a ondulação regular."""
    th = np.arctan2(Q[:, 1] - cz, Q[:, 0] - cx); r = np.hypot(Q[:, 0] - cx, Q[:, 1] - cz)
    NB = 1024; bins = ((th + np.pi) / (2 * np.pi) * NB).astype(int) % NB
    rb = np.full(NB, np.nan); np.fmax.at(rb, bins, r)
    ok = ~np.isnan(rb)
    if ok.sum() < NB * 0.5: return 0, 0.0
    idx = np.arange(NB); rb = np.interp(idx, idx[ok], rb[ok], period=NB)
    ker = np.ones(41) / 41; smooth = np.convolve(np.concatenate([rb[-20:], rb, rb[:20]]), ker, 'valid')
    res = rb - smooth
    spec = np.abs(np.fft.rfft(res)); spec[:10] = 0
    k = int(np.argmax(spec[:260])); power = spec[k] ** 2 / max((spec ** 2).sum(), 1e-12)
    # profundidade só da ondulação dos frisos (amplitude da componente k)
    depth = min(float(4 * spec[k] / NB), 1.2)
    if 12 <= k <= 240 and depth > 0.12 and power > 0.2: return k, round(depth, 3)
    return 0, 0.0

def slices(T, y0, y1, N, spout_axis=None):
    """Perfil entre y0 e y1: [t, a, b, n, cx, cz, frisos, prof. do friso]. Com spout_axis, usa o menor raio (ignora o bico)."""
    out = []; H = y1 - y0
    for i in range(N + 1):
        t = (1 - math.cos(math.pi * i / N)) / 2
        y = y0 + H * min(max(t, 0.002), 0.998)   # evita o plano exato do fundo/topo
        Q = section(T, y)
        if len(Q) < 3: continue
        # centro real da seção (sem o bico): evita perfil torto
        x0, x1 = Q[:, 0].min(), Q[:, 0].max(); z0, z1 = Q[:, 1].min(), Q[:, 1].max()
        cx, cz = (x0 + x1) / 2, (z0 + z1) / 2
        if spout_axis: cx = cz = 0.0
        a = float((x1 - x0) / 2); b = float((z1 - z0) / 2)
        if spout_axis:
            a = float(np.abs(Q[:, 0]).max()); b = float(np.abs(Q[:, 1]).max()); a = b = min(a, b)
        area = hull_area([tuple(q) for q in np.round(Q, 3)])
        n = n_from_ratio(area / (4 * a * b)) if a > 0 and b > 0 and not spout_axis else 2.0
        k, dep = ridges(Q, cx, cz)
        out.append([round(t, 4), a, b, n, round(float(cx), 3), round(float(cz), 3), k, dep])
    return out

res = {}
for pid, row in table.items():
    name, hMM, glass, body, closure, internal, cat = row[:7]; rot = row[7] if len(row) > 7 else 0
    V = []; idx = {'b': set(), 'c': set()}; faces = {'b': [], 'c': []}; cur = None
    for line in open(f'{root}/_ref/obj/{pid}.obj', errors='ignore'):
        if line.startswith('v '): V.append(tuple(map(float, line.split()[1:4])))
        elif line.startswith(('o ', 'g ')):
            n = pn(line[2:].strip()); cur = 'b' if n in body else 'c' if n in closure else None
        elif line.startswith('f ') and cur:
            f = [int(tk.split('/')[0]) for tk in line.split()[1:]]
            f = [j - 1 if j > 0 else len(V) + j for j in f]
            idx[cur].update(f)
            faces[cur] += [(f[0], f[q], f[q + 1]) for q in range(1, len(f) - 1)]
    B = [V[i] for i in idx['b']]; C = [V[i] for i in idx['c']]
    allY = [p[1] for p in B + C]; k = hMM / (max(allY) - min(allY))
    cx = (min(p[0] for p in B) + max(p[0] for p in B)) / 2; cz = (min(p[2] for p in B) + max(p[2] for p in B)) / 2
    tr = lambda p: ((p[2]-cz)*k, p[1]*k, -(p[0]-cx)*k) if rot % 180 else ((p[0]-cx)*k, p[1]*k, (p[2]-cz)*k)
    B = [tr(p) for p in B]; C = [tr(p) for p in C]
    VT = np.array([tr(p) for p in V])
    TB = VT[np.array(faces['b'])]; TC = VT[np.array(faces['c'])]
    bmin, bmax = min(p[1] for p in B), max(p[1] for p in B); cmin, cmax = min(p[1] for p in C), max(p[1] for p in C)
    below = cmin < bmin
    # base da virola: primeira faixa larga da tampa a partir do lado do corpo
    Hc = cmax - cmin; NB = 24; widths = []
    for j in range(NB):
        lo_, hi_ = cmin + Hc*j/NB, cmin + Hc*(j+1)/NB
        S = [p for p in C if lo_ <= p[1] <= hi_]
        widths.append(min(max(p[0] for p in S)-min(p[0] for p in S), max(p[2] for p in S)-min(p[2] for p in S)) if S else 0)
    wmax = max(widths); order = range(NB-1, -1, -1) if below else range(NB)
    kc = next(j for j in order if widths[j] >= 0.45 * wmax)
    cy = cmin + Hc*(kc+1)/NB if below else cmin + Hc*kc/NB
    out = {'name': name, 'glass': glass, 'cat': cat, 'below': below}
    # corpo até onde começa o gargalo: o trecho do topo que estreita
    # (< 62% da largura máxima). Sem estreitamento (potes), corta na virola.
    cut = bmax
    if not below:
        full = slices(TB, bmin, bmax, 80); amax = max(max(s_[1], s_[2]) for s_ in full)
        j = len(full) - 1
        while j > 0 and max(full[j][1], full[j][2]) < 0.62 * amax: j -= 1
        yneck = bmin + (bmax - bmin) * full[min(j + 1, len(full) - 1)][0]
        cut = yneck if bmax - yneck > 1 else (cy if cy < bmax - 0.5 else bmax)
    bp = slices(TB, bmin, cut, 90)
    W = 2 * max(s[1] for s in bp); D = 2 * max(s[2] for s in bp); Hb = cut - bmin
    out['body'] = {'W': round(W, 2), 'D': round(D, 2), 'h': round(Hb, 2),
                   'prof': [[s[0], round(2*s[1]/W, 4), round(2*s[2]/D, 4), s[3], s[4], s[5], s[6], s[7]] for s in bp]}
    out['neck'] = None
    if not below and bmax - cut > 1:
        Q = section(TB, cut + (bmax - cut) * 0.5)
        nw = 2 * float(np.abs(Q).max()) if len(Q) else W * 0.4
        out['neck'] = {'W': round(nw, 2), 'h': round(bmax - cut, 2)}
    # tampa/válvula: perfil a partir da base da virola; bico detectado pela assimetria
    cy0, cy1 = (cmin, cy) if below else (cy, cmax)
    CP = [p for p in C if cy0 - 1e-6 <= p[1] <= cy1 + 1e-6]
    TCP = TC[(TC[:, :, 1].max(1) >= cy0) & (TC[:, :, 1].min(1) <= cy1)]
    ex = max(abs(p[0]) for p in CP); ez = max(abs(p[2]) for p in CP)
    spout = None
    rmin_all = []
    for s in slices(TCP, cy0, cy1, 40, spout_axis=True): rmin_all.append(s[1])
    headR = max(rmin_all) if rmin_all else min(ex, ez)
    if max(ex, ez) > 1.35 * headR and cat == 'V':
        ax = 0 if ex >= ez else 2
        far = max(CP, key=lambda p: abs(p[ax]))
        sign = 1 if far[ax] > 0 else -1
        beyond = [p for p in CP if p[ax] * sign > headR * 1.05]
        root_y = sum(p[1] for p in beyond if abs(p[ax]) < headR * 1.3) / max(1, len([p for p in beyond if abs(p[ax]) < headR * 1.3])) if beyond else far[1]
        tipzone = [p for p in beyond if abs(p[ax]) > abs(far[ax]) - 3]
        spD = max(2.0, min(12.0, (max(p[1] for p in tipzone) - min(p[1] for p in tipzone)) if tipzone else 3.0))
        dirdeg = (0 if sign > 0 else 180) if ax == 0 else (90 if sign > 0 else -90)
        tt = (root_y - cy0) / (cy1 - cy0); dr = root_y - far[1]
        # valores fora do plausível vêm de peças internas (tubo): limita
        if not 0.3 <= tt <= 1: tt = 0.85
        if abs(dr) > 0.35 * (cy1 - cy0): dr = 3.0
        spout = {'L': round(abs(far[ax]) - headR, 2), 'droop': round(dr, 2), 'D': round(spD, 2), 't': round(tt, 3), 'dir': dirdeg}
    cp = slices(TCP, cy0, cy1, 110, spout_axis=bool(spout))
    CW = 2 * max(s[1] for s in cp); CD = 2 * max(s[2] for s in cp)
    out['cap'] = {'W': round(CW, 2), 'D': round(CD, 2), 'h': round(cy1 - cy0, 2),
                  'prof': [[s[0], round(2*s[1]/CW, 4), round(2*s[2]/CD, 4), s[3], s[4], s[5], s[6], s[7]] for s in cp], 'spout': spout}
    out['gapBelow'] = round(bmin - cmax, 2) if below else 0
    res[pid] = out
    fr = sorted({(s[6], s[7]) for s in cp if s[6]} | {(s[6], s[7]) for s in bp if s[6]})
    print(f"{pid:38s} frisos {fr[:3]}  corpo {W:5.1f}×{D:5.1f}×{Hb:5.1f}  gargalo {out['neck']}  tampa {CW:4.1f}×{out['cap']['h']:4.1f}  bico {spout}")
json.dump(res, open(f'{root}/draft/perfis.json', 'w'), separators=(',', ':'))
