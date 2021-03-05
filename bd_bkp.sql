-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 01-Mar-2021 às 21:10
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
-- Estrutura da tabela `artefatos`
--

CREATE TABLE `artefatos` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `id_disciplina_iteracao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `artefatos`
--

INSERT INTO `artefatos` (`id`, `nome`, `id_disciplina_iteracao`) VALUES
(2, 'v_6_seminarioArtigo.pdf', 6),
(6, 'v_81_RetificaÃ§Ã£o II de Edital nÂº 97 - Aluno.pdf', 81),
(7, 'v_81_seminarioArtigo.pdf', 81),
(8, 'v_81_user.png', 81);

-- --------------------------------------------------------

--
-- Estrutura da tabela `disciplina_iteracao`
--

CREATE TABLE `disciplina_iteracao` (
  `id` int(11) NOT NULL,
  `tempo` int(11) NOT NULL DEFAULT '0',
  `id_iteracao` int(11) NOT NULL,
  `disciplina` char(2) NOT NULL,
  `resumo` text,
  `texto` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `disciplina_iteracao`
--

INSERT INTO `disciplina_iteracao` (`id`, `tempo`, `id_iteracao`, `disciplina`, `resumo`, `texto`) VALUES
(6, 20, 2, 'D1', '', ''),
(7, 15, 2, 'D2', '', ''),
(8, 15, 2, 'D3', '', ''),
(9, 18, 2, 'D4', '', ''),
(10, 15, 2, 'D5', '', ''),
(11, 5, 3, 'D1', '', ''),
(12, 4, 3, 'D2', '', ''),
(13, 12, 3, 'D3', '', ''),
(14, 20, 3, 'D4', '', ''),
(15, 0, 3, 'D5', '', ''),
(16, 3, 4, 'D1', '', ''),
(17, 2, 4, 'D2', '', ''),
(18, 0, 4, 'D3', '', ''),
(19, 0, 4, 'D4', '', ''),
(20, 15, 4, 'D5', '', ''),
(81, 20, 17, 'D1', 'Lorem ipsum erat viverra quam convallis habitant imperdiet conubia, habitasse dapibus suscipit vulputate curae velit aenean augue donec, blandit malesuada dictumst duis cubilia ad quis. ornare netus cubilia habitant urna elementum praesent sem himenaeos, sit tellus felis curae turpis consectetur etiam faucibus eget, vitae orci purus est vestibulum pharetra dapibus. tristique vivamus porttitor lacinia nibh justo dictumst, nulla ante tempus dictumst rutrum integer, nisl metus adipiscing tempus aliquam. lorem pulvinar scelerisque placerat lacus sit felis etiam, condimentum curabitur eget eros nec felis. lobortis molestie porttitor mauris nisl sollicitudin senectus id nisi, nec per molestie purus risus a aenean lorem, gravida primis rhoncus sem porta quis morbi. ', '<h1>Testando</h1><div><div>Lorem ipsum erat viverra quam convallis habitant imperdiet conubia, habitasse dapibus suscipit vulputate curae velit aenean augue donec, blandit malesuada dictumst duis cubilia ad quis. ornare netus cubilia habitant urna elementum praesent sem himenaeos, sit tellus felis curae turpis consectetur etiam faucibus eget, vitae orci purus est vestibulum pharetra dapibus. tristique vivamus porttitor lacinia nibh justo dictumst, nulla ante tempus dictumst rutrum integer, nisl metus adipiscing tempus aliquam. lorem pulvinar scelerisque placerat lacus sit felis etiam, condimentum curabitur eget eros nec felis. lobortis molestie porttitor mauris nisl sollicitudin senectus id nisi, nec per molestie purus risus a aenean lorem, gravida primis rhoncus sem porta quis morbi.&nbsp;</div><h3>Titulo 3</h3><div><span style=\"white-space:pre\">	</span>Blandit vestibulum amet condimentum imperdiet morbi proin aptent lacus consectetur egestas curabitur, himenaeos ut suscipit per inceptos placerat urna litora porta massa, erat ornare nam taciti nullam per nisl rhoncus habitant vestibulum. laoreet metus euismod lacinia enim rhoncus hac dolor, nullam lorem magna eleifend litora nisi eu cubilia, tellus ligula proin orci inceptos interdum. viverra litora leo diam vel proin litora molestie, duis eget erat fringilla eleifend porttitor aenean, felis urna leo nibh curae fusce. orci integer habitant luctus diam elit sagittis fermentum lobortis, potenti vel pretium platea sit class semper, ultrices ac cursus curabitur sem libero sed.&nbsp;</div><div><br></div><h2 style=\"text-align: center;\"><font color=\"#ff0000\"><b>Titulo 2</b></font></h2><div><span style=\"white-space:pre\">	</span>Mauris auctor interdum nisl sodales primis fermentum platea consectetur, tempus vel donec interdum platea suspendisse curabitur, aliquam ac fringilla justo feugiat ipsum id. ante aliquam mauris odio inceptos nam diam torquent, amet nibh eros nulla velit ultricies suspendisse, pellentesque ultrices etiam sociosqu nibh lacus. cursus mollis ornare cras vehicula sapien netus felis dolor sapien luctus sagittis, nulla tortor sed maecenas suscipit lectus mauris fringilla curae luctus tellus tempor, nostra condimentum ac enim habitasse nisl nunc quis habitant adipiscing. consectetur sit luctus tristique suscipit varius scelerisque pellentesque bibendum consectetur, porttitor aliquam dui viverra amet tempus pharetra cursus.&nbsp;</div><div><br></div><div><span style=\"white-space:pre\">	</span>Mollis taciti consequat mi cras volutpat aliquet ullamcorper fringilla proin, imperdiet id consectetur lectus mauris sit rhoncus molestie. nisl sodales quis scelerisque quis tristique sit ligula elementum ipsum, primis litora fermentum volutpat ornare urna turpis cursus, neque pulvinar ligula non hendrerit vehicula molestie vel. eu est quisque libero est ante ultrices sodales enim sociosqu quis, turpis purus viverra lacinia malesuada blandit nibh aptent massa iaculis, nisl mollis magna eu varius sociosqu ut habitasse ipsum. inceptos luctus vel porttitor suscipit sit nec id porta egestas mollis condimentum, hac aenean ultrices potenti pharetra curabitur sem facilisis conubia praesent.&nbsp;</div><h3 style=\"text-align: center;\"><font color=\"#0000ff\" face=\"Times\">fsda<i>dafdafdafda</i></font></h3><div>jdkasjfasjkdf</div><div><span style=\"white-space:pre\">	</span>Dictumst duis risus nostra vestibulum primis non venenatis vel tincidunt metus, pellentesque conubia laoreet turpis in platea orci fames curae, ut donec duis felis arcu imperdiet vivamus dolor quisque. ac class varius platea amet consequat lacus platea ut blandit quis, habitant vivamus consectetur elit elementum pretium placerat rutrum tempor, vehicula est varius nulla commodo torquent tincidunt ut curae. commodo mi morbi et maecenas leo imperdiet hac nam, quis tincidunt vehicula velit ut ad elit, volutpat aliquam cursus fermentum aenean molestie egestas. elementum ante sit aenean vel ac litora facilisis torquent nullam vel fringilla praesent, purus vehicula varius orci etiam nunc bibendum volutpat commodo mollis.&nbsp;</div></div><div><img src=\"data:image/png;base64,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\" alt=\"Resultado de imagem para diagramas uml\"><br></div>'),
(82, 15, 17, 'D2', '', ''),
(83, 0, 17, 'D3', NULL, NULL),
(84, 0, 17, 'D4', NULL, NULL),
(85, 0, 17, 'D5', NULL, NULL),
(86, 8, 2, 'D6', '', ''),
(87, 15, 3, 'D6', '', ''),
(88, 22, 4, 'D6', '', ''),
(89, 0, 17, 'D6', NULL, NULL);

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
(2, 'E1', 2),
(3, 'C1', 3),
(4, 'T1', 4),
(17, 'I1', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `user`, `email`, `password`, `admin`) VALUES
(1, 'renan.santos', 'renan@gmail.com', 'renan', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `artefatos`
--
ALTER TABLE `artefatos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_disciplina_iteracao` (`id_disciplina_iteracao`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `artefatos`
--
ALTER TABLE `artefatos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `disciplina_iteracao`
--
ALTER TABLE `disciplina_iteracao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `fase`
--
ALTER TABLE `fase`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `iteracao`
--
ALTER TABLE `iteracao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `artefatos`
--
ALTER TABLE `artefatos`
  ADD CONSTRAINT `artefatos_ibfk_1` FOREIGN KEY (`id_disciplina_iteracao`) REFERENCES `disciplina_iteracao` (`id`) ON DELETE CASCADE;

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
