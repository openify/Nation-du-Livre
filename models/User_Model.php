<?php

class User_Model extends Model {


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
	public function __construct( ) {
		$this->add_attribute_name('id');
		$this->add_attribute_name('login');
		$this->add_attribute_name('password');
		$this->add_attribute_name('name');
		$this->add_attribute_name('lastname');
		$this->id_field = 'id';
		$this->database_table_name = 'users';
	}


	/*************************************************************************
	  INITIALIZATION          
	 *************************************************************************/
	function init_by_login( $login ) {
		$sql = 'SELECT * FROM ' . $this->database_table_name( ) . ' WHERE login=:login;';
		$request = new Database_Request( $sql );
		$data = $request->execute_one( array( ':login' => $login ) );
		if ( ! empty( $data ) ) {
			$this->init_by_data( $data );
		} else {
			throw new Exception( 'No login found' );
		}
	}

	function checkpass( $user, $pass ) {
		if ( $user->password == $pass ) {
			session_start();
			echo 'Logged in.';
		} else {
			throw new Exception( 'Bad password' );
		}
	}
}

?>
