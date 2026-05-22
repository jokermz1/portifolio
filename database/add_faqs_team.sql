-- ============================================================
-- Migration: FAQs + Team Members
-- Run once via phpMyAdmin against portfolio_db
-- ============================================================

CREATE TABLE IF NOT EXISTS faqs (
  id         INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  question   VARCHAR(300)  NOT NULL,
  answer     TEXT          NOT NULL,
  sort_order SMALLINT      NOT NULL DEFAULT 0,
  is_active  TINYINT(1)    NOT NULL DEFAULT 1
) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS team_members (
  id               INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  name             VARCHAR(150) NOT NULL,
  role             VARCHAR(150) DEFAULT NULL,
  bio              TEXT         DEFAULT NULL,
  photo            VARCHAR(255) DEFAULT NULL,
  sort_order       SMALLINT     NOT NULL DEFAULT 0,
  is_active        TINYINT(1)   NOT NULL DEFAULT 1,
  social_facebook  VARCHAR(255) DEFAULT NULL,
  social_twitter   VARCHAR(255) DEFAULT NULL,
  social_instagram VARCHAR(255) DEFAULT NULL,
  social_linkedin  VARCHAR(255) DEFAULT NULL,
  social_youtube   VARCHAR(255) DEFAULT NULL
) ENGINE=InnoDB;

-- Sample FAQs
INSERT IGNORE INTO faqs (question, answer, sort_order) VALUES
('How do I get started with a project?',     'Simply reach out through the contact form with a brief description of your project. I will get back to you within 24 hours to schedule a discovery call.',            1),
('What information do I need to provide?',   'The more detail you can share the better — your brand goals, target audience, any existing materials, and your timeline. A mood board is always welcome.',             2),
('Can I request revisions?',                 'Absolutely. Every project includes multiple revision rounds to ensure the final result exceeds your expectations.',                                                     3),
('How are project prices determined?',        'Pricing is based on scope, complexity, and timeline. After our initial call I will send a detailed proposal with a clear breakdown.',                                  4),
('What file formats will I receive?',         'You will receive all source files (AI, PSD, Figma) plus production-ready exports in every format you need — PNG, SVG, PDF, and more.',                               5),
('Do you offer post-delivery support?',       'Yes. All projects include a support period after delivery so you can ask questions and make minor adjustments as you get familiar with the materials.',               6),
('What is your typical turnaround time?',     'Most projects are completed within 2–4 weeks depending on complexity. Rush deliveries can be arranged — just let me know your deadline.',                             7),
('Can I see examples of your previous work?', 'Of course — browse the Portfolio section of this site for a curated selection of projects across branding, web design, and more.',                                   8);
