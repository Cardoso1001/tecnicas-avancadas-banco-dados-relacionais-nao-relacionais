-- ================================================
-- FATEC — Script de criação do banco de dados
-- Execute este script no MySQL/MariaDB antes de usar o sistema
-- ================================================

CREATE DATABASE IF NOT EXISTS fatec
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE fatec;

-- ── PROFESSOR ─────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS professor (
    rp                   INT PRIMARY KEY AUTO_INCREMENT,
    nome                 VARCHAR(50)  NOT NULL,
    data_nasc            DATE         NOT NULL,
    cpf                  VARCHAR(15)  NOT NULL,
    email_pessoal        VARCHAR(50)  NOT NULL,
    email_institucional  VARCHAR(50)  NOT NULL,
    telefone             VARCHAR(15)  NOT NULL,
    endereco             VARCHAR(100) NOT NULL,
    cidade               VARCHAR(30)  NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── CURSO ─────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS curso (
    codcurso      INT PRIMARY KEY AUTO_INCREMENT,
    nome          VARCHAR(40) NOT NULL,
    carga_horaria INT         NOT NULL,           -- horas totais
    modalidade    VARCHAR(20) NOT NULL,           -- Presencial | Semipresencial | EAD
    tipo_curso    VARCHAR(20) NOT NULL            -- Bacharelado | Licenciatura | Tecnólogo
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── DISCIPLINA ────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS disciplina (
    coddisc       INT PRIMARY KEY AUTO_INCREMENT,
    nome          VARCHAR(50) NOT NULL,
    carga_horaria INT         NOT NULL,
    codprof       INT,
    FOREIGN KEY (codprof) REFERENCES professor(rp) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── ITEM DISCIPLINA / CURSO ───────────────────────────────
CREATE TABLE IF NOT EXISTS item_disc_curso (
    coditem  INT PRIMARY KEY AUTO_INCREMENT,
    coddisc  INT,
    codcurso INT,
    FOREIGN KEY (coddisc)  REFERENCES disciplina(coddisc) ON DELETE CASCADE,
    FOREIGN KEY (codcurso) REFERENCES curso(codcurso) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── TURMA ─────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS turma (
    codturma INT PRIMARY KEY AUTO_INCREMENT,
    nome     VARCHAR(30) NOT NULL,
    codcurso INT,
    FOREIGN KEY (codcurso) REFERENCES curso(codcurso) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── ALUNO ─────────────────────────────────────────────────
CREATE TABLE IF NOT EXISTS aluno (
    ra                   INT PRIMARY KEY AUTO_INCREMENT,
    nome                 VARCHAR(50)  NOT NULL,
    cpf                  VARCHAR(15)  NOT NULL,
    email_pessoal        VARCHAR(50)  NOT NULL,
    email_institucional  VARCHAR(50)  NOT NULL,
    telefone             VARCHAR(15)  NOT NULL,
    data_nasc            DATE         NOT NULL,
    endereco             VARCHAR(100) NOT NULL,
    cidade               VARCHAR(30)  NOT NULL,
    codturma             INT,
    FOREIGN KEY (codturma) REFERENCES turma(codturma) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ── DADOS DE EXEMPLO (opcional) ───────────────────────────
INSERT INTO professor (nome,data_nasc,cpf,email_pessoal,email_institucional,telefone,endereco,cidade) VALUES
('Ana Paula Souza','1980-03-15','123.456.789-00','ana@gmail.com','ana@fatec.sp.gov.br','(11) 99111-2222','Rua das Flores, 100','São Paulo'),
('Carlos Mendes','1975-07-22','987.654.321-00','carlos@gmail.com','carlos@fatec.sp.gov.br','(11) 98222-3333','Av. Paulista, 500','São Paulo');

INSERT INTO curso (nome,carga_horaria,modalidade,tipo_curso) VALUES
('Análise e Desenvolvimento de Sistemas',2400,'Presencial','Tecnólogo'),
('Gestão de TI',1600,'Semipresencial','Tecnólogo'),
('Ciências da Computação',3200,'Presencial','Bacharelado');

INSERT INTO disciplina (nome,carga_horaria,codprof) VALUES
('Programação Orientada a Objetos',80,1),
('Banco de Dados',60,2),
('Engenharia de Software',60,1),
('Redes de Computadores',40,NULL);

INSERT INTO turma (nome,codcurso) VALUES
('ADS - 1º Sem 2025',1),
('ADS - 2º Sem 2025',1),
('GTI - 1º Sem 2025',2);

INSERT INTO item_disc_curso (coddisc,codcurso) VALUES (1,1),(2,1),(3,1),(2,3),(4,3);

INSERT INTO aluno (nome,cpf,email_pessoal,email_institucional,telefone,data_nasc,endereco,cidade,codturma) VALUES
('Lucas Oliveira','111.222.333-44','lucas@gmail.com','lucas@fatec.sp.gov.br','(11) 97001-0001','2003-06-10','Rua A, 10','Guarulhos',1),
('Mariana Costa','555.666.777-88','mari@gmail.com','mariana@fatec.sp.gov.br','(11) 97002-0002','2004-01-25','Rua B, 20','São Paulo',1),
('Pedro Nunes','999.888.777-66','pedro@gmail.com','pedro@fatec.sp.gov.br','(11) 97003-0003','2002-11-30','Rua C, 30','Osasco',2);
