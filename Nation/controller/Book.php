<?php

namespace Nation\Controller;

class Book extends \Controller {


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
		parent::__construct( );
		$this->rootDir = getcwd( );
	}


	/*************************************************************************
	 ACTION METHODS
	 *************************************************************************/
	public function read( $id ) {
		$this->view->content  =  $this->get_html_contents( $id );
		return $this->render( \View::LAYOUT_TEMPLATE ); 
	}

	public function prepublication( ) {

		// Validation
		if ( isset( $_POST[ 'title' ] ) ) {
			$book = new \Model\Book();
			$book->set('title', $_POST['title']);
			$book->set('summary', $_POST['summary']);
			$book->set('table_of_contents', $_POST['table_of_contents']);
			if ( $book->save( ) ){
				$this->view->title = 'Merci, votre demande va être traitée dans les plus brefs délais';
			}

		// Formulaire
		} else {
			$this->view->title = 'Prepublication';
			$this->view->content = $this->render( 'book_prepublication_form.html' ); 
		}		
		return $this->render( \View::LAYOUT_TEMPLATE ); 
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
					return $this->get_html_contents( $id );
				}
				throw new \Exception( 'Destination not generated' );
			}
			throw new \Exception( 'Destination file is not readable' );
		}

		$contents = file_get_contents( $destination );
		$matches = array( );
		preg_match( '/<body>(.*)<\/body>/s', $contents, $matches );
		if ( count( $matches ) < 2 ) {
			throw new \Exception( 'Invalid HTML Export' );
		}
		return $matches[ 1 ];
	}
	private function generate( $id, $format ) {
		$destination  = $this->get_cache_destination_path( $id, $format );
		$source       = $this->get_source_path( $id );

		if ( ! is_readable( $source ) ) {
			throw new \Exception( 'Source file is not readable' );
		}

		$converter = new File_Converter( );
		$converter->setSource( $source );
		if ( $format == self::PDF_FORMAT ) {
			$converter->convertDocToPdf( $source, $destination );
		} else {
			$converter->convertDocToHtml( $source, $destination );
		}
	}
	private function get_cache_destination_path( $id, $format ) {
		return $this->rootDir . '/..' . \File_Converter::CACHE_DIR  . '/' . $id . '/' . $id . '.' . $format;
	}
	private function get_source_path( $id ) {
		return $this->rootDir . '/..' . \File_Converter::SOURCE_DIR . '/' . $id . '/' . $id . '.doc';
	}
}
