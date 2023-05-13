-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 13-Maio-2023 às 23:17
-- Versão do servidor: 8.0.27
-- versão do PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `jobstage`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso_extra`
--

DROP TABLE IF EXISTS `curso_extra`;
CREATE TABLE IF NOT EXISTS `curso_extra` (
  `ID_CURSO` int NOT NULL AUTO_INCREMENT,
  `NOME` varchar(45) DEFAULT NULL,
  `INSTITUICAO` varchar(45) DEFAULT NULL,
  `STATUS` varchar(45) DEFAULT NULL,
  `DURACAO` varchar(45) DEFAULT NULL,
  `NIVEL_TECNICO` varchar(45) DEFAULT NULL,
  `ID_USUARIO` int DEFAULT NULL,
  PRIMARY KEY (`ID_CURSO`),
  KEY `ID_USUARIO_idx` (`ID_USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `ID_EMPRESA` int NOT NULL AUTO_INCREMENT,
  `NOME` varchar(65) DEFAULT NULL,
  `EMAIL` varchar(60) DEFAULT NULL,
  `CNPJ` int DEFAULT NULL,
  `SENHA` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_EMPRESA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa_vaga`
--

DROP TABLE IF EXISTS `empresa_vaga`;
CREATE TABLE IF NOT EXISTS `empresa_vaga` (
  `ID_VAGA` int DEFAULT NULL,
  `ID_EMPRESA` int DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `escolaridade`
--

DROP TABLE IF EXISTS `escolaridade`;
CREATE TABLE IF NOT EXISTS `escolaridade` (
  `ID_ESCOLARIDADE` int NOT NULL AUTO_INCREMENT,
  `CURSO` varchar(45) NOT NULL,
  `INSTITUICAO` varchar(45) NOT NULL,
  `CONTATO` varchar(45) NOT NULL,
  `TURNO` varchar(45) NOT NULL,
  `PREVISAO_FORMATURA` date NOT NULL,
  `PERIODO` int NOT NULL,
  `DURACAO` int NOT NULL,
  `DECLARACAO_MATRICULA` blob NOT NULL,
  `ID_USUARIO` int NOT NULL,
  PRIMARY KEY (`ID_ESCOLARIDADE`),
  KEY `ID_USUSARIO_idx` (`ID_USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `experiencia`
--

DROP TABLE IF EXISTS `experiencia`;
CREATE TABLE IF NOT EXISTS `experiencia` (
  `ID_EXPERIENCIA` int NOT NULL AUTO_INCREMENT,
  `EMPRESA` varchar(45) DEFAULT NULL,
  `CARGO` varchar(45) DEFAULT NULL,
  `INICIO` date DEFAULT NULL,
  `FIM` date DEFAULT NULL,
  `TIPO_CONTRATO` varchar(45) DEFAULT NULL,
  `ATIVIDADES` varchar(300) DEFAULT NULL,
  `ID_USUARIO` int DEFAULT NULL,
  PRIMARY KEY (`ID_EXPERIENCIA`),
  KEY `ID_USUSARIO_idx` (`ID_USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `formacao`
--

DROP TABLE IF EXISTS `formacao`;
CREATE TABLE IF NOT EXISTS `formacao` (
  `ID_FORMACAO` int NOT NULL AUTO_INCREMENT,
  `CURSO` varchar(45) NOT NULL,
  `INSTITUICAO` varchar(45) NOT NULL,
  `NIVEL` varchar(45) NOT NULL,
  `DURACAO` int NOT NULL,
  `STATUS` varchar(45) NOT NULL,
  `ID_USUARIO` int NOT NULL,
  PRIMARY KEY (`ID_FORMACAO`),
  KEY `ID_USUARIO_idx` (`ID_USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `ID_USUARIO` int NOT NULL AUTO_INCREMENT,
  `NOME` varchar(45) NOT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `DATA_NASC` date NOT NULL,
  `SENHA` varchar(50) NOT NULL,
  `ESTADO_CIVIL` varchar(45) NOT NULL,
  `TELEFONE` int NOT NULL,
  `LINKEDIN` varchar(45) DEFAULT NULL,
  `SOBRE` varchar(600) DEFAULT NULL,
  PRIMARY KEY (`ID_USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_vagas`
--

DROP TABLE IF EXISTS `usuario_vagas`;
CREATE TABLE IF NOT EXISTS `usuario_vagas` (
  `ID_USUARIO` int DEFAULT NULL,
  `ID_VAGA` int DEFAULT NULL,
  KEY `ID_USUARIO_idx` (`ID_USUARIO`),
  KEY `ID_VAGA_idx` (`ID_VAGA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vagas`
--

DROP TABLE IF EXISTS `vagas`;
CREATE TABLE IF NOT EXISTS `vagas` (
  `ID_VAGA` int NOT NULL AUTO_INCREMENT,
  `TURNO` varchar(45) DEFAULT NULL,
  `TURNO_DAS` time DEFAULT NULL,
  `TURNO_ATE` time DEFAULT NULL,
  `SALARIO` double DEFAULT NULL,
  `DESCRICAO` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `REQUISITOS` varchar(5000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `CIDADE` varchar(45) DEFAULT NULL,
  `ESTADO` varchar(45) DEFAULT NULL,
  `TIPO_CONTRATO` varchar(45) DEFAULT NULL,
  `ID_EMPRESA` int DEFAULT NULL,
  `ID_USUARIO` int DEFAULT NULL,
  `NOME` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_VAGA`),
  KEY `ID_EMPRESA_idx` (`ID_EMPRESA`),
  KEY `ID_USUARIO_idx` (`ID_USUARIO`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `experiencia`
--
ALTER TABLE `experiencia`
  ADD CONSTRAINT `ID_USUSARIO` FOREIGN KEY (`ID_USUARIO`) REFERENCES `usuario` (`ID_USUARIO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
