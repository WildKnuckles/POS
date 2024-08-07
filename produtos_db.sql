-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 07-Ago-2024 às 14:04
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `produtos_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `nome`) VALUES
(1, 'cosméticos'),
(2, 'eletrodomésticos'),
(3, 'beleza'),
(4, 'lazer');

-- --------------------------------------------------------

--
-- Estrutura da tabela `faturas`
--

DROP TABLE IF EXISTS `faturas`;
CREATE TABLE IF NOT EXISTS `faturas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total` decimal(10,2) NOT NULL,
  `pagou` decimal(10,2) NOT NULL,
  `troco` decimal(10,2) NOT NULL,
  `date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `faturas`
--

INSERT INTO `faturas` (`id`, `total`, `pagou`, `troco`, `date`) VALUES
(1, '905.50', '2000.00', '1094.50', '2024-08-06 16:41:06'),
(2, '240.50', '500.00', '259.50', '2024-08-06 16:48:20'),
(3, '455.50', '1000.00', '544.50', '2024-08-06 18:16:43'),
(4, '976.00', '2000.00', '1024.00', '2024-08-06 18:19:20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fatura_items`
--

DROP TABLE IF EXISTS `fatura_items`;
CREATE TABLE IF NOT EXISTS `fatura_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fatura_id` int(11) NOT NULL,
  `produto_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fatura_id` (`fatura_id`),
  KEY `produto_id` (`produto_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `fatura_items`
--

INSERT INTO `fatura_items` (`id`, `fatura_id`, `produto_id`, `quantity`, `preco`) VALUES
(1, 1, 1, 1, '155.50'),
(2, 1, 4, 1, '85.00'),
(3, 1, 25, 1, '665.00'),
(4, 2, 1, 1, '155.50'),
(5, 2, 4, 1, '85.00'),
(6, 3, 1, 1, '155.50'),
(7, 3, 3, 1, '120.00'),
(8, 3, 7, 1, '180.00'),
(9, 4, 1, 2, '155.50'),
(10, 4, 25, 1, '665.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categoria_id` (`categoria_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `nome`, `preco`, `categoria_id`) VALUES
(1, 'Máscara Facial Preta', '155.50', 1),
(10, 'Batedeira', '4500.00', 2),
(3, 'Liquidificador', '120.00', 2),
(4, 'Cafeteira', '85.00', 2),
(25, 'Jonatão Cardoso', '665.00', 1),
(7, 'Tênis de Corrida', '180.00', 4),
(12, 'Creme Monalisa', '850.00', 3),
(13, 'Casaco da Nike(M)', '15500.00', 4),
(14, 'Microwaves', '30500.00', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
