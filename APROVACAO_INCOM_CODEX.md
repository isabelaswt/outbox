# Aprovação Incom: o que é, como trabalhar e até onde chegamos

Escrito em 18/11/2026 pela sessão Claude, que publicou da cl40 à cl59. É a passagem para o Codex.

Situação: a dona acha que **não estamos acertando as dobradiças**. Ela quer que o Codex tente entender o mecanismo melhor. As seções 4 e 5 contam cada tentativa e a resposta dela.

**Estado no fecho desta sessão (cl59): 13 aprovados (`ok`), 16 `feito` esperando a revisão da dona e 11 em `ajustar`.**
- **Linha Moon inteira APROVADA** pela dona depois da cl59. Ela disse "melhor, aprovar essa linha" e os 10 Moon foram marcados `ok`. **Não mexer no `hingeBloco` dos Moon.** Frame e Macaroon usam o mesmo código, então qualquer mudança neles tem que ser condicionada à família.
- **Flat/Big:** dobradiça refeita na cl58 pela foto ampliada (recorte da tampa + ressalto central da base). Os itens estão `feito`; falta a dona conferir.

Versão no ar: **`2026-11-18.cl59`**. Próximo carimbo: **cl60**.

---

## 1. A ferramenta de aprovação

**Onde fica:** `https://outbox.swtool.co/revisao.html`. Precisa da sessão da dona: entrar no OUTBOX primeiro. Os arquivos são `revisao.html` e `js/revisao.js` (v5).

**O que mostra, para cada produto do catálogo Incom 2026:**
- **À esquerda:** as fotos reais, `assets/revisao/fotos/<slug>/N.jpg`, mais a página do catálogo, `assets/revisao/catalogo-hd/pNNN.jpg`.
- **À direita:** o render ao vivo do OUTBOX num iframe (`index.html?embed=1`).
- **Embaixo:** os botões **Aprovar** (status `ok`) ou **Ajustar** (status `ajustar`), com comentário. A conversa fica em `thread`.

**Status possíveis:**
- `ajustar`: a dona pediu correção.
- `feito`: nós corrigimos e respondemos; ela revisa de novo.
- `ok`: aprovado.

**API** (`api/revisao.php`). Chamar com `fetch` de uma aba já logada em outbox.swtool.co (a aba "seed" do navegador do app):
- **Ler:** `GET api/revisao.php?a=list` devolve `{ itens: { "<chave>": { status, thread: [{ quem, texto, status, build, em }] } } }`.
  - A chave é o nome do preset, por exemplo `"Incom Moon P (compactos)"`.
  - `build` é o carimbo que estava no iframe quando ela comentou. Use isso para saber **que versão ela viu**.
- **Responder:** `POST api/revisao.php?a=set` com o corpo `{ k, status: 'feito', texto: 'o que mudou', build: '2026-11-18.clNN', autor: 'Codex' }`.

**Cache:** o servidor (LiteSpeed/Hostinger) guardava uma cópia velha de `index.html?embed=1`. A revisão chegou a abrir a cl44 quando a cl49 já estava no ar.
- **Corrigido na cl50:**
  - o iframe carrega `index.html?embed=1&t=<agora>` (`js/revisao.js`);
  - o `.htaccess` manda `X-LiteSpeed-Cache-Control: no-cache` no HTML.
- Se ela disser que "nada mudou", confira o `build` do comentário dela.

**Regras da dona:**
- Ir fazendo sem perguntar.
- Aplicar cada pedido **em lote** aos produtos irmãos: todos os Moon, todos os Case, todos os Frame, todas as Flat e assim por diante.
- Forma e detalhes vêm das **fotos**; o desenho do catálogo serve só para as medidas.
- Commit e push em `main` a cada rodada, com o carimbo em 3 lugares:
  - `BUILD` em `js/app.js`;
  - o import `incom.js?v=` em `js/app.js`;
  - o `?v=` em `index.html`.
- Registrar cada envio na seção 8 do `CODEX_REFINO.md` e atualizar o topo do `HANDOFF_CODEX.md`.

## 2. Como conferir localmente

- **Preview:** launch "outbox", porta 8766. Use `http://127.0.0.1:8766`; o localhost mostra a tela de login.
- **No console da página:** `window.OUTBOX` expõe `PRESETS`, `loadState`, `build`, `S`, `product`, `cam` e `render`. Para montar um produto:
  `OUTBOX.loadState(structuredClone(OUTBOX.PRESETS['Incom Moon P (compactos)']), 't'); OUTBOX.S.aberto = true; OUTBOX.build()`
