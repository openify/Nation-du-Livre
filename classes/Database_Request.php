<?php

class Database_Request {


	/*************************************************************************
	  ATTRIBUTES                 
	 *************************************************************************/
	public static $database_driver;
	public static $database_host;
	public static $database_name;
	public static $database_user;
	public static $database_password;
	public $request;
	private $PDObject;
	private $last_insert_id = false;


	/*************************************************************************
	  CONSTRUCTOR                   
	 *************************************************************************/
	public function __construct( $request = '' ) {
		$this->request = $request;
	}
	
	

	/*************************************************************************
	  PUBLIC METHODS                   
	 *************************************************************************/
	public function execute_one( $arguments = array( ) ) {
		$result = $this->execute( $arguments );
		if ( count( $result ) > 0 ) {
			$result = $result[ 0 ];
		}
		return $result;
	}
	public function execute( $arguments = array( ) ) {
		if ( empty( $this->request ) ) {
			throw new Database_Exception( 'The SQL request is empty.' );
		}
		
		$result = array( );
		try {

			// Prepare the request
			$this->connect( );
			$statement = $this->PDObject->prepare( $this->request );
			foreach( $arguments as $parameter => $value ) {
				$statement->bindValue( $parameter, $value );
			}
			$result = $statement->execute( );

			// Execute the request
			if ( ! $result ) {
				throw new Database_Exception( 'Error with the SQL request : ' . $this->request, $statement->errorInfo( ) );
			}
		
			if ( 
				String::i_starts_with($this->request, "SELECT") || 
				String::i_starts_with($this->request, "SHOW") || 
				String::i_starts_with($this->request, "DESCRIBE") || 
				String::i_starts_with($this->request, "EXPLAIN ")
			) {
				$result = $statement->fetchAll( PDO::FETCH_ASSOC );
			} else if ( String::i_starts_with( $this->request, "INSERT" ) ) {
				$id = $this->PDObject->lastInsertId( );
				if ( $id == '0' ) {
					// Error Case or a table without autoincrementation
					$id = false;
					$result = false;
				} else {
					$result = true;
				}
				$this->last_insert_id = $id;
			}
			
		} catch ( PDOException $exception ) {
			throw new Database_Exception( $exception->getMessage( ) );
		}
		$this->disconnect( );
		return $result;
	}
	
	public function last_insert_id( ) {
		return $this->last_insert_id;
	}


	/*************************************************************************
	  PRIVATE METHODS                   
	 *************************************************************************/
	private function connect( ) {
		$this->PDObject = new PDO(
			self::$database_driver . ':host=' . self::$database_host . ';dbname=' . self::$database_name,
			self::$database_user,
			self::$database_password,
			array( PDO::ATTR_PERSISTENT => true )
		);
		$this->PDObject->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
	}
	private function disconnect( ) {
		$this->PDObject = null;
	}
}

class Database_Exception extends Exception {
}



