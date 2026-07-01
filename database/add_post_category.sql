-- ------------------------------------------------------------
-- Adiciona categoria aos posts do blog
-- ------------------------------------------------------------
ALTER TABLE posts
  ADD COLUMN category VARCHAR(80) DEFAULT NULL AFTER excerpt;
