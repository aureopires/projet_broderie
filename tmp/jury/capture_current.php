<?php
require dirname(__DIR__, 2).'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv(dirname(__DIR__, 2).'/.env');
$_ENV['SITE_MAINTENANCE'] = $_SERVER['SITE_MAINTENANCE'] = '0';
class DossierCaptureKernel extends App\Kernel
{
    public function getCacheDir(): string { return __DIR__.'/cache'; }
    public function getLogDir(): string { return __DIR__.'/logs'; }
    protected function build(Symfony\Component\DependencyInjection\ContainerBuilder $container): void
    {
        parent::build($container);
        $container->addCompilerPass(new class implements Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface {
            public function process(Symfony\Component\DependencyInjection\ContainerBuilder $container): void
            {
                foreach (['security.untracked_token_storage', 'session.factory'] as $id) {
                    if ($container->hasDefinition($id) || $container->hasAlias($id)) $container->findDefinition($id)->setPublic(true);
                }
            }
        });
    }
}
$kernel = new DossierCaptureKernel('dev', true);
$browser = new Symfony\Bundle\FrameworkBundle\KernelBrowser($kernel);
$browser->disableReboot();
$kernel->boot();
$manager = $kernel->getContainer()->get('doctrine')->getManager();
$product = $manager->getRepository(App\Entity\Product::class)->findOneBy(['isActive'=>true]);
$category = $product->getCategories()->first();
$quote = $manager->getRepository(App\Entity\QuoteRequest::class)->findOneBy([], ['createdAt'=>'DESC']);
$admin = null;
foreach ($manager->getRepository(App\Entity\User::class)->findAll() as $user) {
    if (in_array('ROLE_ADMIN', $user->getRoles(), true)) {$admin = $user;break;}
}
if (!$admin || !$quote || !$category) throw new RuntimeException('Missing demonstration records.');
$productId=$product->getId();$quoteId=$quote->getId();
$routes=['home'=>'/','gallery'=>'/product','product'=>'/product/'.$product->getSlug(),'category'=>'/category/'.$category->getSlug(),'quote'=>'/quote/new','login'=>'/login','register'=>'/register','privacy'=>'/confidentialite'];
foreach($routes as $name=>$url){
    $browser->request('GET',$url);
    if($browser->getResponse()->getStatusCode()!==200)throw new RuntimeException('Capture failed '.$name);
    file_put_contents(__DIR__.'/'.$name.'.html',$browser->getResponse()->getContent());
}
$admin=$manager->getRepository(App\Entity\User::class)->find($admin->getId());
$browser->loginUser($admin);
foreach(['dashboard'=>'/admin','admin-products'=>'/admin/product','admin-quote'=>'/admin/quote/'.$quoteId,'admin-quotes'=>'/admin/quote','admin-reviews'=>'/admin/review','admin-edit-product'=>'/admin/product/'.$productId.'/edit'] as $name=>$url){
    $browser->request('GET',$url);
    if($browser->getResponse()->getStatusCode()!==200)throw new RuntimeException('Capture failed '.$name);
    file_put_contents(__DIR__.'/'.$name.'.html',$browser->getResponse()->getContent());
}
echo "14 current pages captured through GET requests. No database writes or mail sent.\n";
