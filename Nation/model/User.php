<?php

namespace Nation\Model;

class User extends \Provi\Model\User {


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
	public function __construct( ) {
		parent::__construct( );
		// TODO
		// $this->add_attribute_relation( 'books', 'user', 'book', new \Users_Books_Relation( ) );
	}
}


