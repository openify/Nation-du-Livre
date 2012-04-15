<?php

class User_Controller extends Controller {


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
		return $this->render( $title, $content );
	}


	/*************************************************************************
	  REGISTER ACTION                   
	 *************************************************************************/
	public function register( ) {
		$var = array( );
		if ( $_POST ) {
			$user = new User_Model( );
			$user->login = $_POST['login'];
			$user->password = $user->encrypt_password( $_POST['password'] );
			$user->name = $_POST['name'];
			$user->lastname = $_POST['lastname'];
			$user->save( );
			$var['title'] = 'Register validation';
			$var['content'] = '';
		} else {
			$var['title'] = 'Register page';
			$var['content'] = '<form class="form" method="post" action="">' .
					   '<div><label for="login">Login:</label><input type="text" id="login" name="login" /></div>' .
					   '<div><label for="password">Password:</label><input type="password" id="password" name="password" /></div>' .
					   '<div><label for="name">Name:</label><input type="text" id="name" name="name" /></div>' .
					   '<div><label for="lastname">Last Name:</label><input type="text" id="lastname" name="lastname" /></div>' .
					   '<input type="submit" value="Submit" />' .
					   '</form>';
		}
		return $this->render( View::LAYOUT_TEMPLATE, $var ); 
	}


	/*************************************************************************
	  EDITION ACTION                   
	 *************************************************************************/
	public function edit( ) {
		return $this->render( 'Editer votre profil', 'lorem ipsum' );
	}
}
