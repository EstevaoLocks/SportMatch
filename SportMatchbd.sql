-- 1. CRIA O BANCO DE DADOS SE NÃO EXISTIR
CREATE DATABASE IF NOT EXISTS `bd_reservaquadras` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bd_reservaquadras`;

-- 2. CRIA A TABELA INSTITUIÇÃO
DROP TABLE IF EXISTS `instituicao`;
CREATE TABLE `instituicao` (
  `cod_instituicao` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `nome` varchar(55) NOT NULL,
  `email` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cep` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `numero` int(11) NOT NULL,
  `rua` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cod_instituicao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 3. CRIA A TABELA MODALIDADE
DROP TABLE IF EXISTS `modalidade`;
CREATE TABLE `modalidade` (
  `cod_modalidade` int(11) NOT NULL AUTO_INCREMENT,
  `nome_mod` varchar(50) NOT NULL,
  `descricao_mod` varchar(255) NOT NULL,
  PRIMARY KEY (`cod_modalidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- INSERE DADOS BÁSICOS DE MODALIDADE
INSERT INTO `modalidade` (`cod_modalidade`, `nome_mod`, `descricao_mod`) VALUES
(1, 'Futebol de Salão', 'Jogo de futebol em quadra coberta'),
(2, 'Tênis de Quadra', 'Jogo com raquetes e bola'),
(3, 'Basquete', 'Jogo com bola e cestas'),
(4, 'Vôlei', 'Jogo com bola e rede');

-- 4. CRIA A TABELA QUADRA
DROP TABLE IF EXISTS `quadra`;
CREATE TABLE `quadra` (
  `cod_quadra` int(11) NOT NULL AUTO_INCREMENT,
  `nome_quadra` varchar(100) NOT NULL,
  `arquibancada` tinyint(1) NOT NULL,
  `cobertura` tinyint(1) NOT NULL,
  `tamanho` varchar(20) NOT NULL,
  `composicao` varchar(255) NOT NULL,
  `cep` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `numero` int(11) NOT NULL,
  `valor_hora` decimal(8,2) NOT NULL,
  `cod_instituicao` int(11) DEFAULT NULL,
  PRIMARY KEY (`cod_quadra`),
  KEY `cod_instituicao` (`cod_instituicao`),
  CONSTRAINT `quadra_ibfk_1` FOREIGN KEY (`cod_instituicao`) REFERENCES `instituicao` (`cod_instituicao`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 5. CRIA A TABELA QUADRA_MOD
DROP TABLE IF EXISTS `quadra_mod`;
CREATE TABLE `quadra_mod` (
  `cod_quadra` int(11) NOT NULL,
  `cod_modalidade` int(11) NOT NULL,
  PRIMARY KEY (`cod_quadra`,`cod_modalidade`),
  KEY `cod_modalidade` (`cod_modalidade`),
  CONSTRAINT `quadra_mod_ibfk_1` FOREIGN KEY (`cod_quadra`) REFERENCES `quadra` (`cod_quadra`),
  CONSTRAINT `quadra_mod_ibfk_2` FOREIGN KEY (`cod_modalidade`) REFERENCES `modalidade` (`cod_modalidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 6. CRIA A TABELA USUARIO
DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `cod_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `nome` varchar(55) NOT NULL,
  `rg` varchar(20) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(20) NOT NULL,
  `datanasc` date NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cep` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `numero` int(11) NOT NULL,
  PRIMARY KEY (`cod_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- 7. CRIA A TABELA RESERVA (JÁ ATUALIZADA COM STATUS)
DROP TABLE IF EXISTS `reserva`;
CREATE TABLE `reserva` (
  `cod_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `duracao` decimal(8,2) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data_reserva` date NOT NULL,
  `horario_reserva` datetime NOT NULL,
  `cod_quadra` int(11) DEFAULT NULL,
  `cod_usuario` int(11) DEFAULT NULL,
  `status` VARCHAR(20) DEFAULT 'Pendente', 
  `motivo_cancelamento` VARCHAR(255) NULL,
  PRIMARY KEY (`cod_reserva`),
  KEY `cod_quadra` (`cod_quadra`),
  KEY `cod_usuario` (`cod_usuario`),
  CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`cod_quadra`) REFERENCES `quadra` (`cod_quadra`),
  CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;