<?php
require dirname(__DIR__,2).'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv(dirname(__DIR__,2).'/.env');
$_ENV['SITE_MAINTENANCE']=$_SERVER['SITE_MAINTENANCE']='0'; putenv('SITE_MAINTENANCE=0');
$kernel=new App\Kernel('dev',true);
$client=new Symfony\Bundle\FrameworkBundle\KernelBrowser($kernel);
$results=[];
foreach (['home'=>'/','gallery'=>'/product','quote'=>'/quote/new','login'=>'/login','admin'=>'/admin','review'=>'/review/new','missing'=>'/product/dossier-inexistant','category'=>'/product/category/broderie-personnalisee'] as $name=>$url){
 $client->request('GET',$url); $response=$client->getResponse();
 $results[$name]=['path'=>$url,'status'=>$response->getStatusCode()];
 if(in_array($name,['home','gallery','quote','login'])) file_put_contents(__DIR__.'/'.$name.'.html',$response->getContent());
}
file_put_contents(__DIR__.'/http-results.json',json_encode($results,JSON_PRETTY_PRINT));
echo json_encode($results,JSON_PRETTY_PRINT);
