-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Mar-2021 às 22:59
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
(10, 'Generico D9', 9, 1, '2021-03-17 14:24:29', 0, 0),
(195112, 'EspecificaÃ§Ã£o de caso de uso de negÃ³cios: < Nome do caso de uso de negÃ³cios>', 1, 1, '2021-03-20 02:12:16', 1, 1),
(195339, 'EspecificaÃ§Ã£o de realizaÃ§Ã£o de caso de uso de negÃ³cios: < Nome do caso de uso de negÃ³cios>', 1, 1, '2021-03-20 19:09:18', 1, 2),
(195343, 'EspecificaÃ§Ã£o de caso de uso: < Nome do caso de uso>', 2, 1, '2021-03-21 01:17:02', 1, 3),
(195346, 'EspecificaÃ§Ã£o de Requisitos de Software Para < Subsistema ou Recurso1>', 2, 1, '2021-03-21 01:30:39', 1, 4),
(195350, 'EspecificaÃ§Ã£o de realizaÃ§Ã£o de caso de uso: < Nkjsome do caso de uso>', 3, 1, '2021-03-21 02:23:16', 1, 4),
(195351, 'EspecificaÃ§Ã£o de realizaÃ§Ã£o de caso de uso: < Nome do caso de uso>', 3, 1, '2021-03-21 02:33:50', 1, 4),
(195487, 'EspecificaÃ§Ã£o de Requisitos de Software Para < Subsistema ou Recurso>', 2, 2, '2021-03-21 21:30:11', 1, 4);

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
(28, 'Generico D9', '', 10, 0),
(181392, 'IntroduÃ§Ã£o', '', 195112, 0),
(181393, 'Nome do Caso de Uso de NÃ©gocios', '', 195112, 0),
(181394, 'Metas', '', 195112, 0),
(181395, 'Metas de Desempenho', '', 195112, 1),
(181396, 'Fluxo de Trabalho', '', 195112, 0),
(181397, 'Categoria', '', 195112, 0),
(181398, 'Risco', '', 195112, 0),
(181399, 'Possibilidades', '', 195112, 0),
(181400, 'ProprietÃ¡rio do Processo', '', 195112, 0),
(181401, 'Requisitos Especias', '', 195112, 1),
(181402, 'Pontos de ExtensÃ£o', '', 195112, 1),
(182478, 'IntroduÃ§Ã£o', '', 195339, 0),
(182479, 'RealizaÃ§Ã£o do Fluxo de Trabalho', '', 195339, 0),
(182480, 'Requisitos Derivados', '', 195339, 0),
(182487, 'Nome do Caso de Uso', '', 195343, 0),
(182488, 'Fluxo de Eventos', '', 195343, 0),
(182489, 'Requisitos Especiais', '', 195343, 1),
(182490, 'CondiÃ§Ãµes PrÃ©vias', '', 195343, 1),
(182491, 'PÃ³s-condiÃ§Ãµes', '', 195343, 1),
(182492, 'Ponto de ExtensÃ£o', '', 195343, 1),
(182498, 'IntroduÃ§Ã£o', '', 195346, 0),
(182499, 'DescriÃ§Ã£o Geral', '', 195346, 0),
(182500, 'Requisitos EspecÃ­ficos', '', 195346, 0),
(182501, 'InformaÃ§Ãµes de Apoio', '', 195346, 0),
(182511, 'IntroduÃ§Ã£o', '', 195350, 0),
(182512, 'Fluxo de Eventos - Design', '', 195350, 0),
(182513, 'Requisitos Derivados', '', 195350, 0),
(182514, 'IntroduÃ§Ã£o', '', 195351, 0),
(182515, 'Fluxo de Eventos - Design', '', 195351, 0),
(182516, 'Requisitos Derivados', '', 195351, 0),
(183039, 'IntroduÃ§Ã£o', '', 195487, 0),
(183040, 'DescriÃ§Ã£o Geral', '', 195487, 0),
(183041, 'Requisitos EspecÃ­ficos', '', 195487, 0),
(183042, 'InformaÃ§Ãµes de Apoio', '', 195487, 0);

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
(1, 15, 1, 'D1'),
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
  `nome` varchar(25) NOT NULL,
  `id_projeto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fase`
