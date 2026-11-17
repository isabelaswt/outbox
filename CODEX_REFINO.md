# Refino das modelagens Incom — briefing para o Codex

Você vai trabalhar junto com o Claude na biblioteca **Incom** do OUTBOX. Ela tem 186 itens: 116 produtos e 67 tampas de perfume, mais as variantes "Abaulada" dos batons Long. O objetivo é que cada modelo 3D fique **igual ao catálogo Incom 2026**:

- a forma bate com a foto e com o desenho técnico;
- as medidas fechadas são as do catálogo.

A dona do projeto confere tudo com lupa ("pente fino"). Ela pede: "sem inventar nada", "medidas exatamente iguais".

Leia este arquivo inteiro antes de mexer. As regras da seção 1 não são opcionais.

---

## 1. Regras de trabalho (obrigatórias)

1. **Responder sempre em português do Brasil**, nas mensagens de commit também.
2. **Duas IAs trabalham na mesma pasta e no mesmo repositório** (`isabelaswt/outbox`, branch `main`).
   - Antes de cada commit: `git fetch` e confira `git log HEAD..origin/main`.
   - Se houver commit novo, faça `git pull --rebase` antes de continuar.
   - Nunca sobrescreva trabalho do outro com uma versão sua mais antiga.
   - Se encontrar mudança sem commit que não é sua, ela é do Claude em andamento: não apague nem reverta.
3. **Cada ajuste vira um commit curto em pt-BR, com push direto em `main`**, sem pedir aprovação. O deploy é automático (outbox.swtool.co).
   - Termine a mensagem com a linha de coautoria que o seu ambiente usar.
4. **Carimbo de versão a cada publicação.** Troque o mesmo texto em três lugares:
   - `BUILD` em `js/app.js`;
   - a query `incom.js?v=` no `import` do topo de `js/app.js`;
   - os `?v=` do css e do js em `index.html`.
   - Formato: `AAAA-MM-DD.sufixo` (hoje está `2026-11-17.cmpNN`). Para não colidir com o Claude, use sufixo próprio, por exemplo `2026-11-18.cdx1`, `cdx2`…
5. **Os modelos base ficam bege** (`BEIGE`, acabamento fosco). Peças transparentes do catálogo ficam com `own: true` e acabamento próprio (`pet` ou `cristal`). Não troque a cor padrão.
6. **Mudança de aparência só em passos pequenos, um de cada vez, mostrando antes e depois.**
   - Materiais já aprovados, que não devem mudar sem pedido: o vidro e o PET dos frascos, e o líquido.
   - O acabamento `cristal` (seção 4) foi criado só para os compactos de cristal.
7. **Não inventar.**
   - A medida vem do catálogo. Use o texto do PDF, o desenho técnico com cotas e o tamanho da bandeja (godê) informado.
   - Na falta disso, meça na foto, proporcionalmente a uma medida conhecida, e escreva no comentário do código que foi medido na foto.
   - Se nem a foto mostra (por exemplo, a vista lateral), deixe como está e registre na seção 7 como pendência.
8. **Comentários no código em pt-BR, curtos, dizendo de onde veio a decisão:** foto, desenho, medida do catálogo ou pedido da dona.
9. **Não empilhe regras repetidas.** Antes de criar um bloco novo, procure se já existe um parecido e consolide.

## 2. Divisão de trabalho (para não colidir)

Para começar, sugerimos esta divisão. A dona pode trocar.

| Quem | Linhas do catálogo (`r.c` em `incomProduct`) |
|---|---|
| **Codex** | Batons, Líquidos labiais, Máscaras, Sticks, Conta-gotas, Dispensadores, Deluxes, Potes, Tampas de perfume |
| **Claude** | Compactos, Paletas, Frascos, Frasnagas e a lista de fechamentos (válvulas e tampas) |

Funções compartilhadas (`moduleGeo`, `sprayGeo`, `material`, `compactParts`):

- antes de mexer, avise na seção 8 ("Em andamento");
- prefira opções novas por peça (um campo `m.algo`) a mudar o comportamento padrão de todo mundo.

## 3. Como rodar e conferir

- **App:** `python3 -m http.server 8766` na raiz do projeto.
  - Abra `http://127.0.0.1:8766`. Use `127.0.0.1`, não `localhost`: em `localhost` aparece a tela de login.
