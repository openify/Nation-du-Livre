<?php

class Relation implements ArrayAccess  {


	/*************************************************************************
	  ATTRIBUTES                 
	 *************************************************************************/
	public $_attribute_values = array( );
	public $_attribute_field_names  = array( );
	public $id_field;
	public $database_table_name;


	/*************************************************************************
	  GETTER & SETTER                 
	 *************************************************************************/
	public function __get( $name ) {
		return $this->get( $name );
	}
	public function get( $name ) {
		if ( ! isset( $this->_attribute_field_names[ $name ] ) || ! isset( $this->_attribute_values[ $name ] ) ) {
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
		if ( ! isset( $this->_attribute_field_names[ $name ] ) ) {
			return $this;
		}
		$this->_attribute_values[ $name ] = $value;
	}


	/*************************************************************************
	  DEFINITION          
	 *************************************************************************/
	protected function add_attribute_field( $name ) {
		$this->_attribute_field_names[ $name ] = true;
	}


	/*************************************************************************
	  INITIALIZATION          
	 *************************************************************************/
	protected function get_attribute_field_names( ) {
		return array_keys( $this->_attribute_field_names );
	}
	public function init_by_data( $data ) {
		foreach ( $this->get_attribute_field_names( ) as $name ) {
			if ( isset( $data[ $name ] ) ) {
				$this[ $name ] = $data[ $name ];
			}
		}
	}
	public function init_by_id( $id ) {
		$sql = 'SELECT * FROM ' . $this->database_table_name( ) . ' WHERE ' . $this->id_field . '=:id;';
		$request = new Database_Request( $sql );
		$data = $request->execute_one( array( ':id' => $id ) );
		$this->init_by_data( $data );
	}
	public function get_list_by_data( $datas ) {
		$class = get_class( $this );
		$models = array( );
		foreach ( $datas as $data ) {
			$model = new $class( );
			$model->init_by_data( $data );
			$models[ $model[ $this->id_field ] ] = $model;
		}
		return $models;
	}
	public function get_by_index( $index_name, $index_value ) {
		return $this->get_all( 'WHERE ' . $index_name . '=:' . $index_name, '', array( ':' . $index_name => $index_value ) );
	}
	public function get_all( $specific_where = null, $order_by = null, $parameters = array( ) ) {
		$models = array( );
		$sql = 'SELECT * FROM ' . $this->database_table_name( ) . ' ' . $specific_where . ' ' . $order_by;
		$request = new Database_Request( $sql );
		$datas = $request->execute( $parameters );
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
		return isset( $this->_attribute_field_names[ $offset ] );
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
	public function delete( ) {
		if ( $this->exists( ) ) {
			$sql = 'DELETE FROM ' . $this->database_table_name( ) . ' WHERE ' . $this->id_field . '=:id;';
			$request = new Database_Request( $sql );
			$request->execute_one( array( ':id' => $this->id( ) ) );
			$this->init_by_data( null );
		}
	}
	public function save( ) {
		if ( $this->exists( ) ) {
			$sql = 'UPDATE '.$this->database_table_name( )
				.' SET '.$this->get_set_request( )
				.' WHERE `'.$this->id_field.'` = :'.$this->id_field.' ;';
			$request = new Database_Request( $sql );
			$request->execute_one( $this->bind_params( ) );
		} else {
			$sql = 'INSERT INTO ' . $this->database_table_name( )
				. ' (`' . implode( '`, `', $this->get_attribute_field_names( ) ) . '`) VALUES'
				. ' (:' . implode( ', :', $this->get_attribute_field_names( ) ) . ');';
			$request = new Database_Request( $sql );
			$request->execute_one( $this->bind_params( ) );
			$id = $request->last_insert_id( );
			if ($id !== false) {
				$this[ $this->id_field ] = $id;
			}
		}
		return true;
	}
	protected function database_table_name( ) {
		return $this->database_table_name;
	}
	protected function get_set_request( ) {
		$request = '';
		foreach ( $this->get_attribute_field_names( ) as $attribute_name ) {
			$request .= '`' . $attribute_name . '` = :' . $attribute_name . ', ';
		}
		return substr( $request, 0, -2 );
	}
	protected function bind_params( ) {
		$bind_params = array( );
		foreach ( $this->get_attribute_field_names( ) as $attribute_name ) {
			$bind_params[ ':' . $attribute_name ] = $this->get( $attribute_name );
		}
		return $bind_params;
	}
	public function exists( ) {
		return ( $this->id( ) !== null );
	}
}
