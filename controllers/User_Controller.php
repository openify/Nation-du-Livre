<?php

class User_Controller {


	/*************************************************************************
	  ACTION METHODS                   
	 *************************************************************************/
	public function login( ) {
		if ( $_POST ) {
			echo 'Login/pass validation';
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
