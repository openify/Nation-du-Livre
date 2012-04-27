<?php
session_start();

$project_name = basename( dirname( dirname( __FILE__ ) ) );
require_once( dirname( __FILE__ ) . '/../../Kernel/include.php' );

$project->display( );

/*
$model = new Model\coco( );
$model->id = 8;

$relation = new \Relation\Coco( );
$relation->name = 'coco';
$relation->set_index( '1' );
$relation->model = $model;
if ( $relation->init_by_id( 5 ) ) {
	print_r( $relation );
}
*/

/*
$user = new \Model\User( );
print_r( $user->all( ) );
*/

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

