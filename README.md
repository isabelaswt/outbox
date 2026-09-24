# OUTBOX

Gerador paramétrico de frascos e potes por **módulos empilhados**, direto no navegador.

- Cada módulo (corpo, esfera, tigela, disco, anel, domo, seixo, flare…) tem sliders de forma,
  arredondamento, encaixe, linha de abertura, entalhe frontal e frisos.
- Volumetria ao vivo: volume externo e capacidade estimada (desconta a parede), e ajuste para um volume-alvo.
- Referência: imagem ou desenho técnico sobreposto em escala de mm (vista Frente · ortográfica).
- Exporta PNG (até 4096 px, fundo transparente), GLB (metros), OBJ e STL (mm), e o modelo em JSON.

## Como abrir

```
python3 -m http.server 8765
```

e acessar http://localhost:8765. Precisa de internet (o Three.js vem do CDN jsDelivr).
Modelos salvos ficam no navegador; use **JSON ↓** para guardar ou compartilhar um modelo.
