# Atualização Claude — 20/11/2026, cl145

- **cl145** — (1) On-Off 100/120, dona ("o bico que sai o produto precisa poder andar para o lado, hoje ele tá preso por fora da parte que gira, fazer cavidade para ele andar"): canaleta aberta no alto da parede, da fenda até depois do bico, na profundidade da fenda — o bico nasce lá dentro e corre nela. O "disco" do topo era o perfil do desenho (topo abaulado entre centro e borda): o acionador agora é cilindro reto sem `prof`. (2) Miniaturas, dona ("conferir se os thumbs estão iguais a modelagem aprovada"): a miniatura ao vivo usa `THUMB_LITE`, que pula todos os recortes/cavidades (sumiam a janela da Drop, a aba da frente dos compactos e das Flat, a fenda do On-Off…), e a completa leva de segundos a minutos por produto. As 196 do catálogo Incom agora são prontas, renderizadas com a modelagem completa, em `assets/thumbs/incom/*.png` + `index.json` (assinatura FNV do estado bege → arquivo); a galeria usa a pronta quando a assinatura bate e a leve quando não. `thumbKey` ignora ids sorteados (`uid`, `threadNeckUid`). **Regerar quando mudar a modelagem de algum Incom**: no navegador local, `OUTBOX.makeIncomThumbs(post, nomes?)` manda cada PNG para `post(arquivo, dataURL)` e devolve o índice (com `nomes`, só refaz esses, mas o índice volta inteiro) — todas levam ~34 min. Mudança só de código (sem mudar o estado do preset) NÃO invalida a assinatura: regerar os afetados à mão.

- **cl144** — Dispensing On-Off 100/120, dona (print: "on off não ficou modelado"; fotos DISPENSING-ON-OFF-100 e 6-3): o acionador era um cilindro de topo arredondado com um bico lateral. Agora topo reto (rTop 0,8 e normal reta nas faces de cima — o leque do topo herdava a normal da quina e aparecia um disco sombreado), fenda em U aberta no alto da parede (`incomOnOff`: 0,10·D × 0,34·D, a 15° da frente) e o biquinho redondo furado ao lado dela, rente ao topo (Ø 0,11·D, passa ~1 mm do topo, sai 0,06·D da parede). Medidas tiradas das fotos, sem cota de molde.

- **cl143** — Dona ("todas flat fazer com a nova solução"): a calha com rampas da Flat Dez (cl142/cdx45) e a abertura a 80° agora valem para todas as Flat — Duo, Sexteto, Trio Retangular, Trio Redondo, 6 + 1 e Dez (mesma caixa de 119,7 × 63 × 14,1 no catálogo, sem ajuste de medida). Petit Aplicador · Flat Pad (frasnagas) fica de fora. Conferido local: costas fechadas, aberta a 80° e de lado a 90° nas seis, godês intactos, sem avisos de CSG.

- **cl142** — Flat Dez: integrada a entrega do Codex (estudo cdx45, aprovado pela dona com "feito!" em 20/11), só o patch `flat-dez-somente.patch` — import `INTERSECTION` do three-bvh-csg, ramo `m.hingeFlatDez` em `compactParts` antes de `hingeOculta`, e `hingeFlatDez` + `abreAberto = 80` exclusivamente quando `r.n === 'Flat Dez'`. Calha de 6,5 mm com duas rampas maciças da tampa (+10 mm retos no topo), continuações laterais da base fixas e no nível dela, canto traseiro fechado (corte só por dentro, parede externa contínua), eixo em y0 − 1,35 / z − 0,1. Aplicado sobre a cl141 (o único conflito era o carimbo do import do incom.js no contexto). Conferido local: caixa fechada 119,684 × 62,509 × 14,100 (igual ao estudo), aberta a 80°/90°/105° sem erro, Flat Duo inalterada.

- **cl141** — Aprovação, Dispensing 15 dispensador ("estrutura de válvula é maior, ombro é mais alto, tem um outro degrau no ombro, fazer a correção como você fez no dispensing 15 do conta gotas, em tudo que for"), fotos DISPENSING-15/30/60/QUADRADO: (1) pump dosadora em mm, a mesma peça 20/410 em toda a linha — colar 23,6 × 15,8, guia 17,5 × 6,4, atuador 13,8 × 13,5 (era 22,3 × 12 e mais baixa) — em todos os dispensadores com dosadora (15/30/60, Quadrado, Cube, Elíptico; o Bulb segue o da cl137). (2) Dispensing 15/30/60: anel preto 10,1 mm (era ~4) e o degrau do ombro (W − 4,7 × 4 mm) por cima, dentro da sobretampa, como no conta-gotas; a sobretampa tem 43,8 mm acima do anel (o que a pump pede — no 60 a medida de catálogo deixava a pump furar a tampa). (3) Quadrado: degrau de 2,5 mm sobre o anel (foto). Em 3/4 a lâmina curva do fundo é a mesma do conta-gotas aprovado.

- **cl140** — Pente fino, os dois detalhes (dona: "Corrigir os dois"): (1) **Classic Duo/Quarteto/Uno** — o clip da tampa passava ~7,7 mm da boca e, aberto, parecia um fio saindo da tampa; na foto (CLASSIC-DUO-2 aberta) é um bloquinho rente à boca. Novo `snapLen` (quanto o clip passa da boca, mm) = 1,2 no Classic; dente, fenda e lingueta da base não mudaram. (2) **Big 4/9** — duas frestas escuras na aba fechada. Causa: `sp()` com n 20 punha quase nenhum ponto nas faces (a frente era duas retas de ~30 mm com bico no meio) e a aba, plana, cruzava essa casca. Agora `sp()` usa ângulo polar quando n ≥ 12 (só as Big; mesma curva, pontos espalhados nas faces), a aba da Big segue o abaulado (`snapConform`) e a busca do conform passou de 28 para 64 passos (com n alto deixava ~±6 mm retos). Frente lisa, aba 0,06 mm atrás da tampa de ponta a ponta. Os pontinhos na calha das costas da Big já existiam antes (conferido com a amostragem antiga). Comparativos 29/30.

- **cl139** — Pente fino (renders de todos os produtos que mudaram desde a última aprovação, ao lado das fotos): Dispensing 15/30/60 da linha **dispensadores** estavam com o fundo antigo (refil quase até o chão, sem o bloco de vidro), enquanto os irmãos conta-gotas já tinham o fundo aprovado — agora `roundK` 0,5 nos três: refil de ponta redonda, prato/bloco maciço com a curva escura (mesmo caminho do conta-gotas). Pisos mantidos (medidos nas fotos: fundo do refil → base ≈ 0,32 da largura). Cube/Quadrado (refil quadrado) e Elíptico (sem foto) seguem como estavam.

- **cl138** — Aprovação: Julie ("contagotas redondo") com a pipeta de tubo reto e ponta redonda (`pipTip: 'redonda'`, como Flacon Botão/Sydney); Sydney ("a borracha do conta-gotas tá meio baixa, aumentar levemente a altura") borracha +12% (`actH`); Amsterdam Deluxe 100 ("o spray tá baixo, precisa ficar mais alto") colar da válvula ×1,5 e acionador ×1,4 — chega perto do topo da sobretampa (foto).

- **cl137** — (1) Flacon 15/30 Botão e Sydney, aprovação ("contagotas ser arredondado no final, fazer outro tipo de contagotas"; "conta gotas redondo"): pipeta nova `pipTip: 'redonda'` — tubo reto de vidro, mesmo diâmetro até o fim, fechado em meia-esfera (foto Flacon 15 Botão fundo-cinza_03); também na lista do inspetor ("Tubo reto, ponta redonda"). (2) Conta-gotas (todos), dona (Julie: "como fica aberto? não consigo ver"): no Abrir o conta-gotas sai do frasco e deita ao lado (`capa: true`) e a pipeta vira vidro à vista (o material "dentro do frasco" sumia no fundo claro). (3) Bulb dispensador, aprovação ("a válvula precisa ser mais alta, tudo fica mais alto, quase chega no topo"): colar da válvula ×1,58, acionador ×1,5, cabeça ×1,29 — o bico fica logo abaixo do topo da sobretampa (fotos DISPENSING-BULB).

- **cl136** — Dispensing 15/30 conta-gotas, dona ("prefiro só deixar a mais escura"): sai a curva clara do prato (a superfície unida à casca; volta com `m.comPrato`); fica só o sorriso do topo do bloco de vidro. Malha do bloco mais fina (lathe 256, recorte 200 pontos). Em 3/4 o topo do bloco aparece como uma lâmina curva (é a calha atravessada que faz a curva aparecer de frente).

