// Teste de fumaça do OUTBOX: abre a ferramenta num navegador sem tela, monta todos os
// modelos prontos, testa vidro + líquido, relevo, lado a lado e explodir, e exporta PNG
// e GLB. Qualquer erro na página (ou modelo sem malha) reprova.
//
//   npm test                         (usa o Chromium do Playwright)
//   OUTBOX_CDN_DIR=…/node_modules npm test   (sem internet: three e cia. de uma pasta local)
//   CHROMIUM_PATH=/caminho/chromium npm test
import { chromium } from 'playwright';
import http from 'node:http';
import fs from 'node:fs';
import path from 'node:path';
import { fileURLToPath } from 'node:url';

const ROOT = path.resolve(path.dirname(fileURLToPath(import.meta.url)), '..');
const CDN = process.env.OUTBOX_CDN_DIR;
const TYPES = { '.html': 'text/html', '.js': 'text/javascript', '.mjs': 'text/javascript', '.css': 'text/css', '.png': 'image/png', '.svg': 'image/svg+xml', '.json': 'application/json' };

// Servidor estático: sem PHP a ferramenta entra no modo local (sem login), que é o que o teste usa.
const server = http.createServer((req, res) => {
  const u = decodeURIComponent(new URL(req.url, 'http://x').pathname);
  if (u.startsWith('/api/')) { res.writeHead(404, { 'Content-Type': 'text/plain' }); return res.end('sem api'); }
  const f = path.join(ROOT, u === '/' ? 'index.html' : u);
  if (!f.startsWith(ROOT) || !fs.existsSync(f) || fs.statSync(f).isDirectory()) { res.writeHead(404); return res.end(); }
  res.writeHead(200, { 'Content-Type': TYPES[path.extname(f)] || 'application/octet-stream' });
  fs.createReadStream(f).pipe(res);
});
await new Promise(r => server.listen(0, '127.0.0.1', r));
const base = `http://127.0.0.1:${server.address().port}/`;

