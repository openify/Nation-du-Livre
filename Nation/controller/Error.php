<?php

namespace Nation\Controller;

class Error extends \Controller {


	/*************************************************************************
	  ACTION METHODS                   
	 *************************************************************************/
        public function view( $error_code, $message ) {
		$this->view->title    = 'Error ' . $error_code;
		$this->view->content  =  '<p>' . $message . '</p>';
		$this->view->content .= '<p>Essaye <a href="http://local.nation/book/read/1" >cette url</a></p>';
		return $this->render( \View::LAYOUT_TEMPLATE ); 
	}
}
