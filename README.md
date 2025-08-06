# Sistema de Gerenciamento de Tarefas (To-do List)

Este é um sistema de gerenciamento de tarefas desenvolvido em PHP com PostgreSQL, permitindo que usuários criem uma conta, façam login e gerenciem suas tarefas pessoais.

## Funcionalidades

- ✅ Cadastro de usuários
- 🔐 Sistema de login/logout
- 📝 Criação de tarefas
- 📋 Listagem de tarefas
- ✏️ Edição de tarefas (Ainda não implementado)
- 🗑️ Exclusão de tarefas (Ainda não implementado)
- 📊 Status da tarefa (Pendente, Em andamento, Concluída)

## Requisitos

- Extensões PHP:
  - PDO
  - pdo_pgsql
  - pgsql

## Instalação

1. Configure o banco de dados:
   - Crie um banco de dados PostgreSQL chamado `todo_db`
   - Execute o script SQL do arquivo `database.sql` para criar as tabelas necessárias

2. Configure as credenciais do banco de dados:
   - Abra o arquivo `config/database.php`
   - Altere as credenciais de acordo com sua configuração:
     ```php
     private $host = "localhost";
     private $db_name = "todo_db";
     private $username = "seu_usuario";
     private $password = "sua_senha";
     ```

3. Inicie o servidor PHP:
```bash
cd public
php -S localhost:8000
```

4. Acesse o sistema no navegador:
   - Abra http://localhost:8000
