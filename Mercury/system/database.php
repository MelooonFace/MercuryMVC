<?php

	class Database {
	
		private $conn, $host, $port, $user, $pass, $db;
		public $query;
		
		function __construct( $config )
		{
			foreach( $config as $key => $value )
				$this->$key = $value;
			
			$this->connect();
		}
		
		private function connect()
		{
			$this->conn = mysql_connect( $this->host . ":" . $this->port, $this->user, $this->pass );
			mysql_select_db( $this->db, $this->conn );
			
			return $this;
		}
		
		public function query( $query )
		{
			return ($this->query = mysql_query( $query, $this->conn ));
		}
		
	}