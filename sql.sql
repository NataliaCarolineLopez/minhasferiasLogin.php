CREATE DATABASE usuarios;

USE usuarios;

CREATE TABLE login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL
);

INSERT INTO usuarios.login(email, senha)
VALUES
('nataliacaroline@gmail.com', '12345')