<?php
session_start();

require_once( dirname( __FILE__ ) . '/../../include.php' );

\Kernel\Database_Request::$database_driver = 'mysql';
\Kernel\Database_Request::$database_host = 'localhost';
\Kernel\Database_Request::$database_name = 'nation';
\Kernel\Database_Request::$database_user = 'root';
\Kernel\Database_Request::$database_password = 'password';

$router = new \Kernel\Router( );
try {
	$router->auto_route( );
} catch( Exception $e ) {
	$router->route( '/error/view' );
	$router->parameters = array( '404', $e->getMessage( ) );
}

try {
	echo $router->call( );
} catch( Exception $e ) {
	$router->route( '/error/view' );
	$router->parameters = array( '500', $e->getMessage( ) );
	echo $router->call( );
}


