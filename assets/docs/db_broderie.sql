-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: mariadb:3306
-- Tempo de geração: 02/09/2026 às 14:18
-- Versão do servidor: 10.11.11-MariaDB-ubu2204
-- Versão do PHP: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_broderie`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `category`
--

INSERT INTO `category` (`id`, `name`, `image`, `slug`, `description`) VALUES
(1, 'Broderie personnalisée', '1-6a980cb0ae5f4.jpg', 'broderie-personnalisee', 'Personnaliser vos vêtements accessoires et cadeaux grâce à une broderie de qualité\n            durable et élégante. Logo prénoms motifs ou texte : chaque création est réalisée avec soin.'),
(2, 'Personnalisation textile et accessoires', '2-6a980ce9f27d5.jpg', 'personnalisation-textile-et-accessoires', 'Je personnalise vos vêtements professionnels vos tenues d’association, équipement\n            sportif ou textiles publicitaires afin de valoriser votre image.'),
(3, 'Couture et retouches', '3-6a980cf9a9634.jpg', 'couture-et-retouches', 'Besoin d’une retouche? Je réalise différents travaux de couture avec précision pour\n            donner une seconde vie à vos textiles ou créer une pièce unique.'),
(4, 'Création sur mesure', '4-6a980d0850786.jpg', 'creation-sur-mesure', 'Envie d’un cadeau personnalisé ou d’une création unique ? ensemble nous imaginons un\n            projet qui vous ressemble adapté à vos envies et à votre budget.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20260729074248', '2026-07-29 07:44:56', 341),
('DoctrineMigrations\\Version20260729092935', '2026-07-29 09:33:14', 2171),
('DoctrineMigrations\\Version20260730072959', '2026-07-30 07:31:47', 366),
('DoctrineMigrations\\Version20260731114231', '2026-07-31 11:45:13', 62),
('DoctrineMigrations\\Version20260803085643', '2026-08-03 08:56:57', 265),
('DoctrineMigrations\\Version20260803140032', '2026-08-03 14:00:49', 107);

-- --------------------------------------------------------

--
-- Estrutura para tabela `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint(20) NOT NULL,
  `body` longtext NOT NULL,
  `headers` longtext NOT NULL,
  `queue_name` varchar(190) NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `messenger_messages`
--

