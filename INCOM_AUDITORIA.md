# Pente-fino Incom x Outbox

Data: 17/11/2026. Auditoria iniciada no estado `8e9327d`.

Cobertura: **186 renders comparados** — 116 produtos, duas variantes Abaulada dos batons e 68 montagens de tampas de perfume (incluindo Flint com colar abaulado). É uma auditoria de fidelidade das referências existentes, não uma declaração de que os 186 modelos já foram corrigidos.

## Método e limites

### Correções da revisão `2026-11-17.cdx4`

Os achados abaixo descrevem os renders antigos. Esta atualização registra o que foi efetivamente alterado depois da auditoria; não equivale à aprovação industrial de toda a biblioteca.

| Escopo / fonte | Correção implementada | Limite que permanece |
|---|---|---|
| Tube, p.84 | Frasco rígido com rosca 20-410 exposta, inserto de saída Ø1,6 e tampa removível; eliminada a bisnaga com solda. | Proporção do inserto e espessuras sem cotas próprias; profundidade provisória. |
| Ella/Long/Lipview/Squared, p.88–92 | Proporções base/colar/tubo e visor Lipview revistas pelas fotos; colar circular do Squared; compensação da altura Lipview. | Afilamento da bala, janela Spy e mecanismos internos ainda precisam de refino. |
| Máscaras, p.122–126 | Escovas com cerdas e envelopes diferenciados, transportadas pela tampa junto com a haste ao abrir. | Contagem e seção das cerdas são aproximações visuais; não são especificação do fornecedor. |
| Sticks M/G, p.130–131 | Colar e manga separados; porção visível do produto; tampa oca removível e alturas fechadas preservadas. | Construção oculta do mecanismo não certificada. |
| Líquidos labiais, p.94–108 | Tampa e haste saem juntas; gargalo permanece no corpo; boca aberta. Fundos planos com cantos arredondados nos cinco modelos confirmados (Berlim/Plus, Guggen Plus, Moma/2.0). | Ponteiras comerciais ainda compartilham uma aproximação; não aprovar todas as alternativas de aplicador. |
| Oscar All Crystal, p.103 | Rosca helicoidal contínua, em vez de anéis independentes; haste transparente solidária à tampa. | Passo/diâmetro internos sem cota de fabricação; pé externo ainda pendente. |
| Charm, p.100/104 | Vão do olhal corrigido para Ø4,5; altura da tampa compensada. | Seção de 1 mm estimada e apoios alargados ainda pendentes. |
| Oscar/Tate, p.125/107 | Ápice deixa de retirar altura do conjunto. | Oscar líquido continua com conflito entre foto/desenho na p.102. |
| Mini Jubilee, p.114 | Janela circular transparente na tampa. | Rosca e vedação industrial não aprovadas. |
| Dispensing, p.47–51/54–55 | Refis PET independentes; cascas externas vazias; Twist com manga, refil e acionador separados e rebaixo frontal. Cube/Elíptico com sobretampa arredondada sem aba superior. | Proporções internas estimadas pelas fotos; não certificam capacidade. Cinemática do Twist e canal de fluido não simulados. |
| Deluxes, p.57–62 | Saias lisas, eliminando os frisos genéricos incompatíveis com a foto. | Opções de dosadora e encaixes internos continuam pendentes. |
| Drop/Malika/Tahaa, p.155/171/193 | Fechamento contínuo dos ápices; hemisfério superior esférico da Tahaa e ponta contínua da Malika. | Profundidades não cotadas e interior não certificados. |
| Flat, p.28–33 | Encaixes estreitos na faixa sem espelho, por proporção da foto; faixa e degrau aprovados preservados. | Espessuras, trava e articulação completas não certificadas. |

**Retificação da triagem:** renders novos de cima confirmam losango no Frame G Quinteto e divisórias em X no Moon G Quarteto, já presentes no código. As duas primeiras linhas da tabela histórica de compactos foram superadas por essa evidência; não foi necessário girar os godês.

### Segunda etapa, `2026-11-17.cdx5`

- Apple Blow (p.65, **250 ml**), Bulb Blow 150, Chicago, Miami, Seoul 250 e Sydney 60: saia lisa, guia e proteção transparente sobre o atuador, proporcionais às fotos. A proteção é uma peça independente removível. Folgas de representação e dimensões do fechamento são estimadas; corpo/gargalo têm conferência própria, sem comparar a altura da montagem à cota do frasco.
- Bulb Blow 300 (p.68): saia lisa, haste grossa e cabeça curva larga próprias substituem o pump genérico. A profundidade da cabeça continua provisória; saída e mecanismo ocultos não foram inventados. Não se declara cópia exata em três vistas.
- Avante, Jubilee 15/40/60/85, Oval e Pote Squared (p.111/115–120): cavidade real vazia e refil separado quando documentado. Jubilee 15/Squared deixam o refil opcional oculto para reproduzir a foto vazia. Jubilee 40 não ganha refil que a página não oferece. Proporções, parede, piso e raios são estimados pelas referências; as opções comerciais não tiveram capacidade volumétrica certificada. O envelope cadastrado do Avante é mantido, mas precisa confirmação frente às capacidades comerciais listadas.
- Gaia (p.113): corpo em bege fosco opaco, representando o PP mate; removida a leitura de vidro jateado transparente.
- As roscas genéricas dos sete potes com nova cavidade ficam ocultas, conservando o assentamento da tampa; isso **não** significa que a rosca correta foi modelada/aprovada. A geometria da boca, filetes, vedação, inserto SAN, Polexan/cascaseal e interfaces dos refis seguem pendentes de fonte suficiente.

### Malika, `2026-11-17.cdx6`

Referências adicionais enviadas pela dona: frasco largo achatado sob a gota e tampa com parte principal fosca/faixa inferior lisa transparente (acabamento confirmado por ela). Frasco de demonstração ajustado por proporção da foto para ~73 × 83 mm (L/A); D=26 mm anterior preservado, sem nova evidência lateral. Essas medidas são de apoio genérico, não cotas de frasco Incom. Tampa isolada permanece 30 × 38 mm; base transparente ocupa ~18% da altura por leitura da referência. Curva interpolada suavemente e acabamento dividido na própria malha, inclusive no export. Renders de frente/lado e controles Drop/Tahaa em `_ref/incom/validacao-cdx6/`. O novo PDF foi expressamente adiado até concluir as correções restantes.

