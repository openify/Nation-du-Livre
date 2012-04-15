<?php

class Section_Model extends Model {


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
	public function __construct( ) {
		$this->add_attribute_field('id');
		$this->add_attribute_field('name');
		$this->add_attribute_field('left');
		$this->add_attribute_field('right');
		$this->id_field = 'id';
		$this->database_table_name = 'sections';
	}
}

?>
