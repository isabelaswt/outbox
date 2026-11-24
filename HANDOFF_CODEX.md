# Atualização Claude — 24/11/2026, cl254

- **cl250–254** — Tate e Timeless, dona ("proporção frasco e tampa parecem erradas"):
  - Tate (desenho p.106 medido): frasco 50,3 mm (`SPLIT_FIX[106]`; antes ~0,52 do total). O topo da tampa é reto, de cantos bem arredondados (`rTop` 0,28 W), e não a meia-esfera de antes. Líquido com piso reto.
  - Timeless: a proporção já batia com o desenho p.107. O que destoava das fotos era o cristal: parede e fundo grossos, com a cor recuada.
  - Tate, Timeless e Timeless Plus: `liqInset` 0,22 / 0,18 W e `fundo` 0,26 W. O recuo é ~1,4× o medido na foto, porque o cristal amplia o líquido como lente.
  - Testado e descartado: nível do líquido 95%. Mostrava a haste preta acima do líquido.

- **cl247–249** — Oscar All Crystal, dona ("faltou rosca interna da tampa" e "rever todo, topo do frasco errado"); revisão completa pela foto:
  - Gargalo: largo (0,78 W = 14,5 mm) e curto (0,5 W = 9,3 mm), com 4 voltas. Antes era estreito e alto (19 mm, 0,55 da tampa).
  - Ombro do frasco: arredondado até o gargalo (`rLivre`, `rTop` 2,2).
  - Rosca fêmea: cortada na própria tampa de cristal (`femaleThread` na tampa). A tampa é maciça nos ~45% de cima (`ocoTop`) e tem o furo roscado do Ø do gargalo embaixo; fechada, a rosca aparece pelo cristal.
  - Inserto: virou um anel fino e incolor. Transparente dentro de transparente não aparece no render; por isso a rosca do inserto sumia.

- **cl246** — Oscar Charm, irmão do Moma Charm (desenho da p.104 medido): o corte tampa/frasco passou de 0,5 para 61,2/112,3. Frasco 56 → 61,2 mm, tampa 43,7 mm, argola 7,4 mm acima da tampa (`emb` 1,1).

- **cl245** — Moma Charm, dona ("proporção de tampa e frasco parecem erradas"; desenho da p.100 medido em px): o corte tampa/frasco estava fixo em 0,6 (`SPLIT_FIX[100]`) e agora é 47,8/87,1.
  - Frasco: 52,3 → 47,8 mm.
  - Tampa: 26,9 → 32,6 mm.
  - Argola: sai 6,7 mm acima da tampa. Nova opção `emb` (embutimento) na argola: 1,8 mm no Moma Charm; o padrão continua 0,6.

- **cl244** — Guggen Roll On, dona ("parece que a bola é maior"): a faixa prateada vista pelo aro transparente da foto também é a bola. A bola volta a ~0,75 da largura da rosca (6,9 → 8,6 mm) e quase preenche a cúpula, que continua fechando rente a ela.

- **cl243** — Guggen Roll On, dona ("ela não faz esse gomo, é mais no formato da bola"): o topo do suporte agora é uma cúpula esférica contínua, com o raio do aro. Ela sai tangente da parede reta e fecha rente à bola, ~10% acima do equador, com folga de 0,3 mm. Antes era uma borda abaulada (perfil reto e quarto de círculo) que parecia um gomo.

- **cl241/242** — Guggen Roll On, dona ("não abre, acompanha a bola"): o aro não alarga mais para fora da rosca. Ele tem a largura do miolo da rosca (0,9 do suporte), sobe reto e fecha rente à bola, a 0,6 mm dela. A bola ficou em 0,6 da largura da rosca (6,9 mm; era 8,6), como na foto da p.98. Ela sai ~44% acima do aro, e a tampa compensa para manter a altura fechada.

- **cl240** — Guggen Roll On, dona ("tem uma linha retangular no produto"): era a cavidade interna do frasco (`ocoTopo`), cujas paredes e piso apareciam pelo líquido claro como um retângulo de linhas. O frasco do Roll On não leva mais `ocoTopo`; o líquido preenche o corpo limpo. Nos glosses de cor forte o líquido escondia essa cavidade.

- **cl237–239** — Máscaras, pente fino pelas fotos abertas (medidas em px, em múltiplos da largura da tampa):
  - Nova tabela `MASC_BRUSH` [haste, largura da escova, comprimento] e função `mascBrush`.
  - Haste: 0,2–0,26 (antes ~0,13, fina demais), limitada a 0,5 do Ø do gargalo.
  - Escova: Berlim Plus cone 0,5 × 1,4; Guggen e Oscar finas 0,36 × 0,9 e 0,35 × 0,75; Guggen Plus e Timeless Plus fusiformes ~0,5 × 1,2–1,3.
  - Cerdas: 40 níveis × 18–24 fios (antes 22 × 12–16) e miolo de 0,26 da escova. Antes parecia um pente de fios espetados; agora a escova lê preta e cheia, como nas fotos.
- Potes (11) revisados pelas fotos: sem divergências a corrigir. Timeless Plus (gloss) conferido.
- Revisão pelas fotos sem divergências a corrigir: Chubby Stick M/G, Case G/M Tampa Cristal, Petit Aplicador (7 variantes), Moma Tampa Alta (as fotos são do Moma), Long Abaulada e Long Lipview Abaulada.

