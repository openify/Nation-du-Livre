<?php

class Router {


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
	  PUBLIC METHODS                   
	 *************************************************************************/
	public function call( ) {
		call_user_func_array( array( $this->controller, $this->action ), $this->parameters );
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

		// Controller
		if ( strlen( $this->path ) == 1 ) {
			$controller_name = self::DEFAULT_CONTROLLER;
		} else {
			$controller_name = $url_parts[ 0 ];
		}
		$controller_name = ucfirst( $controller_name ) . '_Controller';
		try {		
			$this->controller = new $controller_name( );
		} catch ( Exception $e ) {
			throw new Exception( 'Unknown controller "' . $controller_name . '"' );
		}

		// Action
		if ( count( $url_parts ) < 2 ) {
			$this->action = self::DEFAULT_ACTION;
		} else {
			$this->action = $url_parts[ 1 ];
		}
		/*if ( method_exists( $this->controller, $this->action ) ) {
			throw new Exception( 'Unknown controller\'s action "' . $controller_name . '::' . $this->action .'"' );
		}*/

		$this->parameters = array_slice( $url_parts, 2 );
	}
}
