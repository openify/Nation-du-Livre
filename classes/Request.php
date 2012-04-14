<?php

class Request {


	/*************************************************************************
	  ATTRIBUTES                 
	 *************************************************************************/
	public $path;
	public $controller;
	public $action;
	public $parameters;

	const DEFAULT_CONTROLLER = 'welcome';
	const DEFAULT_ACTION     = 'view';


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
	public function __construct( ) {
		$this->init_path( );
		$this->init_route( );
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
	private function init_route( ) {
		$url_parts = explode( '/', substr( $this->path, 1 ) );

		if ( strlen( $this->path ) == 1 ) {
			$this->controller = self::DEFAULT_CONTROLLER;
		} else {
			$this->controller = $url_parts[ 0 ];
		}

		if ( count( $url_parts ) < 2 ) {
			$this->action = self::DEFAULT_ACTION;
		} else {
			$this->action = $url_parts[ 1 ];
		}

		$this->parameters = array_slice( $url_parts, 3 );
	}
}
