<?php

define('ROOT', dirname(__DIR__));
require ROOT . '/Core/App.class.php';
require ROOT. '/Vendor/autoload.php';
define('BASE_URL', App::getBaseUrl() );

App::initialize();
$app = App::getInstance();

if($_GET['url'] == ''){ $_GET['url'] = App::getDefaultRoute(); }
$router = new Core\Router\Router($_GET['url']);

App::loadBundles();

$router->addXMLRoutingFile(BASE_URL . '/Config/Routing.xml');

if( $router->match() ){
    $router->execute();
}else{
    echo "erreur 404";
    $router->exception('404');
}