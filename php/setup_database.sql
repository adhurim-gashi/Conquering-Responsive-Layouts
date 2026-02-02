-- Ekzekuto këtë në phpMyAdmin (tab "SQL") për të krijuar bazën dhe tabelën

CREATE DATABASE IF NOT EXISTS my_website;
USE my_website;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    surname VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