const errors = [], fail = m => { errors.push(m); console.log('  ✗ ' + m); }, ok = m => console.log('  ✓ ' + m);
const browser = await chromium.launch({ executablePath: process.env.CHROMIUM_PATH || undefined, args: ['--use-gl=swiftshader', '--enable-unsafe-swiftshader'] });
const page = await browser.newPage({ viewport: { width: 1280, height: 860 }, acceptDownloads: true });
page.on('pageerror', e => fail('erro na página: ' + e.message));
page.on('console', m => { if (m.type() === 'error' && !/Failed to load resource|sem api|404/.test(m.text())) fail('console: ' + m.text().slice(0, 200)); });
if (CDN) await page.route(/^https:\/\/(cdn\.jsdelivr\.net|fonts\.)/, async r => {
  const u = new URL(r.request().url()); if (!u.host.startsWith('cdn')) return r.fulfill({ status: 200, body: '' });
  let p = u.pathname.replace(/^\/npm\//, '').replace(/^((@[^/]+\/)?[^/@]+)@[^/]+/, '$1'); if (p.endsWith('/+esm')) p = p.replace('/+esm', '/build/mp4-muxer.mjs');
  try { r.fulfill({ status: 200, contentType: 'application/javascript', body: fs.readFileSync(path.join(CDN, p)) }); } catch { r.fulfill({ status: 404 }); }
});

await page.goto(base);
await page.waitForFunction(() => window.OUTBOX && !document.body.classList.contains('auth-locked'), null, { timeout: 60000 });
console.log('Abriu', await page.evaluate(() => document.querySelector('#build')?.textContent));

// 1. todos os modelos prontos montam, com malha e medidas válidas
const names = await page.evaluate(() => Object.keys(window.OUTBOX.PRESETS));
console.log(`Modelos prontos: ${names.length}`);
for (const n of names) {
  const r = await page.evaluate(n => {
    const O = window.OUTBOX; O.loadState(structuredClone(O.PRESETS[n]), n);
    let meshes = 0, tris = 0; O.product.traverse(o => { if (o.isMesh && o.visible) { meshes++; const g = o.geometry; tris += (g.index ? g.index.count : g.attributes.position.count) / 3; } });
    let h = 0; O.product.traverse(o => { if (o.isMesh && o.geometry.attributes.position) { o.geometry.computeBoundingBox(); h = Math.max(h, o.geometry.boundingBox.max.y); } });
    const v = O.volumes(O.S);
    return { meshes, tris: Math.round(tris), h, cap: v.cap };
  }, n);
  if (!r.meshes || !(r.h > 0) || !Number.isFinite(r.h)) fail(`${n}: sem malha ou medida inválida ${JSON.stringify(r)}`);
}
ok('modelos prontos montam');

// 2. vidro + líquido, relevo, lado a lado, explodir
const first = names.find(n => /Précieux/.test(n)) || names[0];
const step = async (label, fn) => { try { await page.evaluate(fn); await page.waitForTimeout(800); ok(label); } catch (e) { fail(`${label}: ${e.message}`); } };
await page.evaluate(n => { const O = window.OUTBOX; O.loadState(structuredClone(O.PRESETS[n]), n); }, first);
await step('vidro + líquido', () => { const O = window.OUTBOX, m = O.S.modules.find(q => q.vol); Object.assign(m, { own: true, color: '#4a7d5c', finish: 'vidro', liq: true, liqType: 'perfume', liqLevel: 80 }); O.build(); });
await step('vidro jateado + líquido transparente', () => { const O = window.OUTBOX, m = O.S.modules.find(q => q.vol); Object.assign(m, { finish: 'vidroFosco', liqType: 'transparente' }); O.build(); });
await step('relevo por textura (padrão bolinhas)', async () => {
  const O = window.OUTBOX, i = O.S.modules.findIndex(q => q.vol); O.sel = i;
  const s = [...document.querySelectorAll('select')].find(x => x.querySelector('option[value="bolinhas"]'));
  if (!s) throw new Error('lista de padrões não encontrada'); s.value = 'bolinhas'; s.dispatchEvent(new Event('change'));
  for (let k = 0; k < 40 && !O.S.modules[i].reliefImg; k++) await new Promise(r => setTimeout(r, 250));
  if (!O.S.modules[i].reliefImg) throw new Error('textura não aplicada');
});
await step('lado a lado', () => { document.querySelector('#lineAdd').value = '__atual'; document.querySelector('#lineAddBtn').click(); });
await step('explodir e voltar', () => { document.querySelector('#explodeBtn').click(); document.querySelector('#explodeBtn').click(); });
await step('trocar aba e peça', () => { const O = window.OUTBOX; ['lib', 'build', 'color', 'scene'].forEach(t => O.setSideTab(t)); O.sel = 0; });

// 3. exportar GLB e PNG (pequeno)
const dl = async (label, sel, prep) => {
  try {
    await page.evaluate(prep || (() => {}));
    const [d] = await Promise.all([page.waitForEvent('download', { timeout: 120000 }), page.evaluate(sel => setTimeout(() => document.querySelector(sel).click(), 10), sel)]);
    const f = await d.path(), size = fs.statSync(f).size;
    size > 1000 ? ok(`${label} (${Math.round(size / 1024)} KB)`) : fail(`${label}: arquivo vazio`);
  } catch (e) { fail(`${label}: ${e.message}`); }
};
await dl('exportar GLB', '#dlGlb');
await dl('exportar PNG', '#dlPng', () => { const s = document.querySelector('#pngRes'); s.insertAdjacentHTML('beforeend', '<option value="512">512</option>'); s.value = '512'; document.querySelector('#pngSplit').value = 'tudo'; });

await browser.close(); server.close();
console.log(errors.length ? `\nFALHOU: ${errors.length} problema(s)` : '\nTudo certo');
process.exit(errors.length ? 1 : 0);
