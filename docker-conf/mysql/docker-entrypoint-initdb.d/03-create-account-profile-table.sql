CREATE TABLE IF NOT EXISTS account_profile (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_id INT NOT NULL,
    username VARCHAR(255),
    bio TEXT,
    image VARCHAR(255),
    FOREIGN KEY (account_id) REFERENCES account(id)
);