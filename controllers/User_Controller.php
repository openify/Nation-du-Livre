<?php

class User_Controller {


	/*************************************************************************
	  LOGIN ACTION                   
	 *************************************************************************/
	public function login( ) {
		$error = '';
		
		// User already connected
		if ( isset( $_SESSION[ 'user' ] ) ) {
			header( 'Location: /' );
			die;
		}
		
		// Connection validation
		if ( isset( $_POST[ 'login' ] ) ) {
			$user = new User_Model();
			try {
				$user->init_by_login( $_POST['login'] );
				try {
					$user->check_password( $user->password, $_POST['password'] );
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
		
		// Connection Form 
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

		// Render
		$view = new Default_View( );
		return $view->render( $title, $content );
	}


	/*************************************************************************
	  REGISTER ACTION                   
	 *************************************************************************/
	public function register( ) {
		if ( $_POST ) {
			$user = new User_Model( );
			$user->login = $_POST['login'];
			$user->password = $user->encrypt_password( $_POST['password'] );
			$user->name = $_POST['name'];
			$user->lastname = $_POST['lastname'];
			$user->save( );
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


	/*************************************************************************
	  EDITION ACTION                   
	 *************************************************************************/
	public function edit( ) {
		$view = new Default_View( );
		return $view->render( 'Editer votre profil', 'lorem ipsum' );
	}
}
