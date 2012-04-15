<?php

class User_Controller {


	/*************************************************************************
	  ACTION METHODS                   init_by_login
	 *************************************************************************/
	public function login( ) {
		if ( isset( $_POST['login'] ) ) {
			$user = new User_Model();
			$user->init_by_login( $_POST['login'] );
			$user->checkpass( $user->password, $_POST['password'] );
		} else {
			echo '<h1>Login page</h1>';
			echo '<form method="post" action="">';
			echo '<div><label for="login">Login:</label><input type="text" id="login" name="login" /></div>';
			echo '<div><label for="password">Password:</label><input type="password" id="password" name="password" /></div>';
			echo '<input type="submit" value="Submit" />';
			echo '</form>';
		}
	}

	public function register( ) {
		if ( $_POST ) {
			$user = new User_Model();
			$user->register( );
			echo 'Register validation';
		} else {
			echo '<h1>Register page</h1>';
			echo '<form method="post" action="">';
			echo '<div><label for="login">Login:</label><input type="text" id="login" name="login" /></div>';
			echo '<div><label for="password">Password:</label><input type="password" id="password" name="password" /></div>';
			echo '<input type="submit" value="Submit" />';
			echo '</form>';
		}
	}

	public function edit( ) {
		echo 'edit';
	}

	

}
