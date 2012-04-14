<?php

class Model implements ArrayAccess  {


	/*************************************************************************
	  ATTRIBUTES                 
	 *************************************************************************/
	public $_attribute_values = array( );
	public $_attribute_names  = array( );
	public $id_field;
	public $database_table_name;


	/*************************************************************************
	  GETTER & SETTER                 
	 *************************************************************************/
	public function __get( $name ) {
		return $this->get( $name );
	}
	public function get( $name ) {
		if ( ! isset( $this->_attribute_names[ $name ] ) ) {
			return null;
		}
		if ( ! isset( $this->_attribute_values[ $name ] ) ) {
			return null;
		}
		return $this->_attribute_values[ $name ];
	}
	function id( ) {
		return $this[ $this->id_field ];
	}
	public function __set( $name, $value ) {
		return $this->set( $name, $value );
	}
	public function set( $name, $value ) {
		if ( ! isset( $this->_attribute_names[ $name ] ) ) {
			return $this;
		}
		$this->_attribute_values[ $name ] = $value;
	}


	/*************************************************************************
	  INITIALIZATION          
	 *************************************************************************/
	function add_attribute_name( $name ) {
		$this->_attribute_names[ $name ] = true;
	}
	function get_attribute_names( ) {
		return array_keys( $this->_attribute_names );
	}
	function init_by_data( $data ) {
		foreach ( $this->get_attribute_names( ) as $name ) {
			if ( isset( $data[ $name ] ) ) {
				$this[ $name ] = $data[ $name ];
			}
		}
	}
	function init_by_id( $id ) {
		$sql = 'SELECT * FROM ' . $this->database_table_name( ) . ' WHERE ' . $this->id_field . '=:id;';
		$request = new Database_Request( $sql );
		$data = $request->execute_one( array( ':id' => $id ) );
		$this->init_by_data( $data );
	}
	function get_list_by_data( $datas ) {
		$class = get_class( $this );
		$models = array( );
		foreach ( $datas as $data ) {
			$model = new $class( );
			$model->init_by_data( $data );
			$models[ $model[ $this->id_field ] ] = $model;
		}
		return $models;
	}
	function get_all( $specific_where = null, $order_by = null ) {
		$models = array( );
		$sql = 'SELECT * FROM ' . $this->database_table_name( ) . ' ' . $specific_where . ' ' . $order_by;
		$request = new Database_Request( $sql );
		$datas = $request->execute( );
		$models = $this->get_list_by_data( $datas );
		return $models;
	}

	
	/*************************************************************************
	  ARRAY ACCESS INTERFACE          
	 *************************************************************************/
	public function offsetSet( $offset, $value ) {
		$this->set( $offset, $value );
	}
	public function offsetExists( $offset ) {
		return isset( $this->_attribute_names[ $offset ] );
	}
	public function offsetUnset( $offset ) {
		unset( $this->_attribute_values[ $offset ] );
	}
	public function offsetGet( $offset ) {
		return $this->get( $offset );
	}

	
	/*************************************************************************
	  DATABASE 
	 *************************************************************************/
	function delete( ) {
		if ( $this->exists( ) ) {
			$sql = 'DELETE FROM ' . $this->database_table_name( ) . ' WHERE ' . $this->id_field . '=:id;';
			$request = new Database_Request( $sql );
			$request->execute_one( array( ':id' => $this->id( ) ) );
			$this->init_by_data( null );
		}
	}
	function save( ) {
		if ( $this->exists( ) ) {
			$sql = 'UPDATE '.$this->database_table_name( )
				.' SET '.$this->get_set_request( )
				.' WHERE `'.$this->id_field.'` = :'.$this->id_field.' ;';
			$request = new Database_Request( $sql );
			$request->execute_one( $this->bind_params( ) );
		} else {
			$sql = 'INSERT INTO ' . $this->database_table_name( )
				. ' (`' . implode( '`, `', $this->get_attribute_names( ) ) . '`) VALUES'
				. ' (:' . implode( ', :', $this->get_attribute_names( ) ) . ');';
			$request = new Database_Request( $sql );
			$request->execute_one( $this->bind_params( ) );
			$id = $request->last_insert_id( );
			if ($id !== false) {
				$this[ $this->id_field ] = $id;
			}
		}
		return true;
	}
	function database_table_name( ) {
		return $this->database_table_name;
	}
	function get_set_request( ) {
		$request = '';
		foreach ( $this->get_attribute_names( ) as $attribute_name ) {
			$request .= '`' . $attribute_name . '` = :' . $attribute_name . ', ';
		}
		return substr( $request, 0, -2 );
	}
	function bind_params( ) {
		$bind_params = array( );
		foreach ( $this->get_attribute_names( ) as $attribute_name ) {
			$bind_params[ ':' . $attribute_name ] = $this->get( $attribute_name );
		}
		return $bind_params;
	}
	function exists( ) {
		return ( $this->id( ) !== null );
	}
}
