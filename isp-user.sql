-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 23-Maio-2021 às 17:51
-- Versão do servidor: 10.4.18-MariaDB
-- versão do PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `isp-user`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `emailconfig`
--

CREATE TABLE `emailconfig` (
  `id` int(11) NOT NULL,
  `fromemail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fromname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `protocol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `host` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `security` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `port` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `emailconfig`
--

INSERT INTO `emailconfig` (`id`, `fromemail`, `fromname`, `protocol`, `host`, `username`, `security`, `port`, `password`, `created_at`, `updated_at`) VALUES
(1, 'bhlima2@gmail.com', 'nicbit', 'smtp', 'gmail.google.com', 'official@gmail.com', 'tls', '22', '$2y$10$VToKtP1eqJA6cdah2MlR3uJnG0baHHkSu3OE/CeNjUZm6Rra3DK7C', '2020-08-21 17:43:51', '2021-05-08 11:50:10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `emailsmodel`
--

CREATE TABLE `emailsmodel` (
  `id` int(11) NOT NULL,
  `assunto` varchar(255) NOT NULL,
  `mensagem` longtext NOT NULL,
  `created_at` int(50) NOT NULL,
  `updated_at` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `emailsmodel`
--

INSERT INTO `emailsmodel` (`id`, `assunto`, `mensagem`, `created_at`, `updated_at`) VALUES
(2, 'Teste', '34343434\"', 2021, 2021),
(3, 'teste2', '34343434\"', 2021, 2021),
(7, 'Padrao', 'nicbit - isp - v 1.0.0\r\nRegards', 2021, 2021);

-- --------------------------------------------------------

--
-- Estrutura da tabela `gateway`
--

CREATE TABLE `gateway` (
  `id` int(11) NOT NULL,
  `client_id` int(50) NOT NULL,
  `client_secret` int(50) NOT NULL,
  `pix_cert` varchar(255) NOT NULL,
  `sandbox` tinyint(1) NOT NULL,
  `debug` tinyint(1) NOT NULL,
  `timeout` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  `updated_at` int(50) NOT NULL,
  `created_at` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `gateway`
--

INSERT INTO `gateway` (`id`, `client_id`, `client_secret`, `pix_cert`, `sandbox`, `debug`, `timeout`, `active`, `updated_at`, `created_at`) VALUES
(2, 2147483647, 2147483647, '3232323', 1, 1, 1, 1, 2021, 2021),
(3, 2147483647, 2147483647, 'http://localhost/nicbit/isp-user/public/gateways', 1, 1, 56, 1, 2021, 2021);

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs`
--

CREATE TABLE `logs` (
  `id` int(255) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `reference` int(255) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `browser` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `logs`
--

INSERT INTO `logs` (`id`, `date`, `time`, `reference`, `name`, `ip`, `location`, `browser`, `status`, `created_at`, `updated_at`) VALUES
(13, '2021-05-08', '11:48:20', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-08 11:48:20', '2021-05-08 11:48:20'),
(14, '2021-05-08', '12:35:02', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-08 12:35:02', '2021-05-08 12:35:02'),
(15, '2021-05-08', '22:47:36', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-08 22:47:36', '2021-05-08 22:47:36'),
(16, '2021-05-09', '07:13:27', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-09 07:13:27', '2021-05-09 07:13:27'),
(17, '2021-05-10', '00:06:27', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-10 00:06:27', '2021-05-10 00:06:27'),
(18, '2021-05-10', '01:44:15', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-10 01:44:15', '2021-05-10 01:44:15'),
(19, '2021-05-15', '01:00:09', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-15 01:00:09', '2021-05-15 01:00:09'),
(20, '2021-05-15', '12:45:11', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-15 12:45:11', '2021-05-15 12:45:11'),
(21, '2021-05-16', '07:53:08', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-16 07:53:08', '2021-05-16 07:53:08'),
(22, '2021-05-16', '11:15:38', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-16 11:15:38', '2021-05-16 11:15:38'),
(23, '2021-05-16', '22:00:38', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-16 22:00:38', '2021-05-16 22:00:38'),
(24, '2021-05-17', '04:53:18', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-17 04:53:18', '2021-05-17 04:53:18'),
(25, '2021-05-17', '10:12:42', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-17 10:12:42', '2021-05-17 10:12:42'),
(26, '2021-05-17', '11:29:29', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-17 11:29:29', '2021-05-17 11:29:29'),
(27, '2021-05-17', '11:38:42', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-17 11:38:42', '2021-05-17 11:38:42'),
(28, '2021-05-17', '20:09:18', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-17 20:09:18', '2021-05-17 20:09:18'),
(29, '2021-05-18', '01:02:51', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-18 01:02:51', '2021-05-18 01:02:51'),
(30, '2021-05-18', '06:02:45', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-18 06:02:45', '2021-05-18 06:02:45'),
(31, '2021-05-18', '22:51:35', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-18 22:51:35', '2021-05-18 22:51:35'),
(32, '2021-05-19', '04:30:47', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-19 04:30:47', '2021-05-19 04:30:47'),
(33, '2021-05-19', '09:25:16', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-19 09:25:16', '2021-05-19 09:25:16'),
(34, '2021-05-19', '20:04:02', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-19 20:04:02', '2021-05-19 20:04:02'),
(35, '2021-05-20', '20:41:02', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-20 20:41:02', '2021-05-20 20:41:02'),
(36, '2021-05-21', '02:26:22', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-21 02:26:22', '2021-05-21 02:26:22'),
(37, '2021-05-22', '00:14:51', 1, 'Admin', '127.0.0.1', NULL, 'Firefox', 'Success', '2021-05-22 00:14:51', '2021-05-22 00:14:51');

-- --------------------------------------------------------

--
-- Estrutura da tabela `router`
--

CREATE TABLE `router` (
  `nome` varchar(30) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `porta` varchar(20) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `created_at` varchar(50) NOT NULL,
  `updated_at` varchar(50) NOT NULL,
  `id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `router`
--

INSERT INTO `router` (`nome`, `ip`, `senha`, `usuario`, `porta`, `active`, `created_at`, `updated_at`, `id`) VALUES
('Petropolis', '10.0.0.2', 'fn2188', 'admin', '555555', 1, '', '2021-05-17 01:35:29', 2),
('teste', '10.0.0.0', 'fn2188', 'admin', '3434324', 1, '2021-05-17 01:00:30', '2021-05-17 01:28:54', 4);

-- --------------------------------------------------------

--
-- Estrutura da tabela `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dateformat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timeformat` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iprestriction` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `settings`
--

INSERT INTO `settings` (`id`, `language`, `timezone`, `dateformat`, `timeformat`, `iprestriction`, `created_at`, `updated_at`) VALUES
(1, 'en', 'Asia/Manila', 'yyyy-mm-dd', '24', '', '2020-08-21 17:43:51', '2020-09-11 14:34:44');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `new_email` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_hash` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `firstname` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `activate_hash` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_hash` varchar(191) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reset_expires` bigint(20) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_at` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `email`, `new_email`, `password_hash`, `name`, `firstname`, `lastname`, `activate_hash`, `reset_hash`, `reset_expires`, `active`, `created_at`, `updated_at`) VALUES
(1, 'bhlima2@gmail.com', NULL, '$2y$10$/clmNLUUxGnREFHqraU7P.aVfJ5Mk0iEKRgKVz8.ZKOZIUGJGXlya', 'Admin', 'Admin', 'User', 'ZEWv2TUIY5oDqgw9FkjnmAS78zJNKfpL', NULL, NULL, 1, '2020-08-04 16:07:50', '2021-05-16 14:16:02');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `emailconfig`
--
ALTER TABLE `emailconfig`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `emailsmodel`
--
ALTER TABLE `emailsmodel`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `gateway`
--
ALTER TABLE `gateway`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `router`
--
ALTER TABLE `router`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `emailconfig`
--
ALTER TABLE `emailconfig`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `emailsmodel`
--
ALTER TABLE `emailsmodel`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `gateway`
--
ALTER TABLE `gateway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `router`
--
ALTER TABLE `router`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
