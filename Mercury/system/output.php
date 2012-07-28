<?php

	class Output {
		
		private $output, $header;
		
		public function get_header()
		{
			return $this->header;
		}
		
		public function append_header($header)
		{
			$this->header .= $header. "\n";
			
			return $this;
		}
		
		public function set_content_type($type)
		{
			$this->header .= $this->append_header("Content-type: " .$type);
			
			return $this;
		}
		
		public function set_output($out)
		{
			$this->output = $out;
			
			return $this;
		}
		
		public function append_output($out)
		{
			$this->output .= $out;
			
			return $this;
		}
		
		public function get_output()
		{
			return $this->output;
		}
		
		public function clear_output()
		{
			$this->set_output("");
			
			return $this;
		}
		
	}