// Aprovação Incom: foto real (site Incom + página do catálogo) × render do OUTBOX ao vivo, com aprovar / ajustar
// e a conversa de cada modelo guardadas no servidor (api/revisao.php).
const $ = s => document.querySelector(s);
const el = (t, c, h) => { const e = document.createElement(t); if (c) e.className = c; if (h != null) e.textContent = h; return e; };
const ST = { '': 'Pendente', ok: 'Aprovado', ajustar: 'Ajustar', feito: 'Ajustado · rever' };
const FILTROS = [['todos', 'Todos'], ['', 'Pendentes'], ['ajustar', 'Ajustar'], ['feito', 'Ajustados · rever'], ['ok', 'Aprovados']];
let itens = [], rev = {}, sel = null, filtro = 'todos', linha = '', foto = 0;

const toast = m => { const t = $('#toast'); t.textContent = m; t.classList.add('show'); clearTimeout(toast.t); toast.t = setTimeout(() => t.classList.remove('show'), 1800); };
async function api(path, body) {
  const r = await fetch('api/' + path, body === undefined ? { cache: 'no-store', credentials: 'same-origin' }
    : { method: 'POST', credentials: 'same-origin', headers: { 'Content-Type': 'application/json' }, body: JSON.stringify(body) });
  let j = null; try { j = await r.json(); } catch {}
  if (!r.ok || !j) { const e = new Error(j?.error || 'erro'); e.code = j?.error; e.status = r.status; throw e; }
  return j;
}
const status = k => rev[k]?.status || '';
const visiveis = () => itens.filter(i => (!linha || i.linha === linha) && (filtro === 'todos' || status(i.k) === filtro));

// ---------- OUTBOX embutido (render ao vivo) ----------
const frame = $('#app');
const app = () => { try { const w = frame.contentWindow; return w?.OUTBOX?.PRESETS && !w.document.body.classList.contains('auth-locked') ? w : null; } catch { return null; } };
const appPronto = new Promise(res => { const t = setInterval(() => { if (app()) { clearInterval(t); res(app()); } }, 250); });
const versao = () => ((app()?.document.getElementById('build')?.textContent || '').match(/\d{4}-\d{2}-\d{2}\.\w+/) || [''])[0];
async function mostra3D(k) {
  const w = await appPronto; $('#wait').style.display = 'none'; $('#ver').textContent = versao() ? 'versão ' + versao() : '';
  const p = w.OUTBOX.PRESETS[k]; if (!p) return;
  w.OUTBOX.loadState(w.structuredClone(p), k);
}

// ---------- lista ----------
function renderProg() {
  const box = $('#prog'); box.textContent = '';
  for (const [f, nome] of FILTROS) {
    const n = f === 'todos' ? itens.length : itens.filter(i => status(i.k) === f).length;
    const c = el('button', 'chip' + (filtro === f ? ' on' : '')); if (f !== 'todos') c.append(el('span', 'dot ' + f));
    c.append(`${nome} ${n}`); c.onclick = () => { filtro = f; renderProg(); renderList(); }; box.append(c);
  }
}
function renderList() {
  const box = $('#list'); box.textContent = ''; let cur = '';
  for (const i of visiveis()) {
    if (i.linha !== cur) { cur = i.linha; box.append(el('h3', '', cur)); }
    const r = el('div', 'it' + (sel?.k === i.k ? ' sel' : '')); r.dataset.k = i.k;
    r.append(el('span', 'dot ' + status(i.k)), el('span', 'nm', i.nome), el('em', 'n', 'p.' + i.pg)); r.title = i.nome;
    r.onclick = () => select(i.k); box.append(r);
  }
  if (!box.children.length) box.append(el('div', 'empty', 'Nada aqui com esse filtro.'));
}