- **API de depuração no console:** `window.OUTBOX`, com `S` (estado), `build()`, `render()`, `PRESETS`, `LIB`, `loadState(estado, nome)`, `product`, `renderer`.
  - Os modelos Incom estão em `PRESETS` com o nome `Incom <Nome> (<linha>)`.
  - Exemplo: `Incom Case M (compactos)`, `Incom Chelsea (tampa de perfume)`.
  - Para abrir aberto: `S.aberto = true; build()`.
  - Câmera: clique nos botões `[data-view="front|side|three|top"]`.
- **Catálogo Incom 2026 (PDF):** `_ref/incom/catalogo-incom-2026.pdf`. Fica fora do git (`_ref/` está no `.gitignore`).
  - O número da página de cada produto está no campo `pg` de `js/incom.js`.
  - Para tirar texto e imagens dele, use PyMuPDF (`import fitz`).
- **PDF de conferência lado a lado** (foto do catálogo × render): `OUTBOX x Catalogo Incom 2026.pdf`, na raiz. Também fica fora do git.
  - Para refazer:
    1. `python3 tools/conferencia/recv.py _ref/incom/renders` (deixe rodando: é o receptor, na porta 8799).
    2. No console do app aberto, cole `tools/conferencia/render_incom.js`. O `FILTRO` no fim do arquivo deixa renderizar só uma linha.
    3. `python3 tools/conferencia/build_pdf.py` monta o PDF.
  - O PDF mostra as medidas do catálogo e as do modelo **fechado**.
  - Se o filtro pegar só parte das tampas de perfume, o `_caps.json` (as medidas delas) é sobrescrito só com essas. Para o PDF ficar certo, renderize todas as tampas de uma vez.
- **Teste:** `npm test` só roda no GitHub Actions; não há `node_modules` local. Para conferir a sintaxe: `node --check js/app.js`.

## 4. Mapa do código (`js/app.js`, cerca de 10 mil linhas; os números são aproximados, procure pelo nome)

| O quê | Onde |
|---|---|
| Dados do catálogo (produtos, tampas, perfis extraídos do desenho, bandejas dos godês) | `js/incom.js`: `INCOM_PRODUCTS`, `INCOM_CAPS`, `INCOM_PROD_PROF`, `INCOM_CAP_PROF`, `INCOM_TRAYS` |
| Biblioteca de peças (corpos, tampas, válvulas) | `const LIB` (~l. 312); menus de Peças em `const CATS` (~l. 8090) |
| Montagem de cada produto Incom | `function incomProduct(r)` (~l. 8691). Usa o helper `P(nome, W, D, h, opções)`; `_t: [t0, t1]` corta a fatia do perfil do desenho; `switch (r.t)` por tipo (`cq`/`cqr`/`cr` compactos, `fr*` frascos, `frn*` frasnagas, `gloss`, `pote`, `stick`…). Os ajustes por foto ficam depois do `switch` |
| Tampas de perfume | `incomShape`, `CAP_FIX` (correções por tampa, ~l. 416) e a passada de medida exata antes de `INCOM_CAPS.forEach` (~l. 582), que ajusta W/D/h dentro de ±5% |
| Geometria geral de uma peça | `moduleGeo` (~l. 2262); válvulas em `sprayGeo` (~l. 1760, um ramo por `sprayType`) |
| Godês, espelho, visor, aba, degrau (compactos e paletas) | `compactParts` (~l. 5828). Formatos dos godês: `godesOf`, `QUINTETO`, `TRAY_MM` (tamanho da bandeja em mm), `godeFundo` (rebaixo) |
| Oco da tampa, abertura do dedo, dobradiça | `ocoGeo`, `dedoGeo` (com `rect`, `arc`, `bottom`), `arcSlab`, `setHinge` |
| Tampa Sens (disc-top) | `sensCapGeo` (~l. 2227) |
| Materiais | `material(color, finish, …)` (~l. 3845); `cristal` (acrílico dos compactos) em ~l. 3923 |
| Versão | `const BUILD` (~l. 593) |

Ferramentas internas úteis:

- `cutHole(peça, cortador)` devolve `[fora, dentro]`; `mergeLoose(lista)` junta as partes.
- Cortes coplanares travam o CSG. Sempre deixe uma folga de 0,05 mm ou mais.
- `THUMB_LITE` pula o CSG nas miniaturas.
- `cutCached(tipo, chave, …)` guarda os cortes.

## 5. Decisões já tomadas pela dona (não desfazer)

