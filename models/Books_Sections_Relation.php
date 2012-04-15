<?php

class Books_Sections_Relation extends Relation {


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
	public function __construct( ) {
		$this->add_attribute_field('id');
		$this->add_attribute_field('book');
		$this->add_attribute_field('section');
		$this->id_field = 'id';
		$this->database_table_name = 'books_sections';
	}
}
