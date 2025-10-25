# MenuExpress - Cardápio Online

Sistema de cardápio online desenvolvido com PHP, CSS, JavaScript e MySQL para gerenciamento de pratos de restaurante.

## 🚀 Características

- **Interface Responsiva**: Design moderno e adaptável para todos os dispositivos
- **Painel Administrativo**: Gerenciamento completo de pratos (CRUD)
- **Sistema de Autenticação**: Login seguro para administradores
- **Validações JavaScript**: Validação em tempo real dos formulários
- **Banco de Dados MySQL**: Armazenamento seguro dos dados

## 📋 Pré-requisitos

- XAMPP (Apache + MySQL)
- PHP 7.4 ou superior
- MySQL 5.7 ou superior
- Navegador web moderno

## 🛠️ Instalação

### 1. Configurar o Ambiente

1. Instale o XAMPP: https://www.apachefriends.org/pt_br/index.html
2. Inicie o Apache e MySQL no painel de controle do XAMPP
3. Acesse o phpMyAdmin: http://localhost/phpmyadmin

### 2. Criar o Banco de Dados

1. No phpMyAdmin, clique em "Novo"
2. Crie um banco chamado: `menuexpress`
3. Execute o seguinte SQL para criar a tabela:

```sql
CREATE TABLE pratos (
    id INT(11) AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    preco DECIMAL(10,2) NOT NULL,
    imagem VARCHAR(255) DEFAULT NULL
);
```

### 3. Configurar o Projeto

1. Copie a pasta `menuexpress` para `C:\xampp\htdocs\`
2. Acesse: http://localhost/menuexpress/

## 🎯 Como Usar

### Acesso Público
- **URL**: http://localhost/menuexpress/
- Visualize o cardápio completo
- Interface responsiva para todos os dispositivos

### Painel Administrativo
- **URL**: http://localhost/menuexpress/admin/
- **Usuário**: admin
- **Senha**: admin123

#### Funcionalidades do Admin:
- ✅ Adicionar novos pratos
- ✅ Editar pratos existentes
- ✅ Excluir pratos
- ✅ Visualizar lista completa
- ✅ Validação de formulários
- ✅ Upload de imagens (URL)
- ✅ **Gerenciar clientes** (novo!)
- ✅ **Redefinir senhas** (novo!)
- ✅ **Buscar e filtrar clientes** (novo!)
- ✅ **Visualizar detalhes dos clientes** (novo!)

## 📁 Estrutura do Projeto

```
menuexpress/
├── index.php              # Página principal (cardápio público)
├── config.php             # Configurações do banco de dados
├── assets/
│   ├── css/
│   │   └── style.css      # Estilos principais
│   └── js/
│       └── script.js      # JavaScript principal
├── admin/
│   ├── index.php          # Painel administrativo
│   ├── clientes.php       # Gerenciar clientes
│   ├── login.php          # Página de login
│   ├── logout.php         # Logout
│   └── assets/
│       ├── css/
│       │   └── admin.css  # Estilos do admin
│       └── js/
│           └── admin.js   # JavaScript do admin
└── README.md              # Este arquivo
```

## 🎨 Personalização

### Cores e Estilos
Edite o arquivo `assets/css/style.css` para personalizar:
- Cores do tema
- Fontes
- Layout responsivo
- Animações

### Configurações do Banco
Edite o arquivo `config.php` para alterar:
- Credenciais do banco de dados
- Configurações de conexão

## 🔒 Segurança

### Credenciais Padrão
- **Usuário**: admin
- **Senha**: admin123

⚠️ **IMPORTANTE**: Altere as credenciais padrão em produção!

### Recomendações para Produção:
1. Use senhas fortes e únicas
2. Implemente hash de senhas (password_hash)
3. Configure HTTPS
4. Valide e sanitize todas as entradas
5. Use prepared statements (já implementado)

## 🐛 Solução de Problemas

### Erro de Conexão com Banco
- Verifique se o MySQL está rodando no XAMPP
- Confirme as credenciais no `config.php`
- Verifique se o banco `menuexpress` existe

### Página não Carrega
- Verifique se o Apache está rodando
- Confirme se os arquivos estão em `C:\xampp\htdocs\menuexpress\`
- Acesse: http://localhost/menuexpress/

### Problemas de Permissão
- Verifique as permissões da pasta
- No Windows, execute como administrador se necessário

## 📱 Responsividade

O sistema é totalmente responsivo e funciona em:
- 📱 Smartphones
- 📱 Tablets
- 💻 Desktops
- 🖥️ Telas grandes

## 🚀 Próximos Passos

### Melhorias Sugeridas:
- [ ] Upload de imagens locais
- [ ] Categorias de pratos
- [ ] Sistema de pedidos
- [ ] Relatórios de vendas
- [ ] API REST
- [ ] Sistema de usuários múltiplos
- [ ] Backup automático
- [ ] Cache de imagens
- [ ] **Histórico de alterações de senha** (implementado!)
- [ ] **Exportar dados de clientes** (implementado!)

## 📞 Suporte

Para dúvidas ou problemas:
1. Verifique este README
2. Consulte os comentários no código
3. Teste em ambiente local primeiro

## 📄 Licença

Este projeto é de código aberto e pode ser usado livremente para fins educacionais e comerciais.

---

**Desenvolvido por Francisco e Colaboradores**
