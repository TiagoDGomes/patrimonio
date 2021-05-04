CREATE USER 'patrimonio'@'%' IDENTIFIED by 'password123';
GRANT USAGE ON *.* TO 'patrimonio'@'%' REQUIRE NONE WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;
CREATE DATABASE IF NOT EXISTS `patrimonio` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
GRANT ALL PRIVILEGES ON `patrimonio`.* TO 'patrimonio'@'%';

drop table patrimonio.pessoa;
drop table patrimonio.local;
drop table patrimonio.setor;
drop table patrimonio.registro;



CREATE TABLE patrimonio.pessoa (
    id INT PRIMARY KEY AUTO_INCREMENT,
    codigo varchar(15) UNIQUE KEY,
    senha TEXT,
    nome TEXT
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

CREATE TABLE patrimonio.local (    
    id INT PRIMARY KEY AUTO_INCREMENT,
    descricao TEXT
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

INSERT INTO patrimonio.local (
    id, descricao
) VALUES (1, "IFSP Câmpus São João da Boa Vista");


CREATE TABLE patrimonio.setor(    
    id INT PRIMARY KEY AUTO_INCREMENT,
    idlocal INT,
    descricao TEXT
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;




CREATE TABLE patrimonio.registro(
    id INT PRIMARY KEY AUTO_INCREMENT,
    datahora TIMESTAMP NOT NULL,
    numero VARCHAR(25),
    idpessoa INT NOT NULL,
    idsetor INT NOT NULL,
    descricao TEXT,
    foto VARCHAR(100)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

