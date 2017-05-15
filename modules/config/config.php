<?php
//Start session
session_start();

//Config
if ($_SERVER["SERVER_NAME"] == '') { //Development
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbname = '';
    $dbpassword = '';
} else { //Production
    $dbhost = 'localhost';
    $dbuser = '';
    $dbname = '';
    $dbpassword = '';
}

//Define domain
define('DOMAIN', $_SERVER["HTTP_HOST"]);
define('URL', "");

//Max items per page
$per_page = 10;

//Path for module inclusion
$path = dirname(__FILE__) . '/../';

//Slim init
require $path . 'slim-framework/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

//Redbean init
require $path . 'redbeanphp/rb.php';

//Models
require $path . 'rb_models/models.php';

R::setup("mysql:host=$dbhost;dbname=$dbname", "$dbuser", "$dbpassword");
R::freeze( true );

//Set local
$local = array(
    "name" => ""
);
