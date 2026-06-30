-- ============================================================
-- Adiciona colunas de anexo à tabela resume_items
-- ============================================================

ALTER TABLE resume_items
  ADD COLUMN attachment      VARCHAR(255) DEFAULT NULL AFTER description,
  ADD COLUMN attachment_name VARCHAR(255) DEFAULT NULL AFTER attachment;
