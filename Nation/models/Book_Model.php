<?php

class Book_Model extends Model {


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
	public function __construct( ) {
		$this->add_attribute_field('id');
		$this->add_attribute_field('title');
		$this->add_attribute_field('summary');
		$this->add_attribute_field('table_of_contents');				
		$this->add_attribute_relation( 'users', 'book', 'user', new Users_Books_Relation( ) );
		$this->add_attribute_relation( 'sections', 'book', 'section', new Books_Sections_Relation( ) );

		$this->id_field = 'id';
		$this->database_table_name = 'books';
	}




}

