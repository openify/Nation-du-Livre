<?php

require_once( dirname( dirname( __FILE__ ) ) . '/include.php' );

$router = new Router( );
try {
	$router->auto_route( );
} catch( Exception $e ) {
	$router->route( '/error/view/404' );
}
$router->call( );
