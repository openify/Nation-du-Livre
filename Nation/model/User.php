<?php

namespace Nation\Model;

class User extends \Provi\Model\User {


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
	public function __construct( ) {
		parent::__construct( );
		$this->add_attribute_field( 'books', new \Relation\Users_Books( ) );
	}
}


