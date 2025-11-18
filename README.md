# MenuExpress - Sistema de Cardápio Online

Sistema simples de cardápio online desenvolvido com PHP, MySQL, HTML, CSS e JavaScript.

## 📋 Sobre o Projeto

Este é um sistema de cardápio online para restaurantes, desenvolvido como projeto acadêmico. Permite que clientes visualizem o cardápio, façam cadastro e login no sistema.

## 🚀 Tecnologias Utilizadas

- **PHP** - Linguagem de programação do servidor
- **MySQL** - Banco de dados
- **HTML/CSS** - Interface do usuário
- **JavaScript** - Interatividade
- **XAMPP** - Servidor local (Apache + MySQL)

## 📦 Pré-requisitos

Antes de começar, você precisa ter instalado:

1. **XAMPP** (ou similar: WAMP, MAMP)
   - Baixe em: https://www.apachefriends.org/pt_br/index.html
   - Instale e inicie o Apache e MySQL

## 🛠️ Como Instalar

### Passo 1: Configurar o XAMPP

1. Instale o XAMPP
2. Inicie o **Apache** e o **MySQL** no painel de controle
3. Abra o navegador e acesse: `http://localhost/phpmyadmin`

### Passo 2: Criar o Banco de Dados

1. No phpMyAdmin, clique em "Novo" para criar um banco de dados
2. Nome do banco: `menuexpress`
3. Clique em "Criar"
4. Na aba "SQL", cole e execute o código do arquivo `database.sql`

### Passo 3: Configurar o Projeto

1. Copie a pasta do projeto para: `C:\xampp\htdocs\Projeto_Programacao_Web\`
2. Abra o arquivo `config.php` e verifique as configurações:

```php
$host = 'localhost';        // Servidor do MySQL
$dbname = 'menuexpress';    // Nome do banco de dados
$username = 'root';         // Usuário do MySQL
$password = '';             // Senha do MySQL (vazio por padrão)
```

### Passo 4: Acessar o Sistema

1. Abra o navegador
2. Acesse: `http://localhost/Projeto_Programacao_Web/welcome.php`

## 📁 Estrutura do Projeto

```
Projeto_Programacao_Web/
├── index.php              # Página principal (cardápio)
├── welcome.php            # Página de boas-vindas
├── login.php              # Página de login
├── cadastro.php           # Página de cadastro
├── logout.php             # Logout do sistema
├── perfil.php             # Perfil do usuário
├── menu-publico.php       # Cardápio público (sem login)
├── config.php             # Configurações do banco de dados
├── database.sql           # Script para criar o banco de dados
├── assets/
│   ├── css/
│   │   └── style.css      # Estilos do site
│   └── js/
│       └── script.js      # JavaScript do site
└── admin/
    ├── index.php          # Painel administrativo
    ├── login.php          # Login do admin
    └── clientes.php       # Gerenciar clientes
```

## 👤 Usuários do Sistema

### Cliente (Usuário Normal)

- **Cadastro**: Qualquer pessoa pode se cadastrar
- **Login**: Email e senha
- **Funcionalidades**: Ver cardápio, editar perfil

### Administrador

- **URL**: `http://localhost/Projeto_Programacao_Web/admin/`
- **Usuário padrão**: `admin`
- **Senha padrão**: `admin123`
- **Funcionalidades**: Gerenciar pratos, gerenciar clientes

⚠️ **IMPORTANTE**: Altere a senha do administrador em produção!

## 🎯 Como Usar

### Para Clientes

1. Acesse a página de boas-vindas
2. Clique em "Criar nova conta" para se cadastrar
3. Faça login com seu email e senha
4. Visualize o cardápio completo

### Para Administradores

1. Acesse: `http://localhost/Projeto_Programacao_Web/admin/`
2. Faça login com as credenciais do admin
3. Adicione, edite ou remova pratos do cardápio
4. Gerencie os clientes cadastrados

## 📝 Banco de Dados

O sistema utiliza as seguintes tabelas:

- **pratos** - Armazena os pratos do cardápio
- **usuarios** - Armazena os usuários (clientes e admin)
- **admins** - Armazena os administradores

## 🔧 Solução de Problemas

### Erro de Conexão com o Banco de Dados

- Verifique se o MySQL está rodando no XAMPP
- Confirme se o banco `menuexpress` existe
- Verifique as configurações no arquivo `config.php`

### Página não Carrega

- Verifique se o Apache está rodando no XAMPP
- Confirme se os arquivos estão na pasta correta: `C:\xampp\htdocs\Projeto_Programacao_Web\`
- Tente acessar: `http://localhost/Projeto_Programacao_Web/welcome.php`

### Erro 404 (Página não encontrada)

- Verifique se está usando a URL correta
- Confirme o nome da pasta do projeto
- Verifique se o Apache está rodando

## 📚 Conceitos Aprendidos

Este projeto aborda os seguintes conceitos:

- **Sessões PHP** - Controle de usuários logados
- **Prepared Statements** - Segurança contra SQL Injection
- **Password Hash** - Criptografia de senhas
- **PDO** - Conexão com banco de dados
- **CRUD** - Create, Read, Update, Delete
- **Responsive Design** - Interface adaptável
- **Validação de Formulários** - PHP e JavaScript

## 🎓 Para Estudantes

Este projeto foi desenvolvido para ser simples e didático, ideal para alunos de segundo período. O código contém comentários explicativos para facilitar o aprendizado.

### Dicas de Estudo

1. Leia os comentários no código
2. Entenda o fluxo de navegação entre as páginas
3. Estude como funciona a sessão PHP
4. Analise as queries SQL
5. Teste e modifique o código para aprender

## 📄 Licença

Este projeto é de código aberto e pode ser usado livremente para fins educacionais.

---

**Desenvolvido para fins acadêmicos**
