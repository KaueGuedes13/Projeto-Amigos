# Cadastro de Amigos — CRUD + Login (PHP + MySQL)

Projeto da disciplina **Programação WEB II**

## Funcionalidades

- Cadastro e login de usuários (senha protegida com `password_hash`/`password_verify`)
- Sessões PHP para controle de acesso
- CRUD completo de amigos:
  - **Create**: cadastrar novo amigo
  - **Read**: listar amigos do usuário logado
  - **Update**: editar dados de um amigo
  - **Delete**: excluir amigo (com confirmação)

## Tecnologias

- PHP (PDO para acesso ao banco)
- MySQL
- HTML5 / CSS3

## Como usar

1. Suba o `sql/schema.sql` no seu MySQL (cria o banco `cadastro_amigos`).
2. Ajuste as credenciais em `config/db.php`.
3. Coloque a pasta em um servidor com PHP (XAMPP, Laragon, etc.).
4. Acesse `registrar.php` para criar uma conta e depois `login.php`.

## Estrutura

```
config/db.php        -> conexão PDO
includes/auth.php     -> controle de sessão/login
login.php             -> tela de login
registrar.php         -> criação de conta
logout.php            -> encerra sessão
amigos/listar.php     -> Read
amigos/criar.php      -> Create
amigos/editar.php     -> Update
amigos/excluir.php    -> Delete
css/style.css         -> estilo
sql/schema.sql        -> banco de dados
```
