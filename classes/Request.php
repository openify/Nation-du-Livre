<?php

class Request {


	/*************************************************************************
	  ATTRIBUTES                 
	 *************************************************************************/
	public $domain;
	public $path;


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
	public function __construct( ) {
		$this->init_path( );
		$this->init_url( );
	}


	/*************************************************************************
	  PUBLIC METHODS                   
	 *************************************************************************/
	public function path( ) {
		return $this->path;
	}
	public function domain( ) {
		return $this->domain;
	}
	public function url( ) {
		return $this->domain . $this->path;
	}


	/*************************************************************************
	  PRIVATE METHODS                   
	 *************************************************************************/
	private function init_path( ) {
		$path = urldecode( $_SERVER[ 'REQUEST_URI' ] );
		$path = String::substr_before( $path, '?' );
		if ( $path === '' ) {
			$path = '/';
		}
		$this->path = $path;
	}
	private function init_url( ) {
		$this->domain = $_SERVER[ 'SERVER_NAME' ];
	}
}

?>
