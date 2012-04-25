<?php
session_start();

$project_name = basename( dirname( dirname( __FILE__ ) ) );
require_once( dirname( __FILE__ ) . '/../../Kernel/include.php' );

$project->display( );

/*
$article = new \Model\Article( );
if ( $article->init_by_id( '11' ) ) {
	$article->delete( );
} else {
	$article->titre = 'Essai';
	$article->save( );
}

$login = 'Sylvain &é"è&-é(_&éç_è trop fort';
$sylvain = new \Model\User( );
if ( $sylvain->init_by_login( $login ) ) {
	$sylvain->delete( );
} else {
	$sylvain->login = $login;
	$sylvain->save( );
}
*/

