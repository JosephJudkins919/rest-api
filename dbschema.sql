CREATE DATABASE IF NOT EXISTS quotesdb;

USE quotesdb;

CREATE TABLE IF NOT EXISTS quotes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    quote TEXT NOT NULL,
    author_id INT NOT NULL,
    category_id INT NOT NULL,
    FOREIGN KEY (author_id) REFERENCES authors(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);

CREATE TABLE IF NOT EXISTS authors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    author VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    category VARCHAR(255) NOT NULL
);
