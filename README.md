Questão 1 — Exercício Teórico: Questões Abertas de Fixação
a) Explique detalhadamente por que o código PHP original nunca chega ao navegador do cliente quando servido corretamente por um servidor HTTP.
O código PHP nunca chega ao navegador porque é executado no servidor. Quando o navegador faz a requisição, o servidor HTTP passa o arquivo ao interpretador PHP, que executa o código e devolve ao cliente apenas o resultado em HTML/texto. O navegador não possui interpretador PHP. Já com file:// não há servidor: o arquivo é apenas lido localmente, e por isso o código aparece em texto puro

b) Qual é o papel exato do interpretador PHP nesse fluxo e qual é o formato do conteúdo que ele efetivamente entrega como resposta?

Ele lê e executa o código dentro das tags <?php ... ?> lá no servidor e depois apaga o código original da memória.Asssim
no lugar dele, entrega apenas o resultado final em texto puro, que são html ou json.

Questão 2: Métodos de Envio HTTP — GET versus POST na Prática
a) Diferencie tecnicamente a forma de transmissão dos dados entre GET (URL / Query String) e POST (corpo da
requisição HTTP), indicando quando cada um é semanticamente recomendado.

O GET é recomendado quando os dados pode ser visivel, ou seja um pesquisa ou busca de algo simples,envia também os dados na URL (query string, ?chave=valor), visíveis, ficam no histórico e podem ser favoritados.
o Post é resomendado quando é envio de dados e prescisa ser restrito, por explo um cadastro em algum site ou ate mesmo validação dae uma conta ao colocar senha e nome,e nvia os dados no corpo da requisição HTTP, fora da URL.

b) Desmistifique a afirmação citada: por que o método POST isoladamente NÃO garante o sigilo nem a segurança
dos dados, e que tecnologia é indispensável para proteger o tráfego da rede?

O método POST isoladamente não garante segurança porque, no protocolo HTTP comum, os dados trafegam pela rede em texto puro
(sem proteção), mesmo estando ocultos da barra de endereços.Assim, qualquer pessoa interceptando a conexão consegue ler essas informações facilmente usando softwares simples
de captura de pacotes.Para proteger o tráfego da rede, é indispensável utilizar o protocolo HTTPS (com criptografia TLS), pois ele criptografa todos os dados
enviados, tornando-os ilegíveis durante o transporte.

Questão 3: A Tríade de Tratamento de Dados: Normalização, Validação e Escape de Saída
a) Defina o objetivo de cada uma dessas três etapas no ciclo de processamento do backend PHP.

A normalização organiza e padroniza os dados recebidos, utilizando funções como trim(), que remove espaços desnecessários. A validação verifica se os dados
estão corretos e atendem aos requisitos do sistema, utilizando funções como filter_var(). Já o escape de saída trata os dados  antes de exibi-los no HTML, utilizando htmlspecialchars()
para impedir a execução de códigos  maliciosos.


b) Apresente exemplos práticos de funções nativas do PHP utilizadas em cada uma dessas três etapas (por exemplo, trim, filter_var e htmlspecialchars), explicando a vulnerabilidade específica evitada pelo escape correto
no HTML (XSS).

Na normalização, usamos o trim() para tirar os espaços do começo e do fim do texto. Na validação, usamos o filter_var() para ver se o e-mail está em um formato válido, o mb_strlen() para conferir o tamanho mínimo do nome e o in_array() (com true) para ver se o valor está dentro de uma lista permitida. Na saída, usamos o htmlspecialchars(), que troca caracteres especiais como < e > por entidades HTML antes de mostrar o dado na página.

O escape evita o ataque XSS (Cross-Site Scripting). Sem ele, se alguém digitasse <script>alert("XSS")</script> no campo nome, o navegador executaria esse script como se fosse código da página. Com o htmlspecialchars(), o texto aparece escrito na tela, como texto comum, e não é executado. Eu testei isso no meu projeto e funcionou.

Questão 4: Validação no Navegador (Cliente) versus Validação no Servidor (Backend)
a) Por que essa abordagem representa uma falha crítica de arquitetura e segurança na aplicação web?

Essa abordagem representa uma falha de segurança porque o navegador é um ambiente não confiável, podendo ser manipulado pelo usuário.
Por isso, as validações feitas apenas no cliente não garantem que os dados recebidos pelo servidor sejam corretos ou seguros. 
É necessário validar novamente as informações no backend, utilizando PHP, antes de armazená-las.


b) Cite pelo menos dois cenários práticos em que as validações do cliente são completamente ignoradas e
descreva qual deve ser o papel real da validação no cliente versus a validação no servidor.

As validações do cliente podem ser ignoradas quando o usuário desativa o JavaScript ou envia
requisições POST diretamente por ferramentas como Postman e cURL, sem utilizar o formulário. 
Também é possível alterar os atributos HTML pelo DevTools.
A validação no cliente serve para melhorar a experiência do usuário, apresentando erros imediatamente. 
Já a validação no servidor é responsável por garantir a segurança, integridade e consistência dos dados, sendo obrigatória mesmo quando
já existe validação no navegador.

Questão 5: Manipulação Segura de Superglobais e Entradas Complexas 
a)	Explique a função do operador de coalescência nula (??) na leitura de superglobais (ex: $_POST['nome'] ?? '') e qual erro ou aviso ele evita em relação a chaves não enviadas. 

O operador de coalescência nula (??) permite definir um valor padrão caso uma chave não exista ou tenha valor nulo. Ao utilizar $_POST['nome'] ?? '',
o PHP utiliza o valor recebido ou uma string vazia caso o campo não tenha sido enviado, evitando o aviso Undefined array key.

b)	Como o HTML e o PHP trabalham em conjunto para permitir a seleção múltipla de itens em um formulário (por exemplo, oficinas de interesse com name="oficinas[]")? 

Como o backend deve validar se o dado recebido é realmente uma lista e se seus valores pertencem a um conjunto permitido? 
No HTML, utilizamos o sufixo [] no atributo name, como em name="oficinas[]", para indicar que vários valores podem ser enviados. Assim, 
o PHP recebe essas informações organizadas em um array. No backend, devemos utilizar is_array() para verificar se o dado recebido é uma lista, foreach() para percorrer 
seus elementos e in_array($item, $permitidos, true) para verificar se cada valor pertence a uma lista de opções permitidas (whitelist), rejeitando valores inválidos.
