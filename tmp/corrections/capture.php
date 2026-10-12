<?php
require dirname(__DIR__, 2).'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv(dirname(__DIR__, 2).'/.env');
$_ENV['SITE_MAINTENANCE'] = $_SERVER['SITE_MAINTENANCE'] = '0';
$browser = new Symfony\Bundle\FrameworkBundle\KernelBrowser(new App\Kernel('dev', true));
foreach (['quote' => '/quote/new', 'contact' => '/contact', 'gallery' => '/product'] as $name => $url) {
    $crawler = $browser->request('GET', $url);
    if ($browser->getResponse()->getStatusCode() !== 200) {
        throw new RuntimeException('Capture failed: '.$name);
    }
    file_put_contents(__DIR__.'/'.$name.'.html', $browser->getResponse()->getContent());
    if ($name === 'gallery') {
        $productUrl = $crawler->filter('.product-card a')->first()->attr('href');
        $browser->request('GET', $productUrl);
        if ($browser->getResponse()->getStatusCode() !== 200) {
            throw new RuntimeException('Product capture failed.');
        }
        file_put_contents(__DIR__.'/product.html', $browser->getResponse()->getContent());
    }
}
echo "4 pages locales capturées sans modifier les données.\n";
