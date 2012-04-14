<?php

class Autoloader {


	/*************************************************************************
	  ATTRIBUTES                 
	 *************************************************************************/
	public $classes_folder_path;


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
        public function __construct( ) {
		spl_autoload_register( array( $this, 'loader' ) );
		$this->classes_folder_path = dirname( __FILE__ ) . '/';
        }


	/*************************************************************************
	  PRIVATE METHODS                   
	 *************************************************************************/
        private function loader( $class_name ) {
		$file_path = $this->classes_folder_path . $class_name . '.php';
		if ( is_file( $file_path ) ) {
			require_once( $file_path );
			return true;
		}
		throw new Exception( 'Unknown class name "' . $class_name . '"' );
	}
}
