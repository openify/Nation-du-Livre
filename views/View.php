<?php

class View {


	/*************************************************************************
	 ATTRIBUTES
	 *************************************************************************/
	const LAYOUT_TEMPLATE = '../views/layout.html';


	/*************************************************************************
	  ACTION METHODS                   
	 *************************************************************************/
	public function render( $template, $var ) {
		ob_start();		
		require( $template );
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
}
