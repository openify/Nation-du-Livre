<?php

namespace Nation;

class Users_Books_Relation extends \Relation {


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
	public function __construct( ) {
		$this->add_attribute_field('id');
		$this->add_attribute_field('user');
		$this->add_attribute_field('book');
		$this->id_field = 'id';
		$this->database_table_name = 'users_books';
	}
}
