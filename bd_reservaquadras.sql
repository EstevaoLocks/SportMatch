-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Nov-2025 às 04:22
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
-- Banco de dados: `bd_reservaquadras`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `favoritos`
--

CREATE TABLE `favoritos` (
  `cod_quadra` int(11) DEFAULT NULL,
  `cod_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `instituicao`
--

CREATE TABLE `instituicao` (
  `cod_instituicao` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `nome` varchar(55) NOT NULL,
  `email` varchar(20) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cep` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `numero` int(11) NOT NULL,
  `rua` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `instituicao`
--

INSERT INTO `instituicao` (`cod_instituicao`, `username`, `senha`, `nome`, `email`, `telefone`, `cep`, `estado`, `cidade`, `bairro`, `numero`, `rua`) VALUES
(1, 'inst_central', 'senha123', 'Centro Esportivo SP', 'contato@cesp.com.br', '(11) 98765-4321', '01001-000', 'SP', 'São Paulo', 'Centro', 100, 'Rua da Consolação'),
(2, 'esportes_sul', 'esp2024', 'Associação Esportiva', 'contato@asesul.com.b', '(11) 91234-5678', '04321-000', 'SP', 'São Paulo', 'Jardim Miriam', 254, 'Avenida dos Estados'),
(3, 'clube_raposo', 'raposo22', 'Clube Raposo Tavares', 'contato@cluberpt.com', '(11) 99988-7766', '05556-000', 'SP', 'São Paulo', 'Raposo Tavares', 137, 'Rua Professor Artur Ramos'),
(4, 'esporte_jund', 'jund10', 'Jundiaí Esportes', 'contato@jundiaiesp.b', '(11) 99887-1234', '13200-000', 'SP', 'Jundiaí', 'Centro', 55, 'Rua Barão de Jundiaí'),
(5, 'clube_pinheiros', 'pinh432', 'Clube Pinheiros', 'contato@clubepinh.co', '(11) 94567-8910', '05422-000', 'SP', 'São Paulo', 'Pinheiros', 300, 'Rua Ferreira de Araújo'),
(6, 'esportiva_sp', 'esp_sul22', 'Associação Esportiva', 'contato@esp_sul.com.', '(11) 97654-3210', '04776-000', 'SP', 'São Paulo', 'Campo Limpo', 78, 'Avenida Professor Luís Ignácio'),
(7, 'clube_barueri', 'barueri10', 'Clube Barueri', 'contato@clubebarueri', '(11) 98877-5544', '06400-000', 'SP', 'Barueri', 'Jardim Belval', 99, 'Rua Guilherme Álvaro'),
(8, 'esporte_maua', 'maua2023', 'Mauá Esportes', 'contato@mauaesp.com', '(11) 98765-1122', '09370-000', 'SP', 'Mauá', 'Centro', 140, 'Rua Nicolau Filizola'),
(9, 'esportes_osas', 'osas22', 'Esportes Osasco', 'contato@esportesosas', '(11) 97612-3344', '06000-000', 'SP', 'Osasco', 'Centro', 400, 'Avenida dos Autonomistas'),
(10, 'clube_santo', 'santo33', 'Clube Santo André', 'contato@clubesanto.c', '(11) 99345-6677', '09010-000', 'SP', 'Santo André', 'Centro', 88, 'Rua Senador Flaquer');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modalidade`
--

CREATE TABLE `modalidade` (
  `cod_modalidade` int(11) NOT NULL,
  `nome_mod` varchar(50) NOT NULL,
  `descricao_mod` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `modalidade`
--

INSERT INTO `modalidade` (`cod_modalidade`, `nome_mod`, `descricao_mod`) VALUES
(1, 'Futebol de Salão', 'Jogo de futebol em quadra coberta'),
(2, 'Tênis de Quadra', 'Jogo com raquetes e bola'),
(3, 'Basquete', 'Jogo com bola e cestas'),
(4, 'Vôlei', 'Jogo com bola e rede'),
(5, 'Futsal', 'Futebol em quadra pequena'),
(6, 'Handebol', 'Jogo com bola e gol'),
(7, 'Badminton', 'Jogo com raquetes leves'),
(8, 'Futebol Society', 'Futebol em campo menor'),
(9, 'Tênis de Mesa', 'Jogo com raquetes pequenas'),
(10, 'Skate', 'Prática de manobras');

-- --------------------------------------------------------

--
-- Estrutura da tabela `quadra`
--

CREATE TABLE `quadra` (
  `cod_quadra` int(11) NOT NULL,
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
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `quadra`
--

INSERT INTO `quadra` (`cod_quadra`, `nome_quadra`, `arquibancada`, `cobertura`, `tamanho`, `composicao`, `cep`, `estado`, `cidade`, `bairro`, `rua`, `numero`, `valor_hora`, `cod_instituicao`, `imagem`) VALUES
(1, 'Quadra Central 1', 1, 1, '20x40', 'Piso de madeira', '01001-000', 'SP', 'São Paulo', 'Centro', 'Rua da Consolação', 100, 120.00, 1, 'Quadra-de-Futsal-profissional 1.png'),
(2, 'Quadra Sul 2', 0, 1, '18x36', 'Gramado', '04321-000', 'SP', 'São Paulo', 'Jardim Miriam', 'Avenida dos Estados', 254, 90.00, 2, 'quadraTenis.png'),
(3, 'Quadra Raposo 3', 1, 0, '22x44', 'Piso sintético', '05556-000', 'SP', 'São Paulo', 'Raposo Tavares', 'Rua Professor Artur Ramos', 137, 110.00, 3, 'Quadra-de-Futsal-profissional 1.png'),
(4, 'Quadra Jundiaí 1', 0, 1, '20x40', 'Piso polipropileno', '13200-000', 'SP', 'Jundiaí', 'Centro', 'Rua Barão de Jundiaí', 55, 100.00, 4, 'quadra-de-volei4 1.png'),
(5, 'Quadra Pinheiros 2', 1, 1, '19x38', 'Piso laminado', '05422-000', 'SP', 'São Paulo', 'Pinheiros', 'Rua Ferreira de Araújo', 300, 130.00, 5, 'quadraBaquete 1.png'),
(6, 'Quadra Campo Limpo', 0, 0, '18x36', 'Piso sintético', '04776-000', 'SP', 'São Paulo', 'Campo Limpo', 'Avenida Professor Luís Ignácio', 78, 80.00, 6, 'Quadra-de-Futsal-profissional 1.png'),
(7, 'Quadra Barueri 1', 1, 1, '22x44', 'Piso de madeira', '06400-000', 'SP', 'Barueri', 'Jardim Belval', 'Rua Guilherme Álvaro', 99, 115.00, 7, 'quadraBadminton.png'),
(8, 'Quadra Mauá 1', 0, 1, '20x40', 'Piso polipropileno', '09370-000', 'SP', 'Mauá', 'Centro', 'Rua Nicolau Filizola', 140, 95.00, 8, 'Quadra-de-Futsal-profissional 1.png'),
(9, 'Quadra Osasco 2', 1, 0, '18x36', 'Piso sintético', '06000-000', 'SP', 'Osasco', 'Centro', 'Avenida dos Autonomistas', 400, 85.00, 9, 'quadraTenis.png'),
(10, 'Quadra Santo André', 0, 1, '20x40', 'Piso laminado', '09010-000', 'SP', 'Santo André', 'Centro', 'Rua Senador Flaquer', 88, 100.00, 10, 'quadra-de-volei4 1.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `quadra_mod`
--

CREATE TABLE `quadra_mod` (
  `cod_quadra` int(11) NOT NULL,
  `cod_modalidade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `quadra_mod`
--

INSERT INTO `quadra_mod` (`cod_quadra`, `cod_modalidade`) VALUES
(1, 1),
(1, 5),
(2, 2),
(3, 1),
(4, 4),
(5, 3),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva`
--

CREATE TABLE `reserva` (
  `cod_reserva` int(11) NOT NULL,
  `duracao` decimal(8,2) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data_reserva` date NOT NULL,
  `horario_reserva` datetime NOT NULL,
  `cod_quadra` int(11) DEFAULT NULL,
  `cod_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `reserva`
--

INSERT INTO `reserva` (`cod_reserva`, `duracao`, `valor`, `data_reserva`, `horario_reserva`, `cod_quadra`, `cod_usuario`) VALUES
(1, 1.50, 180.00, '2025-11-10', '2025-11-10 14:00:00', 1, 1),
(2, 2.00, 180.00, '2025-11-12', '2025-11-12 16:00:00', 2, 2),
(3, 1.00, 110.00, '2025-11-15', '2025-11-15 10:00:00', 3, 3),
(4, 2.00, 200.00, '2025-11-18', '2025-11-18 18:00:00', 4, 4),
(5, 1.50, 195.00, '2025-11-20', '2025-11-20 20:00:00', 5, 5),
(6, 1.00, 80.00, '2025-11-21', '2025-11-21 08:00:00', 6, 6),
(7, 1.50, 172.50, '2025-11-22', '2025-11-22 14:00:00', 7, 7),
(8, 2.00, 190.00, '2025-11-23', '2025-11-23 17:00:00', 8, 8),
(9, 1.00, 85.00, '2025-11-24', '2025-11-24 09:00:00', 9, 9),
(10, 1.50, 150.00, '2025-11-25', '2025-11-25 19:00:00', 10, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `cod_usuario` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `senha` varchar(255) NOT NULL,
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
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`cod_usuario`, `username`, `senha`, `nome`, `rg`, `cpf`, `email`, `datanasc`, `telefone`, `cep`, `estado`, `cidade`, `bairro`, `rua`, `numero`) VALUES
(1, 'usuario1', '$2y$10$gwl.HO73S1nvnKC7HmYYfeBRw2dEVRfxUmU41JIuURU3N3YDS/WlO', 'João Silva', '123456789', '111.222.333-44', 'joao@gmail.com', '1990-05-10', '(11) 91234-5678', '01001-000', 'SP', 'São Paulo', 'Centro', 'Rua da Consolação', 120),
(2, 'usuario2', '$2y$10$qguGh4NAyTaA85knkFMAkOvO6xax/fxUkRamZBTJq555ephYzBG3O', 'Maria Oliveira', '987654321', '555.666.777-88', 'maria@gmail.com', '1985-11-20', '(11) 98765-4321', '05422-000', 'SP', '', 'Pinheiros', 'Rua Ferreira de Araújo', 310),
(3, 'usuario3', '$2y$10$Tp3pSBea8k.CYqbzyQCLYuwK8zP603HUnL1UQ3YyUuwWDrZujiw6O', 'Carlos Souza', '135792468', '999.888.777-66', 'carlos@gmail.com', '1992-07-15', '(11) 97654-3210', '13200-000', 'SP', '', 'Centro', 'Rua Barão de Jundiaí', 60),
(4, 'usuario4', '$2y$10$gYxCBV1DPYm6OcApxCRH1uKT0NHKSxRpwNAPpZNgdJYTb3hRtpvE6', 'Ana Paula', '246813579', '444.555.666-22', 'ana@gmail.com', '1995-09-25', '(11) 93456-7890', '06000-000', 'SP', '', 'Centro', 'Avenida dos Autonomistas', 420),
(5, 'usuario5', '$2y$10$o7bOf7tQX5MX7nW938mOlOXCOZbGp8Q/rpuXwOElZQSokjHFQ0lKq', 'Lucas Pereira', '357159486', '333.222.111-99', 'lucas@gmail.com', '1988-03-05', '(11) 94567-8910', '09010-000', 'SP', '', 'Centro', 'Rua Senador Flaquer', 90),
(6, 'usuario6', '$2y$10$eGlU7C/zgE2pF4N3IKDjsuyeaQl559UoWogJmYI1pMKCT5lazfchy', 'Fernanda Lima', '654987321', '222.111.333-55', 'fernanda@gmail.com', '1993-12-12', '(11) 91234-9876', '04776-000', 'SP', '', 'Campo Limpo', 'Avenida Professor Luís Ignácio', 85),
(7, 'usuario7', '$2y$10$oFKd1dKPorusFkBDcFXzauqsBxaeqPNP7v.BsiQT7HRZ5QFhr/g5u', 'Pedro Santos', '789456123', '555.666.777-44', 'pedro@gmail.com', '1987-06-30', '(11) 99887-1234', '05556-000', 'SP', '', 'Raposo Tavares', 'Rua Professor Artur Ramos', 145),
(8, 'usuario8', '$2y$10$2zBB8unLJcaSxX1yvCOW3.gctGPUK0xOjiLLQuQg1eU5d3oUyllSa', 'Juliana Costa', '123789456', '888.999.777-11', 'juliana@gmail.com', '1991-02-17', '(11) 98765-1122', '06400-000', 'SP', '', 'Jardim Belval', 'Rua Guilherme Álvaro', 101),
(9, 'usuario9', '$2y$10$UZDYbn5ZluU1Cnxrsy2IrukzZzW7rQdMKXn/08NXH7hE2Tc3lp5IO', 'Rafael Martins', '456123789', '777.666.555-44', 'rafael@gmail.com', '1989-08-09', '(11) 97612-3344', '09370-000', 'SP', '', 'Centro', 'Rua Nicolau Filizola', 150),
(10, 'usuario10', '$2y$10$ivGglON5qVIijW6YZbSziuXemzIjo50hha3HvaRe5qTvIcNQLMBCa', 'Carla Nunes', '789123456', '666.555.444-33', 'carla@gmail.com', '1994-04-27', '(11) 99345-6677', '01001-000', 'SP', '', 'Centro', 'Rua da Consolação', 110);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD KEY `cod_quadra` (`cod_quadra`),
  ADD KEY `cod_usuario` (`cod_usuario`);

--
-- Índices para tabela `instituicao`
--
ALTER TABLE `instituicao`
  ADD PRIMARY KEY (`cod_instituicao`);

--
-- Índices para tabela `modalidade`
--
ALTER TABLE `modalidade`
  ADD PRIMARY KEY (`cod_modalidade`);

--
-- Índices para tabela `quadra`
--
ALTER TABLE `quadra`
  ADD PRIMARY KEY (`cod_quadra`),
  ADD KEY `cod_instituicao` (`cod_instituicao`);

--
-- Índices para tabela `quadra_mod`
--
ALTER TABLE `quadra_mod`
  ADD PRIMARY KEY (`cod_quadra`,`cod_modalidade`),
  ADD KEY `cod_modalidade` (`cod_modalidade`);

--
-- Índices para tabela `reserva`
--
ALTER TABLE `reserva`
  ADD PRIMARY KEY (`cod_reserva`),
  ADD KEY `cod_quadra` (`cod_quadra`),
  ADD KEY `cod_usuario` (`cod_usuario`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`cod_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `instituicao`
--
ALTER TABLE `instituicao`
  MODIFY `cod_instituicao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `modalidade`
--
ALTER TABLE `modalidade`
  MODIFY `cod_modalidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `quadra`
--
ALTER TABLE `quadra`
  MODIFY `cod_quadra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `reserva`
--
ALTER TABLE `reserva`
  MODIFY `cod_reserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `favoritos`
--
ALTER TABLE `favoritos`
  ADD CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`cod_quadra`) REFERENCES `quadra` (`cod_quadra`),
  ADD CONSTRAINT `favoritos_ibfk_2` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`);

--
-- Limitadores para a tabela `quadra`
--
ALTER TABLE `quadra`
  ADD CONSTRAINT `quadra_ibfk_1` FOREIGN KEY (`cod_instituicao`) REFERENCES `instituicao` (`cod_instituicao`);

--
-- Limitadores para a tabela `quadra_mod`
--
ALTER TABLE `quadra_mod`
  ADD CONSTRAINT `quadra_mod_ibfk_1` FOREIGN KEY (`cod_quadra`) REFERENCES `quadra` (`cod_quadra`),
  ADD CONSTRAINT `quadra_mod_ibfk_2` FOREIGN KEY (`cod_modalidade`) REFERENCES `modalidade` (`cod_modalidade`);

--
-- Limitadores para a tabela `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `reserva_ibfk_1` FOREIGN KEY (`cod_quadra`) REFERENCES `quadra` (`cod_quadra`),
  ADD CONSTRAINT `reserva_ibfk_2` FOREIGN KEY (`cod_usuario`) REFERENCES `usuario` (`cod_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
