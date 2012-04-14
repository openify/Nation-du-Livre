<?php

abstract class String {


	/*************************************************************************
	  STATIC METHODS                   
	 *************************************************************************/
	static function starts_with( $hay, $needle ) {
		return substr( $hay, 0, strlen( $needle ) ) == $needle;
	}
	static function ends_with( $hay, $needle ) {
		return substr( $hay, -strlen( $needle ) ) == $needle;
	}
	static function i_starts_with( $hay, $needle ) {
		return startswith( strtolower( $hay ), strtolower( $needle ) );
	}
	static function i_ends_with( $hay, $needle ) {
		return endswith( strtolower( $hay ), strtolower( $needle ) );
	}
	static function contains( $hay, $needle ) {
		return ( strpos( $hay, $needle ) !== false );
	}
	static function i_contains( $hay, $needle ) {
		return contains( strtolower( $hay ), strtolower( $needle ) );
	}
	static function substr_before( $hay, $needle ) {
		return substr( $hay, 0, strpos( $hay, $needle ) );
	}
	static function substr_after( $hay, $needle ) {
		return substr( $hay, strpos( $hay, $needle ) + 1 );
	}
	static function must_starts_with( $hay, $needle ) {
		if ( ! startswith( $hay, $needle ) ) {
			$hay = $needle . $hay;
		}
		return $hay;
	}
	static function must_ends_with( $hay, $needle ) {
		if ( ! endswith( $hay, $needle ) ) {
			$hay .= $needle;
		}
		return $hay;
	}
	static function must_not_starts_with( $hay, $needle ) {
		if ( startswith( $hay, $needle ) ) {
			$hay = substr( $hay, 1 );
		}
		return $hay;
	}
	static function must_not_ends_with( $hay, $needle ) {
		if ( endswith( $hay, $needle ) ) {
			$hay = substr( $hay, 0, -1 );
		}
		return $hay;
	}
}

?>
