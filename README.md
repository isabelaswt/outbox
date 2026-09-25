# Outbox

Outbox e uma ferramenta web para montar embalagens cosmeticas em 3D por modulos parametricos. A ideia e permitir que uma pessoa construa frascos, bisnagas, tampas, bombas, pumps, relevos e acabamentos direto no navegador, com controles editaveis e exportacao para imagem ou arquivo 3D.

Estado atual: versao `2026-09-25.bisnaga-polida`, commit `4797f53`.

## Como rodar

```bash
python3 -m http.server 8766
```

Depois abra:

```text
http://localhost:8766/?v=bisnaga-polida-4797f53
```

O app e estatico e usa Three.js via CDN. Precisa de internet para carregar as dependencias do CDN.

## Login

Ha um bloqueio simples de entrada no front-end:

- Login: `swt`
- Senha: `swt12345`

Importante: isso e apenas uma protecao visual/local no navegador. Para producao, trocar por autenticacao real no servidor.

## O que a ferramenta ja faz

- Montagem por modulos empilhados: corpo, gargalo, tampa, pump, spray, bisnaga, esfera, disco, taca, domo, seixo e outros.
- Interface clara, com plataforma bege como material padrao.
- Sliders para altura, largura, profundidade, arredondamento, taper, barriga, frisos, linha de abertura, entalhe e detalhes de valvula.
- Bisnagas com corpo achatando ate a solda, serrilhado e tampa embaixo para ficar de ponta cabeca.
- Tampas esfera para bisnaga com controle de raio para manter a forma arredondada.
- Pumps e valvulas: spray fino, pump locao, pump locao com frisos, pump espuma, pump escultural, conta-gotas, push-pull, bico dosador e push-pull esportiva.
- Pescante translucido quando aplicavel; bisnaga nao usa pescante.
- Logo/SVG aplicado na superficie com relevo para fora ou para dentro, com melhoria para suavizar serrilhado em curvas.
- HDR para iluminar preview e PNG exportado, com controle de rotacao e intensidade.
- Exportacao de PNG, GLB, OBJ, STL e JSON do modelo.
- Modelos Draft reconstruidos como perfis parametricos em `draft/perfis.json`.

## Arquivos principais

- `index.html`: aplicacao inteira, UI, geometria 3D, render, exportadores e login.
- `assets/logo_outbox.svg`: logo usado no login.
- `draft/perfis.json`: perfis medidos dos produtos Draft.
- `tools/perfis.py`: script que gera `draft/perfis.json` a partir dos OBJs locais.
- `tools/draft_table.json`: tabela de medidas/produtos Draft.

## Pontos recentes de ajuste

- Tema voltou para claro; o login continua com visual preto.
- A cor padrao da plataforma e sempre bege.
- Bico dosador foi ajustado para uma construcao mais alta e conica.
- Push-pull e push-pull esportivo receberam proporcoes/frisos mais consistentes.
- Bisnaga foi polida: solda menos larga, serrilhado mais suave e tampa inferior mais integrada.

## Proximos cuidados

- Revisar visualmente a bisnaga em pe na tampa. O objetivo e parecer uma bisnaga real apoiada na tampa, sem a tampa virar uma pecinha solta.
- Refinar pump espuma e pump locao com frisos a partir das referencias visuais.
- Se o login virar requisito real de produto, implementar auth fora do front-end.
- Antes de validar visualmente, sempre abrir com um cache-buster novo no `?v=...`, porque o navegador pode manter uma versao antiga.

## Validacao rapida

Como o app esta em um unico HTML, uma checagem util e extrair o script de modulo e validar sintaxe:

```bash
perl -0ne 'print $1 if /<script type="module">(.*)<\/script>/s' index.html > /tmp/outbox-index-script.mjs
node --check /tmp/outbox-index-script.mjs
```

Tambem verificar o diff antes de subir:

```bash
git diff --check
git status --short
```
