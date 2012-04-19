<?php

class Error_Controller extends Controller {


	/*************************************************************************
	  ACTION METHODS                   
	 *************************************************************************/
        public function view( $error_code, $message ) {
		$var = array( );		
		$var[ 'title' ]    = 'Error ' . $error_code;
		$var[ 'content' ]  =  '<p>' . $message . '</p>';
		$var[ 'content' ] .= '<p>Essaye <a href="http://local.nation/book/read/1" >cette url</a></p>';
		return $this->render( View::LAYOUT_TEMPLATE, $var ); 
	}
}
