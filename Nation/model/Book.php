<?php

namespace Nation\Model;

class Book extends \Model_Defined {


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
	public function __construct( ) {
		parent::__construct( );
	
		$this->add_attribute_field( 'title', TRUE );
		$this->add_attribute_field( 'summary' );
		$this->add_attribute_field( 'table_of_contents' );	
		
		// TODO			
		// $this->add_attribute_relation( 'users', 'book', 'user', new \Users_Books_Relation( ) );
		// $this->add_attribute_relation( 'sections', 'book', 'section', new \Books_Sections_Relation( ) );
	}

}

