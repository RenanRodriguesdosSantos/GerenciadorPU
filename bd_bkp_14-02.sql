-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 14-Fev-2021 às 22:21
-- Versão do servidor: 10.1.38-MariaDB
-- versão do PHP: 7.1.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gerenciador_pu`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina_iteracao`
--

CREATE TABLE `disciplina_iteracao` (
  `id` int(11) NOT NULL,
  `tempo` int(11) NOT NULL DEFAULT '0',
  `id_iteracao` int(11) NOT NULL,
  `disciplina` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplina_iteracao`
--

INSERT INTO `disciplina_iteracao` (`id`, `tempo`, `id_iteracao`, `disciplina`) VALUES
(1, 20, 1, 'D1'),
(2, 30, 1, 'D2'),
(3, 15, 1, 'D3'),
(4, 0, 1, 'D4'),
(5, 10, 1, 'D5'),
(6, 39, 2, 'D1'),
(7, 30, 2, 'D2'),
(8, 9, 2, 'D3'),
(9, 35, 2, 'D4'),
(10, 20, 2, 'D5'),
(11, 34, 3, 'D1'),
(12, 14, 3, 'D2'),
(13, 22, 3, 'D3'),
(14, 11, 3, 'D4'),
(15, 28, 3, 'D5'),
(16, 11, 4, 'D1'),
(17, 33, 4, 'D2'),
(18, 39, 4, 'D3'),
(19, 35, 4, 'D4'),
(20, 35, 4, 'D5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fase`
--

CREATE TABLE `fase` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fase`
--

INSERT INTO `fase` (`id`, `nome`) VALUES
(1, 'inicio'),
(2, 'elaboracao'),
(3, 'construcao'),
(4, 'trasicao');

-- --------------------------------------------------------

--
-- Estrutura da tabela `iteracao`
--

CREATE TABLE `iteracao` (
  `id` int(11) NOT NULL,
  `nome` char(2) NOT NULL,
  `id_fase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `iteracao`
--

INSERT INTO `iteracao` (`id`, `nome`, `id_fase`) VALUES
(1, 'I1', 1),
(2, 'E1', 2),
(3, 'C1', 3),
(4, 'T1', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disciplina_iteracao`
--
ALTER TABLE `disciplina_iteracao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iteracao_fk` (`id_iteracao`);

--
-- Indexes for table `fase`
--
ALTER TABLE `fase`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `iteracao`
--
ALTER TABLE `iteracao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fase_fk` (`id_fase`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disciplina_iteracao`
--
ALTER TABLE `disciplina_iteracao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `fase`
--
ALTER TABLE `fase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `iteracao`
--
ALTER TABLE `iteracao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `disciplina_iteracao`
--
ALTER TABLE `disciplina_iteracao`
  ADD CONSTRAINT `iteracao_fk` FOREIGN KEY (`id_iteracao`) REFERENCES `iteracao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `iteracao`
--
ALTER TABLE `iteracao`
  ADD CONSTRAINT `fase_fk` FOREIGN KEY (`id_fase`) REFERENCES `fase` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
