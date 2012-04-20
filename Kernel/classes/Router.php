<?php

namespace Kernel;

class Router {


	/*************************************************************************
	  ATTRIBUTES                 
	 *************************************************************************/
	public $route;
	public $controller;
	public $action;
	public $parameters;

	const DEFAULT_CONTROLLER = 'welcome';
	const DEFAULT_ACTION     = 'view';


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
	public function __construct( ) {
	}


	/*************************************************************************
	  PUBLIC METHODS                   
	 *************************************************************************/
	public function auto_route( ) {
		$this->init_route( );
		$this->init_route_action( );
	}
	public function route( $route ) {
		$this->route = $route;
		$this->init_route_action( );
	}
	public function call( ) {
		return call_user_func_array( $this->callable_action( ), $this->parameters );
	}


	/*************************************************************************
	  PRIVATE METHODS                   
	 *************************************************************************/
	private function init_route( ) {
		$route = urldecode( $_SERVER[ 'REQUEST_URI' ] );
		$route = String::substr_before( $route, '?' );
		if ( $route === '' ) {
			$route = '/';
		}
		$this->route = $route;
	}
	private function init_route_action( ) {
		$autoloader = new Autoloader();
		$url_parts = explode( '/', substr( $this->route, 1 ) );

		// Controller
		if ( strlen( $this->route ) == 1 ) {
			$controller_name = self::DEFAULT_CONTROLLER;
		} else {
			$controller_name = $url_parts[ 0 ];
		}
		try {		
			$controller_name = ucfirst( $controller_name ) . '_Controller';
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
		if ( ! is_callable( $this->callable_action( ) ) ) {
			throw new Exception( 'Unknown controller\'s action "' . $controller_name . '::' . $this->action .'"' );
		}

		$this->parameters = array_slice( $url_parts, 2 );
	}
	private function callable_action( ) {
		return array( $this->controller, $this->action );
	}
}