- **cl234–236** — Silhouette, pente fino pelas fotos:
  - Frasco e tampa são cones de lado reto: o corpo afina de baixo para cima e a tampa alarga para o topo. O contorno do desenho dava curva côncava. Nova opção `perfilReto` em P: reta por mínimos quadrados entre 8% e 92% da altura do perfil.
  - Tampa: borda do topo arredondada 1,5 mm (`rLivre`).
  - Líquido: piso reto (`fundoR` 0,08 W). A concha redonda no fundo, que afina, fazia um bico.
- Revisão de Moma 2.0, Oscar, Oscar All Crystal e Oscar Charm × fotos: sem divergências a corrigir. Tate: sem fotos.

- **cl233** — Guggen Roll On, dona (detalhe da p.98: "rollon abraça a esfera"): novo aro transparente liso acima da rosca do suporte (`Aro que abraça a esfera`, perfil próprio). Ele se curva para dentro e envolve a esfera até ~15% acima do equador, deixando só a calota de fora. Esfera 7,8 → 8,6 mm (~0,75 da largura do suporte, como na foto). Antes a esfera ficava pousada no topo reto do suporte.

- **cl232** — Glosses, dona (Guggen: "aumentar levemente o diâmetro da haste"): o limite da haste em `wandFit` passou de 0,4 para 0,5 do Ø do gargalo. Guggen: haste 4,1 → 5,1 mm (0,27 da tampa; foto 0,29). A ponta segue limitada a 0,62.

- **cl231** — Berlim Plus, dona ("parece muito alto a esponjinha da haste"): ponta flocada 1,07 → 0,65 W (~14 mm, cerca de 2× a própria largura), como nas miniaturas dos aplicadores #54/#56AL/#65 do catálogo. A foto principal da p. 95 exagera a ponta.

- **cl230** — Glosses, dona (Berlim Plus aberto: "parece que fica grosso para entrar"): haste e ponta agora sempre passam pela boca do gargalo. Nova `wandFit`: ponta no máximo 0,62 do Ø do gargalo e haste no máximo 0,4, aplicada sobre as medidas de `GLOSS_WAND`. No Berlim Plus, a haste foi de 7,7 para 4,7 mm e a ponta de 8,8 para 7,3 mm; Guggen e Oscar também afinaram a haste.

- **cl226** — Berlim, pente fino (foto 1 medida): frasco quadrado de cristal com parede grossa; a cor ocupa ~60% da largura e aparece a faixa incolor dos lados. Nova opção `liqInset` (recuo do líquido em mm) em `liquidMeshes`; Berlim 0,16 W, Berlim Plus 0,13 W (catálogo p.95).
- **cl227/228** — Haste e aplicador, dona ("haste tá proporcional?", Berlim Plus × catálogo): medi as páginas 94/95 em px, em múltiplos da largura da tampa. `GLOSS_WAND` ganhou um 4º valor opcional, a largura da ponta.
  - Berlim Plus (entrada própria; antes herdava do Berlim): haste 0,36 W (era 0,18), ponta 0,41 × 1,07 W (era 0,24 × 0,63), folga 1 mm até o fundo. A haste aparente fica em 3,3 W, o limite da profundidade do frasco.
  - Berlim: haste 0,21 W, ponta 0,28 × 0,6 W, folga até o fundo 9,6 → 2 mm. A haste aparente passa de 2,5 para 2,86 W (foto: 2,9 W).

- **cl225** — Ella, dona ("não é plano de um lado, ele tem uma curva simétrica, mas se girar ele, fica uma curva pra cima"): o topo da tampa agora é uma sela (`curvaSela`, 1,8 mm). De frente é um arco simétrico que desce nas laterais; girando 90°, vira uma curva para cima. Substitui o cl224 (curva de um lado só).

- **cl224** — Ella, dona ("está errado a tampa, é curva"): o topo da tampa era uma rampa quase reta na largura toda. Agora é plano em ~40% da largura e só o lado baixo rola em curva convexa (`curvaU: 0.6`, queda 2,2 mm), como nas fotos 1/2.

- **cl223** — Tube, pente fino pela foto aberta (3.jpg, medida): de frente o corpo afina em linha reta do fundo ao ombro (0,81); o ombro é plano com quina pequena (`rTop` 1,6, antes abaulado); a passagem achatado→redondo corre o corpo todo; tampa 0,93 W (138/148 px).

- **cl222** — Revisão pelas fotos (máscaras, sticks, compactos, paletas):
  - Máscaras: haste preta (`rodColor`), como em todas as fotos; antes era branca.
  - Chubby Stick M/G: no Abrir a tampa fica em pé ao lado (`capa: 'pe'`).
  - Compactos (24) conferidos sem divergências a corrigir: visores, godês (Moon G Quarteto em X), espelhos e Case com tampa de cristal batem com as fotos.
  - Nota: os itens de líquidos labiais Berlim Plus e Guggen Plus usam fotos das máscaras homônimas (dado do itens.json); os modelos de máscara existem à parte.

- **cl221** — Tube, dona (foto dos Tubes: "base acaba circular"): perfil próprio [t, a, b, n] no lugar do contorno do desenho. Corpo achatado (superelipse n 3,4, D 0,68 W) que, nos ~40% junto ao gargalo, vira suavemente um círculo de 0,9 W, o Ø da tampa. Essa transição é a "linha diagonal" das fotos; a torção (`polyTwist`) saiu. (cl220 só carimbo intermediário.)

