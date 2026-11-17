# Retomada OUTBOX / Incom — 17/11/2026

Leia este arquivo e **CODEX_REFINO.md inteiro** antes de editar. A dona pediu o repasse porque está ficando sem crédito. Não reiniciar a auditoria nem apagar o trabalho local.

## Objetivo ainda aberto

Refinar todos os modelos conforme catálogo Incom 2026 e fotos oficiais, com os mecanismos visíveis, roscas documentadas e variações oferecidas. Cor base bege fosco; transparências específicas preservadas. **Só produzir o PDF completo foto × render depois das correções.** Não foi produzido PDF novo nesta rodada. Não declarar que tudo está corrigido.

## Últimos pedidos da dona — prioridade

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
