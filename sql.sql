CREATE USER 'patrimonio'@'%' IDENTIFIED VIA mysql_native_password USING '***';
GRANT USAGE ON *.* TO 'patrimonio'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
CREATE DATABASE IF NOT EXISTS `patrimonio`;GRANT ALL PRIVILEGES ON `patrimonio`.* TO 'patrimonio'@'%';

CREATE TABLE patrimonio.pessoa (
    id INT PRIMARY KEY AUTO_INCREMENT,
    codigo TEXT UNIQUE KEY,
    senha TEXT,
    nome TEXT
);

CREATE TABLE patrimonio.local (    
    id INT PRIMARY KEY AUTO_INCREMENT,
    descricao TEXT
);

INSERT INTO patrimonio.local (
    id, descricao
) VALUES (1, "Geral");


CREATE TABLE patrimonio.setor(    
    id INT PRIMARY KEY AUTO_INCREMENT,
    idlocal INT,
    descricao TEXT
)
INSERT INTO patrimonio.setor (
    id, idlocal, descricao
) VALUES (1, 1, "Geral");


CREATE TABLE patrimonio.registro(
    id INT PRIMARY KEY AUTO_INCREMENT,
    datahora TIMESTAMP NOT NULL,
    patrimonio VARCHAR(25),
    idpessoa INT NOT NULL,
    idsetor INT NOT NULL
)