# Novas maquetes — L’Aiguille des Volcans

Esta entrega foi refeita a partir dos sete prints em output/design, dos três exemplos em Exemple e dos documentos em Client. Não reutiliza as maquetes nem o briefing da entrega anterior.

## Conteúdo

- 01-brief: briefing, estrutura das páginas, identidade e recursos, como o Exemplo 1.
- 02-wireframes-desktop: sete páginas em wireframe, como o Exemplo 3.
- 03-wireframes-mobile: os mesmos sete wireframes adaptados para celular.
- 04-maquettes-desktop: as sete páginas coloridas, reconstruídas a partir dos prints.
- 05-maquettes-mobile: adaptação das sete páginas para celular, seguindo a ideia do Exemplo 2.

São 29 SVGs: um briefing, 14 wireframes e 14 maquetes. Desktop com 1440 px de largura e mobile com 390 px. Abra index.html para escolher uma página e comparar as versões.

## Importar os SVGs no figma.com

1. Abra um arquivo **Figma Design**.
2. Arraste um SVG da pasta desejada para a área de desenho. Também pode copiar o SVG aberto em um editor de texto e tentar colar seu conteúdo no canvas.
3. Importe primeiro as páginas de 04-maquettes-desktop se quiser começar pelos prints.
4. Use as camadas para selecionar e alterar os elementos. Fotos são imagens; superfícies e ícones são elementos separados.

Os SVGs não contêm a página inteira achatada em uma imagem. Fotos e logos rasterizados permanecem imagens, como nos arquivos de origem. Na importação direta, o Figma pode transformar textos em vetores: nesse caso, consegue mover, redimensionar e recolorir as letras, mas não trocar as palavras como em uma caixa de texto.

## Importar com textos editáveis

O importador local cria caixas de texto, fotos e formas nativas. Ele não usa IA nem acessa a rede.

1. No aplicativo Figma desktop, abra um arquivo Design.
2. Acesse Plugins → Development → Import plugin from manifest.
3. Escolha importador-editavel/manifest.json.
4. Execute o plugin e escolha importador-editavel/maquettes.json.
5. Selecione desktop, mobile, wireframes, briefing ou tudo e clique em Importar.

O plugin usa Times New Roman e Arial para aproximar a aparência dos prints. Se a fonte não estiver disponível, tenta Libre Baskerville ou Inter e informa a substituição. A posição ou a quebra de linha pode variar se houver substituição de fontes. O importador passou por verificação de sintaxe e revisão local, mas **não foi executado dentro do Figma** nesta entrega. Ele não cria Auto Layout, componentes reutilizáveis ou um protótipo navegável automaticamente. Os SVGs podem ser importados sem esse plugin.

## Escolhas realizadas

- A composição desktop segue os prints; o mobile é uma adaptação, pois não foi fornecido um print mobile.
- A barra preta de depuração foi removida. Os textos públicos que ela encobria foram recuperados dos textos do cliente e dos trechos correspondentes do projeto.
- Conforme sua escolha, Contact usa a imagem do mapa que aparece no material do cliente.
- O upload usa rótulos em francês, em vez dos rótulos portugueses gerados pelo navegador no print.
- Os preços e contagens seguem os prints. No dashboard, o nome encoberto da terceira demanda está como “Client”; o status “Processing” é uma proposta para preencher a área encoberta.
- O PDF menciona “Broderie Minute” em 15 minutos, mas essa prestação não aparece no print: foi registrada no briefing como conteúdo a confirmar, sem inserir uma seção adicional na página.
- A tipografia com empattement foi aproximada com Times New Roman para reproduzir as proporções dos prints; o código do site declara Georgia com alternativas. Cores e ordem dos conteúdos seguem os prints.

## Verificação

Todos os SVGs foram analisados como XML e renderizados localmente. As 14 maquetes tiveram suas medidas e textos verificados; as imagens renderizadas foram inspecionadas para identificar cortes e sobreposições. As telas são maquetes, portanto formulários e botões não enviam informações. O site do projeto não foi alterado.
