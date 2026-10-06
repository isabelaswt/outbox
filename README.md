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

## Login e modelos salvos (PHP + MySQL na Hostinger)

Cada pessoa da equipe entra com e-mail e senha e ve so os proprios modelos. O servidor fica em `api/` (PHP + MySQL). Sem PHP (ex.: `python3 -m http.server`) o app abre direto e salva so no navegador.

Configuracao na Hostinger (uma vez):

1. hPanel → Bancos de dados → MySQL: crie um banco e um usuario (anote nome do banco, usuario e senha).
2. Gerenciador de arquivos → `public_html/api/`: copie `config.sample.php` para `config.php` e preencha com esses dados. O `config.php` fica fora do git.
3. Abra `https://SEU-SITE/api/setup.php`: ele cria as tabelas e a primeira conta de administrador. Depois disso a pagina se desliga sozinha.
4. Entre no OUTBOX. Em **Equipe**, adicione cada pessoa (nome + e-mail) e mande para ela o link gerado; ela cria a propria senha. O link vale 7 dias e so funciona uma vez. Para quem esqueceu a senha, gere um novo link.

Seguranca: senhas com `password_hash`; sessao em cookie httponly/SameSite=Strict; escritas so via JSON; 5 erros de senha no mesmo e-mail (ou 30 no mesmo IP) travam por 15 minutos; `api/.htaccess` bloqueia os arquivos internos.

Teste local com PHP: `php -S 127.0.0.1:8767 -t .` e um `api/config.php` apontando para um MySQL local.

## O que a ferramenta ja faz

- Montagem por modulos empilhados: corpo, gargalo, tampa, pump, spray, bisnaga, esfera, disco, taca, domo, seixo e outros.
- Interface clara, com plataforma bege como material padrao.
- Sliders para altura, largura, profundidade, arredondamento, taper, barriga, frisos, linha de abertura, entalhe e detalhes de valvula.
- Bisnagas com corpo achatando ate a solda, serrilhado e tampa embaixo para ficar de ponta cabeca.
- Tampas esfera para bisnaga com controle de raio para manter a forma arredondada.
- Pumps e valvulas: spray fino, pump locao, pump locao com frisos, pump espuma, pump escultural, conta-gotas, push-pull, bico dosador e push-pull esportiva.
- Pescante translucido quando aplicavel; bisnaga nao usa pescante.
- Logo/SVG aplicado na superficie com relevo para fora ou para dentro, com melhoria para suavizar serrilhado em curvas.
- Texturas de relevo salvas na biblioteca da equipe (banco), com tamanho e força, para reaproveitar em outros frascos.
- Materiais da equipe (cor + acabamento + difusão + IOR) salvos com nome, para aplicar no produto ou numa peça.
- Painel em abas (Biblioteca, Montar, Cor, Cena), arquivo sempre no topo, Exportar e Mais em painéis ao lado, e a peça selecionada num painel à direita com forma, cor, relevo por textura, logo e rótulo juntos.
- Lixeira (Mais ▾): projetos, STL, texturas, materiais e HDR excluídos ficam 30 dias para restaurar ou apagar de vez.
- Lado a lado arrastando: solte um card da galeria na cena, a esquerda ou a direita do que ja esta nela.
- HDR ou EXR para iluminar preview e PNG exportado, com controle de rotacao e intensidade; ficam guardados no banco para a equipe toda (em pedacos, api/hdr.php) e o projeto reabre com o seu.
- Sombra de contato de estudio: linha escura onde o produto encosta e penumbra larga e difusa em volta, seguindo o formato real da base (vidro projeta sombra mais clara).
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
- Spray gatilho refeito como mini gatilho de catalogo: virola lisa, anel de trava, cilindro do pistao a mostra, cabeca em arco com pino, perna traseira, bico cilindrico, alavanca em lamina e trava lateral.
- Novo acabamento `Vidro semi-jateado (acetinado)`, entre o vidro transparente e o jateado.
- Acabamento `PET fosco (jateado)`: plastico leitoso de parede fina.
- Gargalo em vidro/PET fica no topo do corpo e a boca abre para dentro (sem fundo falso).
- Conteudo do corpo alem do liquido: capsulas (duas cores), comprimidos, gomas, perolas/esferas e sais/granulado, com tamanho, nivel e cores.
- Tampa gloss com aplicador (haste + ponta de feltro curva, com comprimento, largura, curva e cor) e modelo `Gloss labial`.
- Modelo `Stick com sobretampa`: base opaca, bastao do produto e sobretampa translucida ate a base.
- Acabamento `PET semi-fosco (translucido)`; espessura da parede muda o visual de vidros/PET.
- Rotulo vai na peca selecionada (corpo ou tampa).
- Arrastar um card para uma aba muda a aba dele (salvos: gravado no modelo; base: vale para a equipe toda, via api/settings.php). Grupos de controles comecam fechados ao abrir um produto.
- Galeria de modelos com abas: Frascos, Potes, Perfumes, Pump e gatilho, Conta-gotas, Bisnagas, Beauty (gloss, stick, batom) e Salvos.
- Video artistico de detalhes: ~30 s, fade cruzado entre as tomadas e o frasco deitado nos dois ultimos takes.
- Oclusao de ambiente (GTAO): junções, frestas e contato com o chao escurecem de leve, como foto real; liga/desliga e forca em Apresentacao.
- Luzes novas: Macia (foto de produto limpa, e-commerce e render de marca) e Lateral recortada (luz projetada, sombra de um lado), cada uma com o fundo combinando.
- Controles de Difusao (liso a difuso, qualquer acabamento) e IOR do vidro, no geral e por peca; vidro refrata pelo volume (tampa macica e frasco), com a cavidade da tampa visivel.
- Rotulo: arte com cor e acabamento proprios (PNG sem fundo, ex.: hot stamping metalizado), com ou sem papel.
- Rotulo: a arte vai por cima da cor do papel (a cor aparece onde a imagem e transparente, sem tingir a arte).

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
