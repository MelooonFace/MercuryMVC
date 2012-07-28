<?php
	
	// Create the instance of the Mercury array, used for temporary ram storage
	$Mercury = array();
	
	// Open up the first item, used for useless data, or temporary information
	$Mercury['tmp'] = array();

	// Open up a new variable for all the config items
	$Config = array();
	
	// Quick logger setup
	$Mercury['logger'] = array();
	$Mercury['logger']['file'] = APP_PATH . "logs/" . "Mercury.log";

	/**
	 *
	 * Start the auto-loading procedure
	 * =======================================================
	 *
	 * Automaticly loads all the core classes and files in the
	 * Mercury system folder(s).
	 *
	 */
	
	$Mercury['autoload'] = array();
	$Mercury['autoload']['loaded'] = array();
	
	// Get a list of all the system files in the SYS_PATH directory
	$Mercury['autoload']['load'] = glob("{" .SYS_PATH. "system/" . "*.php," .SYS_PATH. "classes/" . "*.php," .APP_PATH. "config/*.php}", GLOB_BRACE);
	
	// Start to autoload all the system files (function, base + class files)
	foreach($Mercury['autoload']['load'] as $file_path)
	{
	
		// Its important that these files are not loaded more than once
		require_once($file_path);
		
		// Add the instance of the file being loaded to the array
		array_push($Mercury['autoload']['loaded'], $file_path);
		
	}
	
	// Log a informational message
	log_message("Done autoloading " .count($Mercury['autoload']['loaded']). " file(s) into Mercury!", 1);
	
	
	/**
	 *
	 * Make some quick checks to make sure the log file exists
	 * =======================================================
	 *
	 * Check the file exists, or make a (dumb) log.
	 *
	 */
	
	if( !file_exists( $Mercury['logger']['file'] ) )
		log_message("Severe: Could not find logger file! File does not exists!", 4); // useless, but maybe ill add, displaying severe messages
	
	
	/**
	 *
	 * Do the route logic procedure
	 * =======================================================
	 *
	 * Automaticly finds the correct controller to locate based
	 * on the page request done by the client.
	 *
	 */
	
	$Mercury['request'] = array();
	$Mercury['request']['args'] = array();
	$Mercury['request']['data'] = array();
	$Mercury['controller'] = null;
	
	//die(phpinfo());
	
	// Check if there are any arguments from the client
	if( isset($_SERVER["argv"]) && count($_SERVER["argv"]) != 0 )
		$Mercury['request']['args'] = explode( "/", $_SERVER["argv"][0] );
		
	
	// Get all the requires (extra) data from the arguments
	for($i = 0; $i < count($Mercury['request']['args']); $i++)
		if($i != 0 && $i != 1) $Mercury['request']['data'][] = $Mercury['request']['args'][$i];
		
	
	// Set the controller name (if we have one)
	if( isset( $Mercury['request']['args'][0] ) ) // TODO change the get key
		$Mercury['request']['controller'] = ucfirst(strtolower( $Mercury['request']['args'][0] ));
	
	// Or use the default controller name
	else
		$Mercury['request']['controller'] = ucfirst(strtolower("index"));
	
	// Log useless message
	log_message("Done route logic. '" .$Mercury['request']['controller']. "' selected", 1);
	
	
	
	/**
	 *
	 * Do the controller creation logic
	 * =======================================================
	 *
	 * Checks if the controller exists in the application, and
	 * loads it up + initiates it. Or else it just 404 errors.
	 *
	 */
	
	// Now check wether or not the controler exists in the application directory
	if( file_exists( APP_PATH. "controllers/" .$Mercury['request']['controller']. ".php" ) )
	{
		
		// Log useless message
		log_message("Controller file found: " .APP_PATH. "controllers/" .$Mercury['request']['controller']. ".php", 1);
		
		// Require the controller, just once to be able to use it
		require_once( APP_PATH. "controllers/" .$Mercury['request']['controller']. ".php" );
		
		// Lets get ready to init the controller class
		$Mercury['controller'] = new $Mercury['request']['controller']();
		
		// Log useless message
		log_message("Controller object created '" .$Mercury['request']['controller']. "'", 1);
		
		// Locate the method/function name to use based apon client arguments
		if( isset( $Mercury['request']['args'][1] ) ) // TODO change the get key
			$Mercury['request']['method'] = strtolower( $Mercury['request']['args'][1] );
		
		// Or use a default function if one is not provided
		else
			$Mercury['request']['method'] = strtolower("index");
		
		// Log useless message
		log_message("Ob started", 1);
		
		// Start the ob
		ob_start();
		
		// Now check wether or not that method actually exists + call it
		if( method_exists( $Mercury['controller'], $Mercury['request']['method'] ) )
		{
		
			// Call the __request function, and give arguments
			if( method_exists( $Mercury['controller'], "__request" ) )
			{
				// Log useless message
				log_message("__request method found, executing method...", 1);
				
				call_user_func_array( array(
					$Mercury['controller'],
					"__request"
				), array (
					$Mercury['request']['method'],
					$Mercury['request']['data']
				) );
			}
		
			// Log useless message
			log_message("Excecuting method '" .$Mercury['request']['controller']. "':'" .$Mercury['request']['method']. "' in controller", 1);
		
			// Call the default method in accordance to the request
			call_user_func_array( array(
				$Mercury['controller'],
				$Mercury['request']['method']
			), $Mercury['request']['data'] );
			
		}
		
		// Or else just display the 404 error page
		else
		{
			log_message("Controller method not found, error 404", 1);
			error_404();
		}
		
		// Capture the data sent from the controller
		$Mercury['tmp']['ob_content'] = ob_get_contents();
		
		// Log useless message
		log_message("Retrieved ob data from ob", 1);
		
		// Now end + clean the ob
		ob_end_clean();
		
		// Log useless message
		log_message("Ended and cleaned the ob", 1);

		
		// Log useless message
		log_message("Setting the output header", 1);
		
		// Retrieve the output from the controller
		header( $Mercury['controller']->output->get_header() );
		
		// Log useless message
		log_message("Displaying the ob_output", 1);
		
		// Echo out the data from the ob
		echo $Mercury['tmp']['ob_content'];
		
		// Log useless message
		log_message("Displaying the controller_output", 1);
		
		// And then the output from the controller
		echo $Mercury['controller']->output->get_output();
		
	}
	
	else
	{
		log_message("Controller not found, error 404", 1);
		error_404();
	}
	
	
	// var_dump( $Mercury['controller'] );