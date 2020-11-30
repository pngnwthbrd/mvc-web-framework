<?php

@ini_set('display_errors', true);
error_reporting(E_ALL);

require '../Vendor/Smarty/smarty/libs/Smarty.class.php';
require '../Services/Factories/AutoloaderFactory.php';

use Services\Factories\AutoloaderFactory;
use Services\Factories\RouterFactory;
use Types\Factories\TypeFactory;

$autoloader = AutoloaderFactory::create("Autoloader");
$autoloader->register();

//register_shutdown_function([new application\services\ErrorHandler(), 'shutdown']);
//set_error_handler([new application\services\ErrorHandler(), 'handleError']);

$session = new Services\Session();

/*
if ($session->get('id_user') !== false) {
    $uri = $_SERVER['REQUEST_URI'];
} else {
    $uri = 'login';
}
*/

// below following testing only


$router = RouterFactory::create("Router");

require '../includes/routes.php';

function test(Types\Interfaces\TypeInterface $arg)
{
    //var_dump($arg->getProperty('firstname'));
}

$user_t = TypeFactory::create("UserType");
$user_t->setProperty('firstname', 'Hannelore');
test($user_t);

$uri = $_SERVER['REQUEST_URI'];
die($router->run($uri, $_REQUEST));