- **cl219** — Batons, revisão própria pelas fotos abertas:
  - No Abrir a tampa fica em pé ao lado da bala, com o fecho para cima. Novo modo `capa: 'pe'`: sai sem girar. Antes ficava deitada.
  - Long, Long Abaulada e Long Lipview: a bala sobe `lb * 0,85` (como Ella e Squared). Antes subia só 41/320 da tampa (Long) ou 0,45 (Lipview) e mal aparecia; nas fotos ela sai ~20% da altura do batom aberto.
  - Potes revisados sem divergências a corrigir. As peneiras pretas das fotos são acessório opcional.
  (cl218 só carimbo intermediário.)

- **cl217** — Dispensadores e frascos com sobretampa (Bulb, Dispensing 15/30/60, Quadrado, Amsterdam Deluxe…), pela foto aberta do Bulb: no Abrir a sobretampa transparente sai e fica ao lado da bomba (`capa: 'vira'`). A regra do cl212 agora vale também quando nenhuma outra peça sai.

- **cl216** — Olive: o pontinho escuro na frente da tampa fechada era a crista da rosca 20-410 furando a tampa achatada (20,75 mm de profundidade). Nas frasnagas de rosca, a tampa agora tem no mínimo o Ø do gargalo + 2 mm de profundidade (Olive: 21,7).

- **cl215** — Tampas roscadas das frasnagas (Beatrice, Julie, Olive, Vênus 35/45 e Tube), dona (foto da tampa por dentro: "a tampa não é sólida, é oca assim"): nova opção `capAnel`. A tampa vira uma saia externa fina (1,2 mm, segue a forma da tampa) com uma bucha central roscada solta dela, e um vão aberto por baixo entre as duas. A bucha fica ~0,8 mm recolhida da boca e se funde ao teto. Em tampa achatada ou que afina (Olive), a bucha é recortada pela forma da própria tampa (INTERSECTION) para não vazar. Antes era um bloco maciço com um furo roscado. (cl213/214 só carimbos intermediários.)

- **cl212** — Rodada de comparativos (dona: "continuar os comparativos rígidos"):
  - Tube (dona, foto dos 4 Tubes: o render tinha virado uma cunha): quase não afina (`taper` 97), seção achatada (D 0,6 W, era 0,8), torção leve de 12° (era 20°), fundo com quinas de 4 mm e tampa com 0,9 W (era 0,84).
  - Conta-gotas com sobretampa (Bulb, Dispensing 15/30): no Abrir a sobretampa sai junto e fica ao lado (`capa: 'vira'`); antes flutuava sobre o frasco vazio. Regra geral no fim de `incomProduct`: sobretampa sem `capa` quando outra peça tem.
  - Julie conta-gotas: mesmo frasco da frasnaga Julie, com ombro reto em cone baixo (`coneTop`, `rLivre`).
  (cl209–211 só carimbos intermediários.)

- **cl208** — Líquidos labiais, dona ("os aplicadores não estão na proporção certa de haste e aplicador, conferir por foto"): medi as fotos abertas do site (frasco e haste no mesmo plano) em múltiplos da largura do frasco. Nova tabela `GLOSS_WAND` [Ø da haste, comprimento da ponta, folga até o fundo] por produto; os irmãos herdam pelo prefixo do nome (Charm, Tampa Alta, Plus). Função `glossWand`.
  - Haste: antes 3 mm em todos; agora 0,18–0,28 W (Berlim 3,4, Guggen 5,2, Moma 5,7, Timeless 6,3 mm).
  - Ponta: ~1,35× o Ø da haste, comprimento 0,56–0,76 W.
  - Haste aparente conferida no render: Berlim 1,9 W, Guggen 2,06 W, Oscar 2,22 W, iguais às fotos. Moma, Timeless e Silhouette ficam um pouco abaixo da foto porque o aplicador já está a 1 mm do fundo.

- **cl207** — Líquidos labiais (todos), revisão própria pelas fotos abertas:
  - No Abrir a tampa fica em pé com a haste para cima, ao lado do frasco (`capa: 'vira'`), como em todas as fotos; antes ficava deitada. Vale também para as máscaras.
  - Aplicador: haste preta (`rodColor`) e ponta flocada branca chanfrada e arredondada (`tipStyle: 'chanfro'`, a mesma do Petit); antes a haste era branca e a ponta, uma pá bege.
  - All Crystal segue com a haste incolor. Máscaras seguem com a escova preta.
  (cl206 só carimbo intermediário.)

- **cl205** — Petit Aplicador (e as 7 variantes de aplicador), dona ("tem que ter rosca interna na tampa"): a tampa quadrada agora tem um furo redondo com rosca fêmea casando com a do gargalo (`threadReceiver` W 0,6 W, h 6,8, passo 1,1, 2,5 voltas, `threadNeckUid`). O oco é cheio para caber o aplicador (`threadCavityFull`, parede 1 mm). Antes o oco era quadrado e liso.

- **cl204** — Tube, revisão própria pelas fotos e pelo desenho da p. 84 (pedido da dona de ser mais autônomo):
  - Fechado, fica em pé sobre a tampa (`viraFechado`), como em todas as fotos.
  - O corpo afina para o gargalo (`taper` 91) e termina num ombro arredondado de 3 mm; antes era o contorno reto do desenho, com ombro reto.
  - As quinas correm em diagonal: seção torcida 20° ao longo da altura (`polyTwist`), a linha inclinada das fotos e do desenho.
  (cl202/203 só carimbos intermediários.)