--

INSERT INTO `fase` (`id`, `nome`, `id_projeto`) VALUES
(1, 'inicio', 1),
(2, 'elaboracao', 1),
(3, 'construcao', 1),
(4, 'transicao', 1);

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
  `descricao` tinytext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `projeto`
--

INSERT INTO `projeto` (`id`, `nome`, `autor`, `descricao`, `created_at`) VALUES
(1, 'Projeto RUP', 1, 'RealizaÃ§Ã£o de uma ferramenta para acompanhamento de projeto com o RUP.', '2021-03-20 16:38:20'),
(6, 'Novo Projeto Teste', 1, 'Tesjkdja', '2021-03-20 21:47:03'),
(7, 'TEST2', 1, 'testenao', '2021-03-21 00:26:14');

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
(15, 'Novas Tecnologias AplicÃ¡veis', 'Teste', 8, 0, 0),
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
(42, 'Generico D9', '', 28, 0, 0),
(158154, 'Objetivo', '', 181392, 0, 0),
(158155, 'Escopo', '', 181392, 0, 0),
(158156, 'DefiniÃ§Ãµes, acrÃ´nimos e abreviaÃ§Ãµes', '', 181392, 0, 0),
(158157, 'ReferÃªncias', '', 181392, 0, 0),
(158158, 'VisÃ£o Geral', '', 181392, 0, 0),
(158159, 'Breve DescriÃ§Ã£o', '', 181393, 0, 0),
(158160, '< Nome da Meta de Desempenho>', '', 181395, 0, 1),
(158161, 'Fluxo de Trabalho BÃ¡sico', '', 181396, 1, 0),
(158162, 'Fluxo de Trabalho Alternativos', '', 181396, 1, 0),
(158163, '< Nome do Requisito Especial>', '', 181401, 0, 1),
(158164, '< Nome do Ponto de ExtensÃ£o>', '', 181402, 0, 1),
(159546, 'Objetivo', '', 182478, 0, 0),
(159547, 'Escopo', '', 182478, 0, 0),
(159548, 'DefiniÃ§Ãµes, acrÃ´nimos e abreviaÃ§Ãµes', '', 182478, 0, 0),
(159549, 'ReferÃªncias', '', 182478, 0, 0),
(159550, 'VisÃ£o Geral', '', 182478, 0, 0),
(159554, 'Breve DescriÃ§Ã£o', '', 182487, 0, 0),
(159555, 'Fludo BÃ¡sico', '', 182488, 1, 0),
(159556, 'Fluxo Alternativo', '', 182488, 1, 0),
(159557, '< Primeiro Requisito Especial>', '', 182489, 0, 1),
(159558, 'Fluxo Alternativo', '', 182489, 0, 1),
(159559, '< Pre-condiÃ§Ã£o um>', '', 182490, 0, 1),
(159560, 'Fluxo Alternativo', '', 182490, 0, 1),
(159561, '< PÃ³s-condiÃ§Ã£o um>', '', 182491, 0, 1),
(159562, 'Fluxo Alternativo', '', 182491, 0, 1),
(159563, '< Nome do Ponto de ExtensÃ£o>', '', 182492, 0, 1),
(159564, 'Fluxo Alternativo', 'Tetando sÃ³ pra ve se tÃ¡ tudo bem', 182492, 0, 1),
(159577, 'Objetivo', '', 182498, 0, 0),
(159578, 'Escopo', '', 182498, 0, 0),
(159579, 'DefiniÃ§Ãµes, acrÃ´nimos e abreviaÃ§Ãµes', '', 182498, 0, 0),
(159580, 'ReferÃªncias', '', 182498, 0, 0),
(159581, 'VisÃ£o Geral', '', 182498, 0, 0),
(159582, 'Pesquisa de Modelo de Caso de Uso', '', 182499, 0, 0),
(159583, 'SuposiÃ§Ãµes e DependÃªncias', '', 182499, 0, 0),
(159584, 'RelatÃ³rios de Caso de Uso', '', 182500, 0, 0),
(159585, 'Requisitos Suplementares', '', 182500, 0, 0),
(159601, 'Objetivo', '', 182511, 0, 0),
(159602, 'Escopo', '', 182511, 0, 0),
(159603, 'DefiniÃ§Ãµes, acrÃ´nimos e abreviaÃ§Ãµes', '', 182511, 0, 0),
(159604, 'ReferÃªncias', '', 182511, 0, 0),
(159605, 'VisÃ£o Geral', '', 182511, 0, 0),
(159606, 'Objetivo', '', 182514, 0, 0),
(159607, 'Escopo', '', 182514, 0, 0),
(159608, 'DefiniÃ§Ãµes, acrÃ´nimos e abreviaÃ§Ãµes', '', 182514, 0, 0),
(159609, 'ReferÃªncias', '', 182514, 0, 0),
(159610, 'VisÃ£o Geral', '', 182514, 0, 0),
(160403, 'Objetivo', '', 183039, 0, 0),
(160404, 'Escopo', '', 183039, 0, 0),
(160405, 'DefiniÃ§Ãµes, acrÃ´nimos e abreviaÃ§Ãµes', '', 183039, 0, 0),
(160406, 'ReferÃªncias', '', 183039, 0, 0),
(160407, 'VisÃ£o Geral', '', 183039, 0, 0),
(160408, 'Pesquisa de Modelo de Caso de Uso', '', 183040, 0, 0),
(160409, 'SuposiÃ§Ãµes e DependÃªncias', '', 183040, 0, 0),
(160410, 'RelatÃ³rios de Caso de Uso', '', 183041, 0, 0),
(160411, 'Requisitos Suplementares', '', 183041, 0, 0);

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