- **Para abrir e fechar como a dona faz:** clique em `#openBtn`. Nos compactos isso anima a dobradiça sem remontar a peça (`animateHinges`).
- **Para ver a dobradiça, olhe de trás e de cima, fechado E aberto.** A dona sempre abre totalmente e gira o modelo. A maior parte das reclamações veio do produto **aberto**.

## 3. Mapa do código das dobradiças (`js/app.js`)

| O quê | Onde |
|---|---|
| Presets Incom (medidas, tipo de dobradiça por família) | `incomProduct` (~9900); bloco "Compactos/Paletas" ~10255–10330 |
| Tipo de dobradiça por família | Case ~10267 (`hingeCase`); Frame/Moon/Macaroon ~10275 (`hingeBloco`); Flat ~10279 e Big ~10330 (`hingeOculta` + `hingeCalha`) |
| Geometria das dobradiças | `compactParts` (6590), laço das dobradiças a partir de ~6895 |
| Girar as peças | `setHinge` (6577). `userData.hinge = { y0, z, p, q, under }`; `under` é a peça de baixo que também gira (andar do meio do Moon Deck) |
| Abrir e fechar animado | `animateHinges` (7756); `soDobradica()` decide se dá para animar sem remontar |
| Cortes (CSG) | `cutHole` (1842, three-bvh-csg); `pocketCut`, `sweepCut` e `softTabCut` (6512–6555) |

**Como funciona hoje:**
- Cada módulo com `hinge` (a Tampa, e no Moon Deck também o "Andar do meio") gira em torno de um eixo X na linha de divisão: `y0` = base da tampa e `hz` = perto das costas.
- As peças da dobradiça são malhas a mais, presas à tampa (giram) ou à base (paradas). Os recortes são CSG na malha principal da base (`bObjs[0]`) e da tampa (`objs[0]`).
- **Desde a cl50:** primeiro se monta tudo e só depois se gira (`hingeInfo`). O corte CSG precisa ser feito com as peças na posição fechada.
- **Na foto da dona, a dobradiça quase sempre faz parte da própria tampa e da base**, com recortes e encaixes. Ela não é um "cilindro" nem uma "caixa" grudada por fora. Esse é o ponto que não conseguimos acertar.

## 4. Histórico das dobradiças, família por família

As frases entre aspas são da dona, copiadas da revisão. "cl" é o carimbo publicado.

### Case G / Case M / Case M All Crystal / Tampa Cristal (`hingeCase`)
Fotos: `assets/revisao/fotos/case-*`, `_ref/incom/site/case-m-all-crystal/CASE-M-4/8/9`.

1. **Até a cl48:** dois pares de 3 nós cilíndricos a ±30% do centro (`hingePair`).
2. **Pedido na cl48:** "tem um recorte no meio das dobradiças… a dobradiça vai do lugar onde ela tá até as bordas. tem uma altura na parte de trás da base onde começam as dobradiças".
3. **Resposta na cl49:** de cada lado, nó da base por dentro (18–31% do centro) sobre um ressalto atrás da base, e nó da tampa por fora até 44%. Tampa recortada onde o ressalto entra, base recortada onde o nó da tampa desce, pino de metal corrido.
4. **Pedido na cl49:** "vai até a ponta, não tem esse espaço" e "tem um rebaixo bem no centro da tampa, perto da dobradiça, a casca fica mais fina ali".
5. **Resposta na cl50:** o nó vai até o canto, e a parede de trás da tampa fica rebaixada 0,7 mm entre os nós.
6. **Pedido:** "o buraco das dobradiças é nas pontas".
7. **Resposta na cl53:** invertido. Nó da tampa por dentro, nó e ressalto da base nas pontas, e o recorte da tampa nas pontas, aberto até o canto.
8. **Pedido em aberto (cl53):** "o lugar onde vai o pino é redondo, não quadrado, e é mais curto". Os recortes ainda são caixas (`BoxGeometry`); deveriam ser redondos, acompanhando o nó, e mais curtos.

### Moon (Eco, Eco All Crystal, G com Visor, G Quarteto, G Tampa Fechada, M All Crystal, M com Visor, M Tampa Fechada, P, Deck), Frame e Macaroon (`hingeBloco`)
Fotos: `assets/revisao/fotos/moon-p/1.jpg` (aberto de cima), `moon-eco/2.jpg` (fechado de cima) e `macaroon-g/3.jpg` (lilás).