### Roll-on e olhais Charm, `2026-11-17.cdx7`

- Guggen Roll On (p.98): suporte PE representado por tubo aberto com rosca helicoidal externa, no lugar do cilindro liso; esfera permanece no frasco ao abrir. Passo (~12% do diâmetro), profundidade dos filetes (~4%) e extensão são estimativas do detalhe fotográfico, não norma industrial. Corpo e altura fechada de 103,9 mm preservados. Fundo interno em U e arquitetura do retentor ainda não certificados.
- Moma/Oscar Charm (p.100/104): apoios alargados conectam o aro à tampa. Vão circular Ø4,5 mm e alturas 87,1/112,3 mm preservados. Apoios ficam abaixo da abertura livre; forma externa estimada pela foto/desenho, sem cota própria de espessura. Correntes/pingentes continuam acessórios fora do escopo. Os formatos comerciais das ponteiras seguem pendentes.
- Renderizados os três conjuntos fechados/abertos. Vértices finitos e cotas comparáveis dentro de 0,1 mm em `tools/conferencia/validacao-cdx7.json`; renders locais em `_ref/incom/validacao-cdx7/`.

As duas etapas passaram por renderização atualizada aberta/fechada e checagem de vértices. `tools/conferencia/validacao-cdx4.json` registra 58 montagens e cotas comparáveis dentro de 0,1 mm (inclui controles). A segunda etapa tem relatório próprio em `tools/conferencia/validacao-cdx5.json`. Os JPGs locais ficam em `_ref/incom/validacao-cdx4/` e `_ref/incom/validacao-cdx5/`, ignorados pelo git. Os relatórios não convertem medidas estimadas em cotas oficiais.

Os parâmetros derivados das fotos estão comentados como estimados no código. A revisão não resolve as tampas escultóricas com lapidação faltante (Bouquet, Laura, Joya/Joya Mini, Quartz, Brilhante, Victoria), nem as interpretações ambíguas de Wheel/Rock/Thenue. Estas continuam no backlog, exigindo vistas adicionais para as partes não determinadas pelo catálogo.

- Fonte: `_ref/incom/catalogo-incom-2026.pdf`; fotos, desenhos e cotas da página indicada.
- Comparação visual com os renders existentes em `_ref/incom/renders`, datados de 17/11 às 09:15. São evidência da modelagem anterior; não constituem validação das alterações posteriores.
- Bege fosco é a apresentação de leitura de forma. Diferença de cor do catálogo não é defeito de geometria.
- Silhueta parecida e dimensões externas corretas não comprovam mecanismos internos corretos.
- Rosca, vedação, dobradiça, trava e mecanismos ocultos precisam de vista aberta, desenho ou peça física para aprovação exata. Não inferir aprovação por ausência de diferença em foto fechada.
- As cotas dos frascos medem corpo e gargalo; a altura do fechamento soma por cima. Comparar a altura da montagem com a cota do frasco produz falso erro dimensional.
- Profundidade ausente não significa profundidade igual à largura. Valores estimados precisam aparecer como estimados.

## Frascos e frasnagas: 22 comparações visuais

Triagem individual de foto x render. Achados críticos confirmados também na página inteira do catálogo.

| Produto | Página | Resultado / próximo refino |
|---|---:|---|
| Amsterdam | 64 | Família de fechamento tambor correta. Conferir proporção da altura da tampa e assentamento; render frontal fechado não comprova rosca/vedação. |
| Apple Blow | 65 | Spray exposto e serrilhado no render; foto principal tem sobretampa lisa/transparente. Conferir conjunto completo, não apenas botão spray. |
| Bulb Blow 150 | 66 | Mesmo problema do spray exposto; sobretampa/colar e acabamento do fundo precisam de comparação ampliada. |
| Bulb Blow 250 | 67 | Família bola sobre colar presente. Proporção bola/colar ainda precisa ser aferida na foto; rosca oculta não verificada. |
| Bulb Blow 300 | 68 | Divergência clara: cabeça redonda com braço fino e colar serrilhado genéricos; foto mostra bico de pato largo, curvo e saia lisa. Exige geometria própria do fechamento. |
| Chicago | 69 | Foto com sobretampa transparente lisa; render com spray exposto e colar serrilhado. Conferir fundo e encaixe com o ombro. |
| Miami | 70 | Mesmo desvio de conjunto spray/sobretampa. Não confundir altura da montagem com cota do frasco. |
| New York | 71 | Tampa Sens precisa saída retangular lateral no disco. Correção inicial feita em `8e9327d`, ainda sem render de aprovação. Render do catálogo usa modelo 200 ml; proporções anteriores derivam também de foto 250 ml, não intercambiar silenciosamente. |
| Seoul 250 | 72 | Spray exposto no render versus sobretampa transparente na foto. Ombro arredondado presente; assentamento e detalhes do fundo ainda não aprovados. |
| Sydney 60 | 73 | Spray/colar visíveis demais e sem sobretampa da foto. Seção circular é decisão documentada; não mudar para quadrado por reflexo da foto. |
| Wall | 74 | Família flip-top transparente presente. Render mostra degraus/anel bege por baixo; foto mostra fechamento transparente com anéis próprios. É preciso conferir dobradiça, saída e abertura em vista aberta. |
| Beatrice | 76 | Corpo/tampa retangulares presentes. Foto tem leve redução/degrau no encontro; render precisa conferir assentamento. Bico dosador e inserto não são verificáveis no render fechado. |
| Charlotte | 77 | Orientação sobre a tampa presente. Profundidade do catálogo ausente e derivada de volume no código: não aprovar como medida exata. Dosador/inserto exigem vista aberta. |
| Charlotte Rounded | 78 | Topo arredondado presente; mesmo limite de profundidade estimada e dosador/inserto ocultos. |
| Julie | 79 | Corpo e tampa cilíndricos presentes. Conferir proporção e degrau do ombro; bico dosador/inserto não demonstrados pelo render fechado. |
| Olympea | 80 | Inclinação do topo presente. Conferir encontro tampa/corpo e altura total; render existente informa 90,4 mm versus 90,9 mm cadastrados. |
| Olive | 81 | Silhueta abaulada presente. Dosador/inserto ocultos; fechar comparação do alinhamento da linha de união. |
| Petit com Haste | 82 | Render apenas fechado impede conferir o atributo principal: haste e aplicador. Foto mostra conjunto aberto com haste; exigir render aberto e conferir a peça interna. |
| Petit Aplicador | 83 | Render apenas fechado; foto mostra versões de aplicador sob a tampa. Confirmar qual ponta corresponde ao modelo e modelá-la, sem substituir por haste genérica. |
| Tube | 84 | Divergência estrutural crítica: render é bisnaga com solda serrilhada; catálogo mostra frasco rígido em PE com topo arredondado, tampa/inserto PP, dosador de orifício 1,6 mm e rosca 20-410. `case 'tube'` usa `M('bisnaga')`, interpretação incorreta. Refazer a construção com o desenho e foto; não basta alisar a solda. |
| Vênus 35 | 85 | Silhueta cilíndrica fechada presente. Dosador/rosca/inserto precisam aparecer em render aberto antes de aprovar. |
| Vênus 45 | 86 | Mesmo limite da Vênus 35; verificar altura e proporção da tampa separadamente. |