- **cl135** — Dispensing 15/30 conta-gotas, dona ("essa curva tem que ser em cima da outra"): o sorriso do topo do bloco encosta logo abaixo do prato — 0,7 mm (`m.massaGap`; com 0,05–0,35 aparecia um serrilhado marrom da refração do refil na fresta). Com o recorte atravessado da cl134 o bloco não cobre a ponta do refil.

- **cl134** — Dispensing 15/30 conta-gotas, dona ("ficou uma faixa reta e outra curva de novo, elas duas precisam ser curvas"): o topo do bloco maciço virou um segundo sorriso, paralelo ao prato e descido min(d + 0,2) para a borda dele ficar abaixo da ponta do refil. Como de frente uma peça de revolução mostra a borda da parede (reta), o bloco tem topo plano na altura da borda e um recorte em sorriso que atravessa de frente a trás (calha em x, `cutHole` com ExtrudeGeometry) — de frente aparecem as duas curvas.

- **cl132** — Dispensing 15/30 conta-gotas. (1) Dona ("isso tá melhor, mas sai do vidro"): o corpo afina para baixo, então o prato e o bloco maciço da cl131 passaram a medir o raio da parede na malha a cada altura e ficam 0,7 mm para dentro dela (antes usavam W/2 fixo e saíam do vidro embaixo). (2, publicado como **cl133**) Dona ("conseguimos colocar uma refração embaixo maior?" / "ficou fraco ainda"): o bloco maciço NÃO aparecia — a casca de vidro, desenhada depois, cobria a transmissão dele; agora o bloco vem depois da casca (`renderOrder` + 1), com espessura 1,1·W (`m.massaK`), ior 1,75 (`massaIor`) e atenuação #eef3f3 a 2·W (`massaTint`/`massaDist`). O bloco termina reto 0,15 mm abaixo do meio do prato: seguindo a curva até a parede ele ficava na frente da ponta do refil e a cobria (refração virava uma faixa marrom chapada). Testadas e descartadas: atenuação forte (bloco preto/cinza-escuro). Testada e descartada a pedido dela ("esse reflexo é real? não tinha que ser só vidro?"): uma imagem da ponta do refil invertida dentro do vidro.

- **cl131** — Dispensing 15/30 conta-gotas, dona ("isso não ficou bom ainda, essa linha reta tá esquisita"; "parece que sai do vidro a curva"; "conseguimos deixar mais com cara de massa de vidro?"): o prato abaulado da cl129 fica 0,7 mm dentro da parede (a = W/2 − 0,7; antes passava do vidro com a refração) e ganhou um BLOCO maciço de vidro à parte embaixo (`g.userData.massa` → malha "massa" com material próprio, espessura de refração 0,4·W, topo 0,05 mm abaixo do prato, quina de baixo acompanhando a da casca) — a refração grossa fica só no bloco, a casca segue fina (refil sem contorno dobrado). Testados e descartados: só a metade da frente do prato (cortava de lado), topo do bloco em elipse (sumia a curva), curva em cristal por cima (cortada de lado).

- **cl130** — Flat (todas), dona ("Aplicar as 3", da comparação com a foto nova da Flat Dez aberta e a fechada): (1) rasgo da frente (`dedo`) 1 mm → 2,4 mm de fundo e altura 3,2 → 60% da base (foto aberta: ocupa quase toda a frente; largura 42% já batia); (2) degrau em volta do painel dos godês (`rebaixo`) inset 2 → 2,4 e altura 0,3 → 0,8 mm (aparece como borda na foto); (3) a aba da tampa já tinha a largura do rasgo — na foto fechada ela enche o rasgo inteiro, e como a altura dela segue a do rasgo, agora desce junto. Conferido fechado de frente (aba rente) e aberto de lado.

- **cl129** — Dispensing 15/30 conta-gotas, dona ("não ter a estrutura que segura o refil, fica sobreposta, quero só o refil, a casca e o fundo abaulado"; "não pode ter essa separação"; "ainda tem sobreposição, não?"): sem cavidade cortada no bloco (a superfície dela refratava como um segundo contorno do refil) e sem a lâmina da cl128 (faixa/serrilhado) — o frasco é só a casca de fora + um prato abaulado em sorriso (`incomRefillCavity.prato`: superfície única em torno, de parede a parede, meio 1 mm abaixo da ponta do refil, d = 0,13·W) unido à casca; refração da casca fina (`thick` 0,5) para o refil não aparecer duas vezes.

- **cl128** — (1) Dispensing 15/30 conta-gotas, dona ("isso! parede do lado não existe, apenas fundo"): a cavidade do refil fica colada nele (0,2 mm menor, some) e a curva em sorriso é uma lâmina fina solta no bloco (`incomRefillCavity.lens`: cortador em torno entre duas calotas paralelas, a = W/2 − 0,5, d = 0,13·W, espessura 1,1, meio 1 mm abaixo da ponta do refil) — sem parede subindo dos lados. Casca volta ao acabamento `vidro` #f5f8fb (o do print da revisão que a dona gostou; no `cristal` a lâmina ficava branca). (2) Dona ("que luz é essa que tá tão boa?" / "quero que essa luz seja padrão ao abrir um arquivo"): é a luz Estúdio embutida (SCENE0) com fundo #f1f0ed, a da revisão — `loadState` agora abre todo arquivo com ela (luz studio sem HDRI, giro/intensidade/contraste/altura/principal/preenchimento/maciez no padrão, fundo #f1f0ed sem degradê); depois dá para trocar e salvar em Minhas luzes. (3) Biblioteca de materiais › Plástico: "Acrílico SAN" (vidro #f5f8fb) e "Acrílico cristal" (cristal #f5f8fb) ("não tenho acrílico cristal na minha library").

- **cl127** — Dispensing 15/30 conta-gotas, dona ("ainda não" / "a curva é ao contrário"): a curva virou sorriso — o PISO de dentro do frasco é uma calota rasa de parede a parede (`bowl.d` = 0,13·W, meio mais baixo, 1 mm abaixo da ponta do refil); a cavidade vai até 1,5 mm da parede de fora (a parede de dentro some no contorno, sem formar parede perto do refil); fundo de baixo reto com a marquinha de injeção. Sai a calota côncava por baixo da cl126.

- **cl126** — Dispensing 15/30 conta-gotas, dona ("você fez a mesma coisa, quero uma curva na parte de baixo do frasco, independente do refil"; "ela não sobe e cria uma parede, ela acaba embaixo"): a curva saiu da cavidade do refil e foi para o FUNDO DO FRASCO — calota côncava por baixo de 84% da largura (`punt` a = 0,42·W, d = min(metade do piso, 0,13·W)), que aparece em arco através do bloco e termina no pé; a cavidade do refil fica colada nele (0,2 mm menor, mesmo fundo redondo) e não aparece. A tigela (`bowl`) continua disponível no código, sem uso.

- **cl125** — Dispensing 15/30 conta-gotas, dona ("não é isso, não quero essa parede do frasco de fora perto do refil, só quero uma curva embaixo mostrando esse peso da base"): a cavidade fica colada no refil (0,2 mm MENOR — a parede some dentro do contorno dele, sem linha em volta) e só embaixo da ponta redonda abre a tigela curva (`bowl.d` = rb + 1,6, aro no começo da ponta): a meia-lua de acrílico entre a ponta do refil e a tigela é a única curva à vista, sobre o bloco maciço.

- **cl124** — Dispensing 15/30 conta-gotas, dona ("não ter contato com a parede onde fica o refil, imagina que é tipo um copo e o refil fica flutuando ali"): a cavidade virou um copo 2,6 mm mais largo que o refil (folga ~1,3 mm em volta) com fundo curvo (`bowl.d` = 0,6·rb + 1,3; aro 0,6·rb acima da ponta do refil), sem a aba larga/degrau da cl123 — o refil não encosta nas paredes nem no fundo.

- **cl123** — Dispensing 15/30 conta-gotas, dona (print do 15 ao lado da foto: "ficou ruim, não é melhor modelar uma curva embaixo?"): o copo de parede reta da cl122 saiu; a cavidade é justa no refil (+0,4) e embaixo vira uma tigela rasa (`incomRefillCavity.bowl`: cortador em torno — calota esférica de aba 40% da largura, aro 0,35·rb acima da ponta do refil, fundo 1 mm abaixo dela, e um degrau suave de 0,25·rb de volta à parede justa), como a curva larga das fotos em volta da ponta do refil. Refil desce até a medida do zoom da foto (fundo do refil → base ≈ 0,33 da largura no 15 e 0,23 no 30): piso 0,15 → 0,086 e 0,085 → 0,043 (a medida da cl122 tinha pego a sombra do refil dentro do bloco).

