-- ------------------------------------------------------------
-- Adiciona o campo "client" (cliente do projeto) à tabela projects
-- ------------------------------------------------------------
ALTER TABLE projects ADD COLUMN client VARCHAR(150) DEFAULT NULL AFTER category;
