<?php

class Welcome_Controller {


	/*************************************************************************
	  ACTION METHODS                   
	 *************************************************************************/
	public function view( ) {
		$view = new Default_View( );
		return $view->render( 'Bienvenue', 'The nation to be' ); 
	}
}