--
-- Extraindo dados da tabela `subconteudo2`
--

INSERT INTO `subconteudo2` (`id`, `titulo`, `texto`, `id_subconteudo`, `renomeavel`) VALUES
(6, '< nome da etapa do fluxo de trabalho>', '', 158161, 1),
(7, '< nome da etapa do fluxo de trabalho>', '', 158162, 1),
(94, '< Primeiro Fluxo Alternativo>', '', 159556, 1),
(95, '< Segundo Fluxo Alternativo>', '', 159556, 1);

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
(1, 'renan.santos', 'renan@gmail.com', '202cb962ac59075b964b07152d234b70', 1),
(2, 'ruyther.junior', 'ruyther@gmail.com', '202cb962ac59075b964b07152d234b70', 0);

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
-- Extraindo dados da tabela `users_projeto`
--

INSERT INTO `users_projeto` (`id`, `user`, `projeto`) VALUES
(1, 1, 1),
(2, 1, 6),
(3, 1, 7),
(4, 2, 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `artefatos`
--
ALTER TABLE `artefatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=195504;

--
-- AUTO_INCREMENT de tabela `conteudo`
--
ALTER TABLE `conteudo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183105;

--
-- AUTO_INCREMENT de tabela `disciplina_iteracao`
--
ALTER TABLE `disciplina_iteracao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=426;

--
-- AUTO_INCREMENT de tabela `fase`
--
ALTER TABLE `fase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `iteracao`
--
ALTER TABLE `iteracao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT de tabela `projeto`
--
ALTER TABLE `projeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `subconteudo`
--
ALTER TABLE `subconteudo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160509;

--
-- AUTO_INCREMENT de tabela `subconteudo2`
--
ALTER TABLE `subconteudo2`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `users_projeto`
--
ALTER TABLE `users_projeto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
