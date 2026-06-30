-- ------------------------------------------------------------
-- Ordenação manual das publicações (projetos)
-- sort_order = 0 -> automático (por data); >= 1 -> posição fixa
-- ------------------------------------------------------------
ALTER TABLE projects ADD COLUMN sort_order INT NOT NULL DEFAULT 0 AFTER is_published;
