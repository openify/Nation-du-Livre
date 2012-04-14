<?php

class Error_Controller {


	/*************************************************************************
	  ACTION METHODS                   
	 *************************************************************************/
        public function view( $error_code, $message ) {
		$content =  '<p>' . $message . '</p>';
		$content .= '<p>Essaye <a href="http://local.nation/book/read/1" >cette url</a></p>';
		$view = new Default_View( );
		return $view->render( 'Error ' . $error_code, $content ); 
	}
}
