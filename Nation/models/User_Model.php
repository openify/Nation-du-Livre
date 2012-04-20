<?php

namespace Nation;

class User_Model extends \Provi\User_Model {


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
	public function __construct( ) {
		parent::__construct( );
		$this->add_attribute_relation( 'books', 'user', 'book', new Users_Books_Relation( ) );
	}
}