1. **Até a cl49:** 3 nós cilíndricos curtos no meio (18% da largura).
2. **Pedido:** "dobradiça é inteira, ocupa um espaço que tem um vão na parte de baixo, conferir na imagem de topo, replicar".
3. **Resposta na cl50:** um bloco único da tampa (18% da largura) descendo num vão recortado nas costas da base.
4. **Pedido:** "tá muito grande a dobradiça, que está um quadrado passando por cima do 3d, precisa ter um recorte nesse vão".
5. **Resposta na cl52:** bloco com 14%, rente ao contorno, e cortes finos dos lados também na tampa.
6. **Pedido:** "esse recorte tem que vir até em cima. quando abro completamente o produto, essa dobradiça aparece e fica uma caixa, longe da realidade".
7. **Resposta na cl55:** os dois cortes laterais sobem a altura toda da tampa, de modo que a dobradiça é a própria parede de trás entre eles. Só a língua que desce no vão da base é peça a mais.
8. **Macaroon:** "essa dobradiça é mais fina; tem um recorte no desenho da base para a dobradiça". **Resposta na cl54:** `hingeBloco: { w: 0.09, vao: 3 }`.
9. **Pedido em aberto (cl55, Frame G com Visor):** "quando abre totalmente a caixa fica exposta". Aberta, a língua e a parede entre os cortes ainda parecem um bloco solto.
   - **Ideia que não chegou a ser feita:** na foto `moon-p/1.jpg` (aberto, de cima), a peça entre tampa e base é uma aba fina, da largura da língua, que sai da borda da tampa.
   - O vão da base é um entalhe na parede, aberto em cima.
   - Precisa de um corte de perfil (de lado) que mostre a aba girando por dentro do entalhe sem sobrar volume.

### ⚠️ Foto ampliada da dona: É ESTE o mecanismo (Flat aberta, junção entre tampa e base)
Arquivo: `assets/revisao/ref-dona/flat-dobradica-ampliada.png`. Ela mandou depois da cl57 dizendo "não é isso da dobradiça ainda, é isso que estou falando".

Como lemos a foto (a confirmar com a dona antes de modelar):
- **Na borda de trás da tampa**, as **pontas** (os cantos, à esquerda na foto) descem até a linha de divisão. No **centro**, a borda é **recortada para cima**. Na passagem entre as duas alturas há um **degrau curto com chanfro**: é a "rampa que desce e sobe".
- **Na borda de trás da base** acontece o contrário: as pontas ficam na altura normal e o **centro sobe** como um bloco ao longo de quase toda a largura. Esse bloco entra no recorte da tampa.
  - As pontas da tampa "abraçam" as extremidades desse bloco, e o eixo passa por dentro: "as laterais têm um vão e depois encaixam na base na parte central".
- A **peça translúcida no meio** liga a tampa e a base. Ela é o encaixe de fechamento perto do eixo (`espLatches`); não é a dobradiça.
- **Portanto:** não há cilindro, rolo nem faixa aparente. A dobradiça aparece como um **recorte em degrau na tampa** casado com um **ressalto central na base**, ambos com a parede preta lisa.
- **Feito na cl58** exatamente assim (`hingeOculta` em `compactParts`, com o eixo próprio `axis` dentro do ressalto). Falta a dona conferir.
- Provavelmente o mesmo desenho vale para todas as Flat e as Big (a dona usou a mesma frase em todas).

### ⚠️ Foto ampliada da dona do Moon aberto (cl58)
- A dobradiça é um **bloco preso à BASE**, sentado num entalhe da borda de trás da base e subindo até a tampa, que tem um entalhe por cima dele.
- O pino passa no alto do bloco. Aberto, o bloco fica à vista ligando base e tampa.
- **Feito na cl58** (`hingeBloco`): os cortes de altura inteira da cl55 foram desfeitos.
- **cl59**, print da dona ("isso não é degrau, é reto"): a tampa não tem entalhe e a borda de trás dela passa reta; o bloco da base fica rente até a divisão. Falta a dona conferir.

### Moon Deck (dois andares)
- **Pedido:** "bug ao fechar/abrir".
- **Resposta na cl50:** a tampa gira presa ao andar do meio (`setHinge` com `under`), em ângulo absoluto e com o eixo carregado junto. O andar do meio segue a tampa depois de 60° (`segue: { de: 60, max: 45 }`).
- **Status:** não foi comentado de novo.

### Flat (Dez, Duo, Sexteto, Trio Redondo, Trio Retangular, 6+1) e Big 4 / Big 9 (`hingeOculta` + `hingeCalha`)
Fotos: `assets/revisao/fotos/paleta-flat-dez/1–2.jpg`, `big-4/2.jpg` e catálogo p028.

