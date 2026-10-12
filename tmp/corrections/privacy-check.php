<?php
require dirname(__DIR__, 2).'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv(dirname(__DIR__, 2).'/.env');
$results = [];
foreach ([false, true] as $maintenance) {
    $_ENV['SITE_MAINTENANCE'] = $_SERVER['SITE_MAINTENANCE'] = $maintenance ? '1' : '0';
    $kernel = new App\Kernel('dev', true);
    $browser = new Symfony\Bundle\FrameworkBundle\KernelBrowser($kernel);
    $crawler = $browser->request('GET', '/confidentialite');
    if ($browser->getResponse()->getStatusCode() !== 200 || !str_contains($browser->getResponse()->getContent(), 'Oceane Roux')) {
        throw new RuntimeException('Privacy page failed.');
    }
    $results[] = ['privacyMaintenance' => $maintenance, 'status' => 200];
    if (!$maintenance) {
        file_put_contents(__DIR__.'/privacy.html', $browser->getResponse()->getContent());
        foreach (['/contact', '/quote/new', '/register'] as $url) {
            $crawler = $browser->request('GET', $url);
            if ($browser->getResponse()->getStatusCode() !== 200 || $crawler->filter('a[href="/confidentialite"]')->count() < 2) {
                throw new RuntimeException('Privacy links failed: '.$url);
            }
            $results[] = ['url' => $url, 'privacyLinks' => $crawler->filter('a[href="/confidentialite"]')->count()];
        }
    } else {
        $browser->request('GET', '/quote/new');
        if ($browser->getResponse()->getStatusCode() !== 503) {
            throw new RuntimeException('Maintenance behavior changed unexpectedly.');
        }
    }
    $kernel->shutdown();
}
file_put_contents(__DIR__.'/privacy-results.json', json_encode($results, JSON_PRETTY_PRINT));
echo json_encode($results, JSON_PRETTY_PRINT)."\n";
