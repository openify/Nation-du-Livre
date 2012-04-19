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
					$var['title'] = '';
					$var['content'] = 'Logged in.';
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
			$var['title'] = 'Login page';
			$var['content'] = $this->render( '../views/user_login_form.html' ); 
		}

		// Render
		return $this->render( View::LAYOUT_TEMPLATE, $var );
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
			$var['content'] = $this->render( '../views/user_register_form.html' ); 
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
