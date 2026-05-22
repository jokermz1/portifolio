# Portfólio MVC — PHP + MySQL

Aplicação de portfólio pessoal desenvolvida em PHP puro com arquitetura MVC (sem framework), MySQL e Bootstrap. Inclui painel de administração completo.

## Requisitos

| Componente | Versão mínima |
|---|---|
| PHP | 7.4+ |
| MySQL | 5.7+ |
| Apache | 2.4+ (com `mod_rewrite` activo) |
| XAMPP | 7.4+ (ou WAMP / Laragon) |

## Funcionalidades

- **Portfólio** — Gestão de projectos com slug, imagem e URL externo
- **Blog** — Posts com rascunhos, publicação e comentários moderados
- **Serviços** — Lista de serviços com ícones e ordenação
- **Equipa** — Membros com foto e redes sociais
- **FAQs** — Perguntas frequentes ordenáveis
- **Currículo** — Educação e experiência profissional
- **Contacto** — Formulário que guarda mensagens na base de dados
- **Comentários** — Sistema de moderação (pendente / aprovado / rejeitado)
- **Utilizadores** — Registo público com perfil editável
- **Painel Admin** — CRUD completo para todos os conteúdos e definições do site

---

## Instalação (XAMPP)

### 1. Clonar / copiar o projecto

```bash
# via Git
git clone <url-do-repositorio> C:\xampp\htdocs\portifolio

# ou copie manualmente a pasta para:
C:\xampp\htdocs\portifolio
```

### 2. Activar mod_rewrite no Apache

1. Abra o **XAMPP Control Panel** e clique em **Config** > `httpd.conf`
2. Localize e descomente a linha (retire o `#`):
   ```
   LoadModule rewrite_module modules/mod_rewrite.so
   ```
3. Localize o bloco `<Directory "C:/xampp/htdocs">` e altere `AllowOverride None` para:
   ```
   AllowOverride All
   ```
4. Guarde e reinicie o Apache.

### 3. Criar o utilizador e a base de dados MySQL

Abra o **phpMyAdmin** (`http://localhost/phpmyadmin`) ou o terminal MySQL e execute:

```sql
-- Cria o utilizador dedicado (opcional — pode usar root em desenvolvimento)
CREATE USER 'portfolio_db'@'localhost' IDENTIFIED BY 'K9x#mP2$vL7@nQ4';

-- Cria a base de dados
CREATE DATABASE portfolio_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Concede permissões
GRANT ALL PRIVILEGES ON portfolio_db.* TO 'portfolio_db'@'localhost';
FLUSH PRIVILEGES;
```

> **Desenvolvimento local com root:** pode simplificar e usar `root` sem senha (padrão XAMPP) — veja o passo seguinte.

### 4. Configurar a base de dados

Edite o ficheiro [`config/database.php`](config/database.php):

```php
define('DB_HOST',    'localhost');
define('DB_NAME',    'portfolio_db');
define('DB_USER',    'portfolio_db');    // ou 'root' em dev
define('DB_PASS',    'K9x#mP2$vL7@nQ4'); // ou '' se usar root sem senha
define('DB_CHARSET', 'utf8mb4');
```

### 5. Configurar a aplicação

Edite o ficheiro [`config/config.php`](config/config.php):

```php
define('BASE_URL', 'http://localhost/portifolio/public');
define('APP_NAME', 'Portfólio');
```

> Altere `BASE_URL` caso use um domínio ou subpasta diferente.

### 6. Importar o schema da base de dados

#### Opção A — Via phpMyAdmin (recomendado)

1. Aceda a `http://localhost/phpmyadmin`
2. Seleccione a base de dados `portfolio_db`
3. Clique em **Importar** e importe os ficheiros na ordem:
   1. `database/schema.sql` — tabelas principais + seeds
   2. `database/add_faqs_team.sql` — tabelas FAQs e Equipa
   3. `database/add_resume.sql` — tabela Currículo

#### Opção B — Via linha de comandos

```bash
mysql -u portfolio_db -p portfolio_db < database/schema.sql
mysql -u portfolio_db -p portfolio_db < database/add_faqs_team.sql
mysql -u portfolio_db -p portfolio_db < database/add_resume.sql
```

#### Opção C — Script de setup no browser

Aceda a `http://localhost/portifolio/database/setup.php`, preencha o email e a senha de admin e clique em **Gerar Hash**. Copie o resultado gerado para `config/config.php`:

```php
define('ADMIN_EMAIL',         'seu@email.com');
define('ADMIN_PASSWORD_HASH', '$2y$12$...');
```

> **Importante:** apague ou mova `database/setup.php` após o setup para evitar acesso não autorizado.

### 7. Definir credenciais do admin

Se não usou o script de setup, gere o hash manualmente no terminal PHP:

```bash
php -r "echo password_hash('suasenha', PASSWORD_BCRYPT, ['cost'=>12]);"
```

Cole o resultado em [`config/config.php`](config/config.php):

```php
define('ADMIN_EMAIL',         'seu@email.com');
define('ADMIN_PASSWORD_HASH', '$2y$12$hash_gerado_aqui');
```

### 8. Criar a pasta de uploads

**Windows (XAMPP):**
```
mkdir C:\xampp\htdocs\portifolio\public\uploads
```

**Linux / Mac:**
```bash
mkdir -p /var/www/html/portifolio/public/uploads
chmod 755 /var/www/html/portifolio/public/uploads
```

---

## Acesso à aplicação

| URL | Descrição |
|---|---|
| `http://localhost/portifolio` | Site público |
| `http://localhost/portifolio/public/admin` | Painel de administração |
| `http://localhost/portifolio/public/login` | Login de utilizador |
| `http://localhost/portifolio/public/register` | Registo de utilizador |

---

## Estrutura do projecto

```
portifolio/
├── app/
│   ├── controllers/        # Controllers públicos e admin
│   ├── core/               # Router, Controller base, Model base, View
│   ├── middleware/         # Auth e Admin middleware
│   ├── models/             # Modelos (PDO)
│   └── views/              # Templates PHP
├── config/
│   ├── config.php          # URL base, credenciais admin, sessão
│   └── database.php        # Credenciais da base de dados
├── database/
│   ├── schema.sql          # Schema principal + seeds
│   ├── add_faqs_team.sql   # Migração FAQs + Equipa
│   ├── add_resume.sql      # Migração Currículo
│   └── setup.php           # Script de setup via browser
├── public/                 # Web root (entry point)
│   ├── index.php           # Front controller
│   └── uploads/            # Ficheiros carregados (criar manualmente)
├── routes.php              # Definição de todas as rotas
└── .htaccess               # Redireciona tudo para public/
```

---

## Resolução de problemas

| Problema | Solução |
|---|---|
| Página em branco / 500 | Verifique os logs em `C:\xampp\apache\logs\error.log` |
| `mod_rewrite` não funciona | Confirme que `AllowOverride All` está activo no `httpd.conf` |
| Erro de ligação à BD | Verifique `config/database.php` — utilizador, senha e nome da BD |
| Imagens não carregam | Confirme que `public/uploads/` existe e tem permissões de escrita |
| Acesso negado ao admin | Confirme o hash em `config/config.php` e use o email correcto |

---

## Licença

O template visual é baseado em **TemplatesJungle** (Bootstrap, uso gratuito pessoal e comercial com crédito no rodapé). O código da aplicação MVC é de autoria própria.
