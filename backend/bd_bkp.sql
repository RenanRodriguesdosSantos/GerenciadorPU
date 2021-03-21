-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Mar-2021 às 18:54
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
  `tipo` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `artefatos`
--

INSERT INTO `artefatos` (`id`, `nome`, `id_disciplina_iteracao`, `autor`, `data`, `renomeavel`, `tipo`) VALUES
(1, 'AvaliaÃ§Ã£o da OrganizaÃ§Ã£o Alvo', 1, 1, '2021-03-17 14:24:29', 1, 1),
(3, 'GlossÃ¡rio', 2, 1, '2021-03-17 14:24:29', 0, 0),
(4, 'EspecificaÃ§Ã£o de realizaÃ§Ã£o de caso de uso', 3, 1, '2021-03-17 14:24:29', 0, 0),
(5, 'Plano de IntegraÃ§Ã£o de ContruÃ§Ã£o', 4, 1, '2021-03-17 14:24:29', 0, 0),
(6, 'Resumo da AvaliaÃ§Ã£o do Teste', 5, 1, '2021-03-17 14:24:29', 0, 0),
(7, 'Generico D6', 6, 1, '2021-03-17 14:24:29', 0, 0),
(8, 'Generico D7', 7, 1, '2021-03-17 14:24:29', 0, 0),
(9, 'Generico D8', 8, 1, '2021-03-17 14:24:29', 0, 0),
(10, 'Generico D9', 9, 1, '2021-03-17 14:24:29', 0, 0);

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

--
-- Extraindo dados da tabela `conteudo`
--

INSERT INTO `conteudo` (`id`, `titulo`, `texto`, `id_artefato`, `editavel`) VALUES
(1, 'IntroduÃ§Ã£o', 'jkadjkdsjfkj jTesjkadsjkdfj a', 1, 0),
(2, 'Contexto de NegÃ³cios', '', 1, 0),
(3, 'IdÃ©ias e estratÃ©gias de negÃ³cios no contexto do projeto', '', 1, 0),
(4, 'Fatores Externos', '', 1, 0),
(5, 'Fatores Internos', '', 1, 0),
(6, 'Resultados do benchmarking', '', 1, 0),
(7, 'Desempenho da OrganizaÃ§Ã£o Alvo', '', 1, 0),
(8, 'ConclusÃ£o da AvaliaÃ§Ã£o', '', 1, 0),
(9, 'IntroduÃ§Ã£o', '', 3, 0),
(10, 'DefiniÃ§Ãµes', '', 3, 0),
(11, 'EsteriÃ³tipos UML', '', 3, 0),
(12, 'IntroduÃ§Ã£o', '', 4, 0),
(13, 'Fluxo de Eventos - Design', '', 4, 0),
(14, 'Requisitos Derivados', '', 4, 0),
(15, 'IntroduÃ§Ã£o', '', 5, 0),
(16, 'Subsistemas', '', 5, 0),
(17, 'Builds', '', 5, 0),
(18, 'IntroduÃ§Ã£o', '', 6, 0),
(19, 'Resumo dos Resultados do Teste', '', 6, 0),
(20, 'Cobertura de Teste com base em requisitos', '', 6, 0),
(21, 'Cobertura baseada em cÃ³digo', '', 6, 0),
(22, 'AÃ§Ãµes sugeridas', '', 6, 0),
(23, 'Diagramas', '', 6, 0),
(24, 'Generico D6', '', 7, 0),
(25, 'Generico D7', '', 8, 0),
(26, 'Generico D7', '', 8, 0),
(27, 'Generico D8', '', 9, 0),
(28, 'Generico D9', '', 10, 0);

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

--
-- Extraindo dados da tabela `disciplina_iteracao`
--

