<?php

require_once( dirname( dirname( __FILE__ ) ) . '/include.php' );

try {
	$router = new Router( );
	$router->call( );
} catch( Exception $e ) {
	echo '<h1>Error 500</h1>';
	echo 'Essaye l\'url http://local.nation/book/read/1';
	echo $e->getMessage();
}