// ---------- foto: arrastar para mover, roda/pinça para aproximar, duplo clique alterna inteira / 2,5× ----------
function panZoom(box, im) {
  let z = 1, x = 0, y = 0;
  const bar = el('div', 'zoomBar'), zl = el('button', 'z');
  const set = (nz, px = 0, py = 0) => { // px,py: ponto (relativo ao centro da caixa) que fica parado
    nz = Math.min(8, Math.max(1, nz)); x = px - (px - x) * nz / z; y = py - (py - y) * nz / z; z = nz;
    im.style.transform = `translate(${x}px,${y}px) scale(${z})`; zl.textContent = Math.round(z * 100) + '%';
  };
  const inteira = () => { x = y = 0; z = 1; set(1); };
  const centro = e => { const r = box.getBoundingClientRect(); return [e.clientX - r.left - r.width / 2, e.clientY - r.top - r.height / 2]; };
  const b = (t, tip, f) => { const k = el('button', '', t); k.title = tip; k.onclick = ev => { ev.stopPropagation(); f(); }; return k; };
  bar.append(b('−', 'Afastar', () => set(z / 1.5)), zl, b('+', 'Aproximar', () => set(z * 1.5)), b('Inteira', 'Ver a imagem inteira (duplo clique)', inteira));
  bar.onpointerdown = e => e.stopPropagation(); bar.ondblclick = e => e.stopPropagation(); box.append(bar); set(1);
  box.onwheel = e => { e.preventDefault(); set(z * Math.exp(-e.deltaY * (e.ctrlKey ? 0.01 : 0.0025)), ...centro(e)); };
  box.ondblclick = e => z > 1 ? inteira() : set(2.5, ...centro(e));
  const pts = new Map(); let pinch = 0;
  box.onpointerdown = e => { box.setPointerCapture(e.pointerId); pts.set(e.pointerId, [e.clientX, e.clientY]); box.classList.add('drag'); };
  box.onpointermove = e => {
    const p = pts.get(e.pointerId); if (!p) return;
    if (pts.size === 2) {
      pts.set(e.pointerId, [e.clientX, e.clientY]); const [a, c] = [...pts.values()], d = Math.hypot(a[0] - c[0], a[1] - c[1]);
      if (pinch) set(z * d / pinch, ...centro({ clientX: (a[0] + c[0]) / 2, clientY: (a[1] + c[1]) / 2 })); pinch = d; return;
    }
    x += e.clientX - p[0]; y += e.clientY - p[1]; pts.set(e.pointerId, [e.clientX, e.clientY]); set(z);
  };
  box.onpointerup = box.onpointercancel = e => { pts.delete(e.pointerId); pinch = 0; if (!pts.size) box.classList.remove('drag'); };
}

// ---------- produto selecionado ----------
function renderFotos() {
  const imgs = [...sel.fotos.map(f => ({ src: f, lbl: 'Foto do site Incom' })), ...(sel.catalogo ? [{ src: sel.catalogo, lbl: `Catálogo Incom 2026 · p.${sel.pg}`, cat: true }] : [])];
  const big = $('#big'), th = $('#thumbs'); big.textContent = ''; th.textContent = ''; big.classList.remove('zoom');
  if (!imgs.length) { big.append(el('div', 'empty', 'Sem foto deste produto.')); return; }
  foto = Math.min(foto, imgs.length - 1);
  const cur = imgs[foto], im = new Image(); im.src = cur.src; im.alt = cur.lbl; im.draggable = false; big.append(el('span', 'lbl', cur.lbl), im);
  panZoom(big, im);
  imgs.forEach((f, j) => { const b = el('button', j === foto ? 'on' : ''), t = new Image(); t.src = f.src; t.loading = 'lazy'; b.append(t); if (f.cat) b.append(el('span', 'cat', 'catálogo'));
    b.onclick = () => { foto = j; renderFotos(); }; th.append(b); });
  if (!sel.fotos.length) big.prepend(el('span', 'lbl', 'Sem foto no site — só a página do catálogo'));
}
function renderThread() {
  const box = $('#thread'); box.textContent = ''; const t = rev[sel.k]?.thread || [];
  if (!t.length) box.append(el('div', 'empty', 'Sem comentários ainda.'));
  for (const m of [...t].reverse()) {
    const d = el('div', 'msg' + (/^Claude|^Codex/.test(m.quem || '') ? ' claude' : '')), h = el('div', 'h');
    h.append(el('b', '', m.quem || '—'), new Date(m.em).toLocaleString('pt-BR', { day: '2-digit', month: '2-digit', hour: '2-digit', minute: '2-digit' }));
    if (m.build) h.append('· ' + m.build);
    if (m.status != null) h.append(el('span', 'tag ' + (m.status || 'x'), ST[m.status] || m.status));
    d.append(h); if (m.texto) d.append(el('p', '', m.texto)); box.append(d);
  }
}
function renderDecide() {
  $('#nome').textContent = sel.nome;
  $('#meta').textContent = [sel.linha, 'catálogo p.' + sel.pg, sel.variante, ST[status(sel.k)]].filter(Boolean).join(' · ');
  $('#bOk').classList.toggle('on', status(sel.k) === 'ok'); $('#bAj').classList.toggle('on', status(sel.k) === 'ajustar');
  renderThread();
}
function select(k) {
  sel = itens.find(i => i.k === k); if (!sel) return; foto = 0;
  history.replaceState(null, '', '#' + encodeURIComponent(k));
  document.querySelectorAll('.it').forEach(r => r.classList.toggle('sel', r.dataset.k === k));
  document.querySelector(`.it[data-k="${CSS.escape(k)}"]`)?.scrollIntoView({ block: 'nearest' });
  renderFotos(); renderDecide(); mostra3D(k);
}
function anda(d) { const v = visiveis(), i = v.findIndex(x => x.k === sel?.k); const n = v[(i + d + v.length) % v.length]; if (n) select(n.k); }

