-- ============================================================
-- Portfolio MVC — Schema MySQL
-- ============================================================

CREATE DATABASE IF NOT EXISTS portfolio_db
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE portfolio_db;

-- ------------------------------------------------------------
-- Utilizadores públicos
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS users (
  id              INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name            VARCHAR(100)  NOT NULL,
  email           VARCHAR(150)  NOT NULL UNIQUE,
  password_hash   VARCHAR(255)  NOT NULL,
  avatar          VARCHAR(255)  DEFAULT NULL,
  bio             TEXT          DEFAULT NULL,
  is_active       TINYINT(1)    NOT NULL DEFAULT 1,
  email_verified  TINYINT(1)    NOT NULL DEFAULT 0,
  created_at      TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Projetos do portfólio
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS projects (
  id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title        VARCHAR(200)  NOT NULL,
  slug         VARCHAR(220)  NOT NULL UNIQUE,
  description  TEXT          DEFAULT NULL,
  content      LONGTEXT      DEFAULT NULL,
  category     VARCHAR(100)  DEFAULT NULL,
  image        VARCHAR(255)  DEFAULT NULL,
  project_url  VARCHAR(255)  DEFAULT NULL,
  is_featured  TINYINT(1)    NOT NULL DEFAULT 0,
  is_published TINYINT(1)    NOT NULL DEFAULT 1,
  created_at   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Posts do blog
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS posts (
  id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title        VARCHAR(200)  NOT NULL,
  slug         VARCHAR(220)  NOT NULL UNIQUE,
  excerpt      TEXT          DEFAULT NULL,
  category     VARCHAR(80)   DEFAULT NULL,
  content      LONGTEXT      DEFAULT NULL,
  image        VARCHAR(255)  DEFAULT NULL,
  is_published TINYINT(1)    NOT NULL DEFAULT 0,
  published_at TIMESTAMP     NULL DEFAULT NULL,
  created_at   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Serviços
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS services (
  id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  title       VARCHAR(200) NOT NULL,
  description TEXT         DEFAULT NULL,
  icon        VARCHAR(100) DEFAULT NULL,
  sort_order  SMALLINT     NOT NULL DEFAULT 0,
  is_active   TINYINT(1)   NOT NULL DEFAULT 1
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Habilidades / Skills
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS skills (
  id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(100)  NOT NULL,
  level      TINYINT UNSIGNED NOT NULL DEFAULT 0,   -- 0-100 (%)
  category   VARCHAR(100)  DEFAULT 'Geral',
  sort_order SMALLINT      NOT NULL DEFAULT 0
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Comentários (polimórfico: project | post)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS comments (
  id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  user_id      INT UNSIGNED  NOT NULL,
  entity_type  ENUM('project','post') NOT NULL,
  entity_id    INT UNSIGNED  NOT NULL,
  parent_id    INT UNSIGNED  DEFAULT NULL,             -- NULL = raiz; ID = resposta
  type         ENUM('comment','suggestion','critique') NOT NULL DEFAULT 'comment',
  content      TEXT          NOT NULL,
  ip_address   VARCHAR(45)   NOT NULL,                 -- visível apenas no admin
  status       ENUM('pending','approved','rejected')   NOT NULL DEFAULT 'pending',
  is_edited    TINYINT(1)    NOT NULL DEFAULT 0,
  edited_at    TIMESTAMP     NULL DEFAULT NULL,
  published_at TIMESTAMP     NULL DEFAULT NULL,        -- preenchido ao aprovar
  created_at   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_comments_user   FOREIGN KEY (user_id)   REFERENCES users(id)    ON DELETE CASCADE,
  CONSTRAINT fk_comments_parent FOREIGN KEY (parent_id) REFERENCES comments(id) ON DELETE SET NULL,
  INDEX idx_entity (entity_type, entity_id),
  INDEX idx_status (status)
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Mensagens de contacto (não requer login)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS messages (
  id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name       VARCHAR(100) NOT NULL,
  email      VARCHAR(150) NOT NULL,
  subject    VARCHAR(200) DEFAULT NULL,
  content    TEXT         NOT NULL,
  is_read    TINYINT(1)   NOT NULL DEFAULT 0,
  created_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Configurações gerais (chave → valor)
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS settings (
  id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `key`      VARCHAR(100) NOT NULL UNIQUE,
  value      TEXT         DEFAULT NULL,
  updated_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- ------------------------------------------------------------
-- Seeds — configurações iniciais
-- ------------------------------------------------------------
INSERT IGNORE INTO settings (`key`, value) VALUES
  ('site_name',        'Meu Portfólio'),
  ('owner_name',       'Seu Nome'),
  ('owner_title',      'Designer & Desenvolvedor'),
  ('owner_bio',        'Escreva aqui a sua apresentação.'),
  ('owner_email',      'voce@email.com'),
  ('owner_phone',      ''),
  ('owner_address',    ''),
  ('owner_photo',      ''),
  ('cv_url',           ''),
  ('social_facebook',  ''),
  ('social_github',    ''),
  ('social_linkedin',  ''),
  ('social_twitter',   ''),
  ('social_instagram', ''),
  ('social_youtube',   ''),
  ('hero_text',        'Criando experiências digitais únicas.'),
  ('years_experience', '5'),
  ('projects_done',    '30'),
  ('clients',          '20'),
  ('awards',           '15');
