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

	public function prepublication( ) {
		if ( $_POST ) {
			$book = new Book_Model();
			$book->set('title', $_POST['title']);
			$book->set('summary', $_POST['summary']);
			$book->set('table_of_contents', $_POST['table_of_contents']);
			
			if ($book->save()){
				$title = 'Merci, votre demande va être traitée dans les plus brefs délais';
				$content = '';
			}
		} else {
			$title = 'Prepublication';
			$content = '<form method="post" action="">' .
					   '<div><label for="title">Titre:</label><input type="text" id="title" name="title" /></div>' .
					   '<div><label for="summary">Résumé:</label><input type="text" id="summary" name="summary" /></div>' .
					   '<div><label for="table_of_contents">Table des matières :</label><input type="text" id="table_of_contents" name="table_of_contents" /></div>' .
					   '<input type="submit" value="Submit" />' .
					   '</form>';
		}
		$view = new Default_View( );
		return $view->render( $title, $content );
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
			$converter->convertDocToPdf( $source, $destination );
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