1. **Antes:**
   - Flat: eixo longo numa calha (72%).
   - Trio Retangular: eixo contínuo.
   - Big: par aparente.
2. **Pedido:** "dobradiça é escondida, a tampa tem uma parte que abraça a dobradiça, confira na segunda imagem".
3. **Resposta na cl51:** calha de 90% com um rolo cilíndrico da tampa, rente às costas.
4. **Pedido nas Big:** "não aparece como cilindro, mas as laterais do produto têm um vão e depois encaixam na base na parte central".
5. **Resposta na cl56:** faixa reta (caixa) no centro da calha.
6. **Pedido nas Flat:** "não é um cilindro, veja o desenho, tem uma rampa de desce e sobe". A dona confirmou que é **na dobradiça**.
7. **Resposta na cl57:** o rebaixo de trás da base virou um trapézio (desce em rampa nas pontas, corre reto e sobe), e a faixa da tampa tem o mesmo desenho. A Flat Dez está marcada "feito".
   - **Atenção:** as outras Flat (6+1, Duo, Sexteto, Trio Redondo, Trio Retangular) estão em `ajustar` com o mesmo texto, mas o comentário foi feito na cl52. A cl57 já aplica a rampa a todas, então falta conferir e responder.
   - **Dúvida:** a rampa pode ser o desenho do recorte em L/trapézio que aparece na frente, no desenho do catálogo (p028). Talvez o mesmo perfil exista atrás. Vale pedir à dona uma foto de trás.

## 5. Lista em `ajustar` no fim desta sessão (11 itens, cl59)

**Dobradiça:**
- **Case G (e irmãos, em lote):** "o lugar onde vai o pino é redondo, não quadrado, e é mais curto". Os recortes do `hingeCase` ainda são `BoxGeometry`; devem ser redondos, acompanhando o nó, e mais curtos (seção 4).

(O Frame G com Visor e as Flat 6+1, Duo, Sexteto, Trio Redondo e Trio Retangular foram respondidos como `feito` na cl58 e aguardam a dona.)

**Conta-gotas e frascos** (`incomProduct`, `case 'cg'` ~9935 e `case 'flacon'` ~10003; a borracha fica em `sprayGeo`, `m.sprayType === 'gotas'` ~2085):
- **Bulb e Dispensing 30:** "veja a silhueta do conta-gotas… ele vai abrindo para baixo, como um sino, depois disso tem um respiro embaixo". A borracha deve abrir em sino para baixo, com uma folga sob ela, entre a borracha e o colar.
- **Sydney:** "ajustar conta-gotas", provavelmente o mesmo sino.
- **Flacon 15 Botão:** "apenas arredondou o botão, ele é oval em cima".
- **Flacon 30 Botão e Julie:** "é um domo em cima". O topo do botão deve ser elipsoide ou domo de verdade, não um cilindro com fillet grande.
- **Flacon 15 Bulbo:** "ombro do frasco é mais arredondado em cima".
- **Flacon 30 Bulbo:** "arredondou demais, parece que ficou mais largo, suavizar a base deixando levemente mais arredondada". Na cl52 o ombro foi a 22% da largura, porque o perfil do desenho ignorava o `rTop`. Voltar para algo entre o desenho e isso, e arredondar um pouco o fundo.
- **Dispensing 15:** "refil está acabando antes do fundo". O 30 teve o piso de SAN baixado para 7% (`refillPhoto`); fazer igual no 15.
- **Amsterdam Deluxe 100:** "spray tá terrível, agora fino demais". Na cl51 o atuador ficou com 47% e o anel guia com 72% da largura da válvula; voltar a larguras próximas das de antes (guia ~17, atuador ~13 mm) e manter só a divisão das alturas.

## 6. Lições desta sessão

- **A dona julga com o produto aberto e girado.** Conferir sempre aberto, por trás e de cima, antes de marcar "feito".
- **Peça a mais grudada por fora vira "caixa".** Ela espera recortes nas próprias paredes da base e da tampa, com folgas visíveis.
- **Recorte com `BoxGeometry` fica "quadrado".** Quando o encaixe é de um eixo, o recorte deve ser redondo, acompanhando o nó.
- **Frases como "invertido", "é o contrário" e "até em cima" se referem à foto.** Abrir a foto citada ("imagem 2", "imagem 3") antes de mexer; a ordem está em `assets/revisao/fotos/<slug>/`.
- **Antes de atribuir um comentário a uma versão, conferir o `build` dele.** Vários vieram de versões anteriores à que estava no ar.
