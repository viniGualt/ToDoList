-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 09/11/2024 às 00:37
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tarefas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `prioridade`
--

CREATE TABLE `prioridade` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `prioridade`
--

INSERT INTO `prioridade` (`id`, `nome`) VALUES
(1, 'Baixa'),
(2, 'Média'),
(3, 'Alta');

-- --------------------------------------------------------

--
-- Estrutura para tabela `status`
--

CREATE TABLE `status` (
  `id` int(1) UNSIGNED NOT NULL,
  `nome` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `status`
--

INSERT INTO `status` (`id`, `nome`) VALUES
(0, NULL),
(1, 'Pendente'),
(2, 'Em andamento'),
(3, 'Concluído');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tarefas`
--

CREATE TABLE `tarefas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `prioridade` int(1) NOT NULL,
  `data_criacao` datetime NOT NULL DEFAULT current_timestamp(),
  `data_limite` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `tarefas`
--

INSERT INTO `tarefas` (`id`, `nome`, `descricao`, `status`, `prioridade`, `data_criacao`, `data_limite`) VALUES
(1, 'Implementar create banco de dados', 'Implementar o botão de criar tarefa no trabalho do valdir, ligando ao banco de dados', 1, 3, '2024-11-01 20:41:12', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `prioridade`
--
ALTER TABLE `prioridade`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `tarefas`
--
ALTER TABLE `tarefas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tarefas`
--
ALTER TABLE `tarefas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
