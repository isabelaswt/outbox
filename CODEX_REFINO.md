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

- (vazio)

**Registro** (o mais novo em cima):

- 2026-11-17, Claude: compactos, paletas, cristal, fechamentos dos frascos e Tampa Sens revisados pelas fotos (commits `8dfabe3` a `86ce7ad`); PDF de conferência refeito.
