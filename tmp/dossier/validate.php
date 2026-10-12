<?php
require dirname(__DIR__,2).'/vendor/autoload.php';
(new Symfony\Component\Dotenv\Dotenv())->bootEnv(dirname(__DIR__,2).'/.env');
$_ENV['SITE_MAINTENANCE']=$_SERVER['SITE_MAINTENANCE']='0';
$kernel=new App\Kernel('test',true); $kernel->boot();
$factory=$kernel->getContainer()->get('test.service_container')->get('form.factory');
$base=['articleType'=>'Polo','articleOrigin'=>'client','markingType'=>'broderie','quantity'=>12,'firstName'=>'Camille','lastName'=>'Exemple','organizationType'=>'association','organizationName'=>'Association exemple','email'=>'camille@example.test','phone'=>'0600000000','message'=>'Douze polos avec un motif fourni.'];
$cases=['valide'=>$base,'quantite_zero'=>array_replace($base,['quantity'=>0]),'choix_inconnu'=>array_replace($base,['markingType'=>'inconnu']),'email_invalide'=>array_replace($base,['email'=>'invalide']),'prenom_vide'=>array_replace($base,['firstName'=>''])];
$out=[];
foreach($cases as $name=>$data){$q=new App\Entity\QuoteRequest();$f=$factory->create(App\Form\QuoteRequestType::class,$q,['csrf_protection'=>false]);$f->submit($data);$errors=[];foreach($f->getErrors(true) as $e)$errors[]=$e->getOrigin()->getName().': '.$e->getMessage();$out[$name]=['valid'=>$f->isValid(),'errors'=>$errors];}
foreach(['new','processing','finished','approved'] as $s){try{(new App\Entity\QuoteRequest())->setStatus($s);$out['status_'.$s]='accepted';}catch(InvalidArgumentException $e){$out['status_'.$s]='rejected';}}
file_put_contents(__DIR__.'/form-results.json',json_encode($out,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE));echo json_encode($out,JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE);

