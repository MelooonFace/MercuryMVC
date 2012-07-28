<?php

	/**
	 *
	 * The default error (404) message (TODO)
	 *
	 */
	 
	function error_404()
	{
	
		global $Mercury;
		
		header($Mercury['constants']['404_error_header']. "\n");
		
		if( ( $err = get_error( "error_404" ) ) )
		{
			
			die($err);
			
		}
		
		else
		{
		
			die("<h1>404 Not Found</h1>\nThe file you requested could not be found, please contact the server administrator.");
			
		}
		
	}
	
	
	/**
	 *
	 * Displays an error message/other message
	 *
	 */
	
	function get_error( $error_file )
	{
		
		if( file_exists( APP_PATH . "errors/" . $error_file . ".php" ) )
		{
			
			ob_start();
			
			include  APP_PATH . "errors/" . $error_file . ".php";
			
			$output = ob_get_contents();
			ob_end_clean();
			
			return $output;
			
		}
		
		else
			return false;
		
	}
	
	
	/**
	 *
	 * Gets the instance of the controller (if there has been one initiated)
	 *
	 */
	
	function getInstance()
	{
		// Make sure we have access to the Mercury variable
		global $Mercury;
		
		// Return the controller class
		return ($Mercury['controller'] != null) ? $Mercury['controller']::getInstance() : null;
	}
	
	
	/**
	 *
	 * Log a message into a log file
	 *
	 */
	
	function log_message ( $message = "", $priority = 4 )
	{
		
		global $Mercury;
		
		$continue = explode( ",", trim( LOGGER ) );
		
		if( !in_array( $priority, $continue ) && LOGGER != "ALL" )
			return false;
		
		if( !empty($message) )
		{			
			
			// Open the file up
			$open = fopen( $Mercury['logger']['file'], 'a' );
			
			// Write the message to the file
			fwrite( $open, $message ."\n" );
			
			// Close the file
			fclose($open);
			
		}
				
	}
	
	
	/**
	 *
	 * Load a config item
	 *
	 */
	
	function get_config( $item = null )
	{
	
		global $Config;
		
		if( $item == null )
			return $Config;
			
		else
			return $Config[ $item ];
		
	}