## Compactos e paletas: 30 comparações visuais

Foram vistos 22 compactos (páginas 3-24) e 8 paletas (26-33). Achados ampliados revisados: divisões, Case e Flat. Cor bege, godê saltado do Case, cristal, rebaixos e degraus aprovados não foram classificados como erros.

| Produto | Página | Divergência |
|---|---:|---|
| Frame G Quinteto | 10 | Godê central alinhado ao estojo no render; catálogo mostra losango, girado. A mudança afeta também os quatro godês periféricos. |
| Moon G Quarteto | 20 | Divisórias em + no render em relação à dobradiça; catálogo mostra X. Corrigir orientação relativa ao fecho, não girar só a câmera. |
| Case G, Case M, Case M All Crystal | 3-5 | Frente lisa no render, sem detalhe central do fecho da foto. Articulações laterais pouco definidas em relação ao catálogo. Preservar placa fina e godê saltado. |
| Frame G com Visor, Quinteto, Tampa Fechada, M e P | 9-13 | Dobradiça cilíndrica segmentada mais larga no render; ligação central do catálogo aparenta ser mais estreita. Exige aferição por foto conhecida. |
| Flat Dez, Duo, Sexteto, Trio Retangular, Trio Redondo e 6 + 1 | 28-33 | Dois encaixes na faixa inferior da tampa aparecem como pastilhas quadradas salientes; foto mostra detalhes estreitos junto ao eixo. Manter faixa aprovada, refinar forma e posição. |

Nos demais modelos dessa família não foi confirmado outro desvio inequívoco nessa vista. Isso não aprova mecanismos nem dimensões. Moon Deck requer vistas adicionais do andar inferior e da articulação.

## Conta-gotas, dispensadores, deluxes e potes: 37 comparações

| Produto | Página | Divergência / ressalva |
|---|---:|---|
| Amsterdam Deluxe 100, conta-gotas | 35 | Bulbo aparenta ser alto demais em relação ao colar; conferir por proporção da foto. |
| Bulb, conta-gotas | 36 | Mesma relação bulbo/colar; família do fechamento e sobretampa correspondem. |
| Dispensing 15 e 30, conta-gotas | 37-38 | Recipiente/refil separado da foto não tem leitura equivalente no render, que mostra preenchimento amplo. |
| Flacon 15/30 Bulbo e Flacon 15/30 Botão | 39-42 | Ponta da pipeta no render tem pescoço e pequena bolinha mais pronunciados. Confiança moderada devido à refração; não definir medidas por essa comparação. |
| Julie, conta-gotas | 43 | Foto mostra corpo opaco; render transparente exibe conteúdo/pipeta. Diferença de material, não corrigir geometria para escondê-la. |
| Sydney, conta-gotas | 44 | Transição de fundo aparenta mais angulosa no render. |
| Bulb, dispensador | 46 | Mola/alojamento muito aparentes; catálogo não dá evidência equivalente do mecanismo. Dosadora é alternativa válida na página. |
| Dispensing 15, 30 e 60 | 47-49 | Refil interno e fundo transparente espesso não reproduzidos como conjunto separado. |
| Dispensing Cube | 50 | Sobretampa com topo praticamente reto e borda saliente; referência tem cantos superiores arredondados. Refil/base espessa também precisam refino. |
| Dispensing Elíptico | 51 | Sobretampa com aba saliente e ressalto de base ausentes da foto; referência tem topo arredondado. Falta leitura do refil. |
| On-Off 100 | 52 | Ângulo do render não mostra bico/rebaixo frontal. Há `spout` no código; não declarar bico ausente. Exigir vista frontal apropriada. |
| On-Off 120 | 53 | Render opaco versus foto transparente. Mesma limitação do bico. |
| Dispensing Quadrado | 54 | Falta leitura do refil estreito de fundo arredondado dentro da casca quadrada. |
| Dispensing Twist | 55 | Montagem possui base e corpo giratório; falta componente separado do acionador/refil mostrado na página. Render fechado sozinho não comprova o mecanismo. |
| Amsterdam Deluxe 100 e 200 | 57-58 | Colar com frisos verticais fortes versus colar liso da foto. |
| New York Deluxe 100 e 200 | 59-60 | Mesma divergência do colar. Spray é alternativa compatível; não trocar por Sens só porque existe ícone na página. |
| Sydney Deluxe 100 e 200 | 61-62 | Mesma divergência do colar; fundo aparenta transição mais angulosa. |
| Pote Apple Blow | 110 | Contorno geral presente; fundo com faixas/degraus de sombreado. Confirmar geometria versus iluminação antes de editar. |
| Avante | 111 | Cavidade/refil arredondado e base transparente espessa pouco reproduzidos. Tampa abaulada é opção prevista. |
| Bold | 112 | Sem divergência inequívoca de tampa/silhueta nessa vista; rosca e vedação não conferidas. |
| Gaia | 113 | Referência opaca fosca versus `vidroFosco` no código/render com conteúdo visível. |
| Mini Jubilee | 114 | Visor circular da tampa da foto não aparece na montagem opaca genérica. |
| Jubilee 15 | 115 | Fundo/cavidade transparentes pouco legíveis, dominados por preenchimento amplo. |
| Jubilee 40 | 116 | Referência vazia versus render preenchido impede conferir interior; renderizar vazio antes de concluir erro de parede. |
| Jubilee 60 e 85 | 117-118 | Recipiente interno arredondado/refil não representado como peça separada. |
| Oval | 119 | Mesma divergência interna; tampa abaulada é variante válida. |
| Pote Squared | 120 | Falta cavidade arredondada/inserto distinguível dentro do exterior quadrado espesso. |

