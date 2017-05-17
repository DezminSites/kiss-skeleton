<?php

//Path for module inclusion
$path = dirname(__FILE__) . '/modules/';

//General config
require $path . 'config/config.php';

//Mustache
require $path . 'mustache.php/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();

//Init Slim
$app = new \Slim\Slim(array(
    'debug' => true
));

//Init Mustache
$m = new Mustache_Engine(array(
    'cache' => dirname(__FILE__).'/cache/mustache/',
    'partials_loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__).'/modules/themes/'.$config['theme'].'/views/', array('extension' => '.html')),
));

$app->get('/',function(){
    global $m, $path, $local;
    $context = array();
//    ob_start();
//    include('./modules/xxx/rest/index.php');
//    $context = ob_get_contents(); 
//    $context = json_decode($context,true);
//    ob_get_clean();
    $tpl = file_get_contents(dirname(__FILE__).'/modules/themes/'.$local['theme'].'/views/home.html');
    $context = (array_merge($local,$context,array("title" => $local["name"])));
    echo $m->render($tpl,$context); 
});

//Include modules
$modules = $config['modules'];
foreach($modules as $module){
    include ($path . 'app_'.$module.'/index.php');
}

$app->notFound(function () {
    global $m, $local;
    $context = array();
    $tpl = file_get_contents(dirname(__FILE__).'/modules/themes/'.$local['theme'].'/views/error.html');
    $context = (array_merge($local,$context,array("title" => "Página não encontrada - " . $local["name"])));
    echo $m->render($tpl,$context); 
});
   
$app->run();