<?php

class User_Controller {


	/*************************************************************************
	  ACTION METHODS                   
	 *************************************************************************/
	public function login( ) {
		$error = '';
		if ( isset( $_POST['login'] ) ) {
			$user = new User_Model();
			try {
				$user->init_by_login( $_POST['login'] );
				try {
					$user->checkpass( $user->password, $_POST['password'] );
					$title = '';
					$content = 'Logged in.';
					$_SESSION[ 'user' ] = $user;
				} catch( Exception $e ) {
					// TODO: Compter le nombre d'erreur de login
					$error = 'Mot de passe incorrect';
				}
			} catch( Exception $e ) {
				$error = 'Login inconnu';
			}
		}
		if ( ! isset( $_SESSION[ 'user' ] ) ) {
			$title = 'Login page';
			$content = '';
			if ( ! empty( $error ) ) {
				$content .= '<p class="warning">' . $error . '</p>'; 
			}
			$content .= '<form class="form" method="post" action="">' .
					   '<div><label for="login">Login:</label><input type="text" id="login" name="login" value="' . ( isset( $_POST['login'] ) ? $_POST['login'] : '' ) . '"/></div>' .
					   '<div><label for="password">Password:</label><input type="password" id="password" name="password" /></div>' .
					   '<input type="submit" value="Submit" />' .
					   '</form>';
		}
		$view = new Default_View( );
		return $view->render( $title, $content );
	}

	public function register( ) {
		if ( $_POST ) {
			$user = new User_Model();
			$user->register( );
			$title = 'Register validation';
			$content = '';
		} else {
			$title = 'Register page';
			$content = '<form class="form" method="post" action="">' .
					   '<div><label for="login">Login:</label><input type="text" id="login" name="login" /></div>' .
					   '<div><label for="password">Password:</label><input type="password" id="password" name="password" /></div>' .
					   '<div><label for="name">Name:</label><input type="text" id="name" name="name" /></div>' .
					   '<div><label for="lastname">Last Name:</label><input type="text" id="lastname" name="lastname" /></div>' .
					   '<input type="submit" value="Submit" />' .
					   '</form>';
		}
		$view = new Default_View( );
		return $view->render( $title, $content );
	}

	public function edit( ) {
		echo 'edit';
	}

	

}