INSERT INTO `disciplina_iteracao` (`id`, `tempo`, `id_iteracao`, `disciplina`) VALUES
(1, 0, 1, 'D1'),
(2, 0, 1, 'D2'),
(3, 0, 1, 'D3'),
(4, 0, 1, 'D4'),
(5, 0, 1, 'D5'),
(6, 0, 1, 'D6'),
(7, 0, 1, 'D7'),
(8, 0, 1, 'D8'),
(9, 0, 1, 'D9');

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
(1, 'I1', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

CREATE TABLE `projeto` (
  `id` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `autor` int(11) NOT NULL,
  `descricao` tinytext NOT NULL
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

--
-- Extraindo dados da tabela `subconteudo`
--

INSERT INTO `subconteudo` (`id`, `titulo`, `texto`, `id_conteudo`, `editavel`, `renomeavel`) VALUES
(1, 'Objetivo', 'teakajfdkjfk', 1, 0, 0),
(2, 'Escopo', '', 1, 0, 0),
(3, 'DefiniÃ§Ãµes, acrÃ´nimos e abreviaÃ§Ãµes', '', 1, 0, 0),
(4, 'ReferÃªncias', '', 1, 0, 0),
(5, 'VisÃ£o Geral', '', 1, 0, 0),
(6, 'Clientes', '', 4, 0, 0),
(7, 'Concorrentes', '', 4, 0, 0),
(8, 'Outras Partes IntereÃ§adas', '', 4, 0, 0),
(9, 'Processos de NegÃ³cios', '', 5, 0, 0),
(10, 'Ferramentas de Suporte', '', 5, 0, 0),
(11, 'OrganizaÃ§Ã£o Interna', '', 5, 0, 0),
(12, 'CompetÃªncias, habilidades e atitudes', '', 5, 0, 0),
(13, 'Capacidade de MudanÃ§a ', '', 5, 0, 0),
(14, 'Ãreas de Problemas', '', 8, 0, 0),
(15, 'Novas Tecnologias AplicÃ¡veis', '', 8, 0, 0),
(16, 'Objetivo', '', 9, 0, 0),
(17, 'Escopo', '', 9, 0, 0),
(18, 'ReferÃªncias', '', 9, 0, 0),
(19, 'VisÃ£o Geral', '', 9, 0, 0),
(20, '< aTerm>', '', 10, 1, 0),
(21, '< anotherTerm>', '', 10, 0, 0),
(22, '< aGroupOfTerm>', '', 10, 0, 0),
(23, '< aSecondGroupOfTerms>', '', 10, 0, 0),
(24, 'Objetivo', '', 12, 0, 0),
(25, 'Escopo', '', 12, 0, 0),
(26, 'DefiniÃ§Ãµes, acrÃ´nimos e abreviaÃ§Ãµes', '', 12, 0, 0),
(27, 'ReferÃªncias', '', 12, 0, 0),
(28, 'VisÃ£o Geral', '', 12, 0, 0),
(29, 'Objetivo', '', 15, 0, 0),
(30, 'Escopo', '', 15, 0, 0),
(31, 'DefiniÃ§Ãµes, acrÃ´nimos e abreviaÃ§Ãµes', '', 15, 0, 0),
(32, 'ReferÃªncias', '', 15, 0, 0),
(33, 'VisÃ£o Geral', '', 15, 0, 0),
(34, 'Objetivo', '', 18, 0, 0),
(35, 'Escopo', '', 18, 0, 0),
(36, 'DefiniÃ§Ãµes, acrÃ´nimos e abreviaÃ§Ãµes', '', 18, 0, 0),
(37, 'ReferÃªncias', '', 18, 0, 0),
(38, 'VisÃ£o Geral', '', 18, 0, 0),
(39, 'Generico D6', '', 24, 0, 0),
(40, 'Generico D7', '', 25, 0, 0),
(41, 'Generico D8', '', 27, 0, 0),
(42, 'Generico D9', '', 28, 0, 0);

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
(1, 'renan.santos', 'renan@gmail.com', 'renan', 1);

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
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anexos`
--
ALTER TABLE `anexos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `artefatos`
--
ALTER TABLE `artefatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195063;

--
-- AUTO_INCREMENT de tabela `conteudo`
--
ALTER TABLE `conteudo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181336;

--
-- AUTO_INCREMENT de tabela `disciplina_iteracao`
--
ALTER TABLE `disciplina_iteracao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT de tabela `fase`
--
ALTER TABLE `fase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `iteracao`
--
ALTER TABLE `iteracao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `projeto`
--
ALTER TABLE `projeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `subconteudo`
--
ALTER TABLE `subconteudo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158112;

--
-- AUTO_INCREMENT de tabela `subconteudo2`
--
ALTER TABLE `subconteudo2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
-- Limitadores para a tabela `iteracao`
--
ALTER TABLE `iteracao`
  ADD CONSTRAINT `fase_fk` FOREIGN KEY (`id_fase`) REFERENCES `fase` (`id`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
