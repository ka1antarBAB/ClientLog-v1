CREATE TABLE users (
   id INT AUTO_INCREMENT PRIMARY KEY,
   username VARCHAR(100) NOT NULL,
   phone_number VARCHAR(20) NOT NULL UNIQUE,
   email VARCHAR(100),
   address TEXT,
   source VARCHAR(100),
   category ENUM('A', 'B', 'C') DEFAULT 'C',
   created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE notes (
   id INT AUTO_INCREMENT PRIMARY KEY,
   user_id INT NOT NULL,
   title VARCHAR(100),
   note TEXT NOT NULL,
   contact_date DATETIME DEFAULT CURRENT_TIMESTAMP,
   FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    fullname VARCHAR(100),
    role ENUM('superadmin', 'admin') NOT NULL DEFAULT 'admin',
    allowed_categories TEXT
);