- **Medidas:** cada produto Incom tem de bater com o catálogo **fechado**.
  - Nos frascos, o catálogo mede só frasco + gargalo; o fechamento soma por cima.
  - Nas tampas de perfume, Chelsea, Soho e Manhattan têm na altura do catálogo a válvula de metal aparente.
  - Crown, Dora e Domini têm largura estimada no catálogo.
- **Compactos e paletas:**
  - Godês sempre afundados na base, nunca rentes. A exceção é o Case (abaixo).
  - O pó enche a bandeja quase até a borda, com aro fino.
  - Cantos dos godês arredondados.
  - Paletas: abertura do dedo retangular.
  - Dobradiças desenhadas; slider de abrir.
  - O logo acompanha a tampa e pode ir no pó.
- **Case G, Case M, Case M All Crystal e Moon M All Crystal:** a base é uma placa fina e o godê fica em cima, saltado, num colar. Nos cristal, a latinha de alumínio aparece inteira.
- **Case G/M/All Crystal (foto enviada em 17/11/2026):** topo do godê, produto e colar circular no mesmo nível. O conjunto continua elevado sobre a placa fina da base; não deixar a latinha saltada acima do colar.
- **Frame:** corpo e godê em superelipse (quadrado de lados curvos, n = 4). O visor tem borda fina. O losango do Quinteto tem 20,4 mm.
- **Redondos (Moon, Macaroon, Moon Deck):** o fechamento é uma língua curva da parede da tampa, rente à superfície, encaixada no rebaixo da base. Não é um bloco saltado.
- **Cristal:** acabamento `cristal`, com borda azul-lilás, reflexo e camadas sobrepostas. As tampas redondas de cristal têm anel interno.
- **Paletas Big e Flat:** degrau (patamar dos godês mais alto que a borda; a tampa desce até ela). As Flat têm na tampa uma faixa sem espelho com dois encaixes. O Flat Duo tem bandejas de tamanhos diferentes.
- **Tampa Sens:**
  - Topo reto, com o disco rente.
  - Disco alto, que preenche o U (pelo U não pode aparecer buraco nem o interior).
  - Sem furo em cima do disco.
  - Tigela larga em cima, curva de fundo e pé que afina.
  - No New York: largura 72,7% da do frasco, altura 42,4% dela.
- **Fechamentos dos frascos:** cada frasco usa o fechamento que aparece na foto dele.
  - Amsterdam: tampa tambor.
  - New York: Tampa Sens.
  - Bulb Blow 250: tampa bola sobre colar.
  - Bulb Blow 300: bico de pato.
  - Wall: flip-top transparente.
  - Os outros: spray.
- **Já recusado:** sobretampa com parede dupla; válvula spray onde o catálogo mostra pump dosadora; base sólida onde o catálogo mostra placa com godê saltado.

## 6. Backlog de refino (comece por aqui)

Linhas que ainda não passaram pelo pente fino desta rodada. Compare cada página do PDF de conferência, olhando forma, proporção e detalhes da foto:

- **Batons:** visor e base de cor; as variantes Lipview, Spy e Abaulada; a altura do tubo metálico.
- **Líquidos labiais e máscaras:** proporção da tampa × frasco, aplicador e haste; Oscar All Crystal com o gargalo aparecendo pela tampa.
- **Sticks:** proporção base × tampa e o bastão.
- **Conta-gotas, Dispensadores, Deluxes:**
  - colar, pipeta, pump dosadora e sobretampa;
  - as Deluxes (págs. 58, 60 e 62) listam os mesmos fechamentos dos frascos, mas ainda usam o fechamento antigo.
- **Potes:** rosca, tampa e espessura de parede (as de acrílico são grossas).
- **Tampas de perfume:**
  - recortes, facetas e furos de Golden, Wheel, Thenue, Rock, Drop e Joya;
  - as 7 tampas que estão fora da medida exata, pelos motivos da seção 5.

Pendências conhecidas (precisam de dado ou de decisão; não invente):

- Moon M (bandeja Claris CH01F): o catálogo não traz a medida do godê.
- Moon M All Crystal: o godê de Ø56 mm foi medido na foto.
- Charlotte: a profundidade sai do volume, porque o catálogo não tem vista lateral.
- Sydney 60: seção redonda.
- Espumadora: ficou quase igual à dosadora.
- New York: a foto que a dona mandou é do frasco de 250 ml, e o catálogo tem o de 200 ml.
- Flat Duo: a bandeja 2 (~38 × 42 mm) foi medida na foto.
- Fine mist big: no ícone da Incom ele é preto translúcido, mas aqui fica na cor padrão.

