<?php

namespace Nation\Object;

class File_Converter {


	/*************************************************************************
	 ATTRIBUTES
	 *************************************************************************/
	private $fileSource;

	const SOURCE_DIR	= '/books';
	const CACHE_DIR		= '/caches';
	const CONVERTER		= '/usr/bin/abiword';


	/*************************************************************************
	 PUBLIC METHODS
	 *************************************************************************/
	public function setSource( $filename ) {
		$this->fileSource = $filename ;
	}

	public function convertDocToHtml($source, $destination) {
		$this->convertDoc($source, $destination);
	}

	public function convertDocToPdf($source, $destination) {
		$this->convertDoc($source, $destination);
	}




	/*************************************************************************
	 PRIVATE METHODS
	 *************************************************************************/
	/*
	 * Convert a .doc
	 */
	protected function convertDoc($source, $destination ) {
		$ext = pathinfo($destination, PATHINFO_EXTENSION);

		if ( $ext == 'html' ) {
			$this->execute( $source, $destination );
		}
		elseif ( $ext == 'pdf' ) {
			$this->execute( $source, $destination );
		}
		else{
			throw new \Exception( 'Unknown format ' . $ext );
		}
	}

	protected function execute($source, $destination){
		$ext     = pathinfo( $destination, PATHINFO_EXTENSION );
		$dirname = pathinfo( $destination, PATHINFO_DIRNAME );
		if ( ! is_dir( $dirname ) ) {
			mkdir( $dirname );
		}
		$cmd = self::CONVERTER." --to=$ext --to-name=$destination $source";
		return shell_exec($cmd);
	}
}
