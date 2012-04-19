<?php

require_once( dirname( __FILE__) . '/Kernel/classes/Autoloader.php' );

$autoloader = new \Kernel\Autoloader();
$autoloader->init( );

$project = new \Kernel\Project( );
$project->init( );

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

