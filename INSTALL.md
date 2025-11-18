# MenuExpress - Guia de Instalação

## 🚀 Instalação Rápida

### 1. Pré-requisitos
- XAMPP (Apache + MySQL)
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Navegador web moderno

### 2. Configuração do Ambiente

1. **Instale o XAMPP**
   - Download: https://www.apachefriends.org/pt_br/index.html
   - Instale e inicie o Apache e MySQL

2. **Clone o repositório**
   ```bash
   git clone https://github.com/Igor-dev-backend/Projeto_Programacao_Web.git
   cd menuexpress
   ```

3. **Configure o banco de dados**
   - Acesse: http://localhost/phpmyadmin
   - Crie um banco chamado: `menuexpress`
   - Execute o arquivo `database.sql` no phpMyAdmin

4. **Configure as credenciais**
   - Edite o arquivo `config.php`
   - Ajuste as credenciais do MySQL se necessário

### 3. Acesso ao Sistema

- **Site**: http://localhost/menuexpress/
- **Admin**: http://localhost/menuexpress/admin/
  - Usuário: `admin`
  - Senha: `admin123`

### 4. Primeiro Uso

1. **Cadastre um cliente** através do site
2. **Faça login como admin** para gerenciar o cardápio
3. **Adicione pratos** no painel administrativo

## 🔧 Configuração Avançada

### Personalização
- Edite `assets/css/style.css` para personalizar o visual
- Modifique `config.php` para configurações do banco
- Ajuste as credenciais padrão em `admin/login.php`

### Segurança
- Altere as senhas padrão em produção
- Configure HTTPS em ambiente de produção
- Faça backup regular do banco de dados

## 📞 Suporte

Para dúvidas ou problemas, consulte o README.md principal.
