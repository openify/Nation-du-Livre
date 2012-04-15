<?php

class Model extends Relation  {


	/*************************************************************************
	  ATTRIBUTES                 
	 *************************************************************************/
	public $_attribute_relation_names  = array( );


	/*************************************************************************
	  GETTER & SETTER                 
	 *************************************************************************/
	public function get( $name ) {
		if ( isset( $this->_attribute_relation_names[ $name ] ) && isset( $this->_attribute_values[ $name ] ) ) {
			return $this->_attribute_values[ $name ];
		}
		return parent::get( $name );
	}
	public function add_relation( $name, $value ) {
		$infos = $this->_attribute_relation_names[ $name ];
		$relation = $infos[ 'object' ];
		$relation[ $infos[ 'index' ] ] = $this->id( );
		$relation[ $infos[ 'related' ] ] = $this->format_related_value( $value );
		$relation->save( );
		$this->_attribute_values[ $name ][ ] = $relation;
	}
	public function remove_relation( $name, $value ) {
		$value = $this->format_related_value( $value );
		$infos = $this->_attribute_relation_names[ $name ];
		foreach ( $this->_attribute_values[ $name ] as $key => $relation ) {
echo $relation[ $infos[ 'related' ] ] . ' ? ' . $value . '<br>';
			if ( $relation[ $infos[ 'related' ] ] == $value ) {
				$relation->delete( );
				unset( $this->_attribute_values[ $name ][ $key ] );
				return true;
			}
		}
		return false;
	}
	private function format_related_value( $value ) {
		if ( is_object( $value ) ) {
			return $value->id( );
		}
		return $value;
	}


	/*************************************************************************
	  DEFINITION          
	 *************************************************************************/
	protected function add_attribute_relation( $name, $index, $related, $object ) {
		$this->_attribute_relation_names[ $name ] = array( 'index' => $index, 'related' => $related, 'object' => $object );
	}


	/*************************************************************************
	  INITIALIZATION          
	 *************************************************************************/
	public function init_by_data( $data ) {
		parent::init_by_data( $data );
		foreach ( $this->_attribute_relation_names as $name => $infos ) {
			$relation = $infos[ 'object' ];
			$this->_attribute_values[ $name ] = $relation->get_by_index( $infos[ 'index' ], $this->id( ) );
		}
	}
}
