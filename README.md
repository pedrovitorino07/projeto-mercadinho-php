# Projeto de Mercadinho de Bairro

Este é um projeto simples de um sistema de gerenciamento para um mercadinho de bairro, desenvolvido com **PHP**, **HTML**, **CSS**, **Bootstrap** e um banco de dados **MySQL**. O sistema permite gerenciar clientes, funcionários e vendas, além de exibir produtos disponíveis.

## Funcionalidades

- **Cadastro de Clientes**: Sistema para adicionar, editar e remover clientes.
- **Cadastro de Funcionários**: Sistema para gerenciar informações dos funcionários.
- **Cadastro e Gerenciamento de Produtos**: Adição, edição e remoção de produtos no estoque.
- **Registro de Vendas**: Funcionalidade para registrar vendas realizadas e associar aos clientes.
- **Interface Simples e Responsiva**: Usando Bootstrap para uma interface amigável e acessível.

## Tecnologias Utilizadas

- **PHP**: Linguagem de programação para o backend.
- **HTML/CSS**: Estrutura e estilo das páginas.
- **Bootstrap**: Framework CSS para estilização e responsividade.
- **MySQL**: Banco de dados relacional para armazenar informações de clientes, funcionários e vendas.

## Estrutura do Projeto

- **cadastro_funcionario.php**: Página para cadastro de um novo funcionário, adicionando nome, email e senha. O funcionário é adicionado ao banco de dados para poder fazer login.
- **create.php**: Página para cadastro de um cliente, adicionando nome, email e idade, armazenando os dados no banco de dados.
- **create_pedido.php**: Página onde o cliente pode adicionar um pedido, utilizando seu `cliente_id` e o valor da compra, que pode ser verificado posteriormente.
- **delete.php**: Exclui o cadastro de um cliente, caso ele não seja mais um comprador ou tenha sido banido.
- **delete_pedido.php**: Exclui um pedido específico.
- **index.php**: Página que exibe uma lista de clientes e algumas informações. Dependendo do nível de acesso (funcionário logado), é possível editar ou excluir informações. Caso contrário, é apenas possível visualizar.
- **index_pedido.php**: Similar ao `index.php`, mas exibe a lista de pedidos. As edições são possíveis apenas para funcionários logados.
- **login.php**: Página de login para funcionários, que garante acesso a funcionalidades restritas e segurança na manipulação de dados.
- **logout.php**: Realiza o logout do funcionário.
- **register.php**: Página para registro de novos funcionários, permitindo adicionar seus dados ao banco de dados para login futuro.
- **update.php**: Página para editar informações dos clientes na tabela do banco de dados.
- **update_pedido.php**: Página para editar informações dos pedidos na tabela do banco de dados.



