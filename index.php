<?php

	// Set the erroring setting in php.ini
	ini_set( 'display_errors', 1 );

	// Define the base path
	define( 'BASE_PATH', dirname(realpath(__FILE__)) . "/" );
	
	// Define the application path
	define( 'APP_PATH', realpath("App") . "/" );
	
	// Define the core business path
	define( 'SYS_PATH', realpath("Mercury") . "/" );
	
	/*
	 * Define the log_priority id
	 * 0 - Nothing gets logged
	 * 1 - Information gets logged
	 * 2 - Warnings get logged
	 * 3 - Errors get logged
	 * 4 - Severe errors get logged
	 *
	 */
	define( 'LOGGER', "1" );


	// Get the ball rolling
	require_once( SYS_PATH. "Mercury.php");