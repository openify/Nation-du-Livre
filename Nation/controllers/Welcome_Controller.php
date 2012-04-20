<?php

namespace Nation;

class Welcome_Controller extends \Controller {


	/*************************************************************************
	  ACTION METHODS                   
	 *************************************************************************/
	public function view( ) {
		$var = array( );		
		$var[ 'title' ]    = 'Bienvenue';
		$var[ 'content' ]  =  'The nation to be';
		return $this->render( \View::LAYOUT_TEMPLATE, $var ); 
	}
}