## 7. Como entregar cada refino

1. Uma peça ou um modelo por vez.
2. Renderize o antes e o depois do mesmo ângulo do catálogo e compare com a foto (`_ref/incom/catalogo-incom-2026.pdf`, página `pg`).
3. Confira a medida fechada contra o catálogo, com uma tolerância de 0,1 mm.
4. `node --check js/app.js`, carimbo de versão, `git fetch`, commit e push.
5. Anote o que fez na seção 8 ("Registro"), com uma linha por commit: o quê, de onde veio e o que ficou pendente.

## 8. Coordenação entre Codex e Claude

**Em andamento** (quem está mexendo em quê agora; apague quando terminar):

- Codex: conferência geral após cdx14; ponta da bala Ella/Squared e afilamento Spy em `moduleGeo`/`incomProduct`. Checar altura Olympea e material PE do Julie conta-gotas após essa rodada. Wheel/Rock sem evidência suficiente de passagem frente-verso: não preencher por suposição. PDF adiado até fechar correções verificáveis.

**Registro** (o mais novo em cima):

- 2026-11-17, Codex, `2026-11-17.cdx15`: pontas das balas Ella/Squared afiladas e convexas, conforme fotos p88/92, em lugar do chanfro plano; Spy p91 com afilamento moderado preservando o corte inclinado. Curvaturas estimadas pela foto, sem cota da bala/parte enterrada. Sete batons e variantes renderizados abertos/fechados, cotas dentro de 0,1 mm dos alvos existentes, sem posições/normais inválidas; superfícies novas sem bordas abertas. `tools/conferencia/validacao-cdx15.json`, evidências locais `_ref/incom/validacao-cdx15/`. Conferência geral anterior cdx14 cobre 186 modelos; identificados também material do Julie conta-gotas e altura da Olympea para corrigir antes do PDF.

- 2026-11-17, Codex, `2026-11-17.cdx14`: Bouquet p141 com arcos de pétalas desencontrados em superfície contínua no topo, substituindo anéis torneados; disposição/profundidade estimadas nas duas fotos, sem planta superior cotada. Brilhante p144 com faces laterais em losango e planos convergindo ao ápice, níveis/larguras proporcionais ao desenho; preservado colar aberto oferecido pelo catálogo, profundidade/ângulos estimados. Victoria p197 com região fosca em V e contorno polido, conforme texto do catálogo; não acrescentado sulco sem cota. Três modelos vistos em frente/topo/3/4; W/H preservados, Bouquet/Brilhante sem bordas abertas na superfície base, materiais da Victoria presentes no export. Controles Malika/Thenue preservados. `tools/conferencia/validacao-cdx14.json`, imagens locais `_ref/incom/validacao-cdx14/`. Inicia-se conferência geral; PDF ainda não gerado.

- 2026-11-17, Codex, `2026-11-17.cdx13`: Malika ganha face plana jateada em gota e borda chanfrada polida, substituindo a faixa horizontal; cotas 30 × 38 mm e pé Ø22,2 do desenho da dona preservados. Início/ângulo/profundidade do corte estimados nas fotos; D máximo resultante ~25,92 mm continua sem cota lateral oficial. Thenue p194: removida interpretação do oval como furo passante, painel fosco contínuo recortado na superfície, com borda polida. W32,1/H36,2 preservados; D anterior estimado. Materiais em duas superfícies reais no export, sem casca externa duplicada. Recorte convexo do oval cobre também triângulos grandes; cinco planos de corte e teste de área com oval inteiramente dentro de um triângulo passaram. Seis tampas conferidas em frente/3/4; Malika e controles com superfície base sem bordas abertas, ambos os materiais presentes no export. `tools/conferencia/validacao-cdx13.json`, imagens locais `_ref/incom/validacao-cdx13/`. Restam outras tampas e pendências sem fonte; PDF não gerado.

- 2026-11-17, Codex, `2026-11-17.cdx12`: fechos das makes revisados pelas fotos abertas p3–33 e ampliações da dona. Case com duas dobradiças laterais e ponte vazada ligada ao colar, com língua/dente correspondente na tampa. Flat com duas articulações na faixa sem espelho, retirados os blocos isolados que não tinham par na base. Frame/Moon/Macaroon com eixo central mais curto, conforme fotos. Demais línguas ganham dente e rebaixo receptor recortado na base; curvos acompanham a parede. Dimensões internas/folgas estimadas, sem certificação de molde ou simulação da flexão de destravamento. Trinta conjuntos abertos/fechados sem vértices inválidos, cotas dentro de 0,1 mm; amostragem de três pontos do dente fora do sólido da base em 0/15/45/90 graus. `tools/conferencia/validacao-cdx12.json`, imagens locais `_ref/incom/validacao-cdx12/`. PDF adiado; seguem Malika e tampas pendentes.

