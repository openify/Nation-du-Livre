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
	
		$this->add_attribute_field( 'title', new \Data_Type\Varchar( ), \Model_Index::INDEXED );
		$this->add_attribute_field( 'summary', new \Data_Type\Text( ) );
		$this->add_attribute_field( 'table_of_contents', new \Data_Type\Text( ) );	
		
		// TODO			
		$this->add_attribute_field( 'authors', new \Relation\Users_Books( \Relation::REVERSED ) );
		// $this->add_attribute_relation( 'sections', 'book', 'section', new \Books_Sections_Relation( ) );
	}

}