// ---------- decisão ----------
async function envia(st) {
  const texto = $('#txt').value.trim();
  if (st === undefined && !texto) return toast('Escreva o comentário ou escolha Aprovar / Ajustar');
  if (st === 'ajustar' && !texto && !(rev[sel.k]?.thread || []).length) { $('#txt').focus(); return toast('Conte o que ajustar'); }
  const k = sel.k;
  try {
    const r = await api('revisao.php?a=set', { k, ...(st !== undefined ? { status: st } : {}), texto, build: versao() });
    rev[k] = { ...rev[k], status: r.status, thread: r.thread }; $('#txt').value = '';
    renderProg(); renderList(); if (sel.k === k) renderDecide();
    toast(st === 'ok' ? 'Aprovado' : st === 'ajustar' ? 'Pedido de ajuste enviado' : 'Comentário enviado');
    if (st === 'ok') { const v = visiveis(), i = v.findIndex(x => x.k === k), prox = v.slice(i + 1).find(x => status(x.k) !== 'ok') || v.find(x => status(x.k) !== 'ok'); if (prox) select(prox.k); }
  } catch (e) { toast(e.status === 401 ? 'Entre no OUTBOX de novo' : 'Não consegui salvar — tente de novo'); }
}
$('#bOk').onclick = () => envia('ok');
$('#bAj').onclick = () => envia('ajustar');
$('#bSend').onclick = () => envia();
$('#bPrev').onclick = () => anda(-1); $('#bNext').onclick = () => anda(1);
$('#txt').addEventListener('keydown', e => { if (e.key === 'Enter' && (e.metaKey || e.ctrlKey)) { e.preventDefault(); envia(); } });
addEventListener('keydown', e => {
  if (/TEXTAREA|INPUT|SELECT/.test(document.activeElement?.tagName)) return;
  if (e.key === 'ArrowRight' || e.key === 'j') anda(1); else if (e.key === 'ArrowLeft' || e.key === 'k') anda(-1);
  else if (e.key === 'a') envia('ok'); else if (e.key === 'r') { e.preventDefault(); $('#txt').focus(); }
});
$('#linha').onchange = e => { linha = e.target.value; renderList(); };

// ---------- início ----------
try {
  const [lista, r] = await Promise.all([fetch('assets/revisao/itens.json?v=2').then(x => x.json()), api('revisao.php?a=list')]);
  itens = lista; rev = r.itens || {};
} catch (e) {
  const g = el('div', 'gate'), c = el('div');
  c.append(el('b', '', e.status === 401 ? 'Entre no OUTBOX primeiro' : 'Não consegui abrir a aprovação'),
    el('p', '', e.status === 401 ? 'A aprovação usa o seu login da equipe para guardar o que você decidir.' : 'O servidor não respondeu. Tente de novo em instantes.'));
  const a = el('a', '', 'Abrir o OUTBOX'); a.href = 'index.html'; c.append(a); g.append(c); document.body.append(g);
  throw e;
}
const ls = $('#linha'); ls.append(new Option('Todas as linhas', '')); [...new Set(itens.map(i => i.linha))].forEach(l => ls.append(new Option(l, l)));
renderProg(); renderList();
const h = decodeURIComponent(location.hash.slice(1));
select(itens.some(i => i.k === h) ? h : (itens.find(i => !status(i.k)) || itens[0]).k);