- **cl201** — Petit com Haste, dona ("arredondar o pincel, é nesse nível de detalhe"): a ponta flocada agora é torneada, com borda de raio 0,85 do raio da ponta e emenda arredondada na haste. O chanfro passou a ser um cisalhamento suave dessa ponta (sem quina) em vez do corte reto do cilindro. (cl200 só carimbo de cache.)

- **cl199** — Petit com Haste, dona ("olha como está desproporcional, o aplicador está errado"; medido na foto aberta):
  - Tampa: 0,36 → 0,31 H (no Petit Aplicador também).
  - Gargalo: 5,5 → 6,8 mm.
  - Ombro do frasco: quina arredondada (raio 0,12 W).
  - Haste: preta, da cor da tampa (nova opção `rodColor`), Ø 2,4 → 3,6, saindo ~49 mm da tampa (`pescGap` 14, não vai até o fundo).
  - Aplicador: ponta flocada roliça Ø 4,9 × 11,5 com chanfro de ~45° na ponta (nova opção `tipStyle: 'chanfro'`, `tipChanfro` = altura do corte ÷ Ø) no lugar da pá achatada.
  (cl198 só carimbo de cache.)

- **cl197** — Olive, dona ("parece mais redondo"; foto com a luz contínua da frente para o lado): a seção saiu do polígono de cantos redondos (`sq`, que deixava um vinco onde a reta encontra o arco) e virou superelipse n 3,6. As laterais seguem retas e a curva emenda sem vinco. Com `perfilLiso`, o expoente da seção agora vem de `o.n` (antes era fixo em 2 = oval). (cl196 só carimbo de cache.)

- **cl195** — Olive, dona (vista de cima: "não ficar com listras"): as listras vinham das ondinhas do contorno do desenho, que viravam faixas na luz mesmo depois de alisado. Nova opção `perfilLiso` no `P()`: a largura ao longo da altura é ajustada por uma parábola (mínimos quadrados, 25 pontos). Ligada no frasco e na tampa do Olive.

- **cl194** — Olive, dona ("arredonde mais, não é tão duro as faces"): cantos da seção 0,35 → 0,5 (`sq`). Testado 0,65, mas já voltava a parecer oval; as laterais seguem com um trecho reto. (cl193 só carimbo de cache.)

- **cl192** — Olive (frasnaga), dona (foto e desenho: "não é oval, tem lateral mais reta"): seção do frasco e da tampa passou de oval a retângulo de cantos macios (`sq(0.35)`); medidas 48 × 21,3 mantidas.

- **cl191** — Charlotte Rounded, dona (foto: "não é tão dura as arestas"): quinas da seção do frasco, da tampa e do sulco mais macias (`sq` 0,12 → 0,32). O Charlotte reto segue com as arestas vivas da foto dele.

- **cl190** — Julie (frasnaga), dona ("não é redondo, eu quis dizer que é angulado quando encontra o bico, o ombro é bem reto"): desfeito o ombro redondo do cl189. Agora o ombro é reto, em cone baixo (~0,06 × largura de altura) que sobe da quina viva da borda (raio 0,8 mm) até o gargalo, como na foto aberta. Nova opção `coneTop: { h, k }` no `P()`: os últimos h mm do perfil afinam em reta até k × a largura. O pé segue com raio 2,5 mm.

- **cl189** — Julie (frasnaga), dona (foto aberta: "ele não é tão reto, olha o perfil"): ombro do frasco arredondado (raio 0,11 × largura, ~3,9 mm) e pé com raio 2,5 mm. O corte do perfil do desenho limitava os raios a 0,6/0,5 mm; a nova opção `rLivre` do `P()` mantém os raios pedidos. (cl188 só carimbo de cache.)

- **cl187** — Julie (frasnaga), dona ("não tem essa volta no julie"): saiu o anel de 5,5 mm entre o frasco e a tampa. O frasco acaba no ombro (fração do desenho, sem os +5,5 mm) e o perfil da tampa pula o trecho do anel do desenho, ficando um cilindro simples apoiado direto no ombro, como nas fotos. A altura total foi mantida. (cl186 só carimbo de cache.)

- **cl185** — Charlotte e Charlotte Rounded, dona ("a ponta do bico não é tão arredondada assim"): a ponta do trompete deixou de ser meia esfera; agora é chata, só com a borda arredondada (raio 0,35 do raio da ponta).

- **cl184** — Charlotte e Charlotte Rounded, dona ("rosca são mais próximas e perto da tampa"): passo da hélice 0,28 → 0,2 do Ø do gargalo; as 3 voltas ficam juntas logo acima do bico (onde a tampa rosqueia) e o resto do gargalo fica liso até o ombro.

- **cl183** — Olympea, Charlotte e Charlotte Rounded, dona ("bicos ainda estão diferentes da referência das fotos, fazer exatamente igual"): gargalo e bico do `bocaCurto` refeitos com o perfil medido nas fotos, tudo em função do Ø do gargalo (D). Olympea (foto aberta): aro do ombro 1,13 D × 0,08 D, gargalo liso 0,74 D, 2 voltas de filete grosso (Ø 0,09 D) logo abaixo da boca, bico com disco 0,08 D do mesmo Ø do gargalo e cone reto 0,47 D (base 0,75 D, ponta chata 0,2 D). Charlotte (foto da bisnaga branca aberta, `bocaPerfil: 'trompete'`): gargalo 1,05 D, 3 voltas de passo 0,28 D (`bocaVoltas`), bico em trompete: sai largo (0,86 D), afina em curva côncava até tubo de 0,25 D com ponta redonda, altura 0,72 D. (cl182 só carimbo de cache.)

