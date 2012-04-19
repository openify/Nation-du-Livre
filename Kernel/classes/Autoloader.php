<?php

namespace Kernel;

require_once( dirname( __FILE__ ) . '/String.php' );

class Autoloader {


	/*************************************************************************
	  ATTRIBUTES                 
	 *************************************************************************/
	public $controllers_folder_path = 'controllers/';
	public $models_folder_path      = 'models/';
	public $views_folder_path       = 'views/';
	public $classes_folder_path     = 'classes/';


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
        public function init( ) {
		spl_autoload_register( array( $this, 'loader' ) );
        }
        public function find( $class_name ) {
		$project = new Project( );
		$namespaces = $project->get( 'Files', 'Modules' );
		foreach ( $namespaces as $namespace ) {
			if ( $this->load( $namespace, $class_name ) ) {
				return '\\' . $namespace . '\\' . $class_name;
			}
		}
		throw new \Exception( 'Unknown class name "' . $class_name . '"' );
	}


	/*************************************************************************
	  PRIVATE METHODS                   
	 *************************************************************************/
        private function loader( $absolute_class_name ) {
		$class_name = String::substr_after_last( $absolute_class_name, '\\' );

		// Without Namespace
		if ( $class_name == $absolute_class_name ) {
			$absolute_class_name = $this->find( $class_name );
			class_alias( $absolute_class_name, $class_name );

		// Namespace
		} else {
			$namespace = String::substr_before_last( $absolute_class_name, '\\' );
			if ( $namespace != 'Kernel' ) {
				$project = new Project( );
				$namespaces = $project->get( 'Files', 'Modules' );
				if ( ! in_array( $namespace, $namespaces ) ) {
					throw new \Exception( 'Unknown namespace "' . $namespace . '"' );
				}
			}
		
			// Load
			if ( $this->load( $namespace, $class_name ) ) {
				return TRUE;
			}
			throw new \Exception( 'Unknown absolute class name "' . $absolute_class_name . '"' );
		}
	}
        private function load( $namespace, $class_name ) {

		// Folder
		if ( String::ends_with( $class_name, '_Controller' ) ) {
			$folder_path = $this->controllers_folder_path;
		} else if ( String::ends_with( $class_name, '_Model' ) || String::ends_with( $class_name, '_Relation' ) ) {
			$folder_path = $this->models_folder_path;
		} else if ( String::ends_with( $class_name, '_View' ) ) {
			$folder_path = $this->views_folder_path;
		} else {
			$folder_path = $this->classes_folder_path;
		}
		
		// File path
		$file_path = '../../' . $namespace . '/' . $folder_path . $class_name . '.php';
		if ( is_file( $file_path ) ) {
			require_once( $file_path );
			return TRUE;
		}
		return FALSE;
	}
}
