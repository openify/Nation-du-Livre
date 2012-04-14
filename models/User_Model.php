<?php

class User_Model extends Model {


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
	public function __construct( ) {
		$this->add_attribute_name('id');
		$this->add_attribute_name('name');
		$this->add_attribute_name('lastname');
		$this->id_field = 'id';
		$this->database_table_name = 'users';
	}
}

?>
