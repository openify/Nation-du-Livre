<?php

class Error_Controller {


	/*************************************************************************
	  ACTION METHODS                   
	 *************************************************************************/
        public function view( $error_code ) {
		echo '<h1>Error ' . $error_code . '</h1>';
		echo 'Essaye <a href="http://local.nation/book/read/1" >cette url</a>';
	}
}