- 2026-11-17, Codex, `2026-11-17.cdx11`: Case G/M/M All Crystal com topo do colar, borda do godê e produto alinhados, conforme nova foto da dona. Removido também o vão radial entre colar e latinha; posição elevada sobre a placa da base preservada. Três Case renderizados abertos/fechados e medidos: diferença entre os três topos menor que 0,00001 mm; cotas externas dentro de 0,1 mm. Moon M All Crystal usado como controle, sem alteração. Espessuras internas continuam estimadas pela foto. Relatório `tools/conferencia/validacao-cdx11.json`, renders locais `_ref/incom/validacao-cdx11/`. Demais correções e PDF ainda pendentes.

- 2026-11-17, Codex, `2026-11-17.cdx10`: removida a fresta entre produto e parede interna do godê saltado (Case e Moon M All Crystal), conforme foto ampliada enviada pela dona. Produto agora alcança a parede interna, preservando borda metálica fina e rebaixo de 0,3 mm; espessuras internas continuam estimadas pela foto. Preenchimento ampliado também nos godês redondos, retangulares e de contorno próprio. Trinta compactos/paletas renderizados abertos/fechados, sem vértices inválidos; cotas fechadas dentro de 0,1 mm do catálogo. Relatório `tools/conferencia/validacao-cdx10.json`, evidências locais `_ref/incom/validacao-cdx10/`. Chanfro da Malika, dobradiças/recebedores dos fechos e Thenue ainda em andamento; PDF não gerado.

- 2026-11-17, Codex, `2026-11-17.cdx9`: Laura p169 com recortes laterais e painéis abrindo em leque, em vez de preenchimento torneado que criava faixas horizontais. Arco superior contínuo pela leitura do desenho; contorno rasterizado confundia linhas internas com degraus externos. Mantidos 33,7 × 35 mm (L/A); D=26 anterior segue estimado, distribuição/profundidade dos planos por foto, sem certificação industrial. Conferida frente/3/4; superfície base sem bordas abertas e vértices finitos. Quatro controles (Joya, Mini, Malika, Quartz) preservados na rodada; relatório `tools/conferencia/validacao-cdx9.json`, renders locais `_ref/incom/validacao-cdx9/`. Restam outros itens da auditoria; PDF não gerado.

- 2026-11-17, Codex, `2026-11-17.cdx8`: Joya/Joya Mini com tigela inferior do perfil e coroa triangular real (p167/168); Quartz com painéis hexagonais e triângulos nas bordas (p181). Distribuição/setores/proporções de facetas estimados nas fotos/desenho frontal, sem planta industrial. Renders 3/4 e superior; cotas isoladas 43 × 17, 33,5 × 16,9 e 42,95 × 18 mm preservadas. Superfícies base sem bordas abertas na checagem de arestas; Quartz também testada em duas profundidades e com deslocamento. Registros em `tools/conferencia/validacao-cdx8.json`, renders locais `_ref/incom/validacao-cdx8/`. Não certifica ângulos exatos, acabamento cristal ou alojamentos ocultos. Dona confirmou que só dispõe do catálogo/fotos; detalhes não revelados não serão apresentados como conhecidos.

- 2026-11-17, Codex, `2026-11-17.cdx7`: Guggen Roll On com suporte aberto roscado e esfera assentada, pela p.98; passo/relevo estimados pela foto e comentados, sem norma industrial presumida. Moma/Oscar Charm com apoios alargados sob o olhal (p100/104), preservando o vão Ø4,5 mm e alturas totais; espessuras dos apoios estimadas. Três montagens conferidas fechadas e abertas, sem vértices inválidos e cotas comparáveis dentro de 0,1 mm. Medições em `tools/conferencia/validacao-cdx7.json`, renders locais em `_ref/incom/validacao-cdx7/`. Persistem formatos específicos das ponteiras e a reprodução industrial dos retentores/encaixes.

