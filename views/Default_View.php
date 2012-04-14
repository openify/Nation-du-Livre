<?php

class Default_View {


	/*************************************************************************
	  ACTION METHODS                   
	 *************************************************************************/
	public function render( $title, $content ) {
		ob_start();		
		require( dirname( __FILE__ ) . '/default.html' );
		$html = ob_get_contents();
		ob_end_clean();
		return $html;
	}
}
