<?php

	class Load {
		
		function view ( $filename, $vars, $return = false )
		{
		
			$view_data = null;
			extract($vars);
			
			if( file_exists( APP_PATH. "views/" .$filename ) )
			{
				
				if( $return )
					ob_start();
					
				include APP_PATH. "views/" .$filename;
				
				if( $return ) {
					$view_data = ob_get_contents();
					ob_end_clean();
					
					return $view_data;
				}
				
			}
			
		}
		
		function model ( $model )
		{
		
			$i =& getInstance();
			$model_name = str_replace(" ", "_", strtolower($model));
			$model_file = ucfirst($model_name);
			
			if( isset( $i->$model_name ) || !file_exists( APP_PATH. "models/" .$model_file. ".php" ) )
				return;
			
			require_once(APP_PATH. "models/" .$model_file. ".php");
			$i->$model_name = new $model_file();
			
		}
		
	}