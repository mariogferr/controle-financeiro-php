# Controle Financeiro em PHP

Sistema web de controle financeiro desenvolvido com PHP, MySQL, HTML, CSS e JavaScript.

## Funcionalidades

- Cadastro de usuários
- Login e logout
- Sessão de usuário
- Cadastro de receitas e despesas
- Edição e exclusão de transações
- Cálculo automático de saldo
- Resumo com total de receitas e despesas
- Filtro por mês
- Gráfico de receitas vs despesas

## Tecnologias utilizadas

- PHP
- MySQL
- HTML
- CSS
- JavaScript
- Chart.js

## Estrutura do projeto

- `controllers/` → lógica da aplicação
- `models/` → acesso aos dados
- `views/` → interface do sistema
- `config/` → conexão com banco
- `routes/` → rotas da aplicação
- `assets/` → arquivos estáticos

## Como executar o projeto

1. Clone este repositório
2. Coloque a pasta dentro do `htdocs` do XAMPP
3. Inicie Apache e MySQL no XAMPP
4. Crie o banco de dados `financeiro_db`
5. Crie as tabelas necessárias no phpMyAdmin
6. Ajuste o arquivo `config/database.php` conforme sua configuração local
7. Acesse no navegador:

```bash
http://localhost/financeiro/

## Banco de dados

Para criar as tabelas, execute o arquivo:

database/schema.sql