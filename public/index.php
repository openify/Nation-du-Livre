<?php

require_once( dirname( dirname( __FILE__ ) ) . '/include.php' );

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
