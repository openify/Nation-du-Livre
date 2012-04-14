<?php

class Error_Controller {


	/*************************************************************************
	  ACTION METHODS                   
	 *************************************************************************/
        public function view( $error_code, $message ) {
		echo '<h1>Error ' . $error_code . '</h1>';
		echo '<p>' . $message . '</p>';
		echo '<p>Essaye <a href="http://local.nation/book/read/1" >cette url</a></p>';
	}
}
