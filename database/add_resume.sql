-- ============================================================
-- Resume items: educação e experiência profissional
-- ============================================================

CREATE TABLE IF NOT EXISTS resume_items (
  id          INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  type        ENUM('education','experience') NOT NULL,
  title       VARCHAR(200)  NOT NULL,
  period      VARCHAR(100)  DEFAULT NULL,
  subtitle    VARCHAR(200)  DEFAULT NULL,   -- instituição / empresa
  description TEXT          DEFAULT NULL,
  sort_order  SMALLINT      NOT NULL DEFAULT 0,
  is_active   TINYINT(1)    NOT NULL DEFAULT 1
) ENGINE=InnoDB;

-- Seed: resumo do perfil (chave de settings)
INSERT IGNORE INTO settings (`key`, value) VALUES
  ('resume_summary', 'Desenvolvedor apaixonado por criar experiências digitais únicas, com foco em qualidade, performance e design.');
