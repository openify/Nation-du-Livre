<?php

namespace Kernel;

class View {


	/*************************************************************************
	 ATTRIBUTES
	 *************************************************************************/
	const LAYOUT_TEMPLATE = 'layout.html';


	/*************************************************************************
	  PUBLIC METHODS                   
	 *************************************************************************/
	public function render( $template_name, $var ) {
		$template_path = $this->find_template( $template_name );
		ob_start();		
		require( $template_path );
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}


	/*************************************************************************
	  PRIVATE METHODS                   
	 *************************************************************************/
	protected function find_template( $template_name ) {
		$project = new Project( );
		$namespaces = $project->get( 'Files', 'Modules' );
		foreach ( $namespaces as $namespace ) {
			$template_path = '../../' . $namespace . '/views/' . $template_name;
			if ( file_exists( $template_path ) ) {
				return $template_path;
			}
		}
		throw new \Exception( 'Unknown template name "' . $template_name . '"' );
	}
}