Dosadora e spray aparecem como alternativas nas páginas de dispensadores e deluxes. A presença de ícones não comprova que a escolha de spray seja errada; comparar a geometria do conjunto da foto principal.

## Batons, líquidos labiais, máscaras e sticks: 29 renders comparados

## Batons — sete renders vistos individualmente

| Produto / página | Achado e limite |
|---|---|
| **Ella — p. 88** | O conjunto aberto não reproduz a divisão visual da foto: o colar do render é um cilindro liso e relativamente alto; na foto há dois ressaltos/aneis estreitos junto à base. A base externa fica proporcionalmente mais curta no render. A bala do catálogo afina para uma ponta; o render usa cilindro com corte oblíquo plano e extremidade arredondada. O código inclui `curvaTopo` para a tampa; como ela está deitada e o topo não está exposto no mesmo ângulo da referência, não aprovo nem condeno a curvatura específica apenas por esse render. |
| **Long — p. 89** | Divergência clara na hierarquia base/colar: a foto tem um pé largo muito baixo e, sobre ele, um trecho estreito alto; o render tem base larga alta e colar estreito baixo. O código usa a montagem genérica de base e colar. A bala está muito mais exposta que na foto; isso é diferença de posição de abertura, não prova isolada de comprimento errado da bala. A tampa reta corresponde a uma opção documentada. |
| **Long Abaulada — p. 89** | Render conferido separadamente: a cúpula existe e é uma opção explícita no desenho da página. Repete a divisão incorreta entre pé largo e trecho estreito do Long. Não há foto específica da versão abaulada aberta para certificar seu raio exato; não foi inventada reprovação da cúpula. |
| **Long Lipview — p. 90** | O visor inferior está presente, com copo transparente, cor e aba: não é geometria totalmente faltante. Na foto há uma faixa incolor inferior bem marcada; no render o preenchimento colorido domina mais o copo. A bala renderizada é de corte oblíquo plano, enquanto a foto mostra ponta afilada. JSON registra altura fechada **72,8 mm**, contra **74 mm** no catálogo, diferença de **−1,2 mm**. A vista aberta não permite julgar a junta fechada da tampa. |
| **Long Lipview Abaulada — p. 90** | Conferido individualmente: mantém visor, cor e aba, e acrescenta cúpula autorizada pelo desenho. Repete a diferença da bala e o registro de altura **72,8 versus 74 mm**. O raio exato da variante não foi certificado. |
| **Spy — p. 91** | A janela de cor do topo aparece no catálogo, mas a extremidade externa da tampa não está visível no JPG do render, que mostra sua boca. Portanto, **não há prova visual de visor ausente**. O código aplica disco de segundo material no topo, o que não equivale a demonstrar um visor transparente com construção fiel. A bala do render mantém corpo cilíndrico e chanfro plano; a referência tem afilamento lateral. O fundo arredondado da base está representado. |
| **Squared — p. 92** | O colar entre a base quadrada e o tubo metálico está **quadrado no render**, enquanto o colar exposto na foto é **circular**. O código confirma aplicação de `s0` quadrado ao colar interno. A bala também perde o afilamento pontudo da foto. Base e tampa quadradas estão presentes; não se confundiu sua seção correta com o erro específico do colar. |

## Líquidos labiais — quinze renders vistos individualmente

O caminho de código comum usa uma ponta de gloss lisa, de 13 mm, com largura limitada por fórmula. Não há seleção por modelo dos formatos de ponteira mostrados no catálogo. Isso permite afirmar falta de diferenciação geométrica no código, mas os renders fechados **não permitem verificar visualmente comprimento da haste, ponta escolhida, encaixe, retentor ou rosca sob tampa opaca**. A ausência de cada alternativa comercial no preset não significa que todas as opções precisem aparecer simultaneamente.

