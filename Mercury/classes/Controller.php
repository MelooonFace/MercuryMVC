<?php

	class Controller {
	
		private static $instance;
		public $load, $output, $database;
		
		function __construct()
		{
			self::$instance =& $this;
			
			$this->load = new Load();
			$this->output = new Output();
			
			if(get_config('use_mysql'))
				$this->database = new Database( get_config('database') );
		}
		
		public static function &getInstance()
		{
			return self::$instance;
		}
		
	}