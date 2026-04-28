-- Criação do banco de dados
create database fatec;

create TABLE aluno(
	ra varchar(15) PRIMARY KEY,
	nome varchar(50) not null,
	cpf varchar(15)
);
-- create table curso (
-- 	codcurso int primary key auto_increment,
-- 	nome varchar(40) not null
-- );
-- create table professor(
-- 	rp int primary key auto_increment,
-- 	nome varchar (50) not null
-- );
-- create table disciplina(
-- 	coddisc int primary key auto_increment,
-- 	nome varchar(50) not null
-- );

-- alter table disciplina add column codprof int;
-- alter table disciplina add foreign key (codprof)
-- 	references professor(rp);
-- alter table disciplina add column codcurso int;
-- alter table disciplina add foreign key (codcurso)
-- 	references curso(codcurso);
	
-- create table turma(
-- 	codturma int primary key auto_increment,
-- 	nome varchar(30) null,
-- 	coddisc int,
-- 	foreign key(coddisc) references disciplina(coddisc)
-- );
-- create table matricula(
-- 	codmatricula int primary key auto_increment,
-- 	codaluno varchar(15),
-- 	codturma int,
-- 	foreign key(codaluno) references aluno(ra),
-- 	foreign key(codturma) references turma(codturma)
-- );

-- insert into aluno (ra, nome, cpf) values
-- 	('A100','Lucas Andrade','123.456.789-00'),
-- 	('A101','Fernanda Costa','234.567.890-11'),
-- 	('A102','Rafael Martins','345.678.901-22'),
-- 	('A103','Juliana Alves','456.789.012-33'),
-- 	('A104','Bruno Rocha','567.890.123-44');
-- 	insert into curso (nome) values
-- 	('Sistemas de Informação'),
-- 	('Engenharia de Software'),
-- 	('Ciência da Computação'),
-- 	('Análise e Desenvolvimento de Sistemas'),
-- 	('Redes de Computadores');insert into curso (nome) values
-- 	('Sistemas de Informação'),
-- 	('Engenharia de Software'),
-- 	('Ciência da Computação'),
-- 	('Análise e Desenvolvimento de Sistemas'),
-- 	('Redes de Computadores');
-- 	insert into professor (nome) values
-- 	('Carlos Eduardo'),
-- 	('Patricia Gomes'),
-- 	('Renato Silva'),
-- 	('Camila Ferreira'),
-- 	('Eduardo Nunes');
-- 	insert into disciplina (nome, codprof, codcurso) values
-- 	('Algoritmos',1,1),
-- 	('Banco de Dados',2,5),
-- 	('Estrutura de Dados',3,3),
-- 	('Engenharia de Software',4,2),
-- 	('Redes',5,5);
-- 	insert into turma (nome, coddisc) values
-- 	('Turma 1A',1),
-- 	('Turma 1B',2),
-- 	('Turma 2A',3),
-- 	('Turma 2B',4),
-- 	('Turma 3A',5);
-- 	insert into matricula (codaluno, codturma) values
-- 	('A100',1),
-- 	('A101',2),
-- 	('A102',3),
-- 	('A103',4),
-- 	('A104',5);

--Acima o que eu criei
-----------------------------------------------------------------------------
--Abaixo o que o phpMyAdmin gerou para mim, depois de exportar o banco de dados

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Abr-2026 às 01:49
-- Versão do servidor: 10.4.32-MariaDB
-- versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `fatec`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `ra` varchar(15) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`ra`, `nome`, `cpf`) VALUES
('A100', 'Lucas Andrade', '123.456.789-00'),
('A101', 'Fernanda Costa', '234.567.890-11'),
('A102', 'Rafael Martins', '345.678.901-22'),
('A103', 'Juliana Alves', '456.789.012-33'),
('A104', 'Bruno Rocha', '567.890.123-44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `codcurso` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`codcurso`, `nome`) VALUES
(1, 'Sistemas de Informação'),
(2, 'Engenharia de Software'),
(3, 'Ciência da Computação'),
(4, 'Análise e Desenvolvimento de Sistemas'),
(5, 'Redes de Computadores'),
(6, 'Sistemas de Informação'),
(7, 'Engenharia de Software'),
(8, 'Ciência da Computação'),
(9, 'Análise e Desenvolvimento de Sistemas'),
(10, 'Redes de Computadores');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina`
--

CREATE TABLE `disciplina` (
  `coddisc` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `codprof` int(11) DEFAULT NULL,
  `codcurso` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `disciplina`
--

INSERT INTO `disciplina` (`coddisc`, `nome`, `codprof`, `codcurso`) VALUES
(1, 'Algoritmos', 1, 1),
(2, 'Banco de Dados', 2, 5),
(3, 'Estrutura de Dados', 3, 3),
(4, 'Engenharia de Software', 4, 2),
(5, 'Redes', 5, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `matricula`
--

CREATE TABLE `matricula` (
  `codmatricula` int(11) NOT NULL,
  `codaluno` varchar(15) DEFAULT NULL,
  `codturma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `matricula`
--

INSERT INTO `matricula` (`codmatricula`, `codaluno`, `codturma`) VALUES
(1, 'A100', 1),
(2, 'A101', 2),
(3, 'A102', 3),
(4, 'A103', 4),
(5, 'A104', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

CREATE TABLE `professor` (
  `rp` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`rp`, `nome`) VALUES
(1, 'Carlos Eduardo'),
(2, 'Patricia Gomes'),
(3, 'Renato Silva'),
(4, 'Camila Ferreira'),
(5, 'Eduardo Nunes');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `codturma` int(11) NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `coddisc` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`codturma`, `nome`, `coddisc`) VALUES
(1, 'Turma 1A', 1),
(2, 'Turma 1B', 2),
(3, 'Turma 2A', 3),
(4, 'Turma 2B', 4),
(5, 'Turma 3A', 5);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`ra`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`codcurso`);

--
-- Índices para tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD PRIMARY KEY (`coddisc`),
  ADD KEY `codprof` (`codprof`),
  ADD KEY `codcurso` (`codcurso`);

--
-- Índices para tabela `matricula`
--
ALTER TABLE `matricula`
  ADD PRIMARY KEY (`codmatricula`),
  ADD KEY `codaluno` (`codaluno`),
  ADD KEY `codturma` (`codturma`);

--
-- Índices para tabela `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`rp`);

--
-- Índices para tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`codturma`),
  ADD KEY `coddisc` (`coddisc`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `codcurso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `disciplina`
--
ALTER TABLE `disciplina`
  MODIFY `coddisc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `matricula`
--
ALTER TABLE `matricula`
  MODIFY `codmatricula` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `professor`
--
ALTER TABLE `professor`
  MODIFY `rp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `codturma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `disciplina`
--
ALTER TABLE `disciplina`
  ADD CONSTRAINT `disciplina_ibfk_1` FOREIGN KEY (`codprof`) REFERENCES `professor` (`rp`),
  ADD CONSTRAINT `disciplina_ibfk_2` FOREIGN KEY (`codcurso`) REFERENCES `curso` (`codcurso`);

--
-- Limitadores para a tabela `matricula`
--
ALTER TABLE `matricula`
  ADD CONSTRAINT `matricula_ibfk_1` FOREIGN KEY (`codaluno`) REFERENCES `aluno` (`ra`),
  ADD CONSTRAINT `matricula_ibfk_2` FOREIGN KEY (`codturma`) REFERENCES `turma` (`codturma`);

--
-- Limitadores para a tabela `turma`
--
ALTER TABLE `turma`
  ADD CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`coddisc`) REFERENCES `disciplina` (`coddisc`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
