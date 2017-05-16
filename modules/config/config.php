<?php
//Start session
session_start();

//Config
if ($_SERVER["SERVER_NAME"] == '##localserver##') { //Development
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbname = '';
    $dbpassword = '';
} else { //Production
    $dbhost = 'localhost';
    $dbuser = '##dbuser##';
    $dbname = '##dbname##';
    $dbpassword = '##dbpass##';
}

//Define domain
define('DOMAIN', $_SERVER["HTTP_HOST"]);
define('URL', "##url##");

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
    "name" => "##name##",
    "desc" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vestibulum velit augue, vestibulum molestie justo blandit in. Curabitur ut lacus nec est sagittis vehicula. Vestibulum consectetur nisl hendrerit nulla tempor scelerisque.",
    "year" => date('Y')
);