| Produto / página | Achado e limite |
|---|---|
| **Berlim — p. 94** | Seção quadrada e divisão principal tampa/frasco estão representadas. O render mostra fundo interno em concha bem marcado; a foto tem fundo do reservatório mais plano, com cantos arredondados, e uma base transparente menos profunda visualmente. É divergência do contorno interno visível, não da cor. Ponta e haste fechadas não auditáveis pelo JPG. |
| **Berlim Plus — p. 95** | Conferido separadamente: também apresenta concha interna acentuada em lugar do fundo mais plano da foto. A silhueta quadrada e a tampa relativamente curta estão presentes. A foto mostra aplicador grande; o código mantém a ponta genérica de 13 mm, sem identidade geométrica específica das opções #54/#56AL/#65. Não há vista aberta do render para certificar a montagem. |
| **Guggen — p. 96** | O fundo em sorriso existe; não foi marcado como ausente. O arco interno do render é visualmente mais raso que o reservatório em U alongado da foto. Há bandas verticais facetadas no conteúdo renderizado, diferentes da leitura contínua da referência; a imagem não basta para atribuí-las exclusivamente à malha externa, pois material/refração/normais também podem contribuir. Tampa reta é opção válida. |
| **Guggen Plus — p. 97** | Na foto o fundo interno é quase plano e fica próximo da base; o render impõe concha e faixa transparente inferior mais alta. O código confirma a mesma regra de fundo aplicada aos glosses. O aplicador grande da referência não tem implementação diferenciada; não foi visualmente certificado fechado. |
| **Guggen Roll On — p. 98** | A esfera não está visível no render fechado; **não é correto afirmar que falta**, pois o código cria suporte e esfera de aço. A foto ampliada mostra gargalo com roscas externas e assento da esfera; o ramo de montagem cria suporte liso e esfera, sem reproduzir ali esses filetes expostos. O arco do fundo do render é mais raso que o da foto. A falta de filetes é constatação do código comparada com geometria visível na referência, não observação de um render aberto. |
| **Moma — p. 99** | O arredondamento externo da base está presente. A foto tem cavidade de fundo relativamente plano com cantos arredondados; no render a concha interna é mais pronunciada. Catálogo mostra versões com tampa baixa e alta, totalizando 74 e 85 mm; o render auditado representa a baixa, 74 mm. A versão alta não foi vista como preset separado. Não se deve tratar a baixa como errada apenas por existir outra opção. |
| **Moma Charm — p. 100** | Olhal existe, mas é uma argola toroidal isolada, sem os pés alargados que fazem a transição para a tampa no desenho. O desenho cota **Ø4,5 mm** no olhal; pela fórmula atual o vão interno nominal calculado é aproximadamente **2,54 mm**, sem medir nova malha. Portanto a geometria implementada não reproduz a cota e o apoio da referência. Corrente e pingentes da foto são acessórios, não defeito obrigatório do frasco. |
| **Moma 2.0 — p. 101** | Base arredondada e tampa reta estão presentes e são opções documentadas. O fundo interno está mais abaulado no render do que o reservatório de base achatada e cantos arredondados da foto. A referência aberta mostra haste grossa e ponteira grande; o código compartilha a ponta genérica, sem reprodução específica dessa configuração. |
| **Oscar — p. 102** | Há **conflito de evidência na própria página**: a foto mostra corpo estreito com tampa abaulada, mas o desenho traz olhal e cotas Ø22,6 × 87,1 mm, como Moma Charm. `PROD_FIX` adota Ø18,6 × 109,9 mm e perfil do Oscar máscara (p. 125). Essa substituição é hipótese documentada no código, não confirmação dimensional oficial do Oscar líquido. O render acompanha a tipologia da foto, mas seu JSON registra 109,4 mm, **0,5 mm abaixo do alvo interno de 109,9 mm**. Não chamar esse delta de erro contra uma cota inequívoca da p. 102. |
| **Oscar All Crystal — p. 103** | Tampa transparente e gargalo colorido visível por dentro **estão presentes**. O detalhe conferido mostra que a referência tem linhas de rosca oblíquas; o render apresenta cinco anéis horizontais independentes, e `roscaInt` os constrói como toros, não hélice. Isso é diferença de geometria visível pela tampa. A foto tem pé externo mais arredondado que a base quase reta do render; o desenho técnico simplifica esse fundo, portanto o limite foto/desenho deve ser registrado. Haste transparente está prevista no código, mas não foi vista aberta no render. |
| **Oscar Charm — p. 104** | Conferido separadamente: a argola é toroidal e sem os pés alargados do desenho. A cota Ø4,5 mm não é seguida pelo vão interno nominal calculado da fórmula atual, aproximadamente **2,72 mm**. Base arredondada e olhal existem. Corrente e pingentes foram tratados como acessórios. |
| **Silhouette — p. 105** | A cintura do corpo e o alargamento da tampa no topo estão presentes, não faltantes. Na foto há pequeno degrau/ressalto de gargalo logo abaixo da tampa; o render reduz a região a uma junta quase direta. Há facetas verticais no conteúdo; não se atribui automaticamente isso a seção externa errada. Ponteira/haste não auditáveis fechadas. |
| **Tate — p. 106** | A foto tem topo arredondado com trecho central mais achatado; o render mostra calota mais contínua e uma linha horizontal próxima do topo. O fundo interno da foto é mais plano e o do render fica em concha. JSON registra **90,9 mm**, contra **91,3 mm** da fonte, diferença **−0,4 mm**. A imagem frontal não certifica a profundidade/seção em planta. |
| **Timeless — p. 107** | O fundo interno do reservatório renderizado é mais profundo/abaulado que o fundo quase plano e arredondado nos cantos da foto. O topo arredondado está presente. O código o classifica como `glosssq`; uma foto e um render frontais não bastam para certificar a seção em planta nem declarar erro apenas por essa classificação. |
| **Timeless Plus — p. 108** | Conferido separadamente: reservatório na foto desce com fundo quase plano, enquanto o render aplica concha muito evidente. A ponteira grande de corretivo mostrada e destacada no texto não tem geometria específica no preset, que usa a ponta genérica de gloss. A proporção principal da tampa está representada; não foi certificado o conjunto aberto. |

## Máscaras — cinco renders vistos individualmente

**Falta geométrica comum comprovada no código, depois da conferência individual das cinco fotos:** os presets recebem `tampaGloss` com `sprayType: 'gloss'`; `pescanteGeo` gera ponta lisa achatada e curva, sem cerdas. `masc` altera tamanho e cor e dá o nome “Haste com escova”, mas não troca o gerador por uma escova. O nome da peça não comprova a geometria. Os cinco JPGs estão fechados: o defeito de escova é constatado no caminho de código comparado à referência, não visualização de escova errada no JPG.

| Produto / página | Achado individual e limite |
|---|---|
| **Berlim Plus — p. 122** | A foto mostra escova espessa, com afunilamento no topo e cerdas ao redor; o caminho de gloss não a produz. Corpo/tampa quadrados e a divisão externa principal estão presentes. O símbolo Ø na cota do catálogo não resolve sozinho a seção, pois a foto mostra faces; não foi imposto cilindro com base só no símbolo. |
| **Guggen — p. 123** | A foto mostra escova estreita e quase cilíndrica, com dentes/cerdas curtos, distinta da Berlim Plus; essa configuração não existe na ponta lisa do código. Silhueta externa cilíndrica e tampa reta estão representadas. Não foi constatada divergência externa grande adicional com segurança. |
| **Guggen Plus — p. 124** | A foto mostra escova mais larga e alongada, afilando nas extremidades; falta essa distribuição de cerdas. A forma externa e a tampa reta estão presentes. O detalhe ampliado confirmou **122,0 mm**, coerente com cadastro e JSON; não há achado dimensional de 129 mm. |
| **Oscar — p. 125** | Foto mostra escova estreita com cerdas, não ponta de gloss. Corpo com base arredondada e tampa abaulada estão presentes. JSON registra **109,4 mm**, contra **109,9 mm** cotados na página: **−0,5 mm**. |
| **Timeless Plus — p. 126** | A foto mostra escova espessa, alongada e afilada, com cerdas em volta; falta essa geometria no caminho usado. Contorno frontal de topo arredondado e divisão tampa/corpo estão representados. A seção em planta não foi certificada por essa vista. |

