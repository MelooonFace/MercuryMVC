<?php

	class Test extends Model {
				
		function __construct()
		{
				
			parent::__construct();
			
		}
		
		function do_something()
		{
			
			$i =& getInstance();
			$i->output->clear_output();
			
		}
		
	}