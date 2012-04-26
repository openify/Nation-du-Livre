<?php

namespace Nation\Controller;

class Welcome extends \Controller {


	/*************************************************************************
	 ATTRIBUTES
	 *************************************************************************/
	public $default_action = 'view';


	/*************************************************************************
	  ACTION METHODS                   
	 *************************************************************************/
	public function view( ) {
		$this->view->title   = 'Bienvenue';
		$this->view->content = 'The nation to be';
		return $this->render( \View::LAYOUT_TEMPLATE ); 
	}
}
