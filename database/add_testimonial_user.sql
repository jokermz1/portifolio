-- ------------------------------------------------------------
-- Associa cada avaliação à conta do utilizador (para mostrar a foto de perfil)
-- ------------------------------------------------------------
ALTER TABLE testimonials ADD COLUMN user_id INT UNSIGNED DEFAULT NULL AFTER id;
