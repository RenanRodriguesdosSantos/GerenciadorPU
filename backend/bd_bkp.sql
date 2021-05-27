-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Maio-2021 às 00:19
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `controlrup`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `anexos`
--

CREATE TABLE `anexos` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `conteudo` blob NOT NULL,
  `id_artefato` int(11) NOT NULL,
  `tipo` varchar(5) NOT NULL,
  `tamanho` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `artefatos`
--

CREATE TABLE `artefatos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `id_disciplina_iteracao` int(11) NOT NULL,
  `autor` int(11) NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp(),
  `renomeavel` tinyint(1) NOT NULL DEFAULT 0,
  `tipo` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `conteudo`
--

CREATE TABLE `conteudo` (
  `id` int(11) NOT NULL,
  `titulo` varchar(60) NOT NULL,
  `texto` text NOT NULL,
  `id_artefato` int(11) NOT NULL,
  `editavel` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina_iteracao`
--

CREATE TABLE `disciplina_iteracao` (
  `id` int(11) NOT NULL,
  `tempo` int(11) NOT NULL DEFAULT 0,
  `id_iteracao` int(11) NOT NULL,
  `disciplina` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fase`
--

CREATE TABLE `fase` (
  `id` int(11) NOT NULL,
  `nome` varchar(25) NOT NULL,
  `id_projeto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `iteracao`
--

CREATE TABLE `iteracao` (
  `id` int(11) NOT NULL,
  `nome` char(2) NOT NULL,
  `id_fase` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

CREATE TABLE `projeto` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `autor` int(11) NOT NULL,
  `descricao` tinytext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `subconteudo`
--

CREATE TABLE `subconteudo` (
  `id` int(11) NOT NULL,
  `titulo` varchar(60) NOT NULL,
  `texto` text NOT NULL,
  `id_conteudo` int(11) NOT NULL,
  `editavel` tinyint(1) NOT NULL DEFAULT 0,
  `renomeavel` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `subconteudo2`
--

CREATE TABLE `subconteudo2` (
  `id` int(11) NOT NULL,
  `titulo` varchar(60) NOT NULL,
  `texto` text NOT NULL,
  `id_subconteudo` int(11) NOT NULL,
  `renomeavel` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `user`, `email`, `password`, `admin`) VALUES
(1, 'renan.santos', 'renan@gmail.com', '202cb962ac59075b964b07152d234b70', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_projeto`
--

CREATE TABLE `users_projeto` (
  `id` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `projeto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `anexos`
--
ALTER TABLE `anexos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_artefato` (`id_artefato`);

--
-- Índices para tabela `artefatos`
--
ALTER TABLE `artefatos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_disciplina_iteracao` (`id_disciplina_iteracao`),
  ADD KEY `autor` (`autor`);

--
-- Índices para tabela `conteudo`
--
ALTER TABLE `conteudo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_artefato` (`id_artefato`);

--
-- Índices para tabela `disciplina_iteracao`
--
ALTER TABLE `disciplina_iteracao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `iteracao_fk` (`id_iteracao`);

--
-- Índices para tabela `fase`
--
ALTER TABLE `fase`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_projeto` (`id_projeto`);

--
-- Índices para tabela `iteracao`
--
ALTER TABLE `iteracao`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fase_fk` (`id_fase`);

--
-- Índices para tabela `projeto`
--
ALTER TABLE `projeto`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `subconteudo`
--
ALTER TABLE `subconteudo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subconteudo_ibfk_1` (`id_conteudo`);

--
-- Índices para tabela `subconteudo2`
--
ALTER TABLE `subconteudo2`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_subconteudo` (`id_subconteudo`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users_projeto`
--
ALTER TABLE `users_projeto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user` (`user`),
  ADD KEY `users_projeto_ibfk_1` (`projeto`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anexos`
--
ALTER TABLE `anexos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `artefatos`
--
ALTER TABLE `artefatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=196399;

--
-- AUTO_INCREMENT de tabela `conteudo`
--
ALTER TABLE `conteudo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188160;

--
-- AUTO_INCREMENT de tabela `disciplina_iteracao`
--
ALTER TABLE `disciplina_iteracao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=812;

--
-- AUTO_INCREMENT de tabela `fase`
--
ALTER TABLE `fase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de tabela `iteracao`
--
ALTER TABLE `iteracao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=148;

--
-- AUTO_INCREMENT de tabela `projeto`
--
ALTER TABLE `projeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `subconteudo`
--
ALTER TABLE `subconteudo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168326;

--
-- AUTO_INCREMENT de tabela `subconteudo2`
--
ALTER TABLE `subconteudo2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1513;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users_projeto`
--
ALTER TABLE `users_projeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `anexos`
--
ALTER TABLE `anexos`
  ADD CONSTRAINT `anexos_ibfk_1` FOREIGN KEY (`id_artefato`) REFERENCES `artefatos` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `artefatos`
--
ALTER TABLE `artefatos`
  ADD CONSTRAINT `artefatos_ibfk_1` FOREIGN KEY (`autor`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `artefatos_ibfk_2` FOREIGN KEY (`id_disciplina_iteracao`) REFERENCES `disciplina_iteracao` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `conteudo`
--
ALTER TABLE `conteudo`
  ADD CONSTRAINT `conteudo_ibfk_1` FOREIGN KEY (`id_artefato`) REFERENCES `artefatos` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `disciplina_iteracao`
--
ALTER TABLE `disciplina_iteracao`
  ADD CONSTRAINT `iteracao_fk` FOREIGN KEY (`id_iteracao`) REFERENCES `iteracao` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `fase`
--
ALTER TABLE `fase`
  ADD CONSTRAINT `fase_ibfk_1` FOREIGN KEY (`id_projeto`) REFERENCES `projeto` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `iteracao`
--
ALTER TABLE `iteracao`
  ADD CONSTRAINT `fase_fk` FOREIGN KEY (`id_fase`) REFERENCES `fase` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `subconteudo`
--
ALTER TABLE `subconteudo`
  ADD CONSTRAINT `subconteudo_ibfk_1` FOREIGN KEY (`id_conteudo`) REFERENCES `conteudo` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `subconteudo2`
--
ALTER TABLE `subconteudo2`
  ADD CONSTRAINT `subconteudo2_ibfk_1` FOREIGN KEY (`id_subconteudo`) REFERENCES `subconteudo` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `users_projeto`
--
ALTER TABLE `users_projeto`
  ADD CONSTRAINT `users_projeto_ibfk_1` FOREIGN KEY (`projeto`) REFERENCES `projeto` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_projeto_ibfk_2` FOREIGN KEY (`user`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
