<?php

class Book_Controller {


	/*************************************************************************
	  ATTRIBUTES                 
	 *************************************************************************/
	private $rootDir;

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
			$source = $this->rootDir.'/..'.File_Converter::SOURCE_DIR.'/'.$id.'/'.$id.'.doc';
			$destination = $this->rootDir.'/..'.File_Converter::CACHE_DIR.'/'.$id.'/'.$id;
			
			
			if (!is_readable($source)){
				throw new Exception('File is not readable');
			}
			
        	$converter = new File_Converter();
        	$converter->setSource($source);
        	
        	$toPDF = $destination.'.pdf';
        	$toHTML = $destination.'.html';
        	
        	$converter->convertDocToHtml($source, $toHTML);
        	$converter->convertDocToPdf($source, $toPDF);
	}
}