- **cl122** — Dispensing (refil), dona ("ainda não resolveu" → o fundo do frasco; "não é deixar mais escura, acho que tem que modelar esse fundo mesmo"): fundo MODELADO a partir das fotos ampliadas — nos conta-gotas (`roundK`) a cavidade é um copo 1,2 mm mais largo que o refil, de fundo chato com canto de 35% do raio, 0,6 mm abaixo da ponta do refil (o piso do copo aparece como elipse), e embaixo bloco maciço de fundo reto com a marquinha de injeção no centro (`punt` d 0,35 / a 0,9; os dispensadores seguem com a calota da cl121). Casca de SAN no acabamento `cristal` (Acrílico cristal SAN/PET G: as superfícies do copo e do pé aparecem em camadas); testes de escurecer a faixa do fundo descartados. Altura do maciço medida pixel a pixel (fundo do refil → base ÷ largura): foto 15 ≈ 0,45, foto 30 ≈ 0,38 — a cl121 tinha passado (0,69/0,53); volta para 0,15 no 15 e 0,085 no 30.

- **cl121** — Dispensing (todos com refil: conta-gotas 15/30 e dispensadores), dona (print dos Dispensing ao lado das fotos: "sinto que o chão dos 3ds tá ruim, precisa ter esse peso de vidro no chão"): a casca de SAN passou do material PET (película fina, bloco leitoso) para `vidro` (cor #f5f8fb, espessura padrão 4 — com 0,45·W o refil inchava na refração), quina de baixo rBot min(2,2; 7% da largura) e fundo de baixo côncavo (`incomRefillCavity.punt`: calota de 30% do piso até 2 mm de fundo, raio 34% da largura); fundo maciço dos conta-gotas medido nas fotos pela altura do corpo: Dispensing 15 0,15 → 0,195 (~35%), Dispensing 30 0,07 → 0,11.

- **cl120** — Godês por contorno (Flat, Big, Classic e todo `cells`), dona (print da Flat com "linhas"): (1) a concordância da boca de cada godê (até 1,8) era maior que metade da parede até o vizinho (Flat Dez ~0,9, Big 9 ~1,2): os dois cortes se sobrepunham no meio da parede e o corte único deixava costura escura e serrilhada — agora f ≤ metade da parede − 0,3 (`halfGap`, distância mínima entre contornos vizinhos), e a parede fica com topo; (2) a bandeja do godê estava 0,07 mm afastada da parede do rebaixo (risco escuro tracejado na borda da pastilha): inset 0,12 → 0,04 nos `cells` e RoundedBox cw − 0,42 no godê quadrado. Redondos (Moon, Case) sem mudança.

- **cl119** — (1) Classic, dona (print do Classic aberto: "mais fino, buraco menor e acompanhando o cilindro"): na `hingeBarra` o raio da barra é 70% do anterior; a folga da tampa em volta das pontas da base virou uma cápsula justa (r + 0,2, `CapsuleGeometry`) no formato da ponta, sem o trecho reto que sobrava; o canal da base ficou r + 0,2. (2) Conta-gotas, dona ("Aplicar os 5", da análise foto × render): sino da borracha (`m.sino`, todos os de bulbo menos o Bulb aprovado) começa a 45% da altura e abre até 1/0,72 do corpo (máx. 30% do colar); Dispensing 15/30 com colar 64% do corpo, friso de 0,6 mm na base do colar (`m.friso`) e anel 0,8 mm mais largo que o corpo; botão com domo mais baixo (0,09·actW) e o +10% de diâmetro só no Julie (Flacon ~72% do colar, como na foto); fundo dos 4 Flacon com rBot 12% da largura; Sydney com o frasco começando 3,5% mais alto (colar ~4 mm mais baixo).

- **cl118** — Classic (Duo, Quarteto, Uno), dona (print da barra de costas: "isso tá errado ainda, quero que você faça um mecanismo correto com esse visual, mas funcional"): a barra (tampa) gira num canal redondo da base (cilindro r + 0,3 no eixo, sem a calha oblonga da cl117); nas duas pontas a BASE tem terminais do mesmo raio da barra (cilindro 1,1r + meia esfera, a 0,15 da barra), que formam as pontas arredondadas e seguram o pino; o pino (r·0,32) atravessa a barra e entra 0,9r em cada terminal, sem aparecer; a tampa tem a folga cilíndrica em volta dos terminais (gira sem bater). Conferido fechado, a 60° e aberto, de lado sem sobreposição.

- **cl117** — Classic (Duo, Quarteto, Uno), dona (print do Classic aberto ao lado da foto: "pino não pode aparecer, a calha é maior e arredondada nas pontas"): o pino da `hingeBarra` fica todo dentro da barra (Lh − 1, nada para fora); a calha da base vira um oblongo visto de cima (pontas em meia-lua, ExtrudeGeometry de um stadium), Lh + 1,4 de comprimento, 2r + 3,2 de profundidade e 2r + 1,2 de altura; a barra cresceu para min(0,44·W, 30 mm) (foto: ~45% da largura). Conferido de lado aberto: a tampa não entra na base.

- **cl116** — (1) Classic, dona ("voando" + "faça o mecanismo certo, imagina que tem um pino ali"): a calha da `hingeBarra` corta só a base (a barra fica presa à tampa, sem vão em volta) e um pino r·0,32 atravessa a barra toda e entra 1,5 mm nas paredes da base nas pontas da calha. (2) Deluxe (todos), dona no Amsterdam Deluxe 100: "colar precisa ser mais alto, fazer o mesmo dente interno que você fez no bulb para prender a tampa": anel +60% (tirado do alto do frasco) e o Dente da sobretampa (W−2,6 × 2,5) como no Bulb, sobretampa com gap −2,5. (3) Dispensing 15/30 conta-gotas, dona: "deixar o refil mais alto, tá acabando antes, parede acompanhar": refil +85% da altura do anel, entrando nele (anel gap −e, cavidade incomRefillCavity passante no anel), líquido 99%. Lição repetida: comentário `//` no meio da linha comentou o resto (cutHole) — usar sempre `/* */`.

- **cl115** — Classic, dona (print da barra deitada em cima da base com a paleta aberta): "isso tem que ficar na junção da tampa com a base, não na base": com `hingeBarra` a barra fica centrada no eixo (hz = costas, y = divisão), igual ao giro da cl114; a calha (recorte na base e na tampa) acompanha. Fechada a barra fica na emenda das costas; aberta gira no lugar, sem sobreposição.

- **cl114** — Classic: (1) dona, print de lado com a tampa entrando na base: "nunca acontecer isso de sobrepor" — com `hingeBarra` o giro passa para a quina de trás de cima (hingeInfo z = costas, y = divisão): a tampa só sobe e vai para trás; a barra fica onde estava, na calha, presa à tampa. (2) Classic Uno, foto aberta: "a borda do godê vai quase até a extremidade e é praticamente reta, não arredondada nas pontas" — godes.mgK 0,05 (margem ~5%), mm 0 (sai o limite da bandeja do catálogo) e rq 0,5 (quina do rebaixo, aro e godê quase vivas; concordância da boca 0,4).

- **cl113** — Classic (Duo, Quarteto, Uno), dona: "o classic é uma barra única de dobradiça, não dividida em vários" + "tem uma calha para essa dobradiça": novo `hingeBarra` — no ramo genérico, em vez dos 3 nós (base-tampa-base) e pino, um só cilindro de comprimento Lh preso à tampa; e `hingeCalha = min(0,32; 24/W)` para o recorte da calha na base e na tampa (o mesmo da calha genérica), com o eixo para dentro.

- **cl112** — Flat (todas), dona respondeu "calha reta" + "rampa nos apoios" e mandou foto de cima (Trio Redondo: calha longa e estreita na borda de trás, apoios curtos perto das pontas): calha de pontas RETAS (k = 0) e mais comprida (meia-largura W·0,42), profundidade em z cD = clamp(face de dentro − 0,8; 2,4; 3,3), aberta atrás; a peça da tampa dentro dela é reta e fina (T = 1,8, sem inclinação); os dois apoios (x = ±0,73·meia-largura, largura max(3; W·0,04)) ocupam a profundidade da calha, costas rentes, e têm o topo em RAMPA descendo para a frente (de 0,25 abaixo da borda até 0,5 acima do fundo). Pino único atravessando os apoios.

- **cl111** — Flat (todas), dona (descrição: "calha rebaixada comprida na borda traseira, com dois apoios curtos afastados entre si que recebem o pino e se articulam com os encaixes da tampa; faces planas por fora, o cilíndrico só no alojamento interno do pino, sem rolo aparente"): o recuo da cl110 é a calha. Dentro dela, dois APOIOS da base (blocos retos, unidos por CSG) a ±0,73·meia-largura, largura max(3; W·0,035), 1,5 mm de profundidade rentes às costas, do fundo da calha até 0,25 abaixo da borda. A rampa da tampa ganha os ENCAIXES (fendas com folga 0,22, cortadas com cutHole) onde eles entram. Um pino único r 0,25 no eixo atravessa a rampa e os dois apoios (os dois pinos curtos das pontas saíram).

- **cl110** — Flat (todas), dona mandou uma descrição técnica ("superfície inclinada trapezoidal, a rampa desce em direção ao eixo, laterais inclinadas, relativamente fina, faz parte da tampa e conecta a região interna da tampa aos blocos da dobradiça; evitar rampa arredondada ou espessa"): o macho da tampa virou uma CUNHA — face de dentro inclinada, 0,9 mm de profundidade no pé (no eixo) e até 3,5 mm em cima (encosta no interior da tampa, limitado pela face de dentro da borda − 0,6) — com as laterais em rampa do trapézio. Malha montada à mão (8 vértices, faces planas) e unida à tampa por CSG. O encaixe da base acompanha a mesma inclinação com folga 0,22 + 0,3.

- **cl109** — Flat (todas), dona (print do bloco em pé com a paleta aberta: "tirar essa parte, não preciso"; "essa parte que sobra fica na tampa, não na base"): o macho --\\___/-- continua na TAMPA, mas raso — só T = 1,8 mm, a parede de trás — em vez de ir até a face de dentro da borda; a base só tem o encaixe dele (folga 0,22). Aberta, não sobra bloco em pé na frente do espelho.

- **cl108** — Flat (todas), dona: "é exatamente isso só que para baixo, a rampa está para cima e elas precisam ficar para baixo": o trapézio da cl107 virado. A TAMPA desce no meio num macho --\\___/-- (meia-largura W·0,325 em cima, rampas de max(2,4; W·0,035), fundo ~0,3·h da base), unido à tampa por CSG; a BASE tem o recuo do mesmo desenho (folga 0,22), aberto atrás para o macho sair ao abrir. Eixo no pé do macho (yL−D+0,45), 0,45 para dentro das costas; pinos r 0,25 nas quinas de baixo das rampas, entrando na base. Fechada, a emenda --\\___/-- aparece nas costas como linha fina.

- **cl107** — Flat (todas), dona: "essa seria o macho, quero a forma invertida dessa rampa": papéis trocados. A BASE é o macho — no meio da borda de trás sobe um ressalto em trapézio --/‾‾‾\\-- (meia-largura W·0,325 embaixo, rampas de max(2,4; W·0,035), altura ~0,3·h da base), da face de trás até a face de dentro da borda, unido à base por CSG. A TAMPA é a fêmea (recorte do mesmo desenho, folga 0,22). Pinos r 0,25 no alto das rampas, eixo 0,45 abaixo do topo do ressalto e 0,45 para dentro das costas. Aberta, a tampa gira em volta do topo do ressalto e fica acima da borda, como nas fotos. Fechada, a emenda do ressalto aparece nas costas como linha fina (não dá para esconder com a base macho e o eixo nas costas).

- **cl106** — Flat (todas): dobradiça macho e fêmea no lugar do ressalto da cl58. A borda de trás da base tem POR DENTRO um recuo em trapézio (--\\___/--: rampa, fundo reto, rampa; W·0,65 em cima, rampas de max(2,4; W·0,035), fundo ~0,3·h da base) e a tampa uma língua do mesmo desenho (folga 0,22) que vai até a face de dentro da borda (medida na malha). Dois pinos r 0,3 no alto das rampas, rente à divisão (eixo yL−0,45, 1,75 mm para dentro), entrando nas pontas da base. O recuo começa depois do arredondado da quina de trás: fechada, as costas ficam lisas (dona: "atrás é reto, não tem desenho"); aberta, a língua sobe e o desenho aparece de frente. Big 4/9 seguem como na cl103.

- **cl105** — revisao.html mais compacta para a foto da Incom crescer: barra de decisão com max-height 26vh (era 42vh), nome e meta numa linha, botões menores, comentário de uma linha com Enviar ao lado (a dica do ⌘+Enter foi para o placeholder), miniaturas 46 px.

- **cl104** — Conta-gotas (Julie, Sydney; vale para a linha toda): o furo da rosca atravessava o colar e ele ficava oco em cima (o botão parecia voando); agora o furo para 1 mm abaixo do topo e o colar fica fechado. Botão (Julie, Flacon 15/30 Botão): +10% de diâmetro, lado reto até uma aresta viva (ponto repetido no perfil do lathe = normal partida) e calota esférica baixa; colar com quina viva (collarR 0,35). Bulbo (Sydney, Bulb, Dispensing, Flacon Bulbo): +12% de largura e respiro do pé mais alto (gH até 1,5 mm, Rg 0,82R).

Big 4/9: aba de abertura com espaço para o dedo embaixo; fillet 0,35 nas quinas da junção tampa/base. Próximo carimbo: cl104.

# Atualização Claude — 18/11/2026, cl102

Big 4/9: aba de fechamento ~3× mais alta; dobradiça macho e fêmea (recuo no meio da base, língua da tampa, pino cruzando). Próximo carimbo: cl103.

# Atualização Claude — 18/11/2026

Moon APROVADOS na cl101 (10 itens `ok`), junto com Frame e Case: não mexer em `hingeBloco`/`hingeCase` sem pedido. Próximo carimbo: cl102.

# Atualização Claude — 18/11/2026, cl101

Moon Deck: nós de dobradiça do andar do meio (base + andar) com pino interno; bloco da tampa fundido à tampa. Próximo carimbo: cl102.

# Atualização Claude — 18/11/2026, cl100

Moon Deck: rebaixo da base do tamanho do bloco da dobradiça (eixo da tampa junto das costas); pino escondido. Próximo carimbo: cl101.

# Atualização Claude — 18/11/2026, cl99

Moon Deck: andar do meio gira pela quina de cima (não entra mais na base); fenda em arco no topo da parede de trás da base para a tampa. Próximo carimbo: cl100.

# Atualização Claude — 18/11/2026, cl98

Moon (redondos): área livre em arco na quina de trás da peça de baixo, no caminho da tampa ao abrir. Frame intacto. Próximo carimbo: cl99.

# Atualização Claude — 18/11/2026, cl97

Macaroon: aba reta até a tampa (sem concordância que abria). Próximo carimbo: cl98.

# Atualização Claude — 18/11/2026, cl96

Macaroon: aba encosta no teto abaulado da tampa e a junção tem concordância (curva). Próximo carimbo: cl97.

# Atualização Claude — 18/11/2026, cl95

Macaroon: tampa encosta na base a 90° e a aba nasce do teto de dentro da tampa. Próximo carimbo: cl96.

# Atualização Claude — 18/11/2026, cl94

Macaroon: aba 3 mm abaixo da divisão, peça reta única, saindo por dentro da tampa; rebaixo termina antes do godê. Próximo carimbo: cl95.

# Atualização Claude — 18/11/2026, cl93

Macaroon: aba da dobradiça 1 mm mais funda no rebaixo. Próximo carimbo: cl94.

# Atualização Claude — 18/11/2026, cl92

Macaroon: moldura em U de volta (discreta) e abertura padrão 90° (aba na horizontal). Próximo carimbo: cl93.

# Atualização Claude — 18/11/2026, cl91

Macaroon: peça da dobradiça = continuação da parede de trás da tampa; fechada numa fenda das costas da base, aberta deitada num rebaixo da borda. Próximo carimbo: cl92.

# Atualização Claude — 18/11/2026, cl90

Macaroon: malha do bloco da dobradiça lisa (sem recalcular normais após a CSG). Próximo carimbo: cl91.

# Atualização Claude — 18/11/2026, cl89

Macaroon: bloco da dobradiça maior, fundido à tampa com rampa (sem aresta), sem moldura em U, pino escondido. Próximo carimbo: cl90.

# Atualização Claude — 18/11/2026, cl88

Macaroon: dobradiça em bloco arredondado da tampa num rebaixo com fundo e moldura em U (foto lilás), pino interno. Próximo carimbo: cl89.

# Atualização Claude — 18/11/2026, cl87

Big 4/9: dobradiça com 1/3 da largura (centralizada atrás). Próximo carimbo: cl88.

# Atualização Claude — 18/11/2026, cl86

Big 4/9: dobradiça real atrás (nós da base nas pontas, nó da tampa no meio, abas e pino). Próximo carimbo: cl87.

# Atualização Claude — 18/11/2026, cl85

Big 4/9: tampa gira na quina e encosta na base; cilindro atrás da junção, colado nas costas da base. Próximo carimbo: cl86.

# Atualização Claude — 18/11/2026, cl84

Big 4/9: pino fino na quina de trás (invisível de frente, aberta ou fechada); godês menores com moldura mais larga (`godes.mgK` 0,118). Próximo carimbo: cl85.

# Atualização Claude — 18/11/2026, cl83

Big 4/9: dobradiça = cilindro discreto atrás (nada visível de frente), sem canal ao pé da bandeja, tampa e saia numa malha só. Flat sem as peças cinzas da cl81. Próximo carimbo: cl84.

# Atualização Claude — 18/11/2026, cl82

Big 4/9: dobradiça desce para a borda de fora (a tampa aberta começa na borda de trás, sem caixa embaixo). Próximo carimbo: cl83.

# Atualização Claude — 18/11/2026, cl81

Moon Deck: andar do meio encaixado volta ao eixo da cl77 (não afunda na base). Big/Flat: peça da dobradiça visível nas pontas. Big 4/9: degrau 2,6 e tampa com saia. Próximo carimbo: cl82.

# Atualização Claude — 18/11/2026, cl78–cl80

Frame APROVADO na cl80 (5 itens `ok`): não mexer em planta, visor nem `hingeBloco` sem pedido.

cl80: bloco do Moon/Frame com 60% da base (ponte mais curta). Próximo carimbo: cl81.

cl79: visor dos Frame com a forma de dentro do desenho da dona (visorN 8, visorBow 0,08). Próximo carimbo: cl80.

Moon/Frame (`hingeBloco`): bloco da dobradiça é da tampa, mais alto, num entalhe da base com folga (pedido da dona). Próximo carimbo: cl79.

# Atualização Claude — 18/11/2026, cl77

Frame: planta pelo desenho da dona (n 7,5, bow 0,10) e dobradiça em bloco inteiro (hingeBloco, como Moon), sem as 3 peças. Próximo carimbo: cl78.

# Atualização Claude — 18/11/2026, cl62–cl76

**Case APROVADO pela dona na cl76** — não mexer no ramo `hingeCase` sem pedido dela (como Moon/Classic). Revisão: 16 ok / 24 feito / 0 ajustar.

cl76: Case — sem a lingueta da tampa sobre o cilindro (recorte redondo aberto para as costas). Próximo carimbo: cl77.

cl75: Case — pino até o fim do furo do cilindro. Próximo carimbo: cl76.

cl74: Case — vão da tampa em volta do cilindro ainda maior (1,0/0,9 mm). Próximo carimbo: cl75.

cl73: Case — vão maior da tampa em cima do cilindro. Próximo carimbo: cl74.

cl72: Case — cilindros fundidos à base (união CSG), furo do pino na ponta, contorno fino na lateral da tampa. Próximo carimbo: cl73.

cl71 (Case, confirmado pela dona "é isso mesmo"): cilindro da base em cada ponta, numa forma só com ela, aflorando na lateral com o pino; engate da tampa = peça quadrada de dentro com nervura até o espelho; vão no centro. Próximo carimbo: cl72.

cl70: Case — eixo dentro da tampa, cilindro aflorando como círculo na lateral, rebaixo arredondado na borda de trás da base. Próximo carimbo: cl71.

cl69: Case — peça quadrada sobe como nervura até o espelho; cilindro da ponta dentro de uma abertura da tampa (vão atrás dele). Próximo carimbo: cl70.

cl68: Case — cilindro da ponta curto e grosso, peça quadrada da base do mesmo tamanho, pino só aparece no vão. Próximo carimbo: cl69.

cl67: Case — na ponta um cilindro único da tampa (antes bloco da base + dente) com o pino em L por cima; peça quadrada de dentro é da base; vão no centro. Próximo carimbo: cl68.

cl66: Case — pino metálico visível em L em cada ponta (sobre o bloco da base e dobrando no vão), dois mecanismos independentes. Próximo carimbo: cl67.

cl65: Case — nó da tampa quadrado arredondado segurando o pino e canal vazio no centro (pedido da dona). Próximo carimbo: cl66.

cl64: Case sem nó/pino no centro (pedido da dona); dobradiça só nas pontas: dente da tampa, bloco da base, vão fino, nó da tampa. Próximo carimbo: cl65.

cl62: aba do Moon sem listras (normais radiais na face de fora após a união do `joinTab`). cl63: dobradiça dos Case remontada pela foto CASE-G-2 — cinco nós (dente da tampa, bloco da base na ponta, nó da tampa, nó comprido da base no centro) com os vãos da foto; ver Registro do CODEX_REFINO. Próximo carimbo: cl64.

# Atualização Claude — 18/11/2026, cl61

Conta-gotas: borracha em sino com respiro no pé (todos de bulbo), botão com topo em domo (Flacon Botão, Julie), ombros/fundos dos Flacon 15/30 Bulbo, refil do Dispensing 15/30 até o fundo da cavidade, spray dos Deluxe reproporcionado pela foto (mais baixo e encorpado). Os 10 itens marcados "feito" na revisão. Próximo carimbo: cl62.

# Atualização Claude — 18/11/2026, cl60

Case (todos): dente da tampa nas pontas da dobradiça (parede lateral desce em volta do eixo, fechando o nó da base por fora) e sem o apoio em bloco da cdx29 (a dona disse que não existe). Próximo carimbo: cl61. Macaroon cdx33 segue aguardando a dona; Moon/Classic aprovados intocados. PDF: a dona disse que não precisa gerar.

# Atualização Codex — 18/11/2026, cdx33

Macaroon: pedido da dona de mostrar só a haste lisa, sem dobradiça cilíndrica aparente. Raiz da haste e alojamento do pino modelados numa única peça com furo interno; olhal cilíndrico externo removido, apoios laterais com topo baixo sob o aro. Pino permanece interno, com o mesmo eixo e movimento da cdx32. Preserva ponte curta, desvio em U, godê e espelho. Migra a configuração padrão cdx32 nos projetos anteriores. Referência: assets/revisao/ref-dona/macaroon-haste-sem-cilindro.png. Testes: nove poses, retorno fechado, animação, export e migração da cdx32; eixo e dimensões preservados. Godê, espelho, U da base e três controles (Case M, Frame G com Visor, Moon Deck) idênticos à cdx32. Relatório tools/conferencia/validacao-cdx33.json. Conferência visual da dona continua pendente.

# Atualização Codex — 18/11/2026, cdx32

Macaroon: a dona recusou a ponte comprida/alta da cdx31. Referências novas em assets/revisao/ref-dona/macaroon-ponte-curta-ampliada.png e macaroon-desvio-base-p14.png. Ponte agora mais estreita, curta e baixa junto ao eixo; não chega até o espelho. Base com recorte atravessando o contorno e retorno em U do aro, como na vista superior da p14, e furo do pino atravessando o retorno e a parede original. O godê e sua parede de suporte permanecem iguais. Espessuras/folgas são de representação, estimadas nas fotos. Atualiza só configurações antigas exatas do Macaroon Incom, preservando personalizações. Validação: nove poses do Macaroon, animação abrir/fechar, export e migração do modelo anterior; cinco amostras do eixo livres, passagem vazia e três lados do U com material confirmados por raios. Case M, Frame G com Visor e Moon Deck com malhas idênticas à cdx31. Relatório tools/conferencia/validacao-cdx32.json. Não marcar aprovado sem a dona conferir.

# Atualização Codex — 18/11/2026, cdx31

Pedidos novos: Case com lingueta próxima do colar do godê (cinco variantes), dente interno reposicionado junto. Aba frontal integrada à tampa por união do sólido antes dos recortes de oco/visor; raiz sem chapa sobreposta. Frame com malha subdividida antes de acompanhar a planta abaulada, para não virar uma corda reta. Folga/espessuras de representação estimadas nas fotos. Testes em tools/conferencia/validacao-cdx31.json. Resultado: 32 modelos/288 poses, retorno exato, dimensões fechadas preservadas, 80 amostras livres dos eixos, 45 raios livres nas janelas, espelhos/visores com as mesmas malhas. Três exports de controle. Cache da miniatura separado do modelo completo para não substituir o visor por uma tampa sólida. Dimensões fechadas e demais dobradiças são controles contra cdx30; só a ponte do Macaroon muda nesta rodada.

**Foto nova Macaroon:** assets/revisao/ref-dona/macaroon-fechamento-ampliado.png. A dona confirmou que aponta a ponte larga entre tampa/base (dobradiça). Ponte alargada e orientada pelo interior da tampa, do eixo até perto do espelho; a chapa vertical anterior ficava escondida na parede ao abrir. Folgas/espessuras estimadas, aguardando conferência visual da dona; não marcar aprovado automaticamente. PDF final continua aguardando correções e conferência.

# Atualização Codex — 18/11/2026, cdx30

Frame/Macaroon receberam articulação própria: apoios fixos com furo, olhal e aba móvel da tampa chegando ao pino. Moon/Classic aprovados preservados. Auditoria de 32 modelos / 288 poses, retorno fechado e export de controle: tools/conferencia/validacao-cdx30.json. Pendências novas da dona: eliminar friso na junção tampa/aba e aproximar a lingueta do Case do colar do godê, com encaixe correspondente na tampa. Não marcar aprovação automaticamente.

# Atualização Codex — 18/11/2026, cdx29

Ler `APROVACAO_INCOM_CODEX.md` para os status da dona. Auditoria inicial de 32 conjuntos: Case corrigido com alojamentos circulares mais curtos e pinagem real; cinco variantes validadas. Os 13 Moon/Classic aprovados têm as mesmas malhas. Registro e validação em CODEX_REFINO.md e tools/conferencia/validacao-cdx29.json. Frame/Macaroon ainda em estudo isolado; não mudar hingeBloco dos Moon. Nenhuma aprovação foi marcada automaticamente.

# Retomada OUTBOX / Incom — 17/11/2026

## ATUALIZAÇÃO MAIS RECENTE — 17/11/2026, fim da sessão Claude (ler primeiro)

Versão no ar: **`2026-11-18.cl59`** (`main`). Duas sessões Claude trabalharam em paralelo na mesma pasta (a "fork" fez os aplicadores do Petit, cl5–cl17). Antes de commitar: `git fetch` + `git log HEAD..origin/main`; push por SSH `git@github.com:isabelaswt/outbox.git`; carimbo em 3 lugares (BUILD e import `incom.js?v=` em `js/app.js`, `?v=` de css/js em `index.html`). Próximo carimbo: **cl60**. Registro de cada envio na seção 8 do CODEX_REFINO.md.

### PENDENTE AGORA (2026-11-18, versão no ar cl59)
cl59: Moon — tampa reta na dobradiça (sem entalhe), bloco da base rente à divisão. cl58: dobradiças das Flat/Big (recorte da tampa + ressalto central da base) e dos Moon/Frame/Macaroon (bloco preso à base) refeitas pelas fotos ampliadas da dona. **LER PRIMEIRO: `APROVACAO_INCOM_CODEX.md`** (fecho da sessão Claude na cl59: linha Moon aprovada; 11 itens em ajustar — pino do Case e 10 conta-gotas/frascos) — ferramenta de aprovação, histórico das dobradiças (a dona pediu que o Codex assuma) e os 17 itens em ajustar.
cl57: dobradiça escondida das Flat/Big com rampa (rebaixo trapezoidal na base + faixa da tampa no mesmo desenho). cl56: dobradiça escondida das Big/Flat como faixa reta no centro da calha (não cilindro). cl55: dobradiça dos Moon/Frame/Macaroon = parede de trás da tampa entre dois cortes até o topo + língua no vão da base. cl54: dobradiça do Macaroon mais fina com recorte na base. cl53: Case com o buraco das dobradiças nas pontas, Frame mais retangular (n 8, bow 0.07), visor do Quinteto. cl52: dobradiça dos Moon menor dentro do vão, borracha dos conta-gotas fina, botão de topo curvo, ombro do Flacon 30, refil do Dispensing 30. cl51: dobradiça escondida em Big/Flat (rolo da tampa na calha), Flat 6+1 godê grande à esquerda, spray dos Deluxe, Bulb (anel menor, dente para dentro, conta-gotas fino) e Dispensing conta-gotas (ombro com degrau). cl50: rodada de 22 itens (dobradiça em bloco Moon/Frame/Macaroon, Moon Deck tampa presa ao andar do meio, Case até a ponta + rebaixo, Classic moldura alta invertida, Frame cavidade suave e planta abaulada, parede do godê no Macaroon, flick na vista ortográfica). ATENÇÃO: a revisão abria versão velha por cache do servidor — corrigido com `&t=` no iframe; se a dona disser que algo 'não mudou', conferir o carimbo no rodapé do iframe. cl49: dobradiças do Case até perto da borda (nó da base num ressalto + nó da tampa por fora, com recortes) e moldura dos godês do Classic Duo/Quarteto para cima (`patamar`). cl40–cl48 resolveram tudo o que estava em "ajustar" (Case, Classic, Frame, Macaroon; fillets dos Moon estendidos a todos os compactos/paletas; segunda camada do Moon Deck abrindo junto) e marcaram "feito". Regra da dona: ir fazendo sem perguntar e aplicar cada pedido em lote aos produtos irmãos. Próximo passo: ler de novo `api/revisao.php?a=list` e trabalhar o que voltar em "ajustar". Login: aba do navegador do app em outbox.swtool.co logada pela dona.
Próximo carimbo: cl60.
Atenção: o Flat Dez leva ~3 s para montar (godês por contorno cortados com `pocketCut`); se ficar lento, reduzir os pontos de `cOut` (120) ou os anéis.

### Aprovação Incom (revisao.html) — fluxo de trabalho a partir do cl34
A dona avalia cada modelo em `https://outbox.swtool.co/revisao.html` (foto real × render ao vivo) e marca **Aprovar** ou **Ajustar** com comentário. Para trabalhar: ler `api/revisao.php?a=list` (precisa da sessão dela — pelo navegador dela, com permissão) e pegar os itens com status `ajustar`; corrigir, publicar e responder com POST `api/revisao.php?a=set` `{k, status: 'feito', texto: 'o que mudou', build: '<carimbo>', autor: 'Claude'}`. Ela revisa os `feito` e aprova ou pede de novo. Fotos novas: rodar `python3 tools/revisao/fotos.py` (lista em `tools/revisao/lista.json`, tirada de `window.OUTBOX.PRESETS`).

### Regras da dona reforçadas nesta sessão
- Forma e detalhes vêm das FOTOS (site Incom); desenho técnico só para medidas.
- Cuidar de detalhes minuciosos: fechamento, altura exata onde cada peça começa (linha de divisão), arredondamento de abas/bordas.
- Conteúdo sempre CHEIO (92–94%) e com cor real; líquido transparente tingido (não leitoso — cor pálida vira bloco de leite no material de lente); o frasco tem que aparecer.
- Fundo de PET: leve (2,5% da altura); ela achou 4% pesado. SAN sem refil: 5%.

### Feito nesta sessão (cl1–cl14, Claude)
- Fotos do site: 152 produtos em `_ref/incom/site/<slug>/` + `indice.json` (fichas PDF dentro). Validações antigas foram para a Lixeira (ficaram cdx27 e retomada-cdx28).
- Troca de peça: grupo "Sugestões Incom para este produto" (variantes do catálogo; genérico não mostra).
- Charlotte/Charlotte Rounded/Olympea: em pé sobre a tampa; Abrir mostra gargalo roscado + bico para baixo (`bocaBaixo`, `ocoCima`).
- Petit com Haste/Aplicador: montados como a foto aberta e virados fechados (`viraFechado` em compactParts); ponta arredondada.
- Bico dosador padrão Incom Ø1,6 (`incomBico` em sprayGeo) em Julie, Olive, Vênus 35/45: bordinha rente à boca (não passa para fora) + cone reto. Julie: anel do ombro no frasco.
- **Case: fecho resolvido** (prioridade 1 antiga): painel central rebaixado ~41% da frente, quase a parede toda (`dedo.panel`, `latchRoof`).
- Classic Duo: bandeja com godês desiguais (foto). Moon P com visor.
- Miami = cilindro Ø50,5 (fotos + volume). Chicago com quinas de baixo arredondadas.
- Conteúdo: SERUM_CORES / BASE_CORES / GEL_CORES / CREME_CORES (escolha por nome com `corDe`). Potes e refis com conteúdo. Dispensing 30/60/Quadrado: só casca grossa + coluna (cavidade encosta no refil; coluna 76/82/70%). On-Off: PET transparente com líquido.
- Tube (cdx28) validado antes nesta sessão.

### Conferência foto × render — onde parou
Esteira: preview "shape" (porta 8765, aba "seed"), `window.__rcat(categoria, prefixo, vistaAberta)` renderiza fechado 3/4 + aberto e manda para um receptor local (Claude usou `scratchpad/recv97.py` na porta 8797; 8798 é de outra sessão, 8799 é do Codex). `scratchpad/cmpsheet.py <prefixo>` monta folhas fotos do site × render (tem ALIAS para páginas com título errado: Amsterdam→amsterdam-200, NY Deluxe 100→amsterdam).
- **Conferidos:** compactos, paletas, frascos, conta-gotas, dispensadores (exceto detalhes do Cube/Elíptico), deluxes, frasnagas; e em cl18–cl20 batons, líquidos labiais, máscaras, sticks e potes (correções: Timeless piso plano, Oscar All Crystal inserto incolor, parede grossa no gloss PET G, Gaia translúcido).
- **Tampas de perfume (68) conferidas em cl22** (Crown Mini corrigida). Timeless refeito em cl21 pelas fotos (quadrado de quinas arredondadas). **A conferência foto × render está completa.** Válvulas próprias Incom feitas em cl23 (grupo Incom em Tampa/Válvula; bico de pato `patoIncom` no Bulb Blow 300). Roscas dos conta-gotas feitas em cl24 (Julie e Flacons). Em cl25 bico de pato, espumadora, bico aplicador e tampa bola refeitos pelo ícone (folha `_ref/incom/fechamentos-incom-comparacao.jpg`); em cl26, pelo retorno da dona: bico de pato afinando (curva contínua, sem quina — cl27) com saída retangular, bola COM colar (a dona confirmou pela foto; proporções da foto do BB250 em cl27), bico aplicador sem degraus, sobretampa fine mist descendo até o ombro. Próximo: variantes; por último captura final e PDF. Pendentes: Tate sem foto no site (seção quadrada não confirmada); Pote Apple Blow sem página própria; Avante com peneira (opção).
- Esteira usada em cl18–cl20 (sessão principal): preview `outbox` porta 8766, receptor `scratchpad/recv96.py` na porta **8796**, `scratchpad/cmp.py <prefixo_render> <slug_site> <saida>` monta a folha site × render (fechado frente, 3/4, aberto).
- Pendentes vistos e não feitos: Julie — opções do site (bico aplicador, conta-gotas, válvula) como sugestões de troca; Dispensing Elíptico sem página casada no site; fundo grosso SAN ainda renderiza branco (deveria parecer cristal).

### Continua aberto da lista anterior
- Válvulas próprias Incom (`Incom · Válvula`), começando pelo bico de pato do Bulb Blow 300 (ramo `patoIncom`) — ver abaixo.
- Conta-gotas: roscas onde documentadas. Variantes documentadas (máscaras Guggen/Plus/Oscar, potes Avante/Oval, batons tampa opaca/transparente, colares Brilhante/Iridium/Tahaa, fechamentos Deluxes 200).
- Só depois: captura final e PDF (`tools/conferencia/`).

---
## (Histórico — retomada anterior do Codex; itens 1 Case e 2 Tube já resolvidos acima)

Leia este arquivo e **CODEX_REFINO.md inteiro** antes de editar. A dona pediu o repasse porque está ficando sem crédito. Não reiniciar a auditoria nem apagar o trabalho local.

## Objetivo ainda aberto

Refinar todos os modelos conforme catálogo Incom 2026 e fotos oficiais, com os mecanismos visíveis, roscas documentadas e variações oferecidas. Cor base bege fosco; transparências específicas preservadas. **Só produzir o PDF completo foto × render depois das correções.** Não foi produzido PDF novo nesta rodada. Não declarar que tudo está corrigido.

## Últimos pedidos da dona — prioridade

**ÚLTIMO PEDIDO, após os itens abaixo:** criar válvulas NOVAS e próprias da Incom, e incluir **TODAS as válvulas documentadas da Incom** na biblioteca `Incom · Válvula`, separadas de `Outbox / genérico`. Não resolver apenas mudando nomes/categorias ou reutilizando o desenho genérico sem conferir. Esse trabalho AINDA NÃO foi implementado.

- Começar pelo bico de pato do Bulb Blow 300. O modelo atual usa três `P('...')`/corpos (saia, haste, cabeça) em `incomProduct`, ramo `patoIncom`; é uma aproximação rejeitada, não uma válvula final.
- Foto real mostra saia cilíndrica, haste estreita e cabeça com lâmina fina/alongada, curvada para baixo na ponta. O render atual parece uma placa alta/grossa e não reproduz a saída. Conferir frente, lado, 3/4 e abertura no site oficial; não presumir os mecanismos internos sem imagem.
- Criar peça de válvula própria com identidade Incom no `LIB`/gerador (por exemplo um tipo próprio de spray), geometria real de cabeça/bico/saída conforme foto, e componentes internos só quando documentados. A montagem pode ter componentes editáveis, mas NÃO classificar pump/haste/cabeça como corpo do frasco nem somá-los à capacidade.
- Auditar a biblioteca inteira de válvulas Incom: sprays, dosadoras, espumadoras, bico de pato, conta-gotas bulbo/botão e demais opções que efetivamente constarem nas páginas. Incluir também os acabamentos de válvulas de perfume documentados. Esta é uma lista de investigação, não inventário final: completar a partir do catálogo e do site, sem presumir que cada item já existe/é distinto.
- Cada válvula precisa de fonte/página/URL, dimensões cotadas ou proporções explicitamente estimadas, rosca correta quando listada, material bege como padrão e detalhes observáveis. Preservar genéricas Outbox separadas.
- Substituir os três corpos improvisados no Bulb Blow 300 pela nova válvula. Revisar classificação e cálculo de capacidade em todas as montagens e no menu intercambiável; verificar modelos salvos sem apagar edições da dona.
- Referências preservadas: `_ref/incom/retomada-cdx28/pump-bulb300-atual.png` e `pump-bico-pato-referencia.png`. Screenshot da dona mostra cdx24; confirmar também preset novo antes/depois, sem usar versão antiga como justificativa para deixar a geometria ruim.
- Publicar por etapas pequenas, com comparação foto × render e testes geométricos. Só fazer PDF depois das válvulas e demais correções.


1. **Fecho do Case ainda diferente — NÃO corrigido nesta etapa.** Foto nova mostra recorte/painel frontal central alto e largo na parede da tampa, chegando perto da altura total da parede, com fina borda embaixo. No render atual ele virou uma abertura pequena e baixa. Conferir forma/largura/altura no site e fotos, com o produto fechado e aberto. Não confundir esse recorte da tampa com a pequena lingueta receptora da base: a base continua com lingueta simples, sem caixa. Não generalizar entre famílias sem referência.
   - Referência: `_ref/incom/retomada-cdx28/case-fecho-referencia.png`.
   - Render recusado: `_ref/incom/retomada-cdx28/case-fecho-atual.png`.
   - O limitador atual `t.dedo.h = Math.min(2.4, t.h * 0.45)` em `incomProduct` é um ponto a revisar; não aumentar só por palpite.
2. **Tube:** tampa precisa de rosca INTERNA e parede visualmente fina. Última mudança local acrescenta entrada fina de 1 mm (`threadLead`) e alívio acima da rosca, mas ainda NÃO foi renderizada/testada. Não dizer que essa última mudança está aprovada.
3. **Usar site oficial quando houver dúvida.** A dona autorizou conferir outras imagens e forneceu https://incom.com.br/packing/produto/frasnaga-tube/ . Site confirma 20/410 e orifício Ø1,6 mm. Três imagens baixadas para análise em `_ref/incom/site/tube/`. Catálogo/fotos são as únicas referências; não há CAD nem desenhos internos adicionais.
4. **Case M com espelho:** corrigido e publicado em cdx26. Case M/G padrão agora com tampa bege e espelho; opção Tampa Cristal separada. Não retirar esse espelho ao corrigir o fecho. M All Crystal segue distinto.

## Repositório e estado exato

Pasta: `/Users/isabelarodrigues/LocalCodex/SHAPE_EMBALAGENS`.
Remote configurado: `https://github.com/isabelaswt/outbox.git`, branch `main`.
Último commit de código publicado: **`f24ec1e` / versão `2026-11-17.cdx27`**.

Publicados nesta sequência:

- `d33270d` / cdx25: onze frascos p64–74 com rosca fêmea no fechamento 24-410, fase axial pareada ao gargalo. Corpo + gargalo nas cotas. 264 cristas com folga radial ~0,156–0,160 mm.
- `2142e4c` / cdx26: espelhos dos Cases G/M e opções Tampa Cristal separadas. Cinco conjuntos conferidos; espelhos contidos, cotas preservadas, fechos sem colisões nas amostras. Isso NÃO aprova a aparência do recorte agora recusado.
- `f24ec1e` / cdx27: sete dispensadores explicitamente roscados + seis Deluxes com pares 20-410/24-410. Passagem contínua pelo anel e saia da válvula. On-Off/Twist preservados. Dimensões externas iguais às anteriores. Relatórios em `tools/conferencia/validacao-cdx25.json` a `cdx27.json`.

**WIP local NÃO commitado:** `js/app.js` e `index.html`, carimbo `cdx28`. Não restaurar esses arquivos a partir de HEAD sem salvar o diff. A documentação desta retomada tem commit próprio; não confundir com publicação do código cdx28. Cópia de segurança do diff em `_ref/incom/retomada-cdx28/cdx28-wip.patch`.

Dois arquivos novos nossos ainda sem commit também:

- `tools/conferencia/conferencia_final.html`
- `tools/conferencia/prepare_catalogue.py`

São preparação do PDF, não trabalho alheio. Preservar. Não commitar `_ref/`, catálogo, renders ou PDF.

## O que há no WIP cdx28

- Beatrice, Julie, Olive, Vênus 35/45: boca roscada + tampa fêmea, tampa abre ao lado. Quatro tipos 20-410 conforme texto; Beatrice sem norma cotada usa rosca livre representativa, comentada. Cinco pares testados com 24 amostras cada, sem alterar cotas externas.
- Tube: o perfil extraído do desenho de GARGALO estava sendo usado na tampa, afinando-a abaixo do necessário à rosca. Substituído por tampa cilíndrica própria, proporcional à foto aberta.
- **Leitura dimensional Tube corrigida:** desenho p84 mostra **109 mm de corpo + gargalo exposto**, não conjunto fechado. Corpo atual 94,3 + gargalo representativo 14,7 = 109 mm; bico separado sobe mais. Tampa estimada ~24,4 × 30,4 mm; conjunto fechado ~124,7 mm, que NÃO é cota oficial. Catálogo não traz profundidade: D≈23,2 mm estimado da foto; marcado `fest:'D'`.
- Corpo Tube com seção achatada e cantos arredondados, pela foto 3/4 nova. Manter bege. Não usar as cores dos exemplos como padrão.
- Bico cônico separado `incomTubeTip`, com passagem real Ø1,6 mm em `sprayGeo`; cone/root/lip proporcionais à foto, sem cotas industriais próprias.
- `fMeasure` no Tube e texto do editor esclarecem o escopo da cota; Frascos também indicam corpo + gargalo, sem fechamento.
- Fase de cavidade agora calculada pelo layout normal (`base`), para não mudar a rosca no modo Explodir.
- Último pedido da dona acrescentou à tampa do Tube `ocoWall:1`, `threadLead:{r:W/2-1,h:6.8}` e permitiu alívio acima do gargalo quando `threadCavityFull`. **Essa última mudança ainda exige QA.**

### Validação WIP já existente, com limites

Snapshots preservados em `_ref/incom/retomada-cdx28/`:

- `cdx27-frasnagas-base.json`: onze frasnagas anteriores.
- `cdx28-primeira.json`: primeira rodada. Tube ainda FALHAVA nessa versão (24 cristas sem parede), demais cinco pares passaram. Não usar como aprovação do Tube.
- `qa-final.json`: três controles Cube / New York frasco / Tube da rodada antes do último afinamento. Tube: corpo + gargalo ~109,001; cristas presentes, folga ~0,157–0,160; 90 amostras do bico fora do sólido da tampa; passagem central aberta; exportRoot inclui corpo/gargalo/bico/tampa. Cotas externas dos controles preservadas. Ver também `explodedReceiverChecks`.

A última geometria de entrada mais fina NÃO está coberta por esses snapshots. O `qa-final.json` temporário do receptor pode ter mudado; usar a cópia acima para histórico.

## Próximas ações concretas

1. Revisar o recorte/fecho fechado do Case usando as fotos novas e as páginas oficiais, preservando lingueta simples e espelho. Render comparativo do mesmo ângulo; conferir aberto/fechado, cotas, dente/encaixe. Não considerar só teste de colisão como aprovação visual.
2. Renderizar o Tube após o último afinamento, inclusive vista de dentro da tampa: rosca visível, borda fina, bico sem colidir e orifício Ø1,6 passante. Conferir corpo + gargalo 109 mm e explicar as demais medidas estimadas. Confirmar fonte de profundidade antes de refiná-la mais.
3. Validar/publicar cdx28 quando os testes passarem. Se separar a correção do Case em outro commit, manter o carimbo coerente em BUILD, import incom e css/js do index.
4. **Roscas inferiores que faltam:** Charlotte, Charlotte Rounded, Olympea e Petit com Haste ficam EM PÉ SOBRE A TAMPA. Precisam boca voltada para baixo e receptora correspondente. Não aplicar receita de gargalo superior. Não começaram. Petit Aplicador p83 não consta no inventário de rosca explícita; conferir fotos/site antes de presumir mecanismo.
5. Conferir Conta-gotas (dez modelos) por imagens de abertura e inserir pares quando documentados; inventário de 65 linhas explícitas não os inclui. Não presumir rosca em virolas recravadas ou sistemas press-fit.
6. Completar variantes documentadas (abauladas/retas, fechada/cristal, espelhos opcionais, válvulas compatíveis), sem inventar o que catálogo/site não mostram. Fontes listadas abaixo.
7. Fazer captura completa NOVA de todos os modelos/variantes, conferir fotos/desenhos e cotas e só então PDF. A captura parcial antiga cdx16 de 119/186 está obsoleta.

### Variantes ainda por conferir/implementar

- Guggen / Guggen Plus / Roll On / Moma 2.0 / Oscar líquidos: opções reta/abaulada quando listadas.
- Guggen / Plus / Oscar máscaras: opções reta/abaulada.
- Avante / Oval potes: reta/abaulada.
- Compactos/paletas: visores/fechada/cristal e espelho opcional conforme cada página. Não retirar espelhos dos padrões já corrigidos. Moon M bandeja dupla sem medidas continua pendência, não inventar.
- Batons: tampas opacas/transparentes quando oferecidas.
- Brilhante, Iridium e Tahaa: colares aberto/abaulado; Flint já tem ambos.
- Deluxes 200 oferecem outros fechamentos: conferir opções Sens/Bola/pump na página oficial/catálogo, sem trocar o padrão pela opção errada.
- Moma baixa74/alta85 (cdx22), Long/Long Lipview abaulada (anterior) e Case G/M Tampa Cristal (cdx26) já existem; não duplicar.

## Código e ferramentas

- `js/app.js`: `neckThreadField`, `femaleThreadCutter`, `sprayGeo`, `moduleGeo`, `ocoGeo`, `compactParts`, `buildInto`, `incomProduct`.
- `threadReceiver` permite cavidade na saia; `threadNeckUid` referencia gargalo de outro índice; `threadThrough` passa por anel, `threadCavityFull` mantém espaço acima do gargalo. `threadLead` é opção nova exclusiva Tube por enquanto.
- `incomProduct` Case: `caseLatchSimple`, `t.dedo.h`; partes em `compactParts`.
- `INCOM_PRODUCTS`, perfis e páginas em `js/incom.js`.
- Harness ignorado `_ref/incom/qa-cdx.html`. Parâmetros `filter` regex, `view=three|front`, `export=1`, `explode=1`, `rev=`. Ele usa iframe / `window.OUTBOX`, captura JPEG e manda JSON ao receptor. Tem testes de pares fêmea, espelhos, dentes, bico e modo Explodir. Não confundir `bodyDims` com H fechada do Tube/Frascos.
- HTTP auxiliar: porta8767 na raiz do repo. Receptor: `python3 tools/conferencia/recv.py /tmp/outbox-cdx10` porta8799. Podem ainda estar vivos; conferir antes de iniciar duplicados. Servidor da dona8766: não matar.
- Resultados temporários `/tmp/outbox-cdx10/qa-final.json`, `qa-status.json`, JPEGs. Congelar em `_ref` antes de outra rodada.
- Browser de teste Chrome temporário; não depender de tab IDs antigos. Não substituir o projeto salvo da dona. Ela pode estar vendo modelo salvo antigo mesmo com JS novo: abrir o preset atualizado/usar Atualizar com cuidado, sem descartar edições.

## PDF — preservar preparação

`tools/conferencia/prepare_catalogue.py` já extraiu 183 páginas de referência para `_ref/incom/fotos-conferencia/` e `catalog-data.json`.
`conferencia_final.html` precisa reconhecer `fsourceKey` (Moma Alta, Cases Cristal e futuras variantes), além dos casos antigos Long/Flint. Precisa tratar Tube como corpo+gargalo, não H fechada. Biblioteca já tem mais itens que186; contar dinamicamente.
Montador ReportLab novo ainda não foi escrito. Não usar cegamente o montador legado: semântica das cotas, tampas de perfume com frasco genérico e profundidades estimadas precisam tratamento.

Skill PDF disponível: `/Users/isabelarodrigues/.codex/plugins/cache/openai-primary-runtime/pdf/26.1112.11217/skills/pdf/SKILL.md`. Ler ao aplicar. Runtime ReportLab/PIL: `/Users/isabelarodrigues/.cache/codex-runtimes/codex-primary-runtime/dependencies/python/bin/python3`; host python3 tem fitz/PIL/pypdf. Não precisa instalar.

## Git / coordenação

Fetch e `git log HEAD..origin/main` antes de cada commit; integrar Claude sem sobrescrever WIP. HTTPS fetch funciona. HTTPS push falhou autenticação neste ambiente; SSH funcionou com `git push git@github.com:isabelaswt/outbox.git main` (não alterar remote sem necessidade).
Permissões de escrita no repo/.git e rede já foram concedidas nesta sessão; outro chat pode precisar das permissões próprias. Commit/push direto na main autorizado pela dona. Atualizar registro do CODEX_REFINO a cada publicação. Não commitar o cdx28 sem terminar a validação final.