## Sticks — dois renders vistos individualmente

| Produto / página | Achado individual e limite |
|---|---|
| **Chubby Stick M — p. 130** | A proporção externa de base longa/tampa curta está representada; metadados 31 × 85,5 mm concordam com a fonte. A foto aberta mostra manga/copo elevado em volta do produto e colares intermediários com degraus e detalhes laterais; a montagem tem só `Base`, `Bastão (produto)` e `Tampa`. Esses volumes expostos não são reproduzidos. O bastão é parametrizado genericamente com diâmetro de 78% da largura e altura derivada da tampa; o JPG fechado não prova sua forma aberta. |
| **Chubby Stick G — p. 131** | Conferido separadamente: tampa e base têm alturas próximas, como no render; 31 × 114 mm concordam com o desenho. A foto aberta mostra uma manga exposta muito mais alta que a do M e um colar inferior separado. A montagem de três peças não diferencia nem reproduz esses volumes. O tamanho do bastão oculto não foi certificado. |

Nos dois sticks, o ramo consultado não marca a tampa com `capa`/`oco` e não configura a subida do produto como nos batons. Isso é limite de representação/abertura do código, não certificação de funcionamento industrial. A “tampa de vedação” citada no texto não foi inventada em geometria a partir de uma construção interna que a referência não expõe.

## Tampas de perfume: 68 renders comparados

67 entradas do catálogo e a variante Flint com colar abaulado, em 12 pranchas. Comparação frontal: não aprova planta, profundidade ou encaixe oculto. Golden, Drop, Joya, Rock, Thenue e Wheel também conferidos em páginas inteiras ampliadas.

## Achados por item

