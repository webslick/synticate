<?php
error_reporting(0);
header('Content-Type: text/html; charset=utf-8');

//=== db ==============================================|
define( 'HOST', 'localhost' );
define( 'DB', 'u0649870_centaurus' );
define( 'USERNAME', 'u0649870_centaur' );
define( 'PASS', '5R6j1F0u' );
//=====================================================|

define( 'SITE', "https://centaurus-art.com" );
define( 'LIB', $_SERVER['DOCUMENT_ROOT']."/lib/" );
define( 'CONTROLLERS', $_SERVER['DOCUMENT_ROOT']."/controllers/" );
define( 'MODELS', $_SERVER['DOCUMENT_ROOT']."/models/" );
define( 'VIEWS', $_SERVER['DOCUMENT_ROOT']."/views/" );
define( 'WEB', $_SERVER['DOCUMENT_ROOT']."/web/" );
define( 'DEFAULT_LAYOUT', VIEWS."layout/main.php" );

function autoloader($className) {
    include LIB.'class.'.$className.'.php';
}
spl_autoload_register('autoloader');

            //session_start();
            //print_r($_SESSION);
$router = new Route();
$router->run( $_SERVER['REQUEST_URI'] );

?>