INSERT INTO `messenger_messages` (`id`, `body`, `headers`, `queue_name`, `created_at`, `available_at`, `delivered_at`) VALUES
(1, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":5:{i:0;s:41:\\\"registration/confirmation_email.html.twig\\\";i:1;N;i:2;a:3:{s:9:\\\"signedUrl\\\";s:163:\\\"https://localhost:8443/verify/email?expires=1785503779&signature=T48grZnD7qk1l5rm_hSO-12oYI8MDTcqMhFRZ899xYk&token=NXIH7dNvU1cmjDRv9AKsnc1pC7fTr%2BHv8PpkViANHYk%3D\\\";s:19:\\\"expiresAtMessageKey\\\";s:26:\\\"%count% hour|%count% hours\\\";s:20:\\\"expiresAtMessageData\\\";a:1:{s:7:\\\"%count%\\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:20:\\\"aureopires@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:5:\\\"Admin\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:20:\\\"aureopires@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:25:\\\"Please Confirm your Email\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}i:4;N;}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2026-07-31 12:16:19', '2026-07-31 12:16:19', NULL),
(2, 'O:36:\\\"Symfony\\\\Component\\\\Messenger\\\\Envelope\\\":2:{s:44:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0stamps\\\";a:1:{s:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\";a:1:{i:0;O:46:\\\"Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\\":1:{s:55:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Stamp\\\\BusNameStamp\\0busName\\\";s:21:\\\"messenger.bus.default\\\";}}}s:45:\\\"\\0Symfony\\\\Component\\\\Messenger\\\\Envelope\\0message\\\";O:51:\\\"Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\\":2:{s:60:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0message\\\";O:39:\\\"Symfony\\\\Bridge\\\\Twig\\\\Mime\\\\TemplatedEmail\\\":5:{i:0;s:41:\\\"registration/confirmation_email.html.twig\\\";i:1;N;i:2;a:3:{s:9:\\\"signedUrl\\\";s:165:\\\"https://localhost:8443/verify/email?expires=1785509118&signature=oub-OynjjrA4W7tT9Y8-ZG4T17-8FAilwxJieRStVBU&token=vK%2BOn0o5Sfyx5%2F5mn98fbUfRFxb5pSdNgeoY8TVjLOQ%3D\\\";s:19:\\\"expiresAtMessageKey\\\";s:26:\\\"%count% hour|%count% hours\\\";s:20:\\\"expiresAtMessageData\\\";a:1:{s:7:\\\"%count%\\\";i:1;}}i:3;a:6:{i:0;N;i:1;N;i:2;N;i:3;N;i:4;a:0:{}i:5;a:2:{i:0;O:37:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\\":2:{s:46:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0headers\\\";a:3:{s:4:\\\"from\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:4:\\\"From\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:20:\\\"aureopires@gmail.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:5:\\\"Admin\\\";}}}}s:2:\\\"to\\\";a:1:{i:0;O:47:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:2:\\\"To\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:58:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\MailboxListHeader\\0addresses\\\";a:1:{i:0;O:30:\\\"Symfony\\\\Component\\\\Mime\\\\Address\\\":2:{s:39:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0address\\\";s:20:\\\"aureopires@teste.com\\\";s:36:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Address\\0name\\\";s:0:\\\"\\\";}}}}s:7:\\\"subject\\\";a:1:{i:0;O:48:\\\"Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\\":5:{s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0name\\\";s:7:\\\"Subject\\\";s:56:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lineLength\\\";i:76;s:50:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0lang\\\";N;s:53:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\AbstractHeader\\0charset\\\";s:5:\\\"utf-8\\\";s:55:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\UnstructuredHeader\\0value\\\";s:25:\\\"Please Confirm your Email\\\";}}}s:49:\\\"\\0Symfony\\\\Component\\\\Mime\\\\Header\\\\Headers\\0lineLength\\\";i:76;}i:1;N;}}i:4;N;}s:61:\\\"\\0Symfony\\\\Component\\\\Mailer\\\\Messenger\\\\SendEmailMessage\\0envelope\\\";N;}}', '[]', 'default', '2026-07-31 13:45:18', '2026-07-31 13:45:18', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext DEFAULT NULL,
  `indicative_price` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `product`
--

INSERT INTO `product` (`id`, `title`, `description`, `indicative_price`, `image`, `slug`, `is_active`, `created_at`) VALUES
(1, 'Cadre Brodé Main - Bouquet Floral', 'Magnifique cadre décoratif brodé à main levée représentant un délicat bouquet de fleurs sauvages. Réalisé sur lin naturel avec des fils de coton de haute qualité.', NULL, 'https://picsum.photos/seed/broderie1/800/600', 'cadre-brode-main-bouquet-floral', 1, '2025-01-15 11:00:00'),
(2, 'Sac Cabas Personnalisé en Toile', 'Grand sac cabas résistant en coton biologique, personnalisé avec la broderie de votre prénom ou de vos initiales. Idéal pour le shopping ou la plage.', 32, 'https://picsum.photos/seed/broderie2/800/600', 'sac-cabas-personnalise-en-toile', 1, '2025-01-18 15:30:00'),
(3, 'Retouche et Ourlet de Pantalon', 'Service de retouche professionnelle pour vos pantalons et jeans. Ajustement parfait de la longueur avec conservation de la finition dorigine.', 15, 'https://picsum.photos/seed/broderie3/800/600', 'retouche-et-ourlet-de-pantalon', 1, '2025-01-20 08:00:00'),
(4, 'Coffret Naissance Brodé', 'Ensemble personnalisé pour bébé comprenant un doudou, un bavoir et une sortie de bain, brodés au prénom du nouveau-né. Le cadeau de naissance parfait.', 65, 'https://picsum.photos/seed/broderie4/800/600', 'coffret-naissance-brode', 1, '2025-01-25 10:15:00'),
(5, 'Tablier de Cuisine Brodé Prénom', 'Tablier de cuisine robuste en mélange coton-lin, personnalisable avec un texte brodé élégant. Un cadeau idéal pour les passionnés de gastronomie.', 28, 'https://picsum.photos/seed/broderie5/800/600', 'tablier-de-cuisine-brode-prenom', 1, '2025-02-02 12:45:00'),
(6, 'Veste en Jean Personnalisée', 'Customisation de votre veste en jean avec un motif floral ou lettrage au dos brodé sur-mesure dans notre atelier.', 90, 'https://picsum.photos/seed/broderie6/800/600', 'veste-en-jean-personnalisee', 1, '2025-02-08 17:00:00');

-- --------------------------------------------------------

--
-- Estrutura para tabela `product_category`
--

CREATE TABLE `product_category` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `product_category`
--

INSERT INTO `product_category` (`product_id`, `category_id`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 2),
(6, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela `quote_request`
--

CREATE TABLE `quote_request` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `quote_request`
--

INSERT INTO `quote_request` (`id`, `name`, `email`, `message`, `status`, `created_at`, `user_id`) VALUES
(1, 'Marie Curtis', 'marie.curtis@gmail.com', 'Bonjour, jaimerais commander 15 tabliers brodés avec le logo de notre entreprise pour un événement culinaire le mois prochain. Est-il possible davoir un devis groupé ?', 'pending', '2025-02-20 10:00:00', 2),
(2, 'Lucas Bernard', 'lucas.bernard@yahoo.fr', 'Bonjour, je souhaite faire broder un blason familial complexe au dos dune veste en cuir ou en jean fournie par mes soins. Quel serait le tarif et le délai estimé ?', 'processing', '2025-02-22 15:45:00', 3),
(3, 'Sophie Martin', 'sophie.martin@hotmail.fr', 'Bonjour ! Je prépare un mariage et jaimerais des écharpes de baptême et des petits coussins dalliances personnalisés avec nos initiales et la date.', 'approved', '2025-02-25 09:30:00', 4),
(4, 'Thomas Leroy', 'thomas.leroy@outlook.com', 'Bonjour, est-il possible de réaliser une création sur mesure représentant une fresque paysagère de montagne sur un grand format en tambour ?', 'pending', '2025-02-28 14:15:00', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `review`
--

CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `content` longtext NOT NULL,
  `status` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `review`
--

INSERT INTO `review` (`id`, `content`, `status`, `rating`, `created_at`, `product_id`, `user_id`) VALUES
(1, 'Absolument magnifique ! Le cadre est accroché dans mon salon et tout le monde me fait des compliments sur les finitions.', 'approved', 5, '2025-02-03 14:10:00', 1, 2),
(2, 'Superbe qualité de broderie. Le sac est solide et le rendu des initiales est très élégant. Je recommande vivement !', 'approved', 5, '2025-02-06 18:30:00', 2, 3),
(3, 'Service rapide et soigné pour mon ourlet. On ne voit même pas que le pantalon a été retouché. Merci beaucoup !', 'approved', 4, '2025-02-11 09:00:00', 3, 4),
(4, 'Un cadeau de naissance très apprécié par les parents. Les broderies sont douces et impeccables.', 'approved', 5, '2025-02-14 11:20:00', 4, 5),
(5, 'Le tablier est de très bonne facture, le tissu ne se froisse pas trop et la broderie tient bien au lavage.', 'approved', 4, '2025-02-18 16:00:00', 5, 6);

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(180) NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `is_verified` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `user`
--

INSERT INTO `user` (`id`, `email`, `roles`, `password`, `first_name`, `last_name`, `created_at`, `is_verified`) VALUES
(1, 'admin@broderie.com', '[\"ROLE_ADMIN\"]', '$2y$13$O3tPe72Aw2KUx5VcnaeTQ.BMB44anq/Mr0BCm3cWxuQQ6h21GEcDS', 'Admin', 'Admin', '2026-03-17 21:55:15', 0),
(2, 'marie.curtis@gmail.com', '[\"ROLE_USER\"]', '$2y$13$ZuQU15lxLqQ0jzWJisJy5.oX/LNprj1cWFBjBhEU49YBrdy4Py4Cy', 'Marie', 'Curtis', '2026-03-09 19:57:57', 0),
(3, 'lucas.bernard@yahoo.fr', '[\"ROLE_USER\"]', '$2y$13$YuGfWUXO4vJfzf0sL8BoYeVr7zbZ0uaTNIe7bTRmAoI6uueUvVGQy', 'Lucas', 'Bernard', '2026-07-19 19:39:24', 0),
(4, 'sophie.martin@hotmail.fr', '[\"ROLE_USER\"]', '$2y$13$KuAusHHE9l2UYVno5EsdkOPh3lNgLxE40rei7T5nSW.3kH8ZkYUuq', 'Sophie', 'Martin', '2025-11-04 03:22:57', 0),
(5, 'thomas.leroy@outlook.com', '[\"ROLE_USER\"]', '$2y$13$mQYuJx3gK2gZQQU/T2JRm.GVFrrc2kO02MduHfqZlET86LkOYxgbK', 'Thomas', 'Leroy', '2025-09-16 22:41:15', 0),
(6, 'nicolas.melvin@gmail.com', '[\"ROLE_USER\"]', '$2y$13$qnnB4MRVupa.xlLCdY9rxOYi7gB5sTLNPATYx5wxQ2//rHK7vQM.m', 'Nicolas', 'Melvin', '2026-04-05 20:32:14', 0),
(523, 'ueichmann@example.net', '[\"ROLE_USER\"]', '$2y$13$BCcP5xuuhOLF2YOsb6ts5e0EPXrN3ARKEMe2dxihg7dNOGadsqdZS', 'Ewald', 'Purdy', '2025-09-05 22:42:15', 0),
(524, 'bcremin@example.org', '[\"ROLE_USER\"]', '$2y$13$FaIVpNCRLaF5FsQcykW67uJ3piWRIzW9/tYl6UW3fyZHHSSQjEpO6', 'Delta', 'Crist', '2026-02-01 19:18:58', 0),
(525, 'champlin.hortense@example.net', '[\"ROLE_USER\"]', '$2y$13$XFyxs5Bnz/Us6XwmQnUYOeq8UrbOTo1vMoPtmTbRObab5f/LLlr5i', 'Melvin', 'Nicolas', '2025-09-08 19:19:03', 0),
(526, 'thurman.franecki@example.com', '[\"ROLE_USER\"]', '$2y$13$hB1lTTiWfs7eE.dg7ROg5OsKkNstBNylz05iYG94F5ZUoicKjTPQO', 'Ada', 'Walker', '2026-03-26 02:23:54', 0),
(527, 'snicolas@example.org', '[\"ROLE_USER\"]', '$2y$13$dHjaOfXfs4BGRYl2ZDJzVuGCVkeRlHuuZy11vNM.22fkortsNzf36', 'Nasir', 'Feest', '2026-06-29 16:58:19', 0),
(528, 'efrain.hand@example.com', '[\"ROLE_USER\"]', '$2y$13$Q6xEBOWyhuiw8mQxkNj.BuYJyQN6Ppx1Ra/6fnh93hFn7Ff7Uq7zi', 'Eliseo', 'Pfeffer', '2026-05-31 15:55:24', 0),
(529, 'funk.stevie@example.com', '[\"ROLE_USER\"]', '$2y$13$JDndMaRAPT3cuIprukopc..rg3YpW4i8GPkUPBu8cvil1pGe2QmQ.', 'Bernadine', 'O\'Kon', '2026-07-28 16:14:21', 0),
(530, 'greg.mcclure@example.org', '[\"ROLE_USER\"]', '$2y$13$erpIapI2NNjGDR9V2pBJ4eygTTHc5r69ZrpqFlDeij8mUTp1cFitO', 'Samir', 'Schimmel', '2026-02-01 01:42:07', 0),
(531, 'gparisian@example.org', '[\"ROLE_USER\"]', '$2y$13$QRwtIbl29QZEMj8cHKS7ruo4Sg1W1XtN5LZf79xN8PpVJkYRMfVeK', 'Bernadette', 'Blick', '2025-12-28 02:16:06', 0),
(532, 'devonte.stoltenberg@example.org', '[\"ROLE_USER\"]', '$2y$13$32IxBF5q5oDEUnZgQyYwDeZJQXd42ZfGUbg.99Eo50PbSBL71E/aK', 'Emmy', 'Hackett', '2026-02-27 17:10:11', 0),
(533, 'tito.ferry@example.com', '[\"ROLE_USER\"]', '$2y$13$GcIHSQF./reHcE4VGzGtWO/DHWc5VCbx/samSMtbSLhHxbafgv/3W', 'Ubaldo', 'Wilkinson', '2026-01-01 04:37:44', 0),
(534, 'isaac67@example.org', '[\"ROLE_USER\"]', '$2y$13$egQdfD7LVmWm2fTbFP5ss.HR4I4ZzYD0BE/GOqvV2fQuLwSrd7OYS', 'Mathilde', 'Anderson', '2026-06-24 05:59:31', 0),
(535, 'vonrueden.melyssa@example.net', '[\"ROLE_USER\"]', '$2y$13$ueq5cXVqUVlqsVGyfgnBoeaNcEAaNHDMDeRUO5n08e9BS7tMYLeiq', 'Pasquale', 'Weissnat', '2026-01-02 12:32:15', 0),
(536, 'xhyatt@example.org', '[\"ROLE_USER\"]', '$2y$13$sbfLEOO36RuhMBqzEUnkk.HhX3ODL6H/p.kCk5wU6gmn11ju9wfx.', 'Ulices', 'Satterfield', '2026-02-26 01:12:01', 0),
(537, 'tromp.laverne@example.net', '[\"ROLE_USER\"]', '$2y$13$6iFEqaLJLoHOi9Gp9cjOm.FROtsW3bYXdPcpwlHwteLXYq.87tIfC', 'Gustave', 'Kihn', '2026-01-05 02:18:42', 0),
(538, 'christian.white@example.org', '[\"ROLE_USER\"]', '$2y$13$a.niAiySJp2gQWugu2jefOgbBPlePkCRwG9ll2JtVDzhyof89mPIe', 'Karlie', 'Lindgren', '2025-12-26 01:22:16', 0),
(539, 'thompson.allen@example.com', '[\"ROLE_USER\"]', '$2y$13$1GaS5A6adtimiSd3x4TaTe3.uyx4s1cJF1roONY3Q7Rz9myMWDSf6', 'Dora', 'Mayert', '2025-09-03 11:59:47', 0),
(540, 'miller.daphne@example.com', '[\"ROLE_USER\"]', '$2y$13$Sx3boxdV017fPWRnYUIVUeNzRL/kzW3uJKp/hkIpdXastLxZNmH0m', 'Mohamed', 'Morar', '2026-01-26 10:38:31', 0),
(541, 'piper.keebler@example.net', '[\"ROLE_USER\"]', '$2y$13$cgib9gDwkveWg/xdgIfYMeEEHs3o1zX3I16KHNnkZB40eOIoSCkni', 'Chadd', 'Leuschke', '2025-09-18 13:17:42', 0),
(542, 'kreichert@example.net', '[\"ROLE_USER\"]', '$2y$13$YvsaChf.yMZ3Ct8pDbgmQupA0F7Rw.wehfUJqKTuBDBjJEiuZEKGq', 'Chadrick', 'Turcotte', '2026-03-08 21:15:05', 0),
(543, 'stanton.thalia@example.com', '[\"ROLE_USER\"]', '$2y$13$UC6ZHWfJogV0s0BHtRkIPeheLrY1pztDtOROjszT4VlrdvrgUlhzS', 'Ines', 'Kshlerin', '2026-07-07 12:45:01', 0),
(544, 'cecelia.oberbrunner@example.net', '[\"ROLE_USER\"]', '$2y$13$eD/hNA0zCZeLfgh.N.tysOyc98WJepJ1WtW8GzX90qqQPt70KG5Xu', 'Gail', 'Marks', '2025-09-18 17:19:20', 0),
(545, 'deanna36@example.org', '[\"ROLE_USER\"]', '$2y$13$nfmcrWckrK8JrsFgkpm9nuBKByZJd7n5HDyna5WDgKT5OLKxuROzO', 'Nannie', 'Turcotte', '2026-05-11 19:21:32', 0),
(546, 'sean.balistreri@example.com', '[\"ROLE_USER\"]', '$2y$13$swlcyYm9iT5Xwx5VwAxAOuVFfPRj5cctfMX8JvHmoHGK2XK28QnDa', 'Alba', 'Hickle', '2025-11-17 23:25:09', 0),
(547, 'cole.santos@example.net', '[\"ROLE_USER\"]', '$2y$13$f1wNKRT92J/Fo1vKgvi1VOls37ASEYbYj9gKrhnfZHT38v3WkpEZG', 'Flavie', 'Conn', '2025-12-29 15:37:06', 0),
(548, 'hbogan@example.com', '[\"ROLE_USER\"]', '$2y$13$Qt5PPVqvWYg/xp2IvweLVe1ngYJYm/14/v2IPxB2YiHAkTM1/NI1O', 'Flossie', 'Treutel', '2026-03-15 04:57:09', 0),
(549, 'tlittel@example.com', '[\"ROLE_USER\"]', '$2y$13$LQ3jmeU.vcpSM6euEXu7iuyUtPF1/QUtjGUpksPUzu1jCo9RuRJg.', 'Andreanne', 'Weissnat', '2026-07-11 17:08:40', 0),
(550, 'gregory.gaylord@example.net', '[\"ROLE_USER\"]', '$2y$13$wbv5IZl52WpEYhfazYLbneTWhnIfopDPE91j9J/sv7qX8j2LUnHF.', 'Courtney', 'Wilkinson', '2026-02-04 13:56:53', 0),
(551, 'schaefer.stacy@example.org', '[\"ROLE_USER\"]', '$2y$13$bPz7D072K.kEa6roYlFQR.GLy.5kOwOCbojWP6MzUDCCCcS8AbqUC', 'Orin', 'Lind', '2026-01-14 18:35:57', 0),
(552, 'therese.simonis@example.org', '[\"ROLE_USER\"]', '$2y$13$.6NVBxpB2daxSbN5i3ZewuA5br4nX537Xjvs/XepQAQ3oqpVcM29q', 'Buck', 'Mills', '2025-09-20 23:38:41', 0),
(553, 'okuhn@example.org', '[\"ROLE_USER\"]', '$2y$13$KF8eQHslLz.A8cjqNrtAheEbFdrrSDKdI4nK7y6fWFx4Y1IeCr0si', 'Estel', 'Padberg', '2026-05-17 13:53:34', 0),
(554, 'strosin.jerrold@example.com', '[\"ROLE_USER\"]', '$2y$13$30cXoP1yK6APftMhdtOcR.nYyYx1Z0qD0YFkGMTJAXm6EXQEWbksa', 'Fae', 'Carter', '2026-07-04 10:39:29', 0),
(555, 'maye96@example.net', '[\"ROLE_USER\"]', '$2y$13$SiBHAcU8PaqJxNnfTjrr7uVwHiQ77KjWxCVRYIRJqvqLFvE.ESJCG', 'Antwan', 'Leffler', '2026-01-09 05:31:12', 0),
(556, 'kdickens@example.com', '[\"ROLE_USER\"]', '$2y$13$ETgwzZPbuEuuUnLrejU6A.4PE8EMJ9mgb3QV2FmTaOVs9DNyfdi1C', 'Eduardo', 'Kautzer', '2026-07-25 00:13:56', 0),
(557, 'fritz07@example.com', '[\"ROLE_USER\"]', '$2y$13$BuNYKT172LXb36I3YWOYxeXl5B1cbVQxX9yFL6zIAad354.8S9ZQe', 'Leonora', 'Green', '2026-06-22 18:45:59', 0),
(558, 'zhagenes@example.com', '[\"ROLE_USER\"]', '$2y$13$4QyKxbaP5xoeuegE8nWpgu5oLuIUl8Lj.couEzgPbSlv4PybMUa3u', 'Arne', 'Zboncak', '2026-03-08 16:30:37', 0),
(559, 'jordy.mccullough@example.net', '[\"ROLE_USER\"]', '$2y$13$RK.XWGcuxYURs/w7gCzEZOaEPXU.znWABgAB9ccB6k9zDhmXGHUL2', 'Filiberto', 'Koch', '2026-06-09 19:46:34', 0),
(560, 'ila.hills@example.com', '[\"ROLE_USER\"]', '$2y$13$LGp32nRLgx7rWX1N2L3R3OkpqDekOO9CTLCHWFr/85pfnZMsyuR8W', 'Kasey', 'Hauck', '2026-04-24 04:23:58', 0),
(561, 'ben.smitham@example.net', '[\"ROLE_USER\"]', '$2y$13$kLHhcYBQ2EvMjSwBJcXNhOuuwXv2yoYcEDzB5hgObJ51bIjOapJdi', 'Leanne', 'Pollich', '2025-08-19 21:50:34', 0),
(562, 'john.deckow@example.org', '[\"ROLE_USER\"]', '$2y$13$KLrSq2Zfkrnm9TsSWHR1GOuBzvOlvk1d/XUUtAZdrOQPoow5bNOUO', 'Cathy', 'Walker', '2025-12-18 19:16:48', 0),
(563, 'vladimir07@example.com', '[\"ROLE_USER\"]', '$2y$13$4ia.C5mn.C7oqauAZPusuO8a9kma5qLmcp3A7bJYyCj7vrb7fu3JW', 'Karine', 'Krajcik', '2026-02-21 02:27:05', 0),
(564, 'rmonahan@example.net', '[\"ROLE_USER\"]', '$2y$13$bxGyAhyvIAgXjiEAORvjvexM18qaUi.YXBJyiPzyFCXj/Huqdnj2i', 'Gage', 'Cronin', '2025-08-10 21:07:04', 0),
(565, 'crystal.crona@example.com', '[\"ROLE_USER\"]', '$2y$13$/3OarZxGHRoKtw40vvU3.uoDficojiWAxqCIm7FPf53C.79wWd1Ry', 'Janae', 'Wilkinson', '2026-04-24 13:22:34', 0),
(566, 'fschmeler@example.net', '[\"ROLE_USER\"]', '$2y$13$kMUI8L4VQuacCfptgyx/Fewq0SpnYSreQtbkpCk5R2daJ3AX4qbGK', 'Jacklyn', 'Doyle', '2026-06-03 17:48:09', 0),
(567, 'faye64@example.net', '[\"ROLE_USER\"]', '$2y$13$RLrEXVoqpFqpPJcJ2b6j.u8Cfayv4elzud/X9/d1iOy9jxzCsN/XS', 'Kamren', 'Towne', '2026-06-17 08:42:06', 0),
(568, 'aureopires@gmail.com', '[]', '$2y$13$lk1KCZG5nDZznA8bI9w8G.MlRhfO0po5yqM0to.OLMqEbgOowd7We', 'Aureo', 'RUFFIER', '2026-08-10 15:44:02', 0),
(569, 'aureopires@teste.com', '[]', '$2y$13$lPa/v8WtbOivo9s2XoEfcOsUNEU7ZVS371tHGSnAm8MWmomQp.6tW', 'Aureo', 'RUFFIER', '2026-08-11 16:31:41', 0),
(570, 'aureopires@blabla.com', '[]', '$2y$13$IHrAtqM2aY8gf2Njmgg3BOq1esi7TALricZ9Zddtf3r2keDd1P6Me', 'Aureo', 'RUFFIER', '2026-08-11 16:33:56', 0),
(571, 'aureopires@bla.com', '[]', '$2y$13$2A3Q4F7nL35S/xVdcQj8FuYRjUDxM5MY./Cvu2nAFLAEI6qjLEJw2', 'Aureo', 'RUFFIER', '2026-08-11 16:37:48', 0),
(572, 'aureopires@blba.com', '[]', '$2y$13$QFUvjlGC6GI/VTg74zukN.bKMtqAqfkhIuuJi5i4Hwcfj4BymDz4q', 'Aureo', 'RUFFIER', '2026-08-11 16:41:01', 0),
(573, 'aureopires@blbla.com', '[]', '$2y$13$qWNlzw59Iq6UgvvK8N4s4.ZK9GdYj8DjFM39HmWFuBnqTovBCZQI2', 'Aureo', 'RUFFIER', '2026-08-11 16:43:27', 0),
(574, 'aureopires@blblaaa.com', '[]', '$2y$13$R9pry7krBSxeeuIOgnjifeCCgiQnx5XGbmGkCB1XOl3IEUXmYrMgW', 'Aureo', 'RUFFIER', '2026-08-11 16:45:44', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Índices de tabela `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0E3BD61CE16BA31DBBF396750` (`queue_name`,`available_at`,`delivered_at`,`id`);

--
-- Índices de tabela `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`product_id`,`category_id`),
  ADD KEY `IDX_CDFC73564584665A` (`product_id`),
  ADD KEY `IDX_CDFC735612469DE2` (`category_id`);

--
-- Índices de tabela `quote_request`
--
ALTER TABLE `quote_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_D478271BA76ED395` (`user_id`);

--
-- Índices de tabela `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_794381C64584665A` (`product_id`),
  ADD KEY `IDX_794381C6A76ED395` (`user_id`);

--
-- Índices de tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT de tabela `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=242;

--
-- AUTO_INCREMENT de tabela `quote_request`
--
ALTER TABLE `quote_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=575;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `FK_CDFC735612469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_CDFC73564584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `quote_request`
--
ALTER TABLE `quote_request`
  ADD CONSTRAINT `FK_D478271BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Restrições para tabelas `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `FK_794381C64584665A` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_794381C6A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
