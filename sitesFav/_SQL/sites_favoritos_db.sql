-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06/10/2026 às 17:30
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
-- Banco de dados: `sites_favoritos_db`
--
  CREATE DATABASE sites_favoritos_db;
  USE sites_favoritos_db;

-- --------------------------------------------------------

--
-- Estrutura para tabela `sites`
--

CREATE TABLE `sites` (
  `idSite` int(11) NOT NULL,
  `nomeSite` varchar(100) NOT NULL,
  `urlSite` varchar(300) NOT NULL,
  `descricaoSite` text NOT NULL,
  `categoriaSite` varchar(50) NOT NULL,
  `dataSite` date NOT NULL,
  `fotoSite` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `sites`
--

INSERT INTO `sites` (`idSite`, `nomeSite`, `urlSite`, `descricaoSite`, `categoriaSite`, `dataSite`, `fotoSite`) VALUES
(2, 'Microsoft', 'https://www.microsoft.com/pt-br', 'Site da Microsoft', 'Tecnologia', '2026-10-15', NULL),
(3, 'w3schools', 'https://www.w3schools.com/', 'Site de estudos de programa&ccedil;&atilde;o', 'Tecnologia', '2026-10-06', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `sites`
--
ALTER TABLE `sites`
  ADD PRIMARY KEY (`idSite`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `sites`
--
ALTER TABLE `sites`
  MODIFY `idSite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
