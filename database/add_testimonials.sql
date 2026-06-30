-- ------------------------------------------------------------
-- Depoimentos / Reviews dos clientes
-- ------------------------------------------------------------
CREATE TABLE IF NOT EXISTS testimonials (
  id           INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name         VARCHAR(150)  NOT NULL,
  location     VARCHAR(150)  DEFAULT NULL,
  role         VARCHAR(150)  DEFAULT NULL,
  rating       TINYINT       NOT NULL DEFAULT 5,
  content      TEXT          NOT NULL,
  avatar       VARCHAR(255)  DEFAULT NULL,
  is_featured  TINYINT(1)    NOT NULL DEFAULT 0,
  status       ENUM('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  ip_address   VARCHAR(45)   DEFAULT NULL,
  created_at   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at   TIMESTAMP     NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;
