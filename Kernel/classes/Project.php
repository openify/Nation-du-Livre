<?php

namespace Kernel;

class Project {


	/*************************************************************************
	 ATTRIBUTES
	 *************************************************************************/
	static public $conf;


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
	public function __construct( ) {
	}
	public function init( ) {
		self::$conf = parse_ini_file( '../conf/project.ini', true );
	}


	/*************************************************************************
	  PUBLIC METHODS                   
	 *************************************************************************/
	public function get( $section, $property ) {
		if ( ! $this->has( $section, $property ) ) {
			return FALSE;
		}
		return self::$conf[ $section ][ $property ];
	}
	public function has( $section, $property ) {
		return isset( self::$conf[ $section ][ $property ] );
	}
}