- **cl181** — Charlotte e Charlotte Rounded, dona ("parece que a rosca é mais espaçada"): passo da hélice 0,19 → 0,34 do Ø do gargalo (`bocaPitch`); Olympea segue com a rosca junta.

- **cl180** — Charlotte e Charlotte Rounded, dona (foto do Charlotte aberto: "não é tão alto"): o gargalo do `bocaCurto` tem no máximo ~1,05× o próprio Ø de altura (numa tampa alta ele esticava até encher o vão); o cone tem comprimento próprio (0,21 da peça) e embaixo dele sobra o vão da tampa. Olympea sem mudança (o gargalo dele já era mais curto que o limite).

- **cl179** — Olympea, Charlotte e Charlotte Rounded, dona ("deixar mais curto ainda"): cone do bico independente bem mais curto (ponta a 42% da altura do trecho do bico, era 22%; base 0,48·R).

- **cl178** — Olympea, Charlotte e Charlotte Rounded, dona (foto ao lado do render aberto: "um pouco menor o bico"): o cone do bico independente ficou ~22% mais curto e mais estreito (base 0,5·R, ponta 0,12·R); gargalo, rosca e tampa iguais — a ponta só fica mais acima.

- **cl177** — Frasnagas, dona: (1) Beatrice (foto: "base parece ser mais arredondada"): quina de baixo do frasco 0,5 → 4 mm. (2) Olympea (foto ampliada: "rosca é mais junta, comparar as duas"): as 2 voltas da hélice ficam juntas logo acima da boca (passo ~0,19 do Ø do gargalo); o resto do gargalo é liso até o aro do ombro. (3) Charlotte e Charlotte Rounded ("charlotte também tem questão com o bico, replicar"): mesma solução do Olympea (`bocaCurto`): gargalo translúcido com rosca junta e bico independente opaco de cone curto, na largura que cabe na tampa deles (50% da profundidade). Miniaturas dos quatro regeradas.

- **cl176** — Olympea, dona ("essa base do bico segue a mesma dimensão da rosca, não é para fora"): o disco do bico independente passa de 0,9·R para o raio do gargalo (`Rc`), rente a ele.

