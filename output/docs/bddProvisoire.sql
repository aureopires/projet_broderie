-- --------------------------------------------------------
-- Ficheiro SQL atualizado para popular a base de dados (db_broderie)
-- Utilizando URLs diretas/Picsum para as imagens funcionarem imediatamente no Twig
-- Tabelas incluídas: product, review, quote_request, product_category
-- --------------------------------------------------------

SET
FOREIGN_KEY_CHECKS = 0;

-- Limpa os dados das tabelas dependentes e de produtos sem tocar na tabela `user`
DELETE
FROM `db_broderie`.`review`;
DELETE
FROM `db_broderie`.`quote_request`;
DELETE
FROM `db_broderie`.`product_category`;
DELETE
FROM `db_broderie`.`product`;

-- 2. Inserir Produtos (product)
INSERT INTO `db_broderie`.`product` (`id`, `title`, `description`, `indicative_price`, `image`, `slug`, `is_active`,
                                     `created_at`)
VALUES (1, 'Cadre Brodé Main - Bouquet Floral',
        'Magnifique cadre décoratif brodé à main levée représentant un délicat bouquet de fleurs sauvages. Réalisé sur lin naturel avec des fils de coton de haute qualité.',
        45, 'https://picsum.photos/seed/broderie1/800/600', 'cadre-brode-main-bouquet-floral', 1,
        '2025-01-15 11:00:00'),
       (2, 'Sac Cabas Personnalisé en Toile',
        'Grand sac cabas résistant en coton biologique, personnalisé avec la broderie de votre prénom ou de vos initiales. Idéal pour le shopping ou la plage.',
        32, 'https://picsum.photos/seed/broderie2/800/600', 'sac-cabas-personnalise-en-toile', 1,
        '2025-01-18 15:30:00'),
       (3, 'Retouche et Ourlet de Pantalon',
        'Service de retouche professionnelle pour vos pantalons et jeans. Ajustement parfait de la longueur avec conservation de la finition dorigine.',
        15, 'https://picsum.photos/seed/broderie3/800/600', 'retouche-et-ourlet-de-pantalon', 1, '2025-01-20 08:00:00'),
       (4, 'Coffret Naissance Brodé',
        'Ensemble personnalisé pour bébé comprenant un doudou, un bavoir et une sortie de bain, brodés au prénom du nouveau-né. Le cadeau de naissance parfait.',
        65, 'https://picsum.photos/seed/broderie4/800/600', 'coffret-naissance-brode', 1, '2025-01-25 10:15:00'),
       (5, 'Tablier de Cuisine Brodé Prénom',
        'Tablier de cuisine robuste en mélange coton-lin, personnalisable avec un texte brodé élégant. Un cadeau idéal pour les passionnés de gastronomie.',
        28, 'https://picsum.photos/seed/broderie5/800/600', 'tablier-de-cuisine-brode-prenom', 1,
        '2025-02-02 12:45:00'),
       (6, 'Veste en Jean Personnalisée',
        'Customisation de votre veste en jean avec un motif floral ou lettrage au dos brodé sur-mesure dans notre atelier.',
        90, 'https://picsum.photos/seed/broderie6/800/600', 'veste-en-jean-personnalisee', 1, '2025-02-08 17:00:00');

-- 3. Associar Produtos às Categorias (product_category)
-- (Garante que cada produto aponte para uma categoria válida entre 1 e 4 que você já cadastrou)
INSERT INTO `db_broderie`.`product_category` (`product_id`, `category_id`)
VALUES (1, 1),
       (2, 2),
       (3, 3),
       (4, 4),
       (5, 2),
       (6, 4);

-- 4. Inserir Reviews (review)
INSERT INTO `db_broderie`.`review` (`id`, `content`, `status`, `rating`, `created_at`, `product_id`, `user_id`)
VALUES (1,
        'Absolument magnifique ! Le cadre est accroché dans mon salon et tout le monde me fait des compliments sur les finitions.',
        'approved', 5, '2025-02-03 14:10:00', 1, 2),
       (2,
        'Superbe qualité de broderie. Le sac est solide et le rendu des initiales est très élégant. Je recommande vivement !',
        'approved', 5, '2025-02-06 18:30:00', 2, 3),
       (3,
        'Service rapide et soigné pour mon ourlet. On ne voit même pas que le pantalon a été retouché. Merci beaucoup !',
        'approved', 4, '2025-02-11 09:00:00', 3, 4),
       (4, 'Un cadeau de naissance très apprécié par les parents. Les broderies sont douces et impeccables.',
        'approved', 5, '2025-02-14 11:20:00', 4, 5),
       (5, 'Le tablier est de très bonne facture, le tissu ne se froisse pas trop et la broderie tient bien au lavage.',
        'approved', 4, '2025-02-18 16:00:00', 5, 6);

-- 5. Inserir Pedidos de Devis / Cotação (quote_request)
INSERT INTO `db_broderie`.`quote_request` (`id`, `name`, `email`, `message`, `status`, `created_at`, `user_id`)
VALUES (1, 'Marie Curtis', 'marie.curtis@gmail.com',
        'Bonjour, jaimerais commander 15 tabliers brodés avec le logo de notre entreprise pour un événement culinaire le mois prochain. Est-il possible davoir un devis groupé ?',
        'pending', '2025-02-20 10:00:00', 2),
       (2, 'Lucas Bernard', 'lucas.bernard@yahoo.fr',
        'Bonjour, je souhaite faire broder un blason familial complexe au dos dune veste en cuir ou en jean fournie par mes soins. Quel serait le tarif et le délai estimé ?',
        'processing', '2025-02-22 15:45:00', 3),
       (3, 'Sophie Martin', 'sophie.martin@hotmail.fr',
        'Bonjour ! Je prépare un mariage et jaimerais des écharpes de baptême et des petits coussins dalliances personnalisés avec nos initiales et la date.',
        'approved', '2025-02-25 09:30:00', 4),
       (4, 'Thomas Leroy', 'thomas.leroy@outlook.com',
        'Bonjour, est-il possible de réaliser une création sur mesure représentant une fresque paysagère de montagne sur un grand format en tambour ?',
        'pending', '2025-02-28 14:15:00', 5);

SET
FOREIGN_KEY_CHECKS = 1;
