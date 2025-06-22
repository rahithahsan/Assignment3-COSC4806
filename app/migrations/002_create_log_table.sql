-- creates log table for good/bad login attempts
CREATE TABLE IF NOT EXISTS log (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  username   VARCHAR(100),
  outcome    ENUM('good','bad') NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);