| Item | Página | Diferença / resultado observado | Limite da evidência |
|---|---:|---|---|
| Antonov | 133 | Sem divergência frontal clara na assimetria e no topo inclinado. | Profundidade estimada; foto não fornece cota lateral. |
| Aramis | 134 | Topo côncavo e colar presentes; seção quadrada superior não confirmável no render frontal. | Necessária vista superior do modelo; opções de colar não são erro por si. |
| Áurea | 135 | Cabeça larga, ombro e pescoço compatíveis na frente. | Vista frontal não valida seção superior nem interior. |
| Bamboo | 136 | Corpo horizontal reconhecível; render deixa a válvula bastante exposta sob a concavidade central. | Montagem pode explicar a exposição; profundidade estimada; falta vista lateral. |
| Bilbao | 137 | Conicidade e topo inclinado presentes, sem erro frontal demonstrável. | Rotação muda o lado aparente da inclinação; falta vista superior. |
| Block | 138 | Sem divergência frontal clara no bloco reto. | Frente não distingue bem quadrado de seção arredondada. |
| Boulle | 139 | Silhueta globular compatível. | Sem validação de interior ou profundidade por imagem frontal. |
| Boulle Big | 140 | Silhueta globular com base truncada compatível. | Frente isolada não valida a seção e a cavidade. |
| Bouquet | 141 | Divergência clara: pétalas/volutas do topo foram reduzidas a degraus concêntricos; render parece uma tigela com botão. | Foto e desenho sustentam o relevo; quantidade/profundidade exatas pedem vista superior e cotas. |
| Bowl | 142 | Contorno de tigela compatível. | Render bege não permite conferir paredes transparentes ou cavidade. |
| Box | 143 | Bloco frontal compatível. | Quinas e espessuras internas precisam de vista superior. |
| Brilhante | 144 | Lapidação simplificada em faces longitudinais amplas; faltam as subdivisões diagonais visíveis no catálogo. | Quantidade e ângulos das facetas não cotados; colar aberto é opção válida. |
| Chelsea | 145 | Bloco e trecho metálico aparente presentes; sem erro frontal claro. | Altura de catálogo inclui válvula aparente; 24,5 mm da tampa isolada não contradizem sozinhos 29,5 mm do conjunto. |
| Chess Deluxe | 146 | Placa espessa sobre pescoço coerente com o desenho. | Frente não valida seção quadrada e espessura interna. |
| Chess | 147 | Contorno baixo e chanfro inferior coerentes. | Válvula visível depende de assentamento; cavidade não auditada. |
| Cool Claire | 148 | Cilindro e pequeno abaulamento superior coerentes com o desenho. | Detalhe vermelho da foto é aparência/acessório; não tratado como falta geométrica. |
| Claire | 149 | Sem divergência frontal clara no cilindro. | Não valida espessura, interior ou acabamento. |
| Crown | 150 | Cabeça facetada e pescoço reconhecíveis; sem outra divergência frontal demonstrada. | W=37 nos dados é estimado; desenho cota altura e pescoço, não largura máxima. Render salvo mede 46,1 mm. |
| Crown Mini | 151 | Cabeça facetada e pescoço coerentes na frente. | Número/posição das facetas superiores não conferidos sem render de cima. |
| Cubic | 152 | Barril de seção quadrada arredondada reconhecível; forma frontal compatível. | Reflexos da foto transparente não provam por si facetas externas adicionais; falta vista superior. |
| Domini | 153 | Topo inclinado e aba unilateral presentes. | Aba aparece no lado oposto à foto, mas coincide com a orientação do desenho: rotação não é defeito; largura estimada. |
| Dora | 154 | Cabeça larga inclinada e pescoço reconhecíveis. | Largura máxima estimada: 33 nos dados e 40,8 mm no render não resolvem a cota real; altura salva 32,0 versus 32,2 mm merece medição atual. |
| Drop | 155 | Vão em gota confirmado. Render apresenta pequeno platô no ápice externo, enquanto foto/desenho mostram ponta mais contínua. | Platô é achado visual, sem cota; válvula no vão pode ser normal na montagem; profundidade não cotada. |
| Duomo | 156 | Domo e faixa inferior coerentes. | Reflexos no material transparente não bastam para afirmar facetas externas ausentes. |
| Elipse | 157 | Contorno frontal baixo compatível. | Não é possível validar seção elíptica nem assentamento por uma única frente. |
| Flint | 158 | Corpo cônico e topo abaulado compatíveis; render usa colar aberto. | Foto principal usa outra opção; pág. 158 oferece colares, portanto diferença isolada não é erro. |
| Flint (colar abaulado) | 158 | Corpo com anel-barriga-anel compatível com a variante abaulada. | Desenho principal é do colar aberto; geometria do abaulado foi derivada da foto, sem cotas próprias completas. |
| Flora | 159 | Hélices do render parecem ter sentido oposto às da foto/desenho e sulcos mais largos/arredondados. | Confirmar lateral e vista superior para separar hélices dianteiras/traseiras; W estimado nos dados. |
| Golden | 160 | Vão circular sustentado por foto, desenho e texto; sem erro de recorte frontal claramente demonstrado. CAP_FIX usa furo circular w=0,60, yc=0,60. | Largura e profundidade estimadas; D=12 nos dados versus D=22 em CAP_FIX, render salvo 21,6 mm. Não há cota lateral para escolher entre elas. Válvula aparente é prevista no catálogo. |
| Hexa | 161 | Faces hexagonais e base inferior reconhecíveis. | 31 × 27,1 mm pode resultar da orientação do hexágono; não usar D ausente como obrigação de D=W. |
| Indico | 162 | Calha côncava superior e corpo afunilado presentes. | Curvatura transversal e profundidade não validadas sem render superior/lateral. |
| Íon | 163 | Contorno frontal reto compatível. | Frente não comprova seção superior ou cavidade. |
| Íon Mini | 164 | Contorno frontal reto compatível. | Frente não comprova seção superior ou cavidade. |
| Iridium | 165 | Ovo e colar abaulado presentes. | Não há divergência frontal clara; interior e opção de colar fora da comprovação. |
| Isis | 166 | Três níveis e estreitamentos reconhecíveis. | Cotas dos pequenos raios/degraus não verificáveis na prancha. |
| Joya | 167 | Divergência clara de lapidação: render forma uma tigela quase lisa com poucas faces no ombro; falta a rede de facetas triangulares do topo. CAP_FIX: 12 lados, polyFrom=0,65 e facetBlend=2,5. | Foto, texto e desenho sustentam topo facetado, mas não definem todos os ângulos; render frontal não permite auditar alívio de massa central e interior. |
| Joya Mini | 168 | Mesma simplificação da Joya: topo sem a rede triangular e corpo visualmente arredondado. | Pág. 168 mostra lapidação; distribuição 3D exata e cavidade dependem de vista superior e cotas. |
| Laura | 169 | Divergência forte: faltam nervuras/radiais e recortes laterais do leque; render vira cúpula escalonada com faixas horizontais. | Foto e desenho mostram o leque; profundidade das nervuras e vista traseira não estão determinadas. |
| Liz | 170 | Cone truncado alto compatível. | Seção superior e paredes internas não verificadas. |
| Malika | 171 | Render cria pequeno ressalto/platô no ápice; foto/desenho mostram ponta de gota contínua. | Confirmar em render ampliado atual; sem cota do raio da ponta. |
| Mandy | 172 | Cabeça baixa sobre haste compatível. | Não valida detalhes da seção superior ou interior. |
| Manhattan | 173 | Cilindro e aro metálico aparente presentes. | 27 mm da tampa isolada versus 30 mm do catálogo incluem a diferença da válvula aparente; não declarar erro de altura por isso. |
| Matrix | 174 | Render mostra topo dividido/inclinado, mas a dobra sobreposta do catálogo não fica suficientemente demonstrada. | Achado inconclusivo na frente; requer render superior/3/4. |
| Memphis | 175 | Ombros rebaixados e corpo afunilado reconhecíveis. | Seção quadrada superior visível na foto não se valida pela frente do render. |
| Navette | 176 | Cabeça larga e pescoço presentes; gomos ficam pouco legíveis na frente. | Não comprova forma em planta nem amplitude dos quatro lóbulos; precisa render superior. |
| Plate | 177 | Placa circular baixa e pequeno abaulamento inferior coerentes. | Válvula aparente depende da montagem; espessura interna não auditada. |
| Prisma | 178 | Face estreita adicional do chanfro aparece no render. | Foto e desenho em planta sustentam corte a 45 graus; largura e posição do corte não quantificadas pela frente. |
| Próton | 179 | Bloco baixo com pé inferior coerente. | Sem render de cima, seção e quinas não ficam verificadas. |
| Quad | 180 | Retângulo alto frontal compatível. | Frente não comprova seção quadrada nem interior. |
| Quartz | 181 | Lapidação simplificada em faixas/faces largas; falta rede de facetas triangulares do topo e laterais mostrada no desenho/foto. | Ângulos e contagem exata requerem planta/modelo superior; apoio metálico não foi tratado como erro. |
| Quattro | 182 | Bloco largo e baixo compatível. | Quinas e profundidade precisam de outra vista. |
| Rams | 183 | Cilindro com pé rebaixado compatível. | Espessura interna e encaixe não auditados. |
| Rock | 184 | Prioridade alta de confirmação: render e código abrem elipse passante regular; fotos mostram pedra volumosa com alojamento vertical central e superfícies contínuas/refrativas. Perde também a irregularidade do recorte interno desenhado. CAP_FIX: w=0,60, hh=0,52, yc=0,55. | Forte indício de interpretação indevida de linha interna; desenho isolado pode parecer um vão. Sem corte ou foto traseira, não afirmar construção maciça nem prescrever fechamento definitivo; profundidade estimada. |
| Royal | 185 | Cone poligonal invertido compatível na frente. | Planta e facetas posteriores não verificadas. |
| Royal Mini | 186 | Cone poligonal invertido compatível. | Válvula aparente e efeito decorativo da foto não comprovam erro de geometria. |
| Safira | 187 | Cabeça poligonal sobre pescoço e anel inferior reconhecíveis. | Facetas superiores e raios pequenos não auditáveis na frente. |
| Slim Classic | 188 | Cilindro com pequeno domo superior coerente com o desenho. | Não valida parede ou encaixe interno. |
| Slim Honey | 189 | Sequência de anéis e rebaixos presente e visualmente compatível. | Raios/alturas de cada anel não foram medidos na prancha. |
| Slim Quadric | 190 | Corpo reto com anéis na base presente. | Seção quadrada muito arredondada só pode ser conferida por cima; frente não aprova sideR=0,55. |
| Soho | 191 | Trapézio e metal aparente presentes, sem erro frontal claro. | Altura salva de tampa 25 mm versus catálogo 30 mm inclui válvula aparente; não é erro automático. |
| Sophia | 192 | Cintura de ampulheta coerente. | Detalhes polidos/foscos e forma em planta não conferidos; nome no catálogo é Sophia. |
| Tahaa | 193 | Render tem pequeno platô/ressalto no topo da esfera, não evidente no desenho esférico. | Confirmar raio do ápice em imagem atual; colar abaulado é opção válida da página. |
| Thenue | 194 | Prioridade alta de confirmação: app elimina o miolo com elipse passante; fotos mostram painel oval fosco contínuo dentro de borda polida. CAP_FIX: w=0,72, hh=0,78, yc=0,55. | Diferença foto-render clara; espessura do painel e construção interna não determinadas por seção. Desenho com elipses concêntricas é ambíguo; profundidade estimada. |
| Tutti | 195 | Barra transversal sobre pescoço coerente. | Vista frontal não valida profundidade da barra nem encaixe. |
| Twist | 196 | Torção entre faces presente e reconhecível. | Ângulo e sentido exatos precisam de vista superior/3/4; sem conclusão quantitativa sobre polyTwist=1,25. |
| Victoria | 197 | Divergência: desenho/foto exibem linhas diagonais em V e encontro das faces; render mostra tronco com abertura superior e frente quase lisa, sem o V. | Parte do contraste é acabamento polido/fosco; não inferir profundidade de sulco a partir da foto. |
| Wheel | 198 | Prioridade alta de confirmação: render transforma a tampa em argola circular vazada, com válvula totalmente exposta; fotos mostram lente volumosa com alojamento vertical atravessando visualmente o centro. CAP_FIX: furo circular w=0,62, yc=0,47. | Desenho frontal e ícones sugerem argola, mas fotos não confirmam passagem frente-trás. Exigir corte ou foto posterior antes de alterar; D é estimado e não foi validado. |
| Zaha | 199 | Ressalto superior assimétrico e paredes afuniladas presentes. | Foto e desenho variam com a orientação; sem vista superior do render não há validação completa. |


