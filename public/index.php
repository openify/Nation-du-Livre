<?php

require_once( dirname( dirname( __FILE__ ) ) . '/include.php' );

Database_Request::$database_driver = 'mysql';
Database_Request::$database_host = 'localhost';
Database_Request::$database_name = 'nation';
Database_Request::$database_user = 'root';
Database_Request::$database_password = 'password';

$router = new Router( );
try {
	$router->auto_route( );
} catch( Exception $e ) {
	$router->route( '/error/view' );
	$router->parameters = array( '404', $e->getMessage( ) );
}

try {
	$router->call( );
} catch( Exception $e ) {
	$router->route( '/error/view' );
	$router->parameters = array( '500', $e->getMessage( ) );
}


