<?php

namespace Nation;

class Welcome_Controller extends \Kernel\Controller {


	/*************************************************************************
	  ACTION METHODS                   
	 *************************************************************************/
	public function view( ) {
		$var = array( );		
		$var[ 'title' ]    = 'Bienvenue';
		$var[ 'content' ]  =  'The nation to be';
		return $this->render( \Kernel\View::LAYOUT_TEMPLATE, $var ); 
	}
}
