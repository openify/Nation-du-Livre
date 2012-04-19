<?php

namespace Kernel;

require_once( dirname( __FILE__ ) . '/String.php' );

class Autoloader {


	/*************************************************************************
	  ATTRIBUTES                 
	 *************************************************************************/
	public $controllers_folder_path;
	public $models_folder_path;
	public $views_folder_path;
	public $classes_folder_path;
	public $root_paths = array( );


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
        public function __construct( ) {
		spl_autoload_register( array( $this, 'loader' ) );
		$this->root_paths[ ] = dirname( dirname( __FILE__ ) ) . '/';
		$this->root_paths[ ] = '../';
		$this->controllers_folder_path = 'controllers/';
		$this->models_folder_path      = 'models/';
		$this->views_folder_path       = 'views/';
		$this->classes_folder_path     = 'classes/';
        }


	/*************************************************************************
	  PRIVATE METHODS                   
	 *************************************************************************/
        private function loader( $absolute_class_name ) {
		$class_name = String::substr_after_last( $absolute_class_name, '\\' );
		if ( String::ends_with( $class_name, '_Controller' ) ) {
			$folder_path = $this->controllers_folder_path;
		} else if ( String::ends_with( $class_name, '_Model' ) || String::ends_with( $class_name, '_Relation' ) ) {
			$folder_path = $this->models_folder_path;
		} else if ( String::ends_with( $class_name, '_View' ) ) {
			$folder_path = $this->views_folder_path;
		} else {
			$folder_path = $this->classes_folder_path;
		}
		foreach ( $this->root_paths as $root_path ) {
			$file_path = $root_path . $folder_path . $class_name . '.php';
			if ( is_file( $file_path ) ) {
				require_once( $file_path );
				return true;
			}
		}
		throw new \Exception( 'Unknown class name "' . $absolute_class_name . '"' );
	}
}
