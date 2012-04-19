<?php

namespace Nation;

class User_Model extends \Kernel\Model {


	/*************************************************************************
	 ATTRIBUTES
	 *************************************************************************/
	const CRYPT_SEED = 'dacz:;,aafapojn';


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
	public function __construct( ) {
		$this->add_attribute_field('id');
		$this->add_attribute_field('login');
		$this->add_attribute_field('password');
		$this->add_attribute_field('name');
		$this->add_attribute_field('lastname');
		$this->add_attribute_relation( 'books', 'user', 'book', new Users_Books_Relation( ) );
		$this->id_field = 'id';
		$this->database_table_name = 'users';
	}


	/*************************************************************************
	  INITIALIZATION          
	 *************************************************************************/
	function init_by_login( $login ) {
		if ( ! $this->init_by_fields( array( 'login' => $login ) ) ) {
			throw new \Exception( 'No login found' );
		}
	}

	function check_password( $userpwd, $pass ) {
		if ( $userpwd === $this->encrypt_password( $pass ) ) {
			return true;
		} else {
			throw new \Exception( 'Bad password' );
		}
	}

	function encrypt_password( $pwd ) {
		return sha1( self::CRYPT_SEED . $pwd );
	}
}


