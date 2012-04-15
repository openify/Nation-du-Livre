<?php

class Book_Controller {


	/*************************************************************************
	  ATTRIBUTES                 
	 *************************************************************************/
	private $rootDir;

	const HTML_FORMAT = 'html';
	const PDF_FORMAT  = 'pdf';


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
        public function __construct( ) {
        	$this->rootDir = getcwd();
        }


	/*************************************************************************
	  ACTION METHODS                   
	 *************************************************************************/
        public function read( $id ) {
		$view = new Default_View( );
		return $view->render( '', $this->get_html_contents( $id ) ); 
	}


	/*************************************************************************
	  PRIVATE METHODS                   
	 *************************************************************************/
	private function get_html_contents( $id ) {
		$format = self::HTML_FORMAT;
        	$destination  = $this->get_cache_destination_path( $id, $format );
		
		if ( ! is_readable( $destination ) ) {
			if ( ! is_file( $destination ) ) {
				$this->generate( $id, $format );
				if ( is_readable( $destination ) ) {
					return $this->read( $id );
				}
				throw new Exception( 'Destination not generated' );
			}
			throw new Exception( 'Destination file is not readable' );
		}
		
		$contents = file_get_contents( $destination );
		$matches = array( );
		preg_match( '/<body>(.*)<\/body>/s', $contents, $matches );
		if ( count( $matches ) < 2 ) {
			throw new Exception( 'Invalid HTML Export' );
		}
		return $matches[ 1 ];
	}
        private function generate( $id, $format ) {
        	$destination  = $this->get_cache_destination_path( $id, $format );
		$source       = $this->get_source_path( $id );

		if ( ! is_readable( $source ) ) {
			throw new Exception( 'Source file is not readable' );
		}
			
        	$converter = new File_Converter( );
        	$converter->setSource( $source );
		if ( $format == self::PDF_FORMAT ) {
	        	$converter->convertDoc( $source, $destination );
		} else {
        		$converter->convertDocToHtml( $source, $destination );
		}
	}
	private function get_cache_destination_path( $id, $format ) {
		return $this->rootDir . '/..' . File_Converter::CACHE_DIR  . '/' . $id . '/' . $id . '.' . $format;
	}
	private function get_source_path( $id ) {
		return $this->rootDir . '/..' . File_Converter::SOURCE_DIR . '/' . $id . '/' . $id . '.doc';
	}
}
