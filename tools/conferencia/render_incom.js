// Cola no console do OUTBOX aberto (http://127.0.0.1:8766) com tools/conferencia/recv.py rodando.
// Renderiza os modelos Incom e manda imagem + medidas (fechado) para o receptor, que grava em _ref/incom/renders.
// Compactos, paletas e batons saem abertos (3/4); o resto de frente.
// FILTRO: troque a regex para renderizar só uma linha, ex.: /^Incom .*\(frascos\)$/
(async (FILTRO = /^Incom /) => {
  const O = window.OUTBOX, cv = O.renderer.domElement, caps = {};
  const slug = k => k.normalize('NFD').replace(/[̀-ͯ]/g, '').replace(/[^a-zA-Z0-9]+/g, '_');
  const send = (name, body) => fetch('http://127.0.0.1:8799/save?name=' + name, { method: 'POST', body });
  const ks = Object.keys(O.PRESETS).filter(k => FILTRO.test(k));
  window.CONF = { done: 0, total: ks.length, err: [] };
  for (const k of ks) {
    try {
      O.loadState({ ...structuredClone(O.PRESETS[k]), side: [], logos: [] }, k); O.S.side = []; O.S.logos = []; O.S.aberto = false; O.build();
      const isCap = /\(tampa de perfume\)/.test(k), idx = O.S.modules.length - 1;
      const all = { mn: 1e9, mx: -1e9, xn: 1e9, xx: -1e9, zn: 1e9, zx: -1e9 }, cap = { ...all };
      const grow = (b, bb) => { b.mn = Math.min(b.mn, bb.min.y); b.mx = Math.max(b.mx, bb.max.y); b.xn = Math.min(b.xn, bb.min.x); b.xx = Math.max(b.xx, bb.max.x); b.zn = Math.min(b.zn, bb.min.z); b.zx = Math.max(b.zx, bb.max.z); };
      O.product.traverse(o => { if (o.isMesh && !o.userData.liquid && !o.userData.logo) { o.geometry.computeBoundingBox(); const bb = o.geometry.boundingBox.clone().applyMatrix4(o.matrixWorld); grow(all, bb); if (isCap && o.userData.idx === idx) grow(cap, bb); } });
      if (isCap) caps[k] = [+(cap.xx - cap.xn).toFixed(1), +(cap.zx - cap.zn).toFixed(1), +(cap.mx - cap.mn).toFixed(1)];
      const f = O.S.modules.find(m => m.fH) || {}, opn = /\((compactos|paletas|batons)\)/.test(k);
      if (opn) { O.S.aberto = true; O.build(); }
      document.querySelector(`[data-view="${opn ? 'three' : 'front'}"]`)?.click();
      await new Promise(r => setTimeout(r, 80)); O.render();
      await send(slug(k), cv.toDataURL('image/jpeg', 0.9));
      await send(slug(k), JSON.stringify({ k, W: +(all.xx - all.xn).toFixed(1), D: +(all.zx - all.zn).toFixed(1), H: +(all.mx - all.mn).toFixed(1), fW: f.fW, fD: f.fD, fH: f.fH, mat: f.fmat, vol: f.fterm, pg: f.fpg, aberto: opn }));
    } catch (e) { window.CONF.err.push(k + ': ' + e.message); }
    window.CONF.done++;
  }
  if (Object.keys(caps).length) await send('_caps', JSON.stringify(caps));
  window.CONF.fim = true;
})();
