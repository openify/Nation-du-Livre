<?php

require_once( dirname( __FILE__ ) . '/String.php' );

class Autoloader {


	/*************************************************************************
	  ATTRIBUTES                 
	 *************************************************************************/
	public $controllers_folder_path;
	public $models_folder_path;
	public $classes_folder_path;


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
        public function __construct( ) {
		spl_autoload_register( array( $this, 'loader' ) );
		$root_path = dirname( dirname( __FILE__ ) );
		$this->controllers_folder_path = $root_path . '/controllers/';
		$this->models_folder_path = $root_path . '/models/';
		$this->classes_folder_path = $root_path . '/classes/';
        }


	/*************************************************************************
	  PRIVATE METHODS                   
	 *************************************************************************/
        private function loader( $class_name ) {
		if ( String::ends_with( $class_name, '_Controller' ) ) {
			$file_path = $this->controllers_folder_path;
		} else if ( String::ends_with( $class_name, '_Model' ) ) {
			$file_path = $this->models_folder_path;
		} else {
			$file_path = $this->classes_folder_path;
		}
		$file_path .= $class_name . '.php';
		if ( is_file( $file_path ) ) {
			require_once( $file_path );
			return true;
		}
		throw new Exception( 'Unknown class name "' . $class_name . '"' );
	}
}
