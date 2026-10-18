<?php
require dirname(__DIR__, 2).'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv(dirname(__DIR__, 2).'/.env');
$_ENV['DATABASE_URL'] = $_SERVER['DATABASE_URL'] = 'sqlite:///:memory:';
$_ENV['SITE_MAINTENANCE'] = $_SERVER['SITE_MAINTENANCE'] = '0';
$_ENV['APP_EMAIL_ENABLED'] = $_SERVER['APP_EMAIL_ENABLED'] = '0';
$kernel = new App\Kernel('test', true);
$browser = new Symfony\Bundle\FrameworkBundle\KernelBrowser($kernel);
$browser->disableReboot();
$kernel->boot();
$em = $kernel->getContainer()->get('test.service_container')->get(Doctrine\ORM\EntityManagerInterface::class);
$params = $em->getConnection()->getParams();
if (($params['driver'] ?? '') !== 'pdo_sqlite' || empty($params['memory'])) throw new RuntimeException('Non-isolated database refused.');
(new Doctrine\ORM\Tools\SchemaTool($em))->createSchema($em->getMetadataFactory()->getAllMetadata());
$admin = (new App\Entity\User())->setEmail('admin@example.test')->setFirstName('Compte')->setLastName('Démonstration')->setRoles(['ROLE_ADMIN'])->setPassword('demonstration-hash')->setIsVerified(true);
$user = (new App\Entity\User())->setEmail('camille@example.test')->setFirstName('Camille')->setLastName('Exemple')->setPassword('demonstration-hash')->setIsVerified(true);
$em->persist($admin);$em->persist($user);
$category = (new App\Entity\Category())->setName('Broderie personnalisée')->setSlug('broderie-personnalisee')->setDescription('Une sélection de réalisations personnalisées pour les particuliers et les associations.');
$em->persist($category);
$html = file_get_contents(dirname(__DIR__).'/corrections/gallery.html');
preg_match_all('~src="/uploads/products/([^"\s]+)"~', $html, $matches);
$images = array_values(array_unique($matches[1]));
$products = [];
foreach (['Veste en jean personnalisée', 'Tablier de cuisine brodé', 'Coffret de naissance brodé'] as $i => $title) {
    $product = (new App\Entity\Product())->setTitle($title)->setSlug('realisation-'.($i+1))->setDescription('Exemple de réalisation personnalisée. Le motif et les couleurs peuvent être adaptés au projet du client.')->setIsActive(true)->setCreatedAt(new DateTimeImmutable('2026-10-12'))->setIndicativePrice([90,28,65][$i])->setImage($images[$i] ?? null)->addCategory($category);
    $em->persist($product);$products[] = $product;
}
$quote = (new App\Entity\QuoteRequest())->setName('Camille Exemple')->setEmail('camille@example.test')->setMessage('Douze polos pour une association avec un logo brodé sur le côté gauche.')->setArticleType('Polo')->setArticleOrigin('client')->setMarkingType('broderie')->setQuantity(12)->setOrganizationType('association')->setOrganizationName('Association Exemple')->setPhone('0600000000')->setStatus('new')->setCreatedAt(new DateTimeImmutable('2026-10-12 10:00:00'));
$em->persist($quote);
$review = (new App\Entity\Review())->setContent('Une réalisation soignée et une bonne écoute pour notre projet.')->setRating(5)->setStatus('approved')->setUser($user)->setProduct($products[0])->setCreatedAt(new DateTimeImmutable('2026-10-12'));
$em->persist($review);$em->flush();
$quoteId = $quote->getId();$productId = $products[0]->getId();
$routes = ['home'=>'/','gallery'=>'/product','product'=>'/product/realisation-1','category'=>'/category/broderie-personnalisee','quote'=>'/quote/new','login'=>'/login','register'=>'/register','privacy'=>'/confidentialite'];
foreach ($routes as $name => $url) {
    $browser->request('GET', $url);
    if ($browser->getResponse()->getStatusCode() !== 200) throw new RuntimeException('Capture failed '.$name);
    file_put_contents(__DIR__.'/'.$name.'.html', $browser->getResponse()->getContent());
}
$admin = $em->getRepository(App\Entity\User::class)->findOneBy(['email'=>'admin@example.test']);
$browser->loginUser($admin);
foreach (['dashboard'=>'/admin','admin-products'=>'/admin/product','admin-quote'=>'/admin/quote/'.$quoteId,'admin-quotes'=>'/admin/quote','admin-reviews'=>'/admin/review','admin-edit-product'=>'/admin/product/'.$productId.'/edit'] as $name => $url) {
    $browser->request('GET', $url);
    if ($browser->getResponse()->getStatusCode() !== 200) throw new RuntimeException('Capture failed '.$name);
    file_put_contents(__DIR__.'/'.$name.'.html', $browser->getResponse()->getContent());
}
echo "14 pages generated with fictional data in isolated SQLite memory; production and development database untouched.\n";