## Problemas do processo de conferência

1. O PDF existente compara também itens fechados cujo principal diferencial está escondido. Acrescentar vistas abertas dos dosadores, aplicadores e tampas, além da vista fechada.
2. O campo `fD` usa largura como substituta de profundidade desconhecida em alguns casos. Não apresentar esse valor como cota comprovada.
3. A lista de fechamentos do catálogo representa alternativas compatíveis. A montagem padrão deve reproduzir o fechamento da foto principal; cada alternativa precisa ter sua própria forma.
4. O código ainda define a espumadora com `sprayType: 'dosadora'`. Isso identifica reaproveitamento geométrico; não comprova fidelidade ao item espumador do catálogo.
5. As peças intercambiáveis foram extraídas dos modelos atuais. Estar na aba Incom identifica origem da referência, não aprovação de fidelidade.

## Estado de aprovação

Nenhum produto deve receber aprovação de mecanismo completo apenas com esta triagem. A auditoria registra divergências e limitações; aprovação final exige render atualizado, medida da peça correta e referência suficiente de abertura/fechamento.

## Ordem de correção recomendada

1. Erros de construção comprovados: Tube; visor Mini Jubilee; acionador/refil Dispensing Twist; escovas das cinco máscaras; mangas e colares dos sticks; divisões Frame Quinteto e Moon Quarteto; colar circular do Squared e proporções base/colar dos Long.
2. Fechamentos próprios: bico de pato Bulb Blow 300; spray liso e sobretampas; refino e vista aberta da Sens; bicos dosadores e aplicadores Petit.
3. Componentes internos visíveis no catálogo: refis Dispensing e cavidades de potes, sem substituir a parede/refil por líquido cheio.
4. Tampas escultóricas: Bouquet, Laura, Joya/Joya Mini, Quartz e Brilhante. Validar primeiro em três vistas.
5. Interpretações ambíguas: Thenue, Wheel e Rock. Pedir corte ou vista posterior quando necessário; não remover/preencher material por suposição.
6. Fechos e dobradiças de compactos/paletas e cotas dos conjuntos. Revisar fechado, aberto e durante o movimento.

## Conferência dimensional pendente

Os JSON existentes apontam diferenças que precisam ser medidas novamente na revisão atual, sem usar perspectiva da imagem como régua:

| Produto | Cota cadastrada | Medida no render existente | Ressalva |
|---|---:|---:|---|
| Long Lipview e Abaulada | A 74 mm | A 72,8 mm | Verificar perfil/visor e montagem fechada. |
| Oscar, máscara | A 109,9 mm | A 109,4 mm | Cota direta da página 125; medir novamente. |
| Oscar, líquidos labiais | Alvo interno A 109,9 mm | A 109,4 mm | Página 102 tem conflito foto/desenho; alvo substituído pelo Oscar máscara no código. Não é cota oficial inequívoca do produto líquido. |
| Tate, líquidos labiais | A 91,3 mm | A 90,9 mm | Nova medição necessária. |
| Olympea | A 90,9 mm | A 90,4 mm | Considerar topo inclinado e encaixe. |
| Dispensing Elíptico | L 42,8 mm | L 42,6 mm | Nova medição necessária. |
| Tube | L 29 mm | L 29,4 mm | A construção está errada; corrigir forma antes de fechar cotas. |

Alturas de frascos com fechamento e profundidades estimadas foram excluídas desta lista para evitar falsos erros. Diferenças de até 0,1 mm nos metadados arredondados também não foram tratadas como falha.
