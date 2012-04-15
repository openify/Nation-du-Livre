<?php

class Book_Model extends Model {


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
	public function __construct( ) {
		$this->add_attribute_field('id');
		$this->add_attribute_field('name');
		$this->id_field = 'id';
		$this->database_table_name = 'books';
	}
}

?>