- **cl175** — (1) Olympea, dona ("a solução é parecida com esse [o gargalo da Beatrice], mas mais curta, o bico é independente"): `bocaBaixo` + `bocaCurto` virou duas peças — gargalo translúcido (petFosco #f6f3ee, como o da Beatrice) com aro junto ao ombro e rosca em hélice (2 voltas, filete redondo), e o bico à parte em PP opaco (extra `insert`): disco na boca e cone curto (36% da peça) até a ponta pequena e achatada. (2) Beatrice, dona (foto deitada: "o bico é levemente mais baixo, a parte da rosca"): gargalo do inserto 16 → 13 mm. Miniaturas das duas regeradas.

- **cl174** — Olympea, dona (foto ampliada do bico ao lado do render aberto: "o bico parece que precisa ser menos bicudo"; "tudo parece que precisa ser maior comparado à foto, o raio da rosca"): gargalo e bico com 56% da largura do corpo (era 0,62 × 22 = 39%); `bocaCurto` no perfil `bocaBaixo` — aro largo junto ao ombro, 2 voltas de rosca, aro em cima da rosca e cone curto (~38% da peça) até uma ponta pequena e achatada (raio 0,15·R) com o furinho. Charlotte segue com o bico longo. Miniatura regerada.

- **cl173** — Olympea, dona ("ele é reto no topo"): sai a solda inclinada (`tilt`/`keepTiltHeight`); o topo do corpo cônico é reto, como no desenho da p80. Miniatura regerada.

- **cl172** — Olympea, dona (desenho da p80: "olympea é uma frasnaga cônica"): de frente o corpo é um retângulo de 35 mm até a solda; de lado afina em ogiva até ~3 mm (`coneZ` k 3/W, pw 2,6 — nova deformação em `moduleGeo`: a profundidade encolhe com a altura, a largura fica). No desenho a vista de lado tem a mesma largura da frente na tampa: tampa e pé do corpo redondos Ø 35 (era 94% de 35 × 22, retângulo arredondado). Solda de cima segue inclinada (fotos). Bico na mesma medida de antes. Miniatura regerada.

- **cl171** — Olympea, dona (vista de lado: "parece uma diferença grande entre frasco e tampa, é assim mesmo?"; fotos OLYMPIA): o frasco afina para baixo (taperB 94) e a tampa estava na largura do topo — degrau na junção. Pelas fotos, a tampa tem a largura do pé do frasco: agora 94% (W e D), junção alinhada com o sulco fino. Miniatura regerada.

- **cl170** — Charlotte, Charlotte Rounded, Olympea, dona ("foi muito, não se vê o bico"): a fresta de 0,5 mm mostrava o bico branco; agora 0,2 mm preenchida por um anel do próprio frasco recuado 1,2 mm (`Sulco da tampa`) — de fora fica só um sulco fino, sem o bico aparecendo. Altura total igual. Miniaturas dos três regeradas.

- **cl169** — Charlotte, Charlotte Rounded, Olympea, dona ("esse detalhe da tampa não existe"; "ele só tem um pequeno dente de distância, foi muito"; "parece que não é menor não, só tem um espacinho de separação"): sai a faixa da cl168; a tampa fica na largura do corpo, sem o perfil do desenho (que fazia uma borda saltada no alto — laterais retas), e há só uma fresta de 0,5 mm entre tampa e corpo (o frasco sobe e encurta o mesmo tanto; altura total igual). O bico do Charlotte/Rounded ficou com 50% da profundidade de referência (era 62%) para caber no vão da tampa. Miniaturas dos três regeradas.

- **cl168** — Frasnagas em pé sobre a tampa (Charlotte, Charlotte Rounded, Olympea), dona (foto do Charlotte: "tem um dente entre a tampa e a frasnaga, faça por favor"): faixa do frasco de 1,2 mm entre a tampa e o corpo, 0,8 mm para dentro dos dois (`Dente da tampa`, mesma seção da tampa); o frasco encurta o mesmo tanto e a altura total fica igual. Miniaturas dos três regeradas.

- **cl167** — Beatrice, dona (detalhe da pág. 76 ao lado do modelo: "rosca não vai até embaixo"; depois "aprovado"): o gargalo tem só 3 voltas no alto, um trecho liso embaixo e o anel mais largo junto ao ombro (ringH 1,6 / ringW 0,9); o anel fica dentro da tampa, que apoia no ombro (a rosca da tampa não conta o anel e o bico desce os 1,6 mm do anel na pilha). A aba do bico ficou da largura da rosca. Altura fechada 101,5. **Aprovado pela dona no chat.**

- **cl166** — Frasnagas, dona: (1) Charlotte/Charlotte Rounded/Olympea ("se aparece o furo pela transparência, a rosca fica na frente"): o perfil do bico virado para baixo (`bocaBaixo`) vinha no sentido inverso — as faces apontavam para dentro e de frente aparecia o canal por trás da rosca; perfil invertido e bicos em PP natural opaco acetinado (`fosco`, #f5f2ec), sem refração. Emenda do torno dos bicos virada para trás. (2) Beatrice ("onde tem isso?"; "precisa ser mais parecido, mais pontudo"; "tem uma borda que encaixa na rosca"; detalhe BICO DOSADOR da pág. 76): bico próprio fino (`incomBico.fino`) — aba de ~1,3 mm sobre a boca do gargalo, da largura da rosca, e bico em sino: base ~58% do Ø do gargalo, ~37/28% a 30/70% da altura, ponta ~20%, altura ~0,8× o Ø; gargalo Ø13 × 16 com ~5 voltas. Altura fechada 101,5. Índice das miniaturas refeito (imagens iguais).

- **cl165** — (1) Beatrice, dona (foto aberta: "beatrice"; "ele não é quadrado, é fino"): sem profundidade no catálogo — 45 ml em 42,9 × ~73 mm de corpo dão ~20 mm, então o frasco ficou achatado (42,9 × 20,2; quadrado seriam ~105 ml). Gargalo do inserto pela foto deitada: Ø 13, 16 mm de comprido, voltas largas (passo 2,6, 5 voltas), em PP branco translúcido (não a cor do frasco), e o bico dosador em ponta que os irmãos Julie/Olive já tinham ("Tampa e Inserto em PP"). Altura fechada mantida (101,5). (2) Frasnagas, dona (bico com um bastão bege por dentro: "que material é esse do bico? parece bege dentro"): os bicos dosadores (Charlotte, Charlotte Rounded, Olympea, Vênus) eram PET transparente e o canal de 1,6 mm aparecia como um bastão bege refratado; agora PP natural leitoso (`petFosco`), como na foto da Beatrice. E em qualquer peça transparente o furo passa a usar o material da própria peça, não o escuro de furo. Miniatura da Beatrice regerada; índice refeito.

- **cl163** — Dona (bico de pato ao lado da foto: "proporção tá certa do pump?"): a peça `patoIncom` já bate com as fotos (colar 26,9 × 18,7, haste 14,1 × 15,3, braço 5,2 — num frasco de ~50 mm: colar ~55%, haste ~29%), mas a troca da cl161/cl162 estreitava só o colar (45% do frasco / Deluxe 45%) e a haste ficava larga demais para ele. Agora o bico de pato entra no tamanho real da peça (mesma rosca 24/410) — Frascos e Deluxes. Conferido ao lado das fotos do Chicago e do Seoul.

- **cl162** — Dona ("Sim, levar" — a troca de fechamentos da cl161 para Deluxe e Dispensadores): ao clicar na válvula, "Fechamentos do catálogo para este produto". Deluxes: Spray e Dosadora ajustados para caber sob a sobretampa (`fitValveIn` com a altura da sobretampa menos o dente e 1,5 mm), e Bico de pato, Trigger, Espumadora, Bico aplicador e Tampa Sens marcados "(sem sobretampa)" — a troca tira a sobretampa e o dente. Dispensadores (menos Twist e On-Off, de mecanismo próprio): Spray e Dosadora, sempre sob a sobretampa. Conferido nos 13 produtos: todas as válvulas ficam 2,5–18 mm abaixo do topo da sobretampa. A troca guarda rosca/gargalo da válvula original (`threadReceiver`). Miniaturas não mudam (presets iguais).

- **cl161** — (1) Dona (Amsterdam frasco ao lado da pág. 64: "aqui oferecer as peças intercambiáveis de válvulas, sempre oferecer a troca quando possível"): nos Frascos, ao clicar no fechamento, a troca abre com "Fechamentos do catálogo para este frasco" — Spray, Dosadora, Válvula bico de pato, Trigger, Espumadora, Bico aplicador, Tampa Sens e Tampa tambor (`incomSuggestions`), já no tamanho do frasco (Sens 72,7% da largura, tambor 98%, bico de pato 88/196). Conferido: as oito encaixam no gargalo do Amsterdam. Tampa bola fica fora da lista (são duas peças: colar + bola). (2) Dona (print do spray ao lado da foto: "não tem tampa"): os Frascos com spray (Apple Blow, Bulb Blow 150, Chicago, Miami, Seoul 250, Sydney 60) ficaram sem a proteção transparente sobre o atuador. Miniaturas desses regeradas.

- **cl160** — (1) Dona ("aumentar líquido geral para não ter muito headgap"): nível do conteúdo 97% nos frascos (padrão do módulo, conta-gotas/dispensadores/deluxes, Frascos PET, On-Off) e 96% nos potes e no tubo de gloss (eram 90–94%); refis seguem 99%. (2) Dona (print do Deluxe: "dente é interno, sempre"): o dente da sobretampa saía mais largo que o topo do anel (perfil do desenho) e atravessava a parede da sobretampa; agora fica sempre 0,6 mm dentro do topo do anel e 0,6 mm dentro do vão da sobretampa (parede ~1,5 mm) — Bulb e Deluxes. Miniaturas: imagens iguais (bege opaco não mostra líquido nem dente); só o índice foi refeito (`makeIncomThumbs(post, [])`), porque o padrão do líquido muda a assinatura de todos.

- **cl159** — Deluxes, dona (Amsterdam Deluxe 200 ao lado da página 58: "proporção não parece certa"): medidas nas fotos do catálogo (págs. 57–62), o frasco ocupa ~58–65% da altura e a sobretampa ~28–31%; o modelo dava frasco 55% e sobretampa 37% nos seis. Frasco e anel agora pela foto de cada um (Amsterdam 100: 58,5/10,4%; Amsterdam 200: 63,7/8,3%; New York 100: 59,6/9,2%; New York 200: 62,2/6,8%; Sydney 100: 61,9/8,6%; Sydney 200: 64,8/6,6%), a sobretampa com o resto (altura total = catálogo) e a pump encolhe proporcionalmente só se não couber (2,5 mm de folga no topo). Miniaturas regeradas.

- **cl158** — Deluxes, dona (foto da sobretampa: "nunca redonda, sempre arredondada"): a opção do topo da sobretampa deixou de ser domo — "Arredondada" é topo reto com canto de ~22% da largura (≈ 9 mm no Amsterdam 100); "Reta" segue com raio 1,2. O desenho do New York e do Sydney dava domo: esses vêm Arredondada por padrão. Miniaturas regeradas.

- **cl157** — Deluxes, aprovação (Amsterdam Deluxe 100: "poder ter tampa redonda ou reta"; Amsterdam Deluxe 200: "ajustar tamanho do spray, poder ter tampa reta ou curva"; New York Deluxe 100: "ajustar tamanho da base do spray para ficar como a ref"): (1) o spray mais alto aprovado no Amsterdam 100 (cl138: colar ×1,5, acionador ×1,4) vale para todos os Deluxe — Amsterdam, New York e Sydney 100/200. (2) Sobretampa dos Deluxe com a opção "Topo da sobretampa" no editor: Como no catálogo / Redonda (domo, raio ≈ metade da largura) / Reta (raio 1,2) — `capTopoOpt`/`capTopo`, aplicado no build sem o perfil do desenho; as fotos mostram as duas versões. Miniaturas regeradas.

- **cl156** — On-Off 100/120, aprovação ("topo do atuador é bem no nível, não é rebaixado, precisa ter espaço atrás para dedo"): o disco do acionador fica no nível da borda da capa (só a fresta em volta; o bico 0,4 mm abaixo dela) e a parede da capa tem uma cava suave atrás (~70% da largura, ~3,5 mm de fundo; cilindro deitado ∩ anel da parede, então o disco fica inteiro), por onde o dedo aperta. Miniaturas regeradas.

- **cl155** — Dispensing Cube, dona ("precisa arredondar mais a tampa, não tem esse chanfro"): o arredondamento elíptico do alto da sobretampa (8,5 de altura × 5,9 para dentro) aparecia como chanfro; agora raio redondo de 7,5 mm. Miniatura regerada.

- **cl154** — Dispensing Twist, dona ("é para dentro, ela fica totalmente para dentro, a calha fica interna"): o entalhe da cl153 atravessava a parede; agora é um canal só na face de dentro da manga, no meio da frente, aberto em cima (`incomTwistNotch.keep` = 1,4 mm de parede por fora) — por fora não aparece. Fechado, o acionador fica todo dentro da manga (topo 0,3 mm abaixo da borda, bico 2 mm para dentro da face); aberto, sobe ~15 mm pelo canal. Miniatura regerada.

- **cl153** — Dispensing Twist, dona (desenho pág. 55: "tem uma calha na estrutura para sair a tampa que vai para fora"): entalhe atravessando a parede da manga na borda de cima, no meio da frente (largura do bico + 0,6, 2,9 mm de altura, `incomTwistNotch`) — fechado, o bico do acionador encaixa nele (foto fechada); aberto, fica o entalhe vazio. Miniatura regerada.

- **cl152** — Dispensing Twist, dona (foto aberta: "ir mais alto a abertura, o lugar que sai o produto é pra frente"; "não é um buraco, é um retângulo para frente com furo dentro retangular também"): aberto, o acionador sobe ~14 mm (era ~5) e continua encaixado na manga — ele ganhou 3 mm a mais por baixo, escondidos dentro da manga quando fechado. A saída virou um bico retangular saltado ~1 mm no alto da frente (~0,115·W × 2,6 mm), com furo retangular dentro (`incomTwistOutlet.boss`). Miniatura regerada.

- **cl151** — On-Off 100/120, dona (fotos de perto do topo: "arredondar na quina"; "o pump é separado da estrutura"): fenda e canaleta num recorte só, com os cantos de dentro arredondados (ponta da canaleta ~0,9 mm, passagem para a fenda ~0,7 mm), perfil plano na tangente do meio do recorte. A capa virou um cilindro de parede fina (~1,5 mm) e o disco do acionador fica dentro dela, 0,8 mm abaixo da borda, de quina arredondada, com uma fresta de ~0,45 mm em volta; o bico nasce no disco (alto 0,9 mm abaixo da borda). Miniaturas dos dois regeradas.

- **cl150** — (1) Dispensing Cube, dona (foto do Cube aberto na bancada: "refil vai até em cima, parece ter um clic para travar"): o colar do refil ocupa quase toda a boca do frasco (~92% da largura, ~22% do refil de altura) e ganhou duas travinhas do clique na borda de cima, na frente e atrás (`refilClic`, posição pela caixa real da peça — o W da peça poligonal é o raio de fora). (2) Dispensing Elíptico, dona ("tem um vão"): o líquido dos refis dos dispensadores ia a 94% e sobrava uma faixa vazia sob o anel (aparecia o gargalo); agora 99%, como nas fotos — vale para todos os refis desse bloco (15/30/60, Quadrado, Cube, Elíptico e os 15/30 conta-gotas). Miniaturas regeradas.

- **cl149** — Dispensing Cube, dona (desenho "Refil 50 / Refil 30" do catálogo: "tem refil o dispensing cube… parece ser um refil quadrado também"): o refil quadrado ganhou o colar mais largo no alto (~15% mais largo que o corpo, ~15% da largura de altura, PET transparente), logo abaixo do gargalo 20/410 e do anel — aparece como a faixa clara no alto do conteúdo, como na foto. Miniatura regerada.

- **cl148** — Dispensing Elíptico, dona (print do fundo ao lado da foto do catálogo: "tá bem diferente o fundo, fazer de fora a fora a curva"): o prato/bloco usava a profundidade (30) como raio e parava no meio — aparecia uma caixa clara. Agora vai até a parede na largura (W/2 − 0,7, achatado na profundidade), com a curva mais rasa (2,4 mm), e o refil tem o fundo quase reto da foto (cantos de ~20%, não a ponta redonda dos 15/30/60). Miniatura regerada.

- **cl147** — Aprovação (5 pedidos): (1) Flat Duo ("borda dos godês é mais arredondada, o godê da direita tem uma borda maior"): cantos dos godês ~3 mm (`godes.rc` 3,2) e a moldura do da direita 3 mm (era 1,6), com a quina do degrau arredondada (`step.round` → `pocketCut`). (2) Flat Trio Redondo ("godês estão low poly"): o contorno do desenho tinha 16 pontos — cada godê vira elipse lisa de 96 pontos no mesmo retângulo. (3) Dispensing Elíptico ("válvula tá menor, falta dente interno"; "líquido passando da parte do refil, base com bug de modelagem"): pump ×1,15 (na proporção da sobretampa), degrau do ombro como o Quadrado, e o fundo dos irmãos 15/30/60 (refil de ponta redonda + prato/bloco maciço); o bloco de revolução achata na profundidade em corpo elíptico (`kz = D/W`). (4) Dispensing Cube ("face lateral tem ângulos maior e embaixo fica quase um trapézio, ver desenho técnico", pág. 50): quinas verticais bem arredondadas (sideR 0,3 — face reta ~70% da largura) e o pé fechando em 8,5 mm de altura por 5,9 para dentro (rBot/rBotW), igual no alto da sobretampa. (5) Dispensing Twist ("o abrir aqui tem que ser com barra pq tem giro embaixo para o pump abrir"): o Abrir e o slider da barra giram a base (até 90°) e sobem o acionador ~4% da altura (`twist`/`twistLift`, `poseTwist`, sem remontar); a manga não sai mais. Observado e não mexido: o Twist fechado mede 123 mm contra 117,5 do catálogo (já era assim). Miniaturas dos cinco regeradas (só a do Cube mudou de imagem).

- **cl146** — On-Off 100/120, dona ("ele tá passando da tampa"): o bico ficava 2,6 mm para fora da parede e ~1 mm acima do topo. Agora fica todo dentro da canaleta — ponta 0,4 mm para dentro da parede e o alto 0,4 mm abaixo do topo (a caixa da peça fica no raio e no topo da capa). Miniaturas dos dois On-Off regeradas (`makeIncomThumbs` com os dois nomes) e índice atualizado.

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
