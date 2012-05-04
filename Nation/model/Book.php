<?php

namespace Nation\Model;

class Book extends \Model_Defined {


	/*************************************************************************
	  GETTER & SETTER             
	 *************************************************************************/
	public function name( ) {
		return $this->title;
	}


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
	public function __construct( ) {
		parent::__construct( );
	
		$this->add_attribute_field( 'title' );
		$this->add_attribute_field( 'summary', new \Data_type\Text( ) );
		$this->add_attribute_field( 'table_of_contents', new \Data_type\Text( ) );	
		
		// TODO			
		$this->add_attribute_field( 'authors', new \Relation\Users_Books( \Relation::REVERSED ) );
		// $this->add_attribute_relation( 'sections', 'book', 'section', new \Books_Sections_Relation( ) );
	}

}

