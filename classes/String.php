<?php

abstract class String {


	/*************************************************************************
	  STATIC METHODS                   
	 *************************************************************************/
	static function startswith( $hay, $needle ) {
		return substr( $hay, 0, strlen( $needle ) ) == $needle;
	}
	static function endswith( $hay, $needle ) {
		return substr( $hay, -strlen( $needle ) ) == $needle;
	}
	static function istartswith( $hay, $needle ) {
		return startswith( strtolower( $hay ), strtolower( $needle ) );
	}
	static function iendswith( $hay, $needle ) {
		return endswith( strtolower( $hay ), strtolower( $needle ) );
	}
	static function contains( $hay, $needle ) {
		return ( strpos( $hay, $needle ) !== false );
	}
	static function icontains( $hay, $needle ) {
		return contains( strtolower( $hay ), strtolower( $needle ) );
	}
	static function substr_before( $hay, $needle ) {
		return substr( $hay, 0, strpos( $hay, $needle ) );
	}
	static function substr_after( $hay, $needle ) {
		return substr( $hay, strpos( $hay, $needle ) + 1 );
	}
	static function must_startswith( $hay, $needle ) {
		if ( ! startswith( $hay, $needle ) ) {
			$hay = $needle . $hay;
		}
		return $hay;
	}
	static function must_endswith( $hay, $needle ) {
		if ( ! endswith( $hay, $needle ) ) {
			$hay .= $needle;
		}
		return $hay;
	}
	static function must_not_startswith( $hay, $needle ) {
		if ( startswith( $hay, $needle ) ) {
			$hay = substr( $hay, 1 );
		}
		return $hay;
	}
	static function must_not_endswith( $hay, $needle ) {
		if ( endswith( $hay, $needle ) ) {
			$hay = substr( $hay, 0, -1 );
		}
		return $hay;
	}
}

?>