- 2026-11-17, Codex, `2026-11-17.cdx6`: Malika com gota fosca bege e faixa inferior lisa/transparente, conforme confirmação da dona. Tampa preservada em 30 × 38 mm. Frasco de demonstração passa de 42 × 44,1 mm (L/A) para ~73 × 83 mm, por proporção da foto enviada; profundidade anterior de 26 mm preservada por falta de vista lateral. Corpo continua genérico, sem cota comercial/capacidade certificada. Bordas redondas, sem chanfro. Dois materiais recortados na superfície (`mat2Mesh`) preservam o acabamento no export, sem duplicar a tampa inteira. Conferidos frente/lado, envelope da tampa e faixas do export (fosco acima de 18%, PET abaixo); teste geométrico de cinco planos preserva volume/atributos. Malika/Drop/Tahaa sem vértices inválidos. Evidência local em `_ref/incom/validacao-cdx6/`. PDF completo adiado por pedido da dona até concluir as correções.

- 2026-11-17, Codex, `2026-11-17.cdx5`: sprays dos frascos p65/66/69/70/72/73 com saia lisa e proteção transparente independente; Bulb Blow 300 com volumes externos próprios do bico pato. Avante/Jubilee15/40/60/85/Oval/Squared com cavidade vazia e refil separado quando documentado; Gaia PP opaco fosco. Verificadas 22 montagens abertas/fechadas, sem vértices inválidos; cotas comparáveis dentro de 0,1 mm em `tools/conferencia/validacao-cdx5.json` (frascos: corpo+gargalo separados do fechamento). Renders locais em `_ref/incom/validacao-cdx5/`. Paredes/refis e fechamento sem cota continuam estimados; roscas genéricas dos sete potes ocultas, não substituídas por roscas industriais aprovadas. Persistem lapidações, mecanismos/vedações sem cortes, aplicadores específicos, apoios Charm, visores/afilamento de batons, conta-gotas e detalhes de fechos; consultar auditoria antes de chamar a biblioteca de cópia exata.

- 2026-11-17, Codex, `2026-11-17.cdx4`: correções estruturais da auditoria: Tube rígido/rosca/inserto Ø1,6; visor Mini Jubilee; refis Dispensing e acionador/manga Twist; escovas/abertura solidária da haste; rosca helicoidal All Crystal; proporções Ella/Long/Lipview, colar circular Squared, mangas dos sticks; colares lisos Deluxes; ápices Drop/Malika/Tahaa; olhais Charm Ø4,5; alturas Oscar/Tate; fundos dos glosses confirmados e encaixes estreitos das Flat. Renders novos de 58 montagens, sem vértices inválidos; cotas e limites em `tools/conferencia/validacao-cdx4.json` e `INCOM_AUDITORIA.md`. Flat teve compensação adicional de profundidade após medição. Renders em `_ref/incom/validacao-cdx4/` (ignorados pelo git). Quinteto/Moon Quarteto já tinham losango/X corretos: achado antigo retificado. Proporções internas e mecanismos sem vistas suficientes continuam estimados/pendentes, não aprovados como peças industriais exatas.

- 2026-11-17, Codex, `2026-11-17.cdx3`: pente-fino de 186 renders documentado em `INCOM_AUDITORIA.md`, comparando fotos/desenhos do catálogo aos renders salvos. Inclui desvios por família, pendências de evidência, limitações dimensionais e ordem de correção. Não representa aprovação dos mecanismos ocultos nem render novo das correções. Próximo refino: Tube, Mini Jubilee, Dispensing Twist, escovas das máscaras, mangas dos sticks e fechamentos próprios.

- 2026-11-17, Codex, `2026-11-17.cdx2`: abas Outbox/Incom e miniaturas bege fosco no seletor, conferidas no navegador. Tampa Sens: saída circular no fundo substituída por retângulo lateral no disco, conforme pedido da dona; cota exata da saída ainda pendente. Geometria da Sens validada apenas por sintaxe nesta etapa.

- 2026-11-17, Codex, `2026-11-17.cdx1`: peças intercambiáveis separadas em Incom e Outbox / genérico nos menus de adicionar e trocar. Corpos, tampas e válvulas extraídos das montagens atuais do catálogo, com referência à página e dimensões preservadas ao selecionar. Geometrias existentes preservadas; inclusão na biblioteca não significa refino aprovado. Pendente: conferir modelo a modelo contra o PDF da dona; espumadora ainda compartilha `sprayType: 'dosadora'` com a dosadora. Nenhum mecanismo oculto foi inventado.

- 2026-11-17, Claude: compactos, paletas, cristal, fechamentos dos frascos e Tampa Sens revisados pelas fotos (commits `8dfabe3` a `86ce7ad`); PDF de conferência refeito.
