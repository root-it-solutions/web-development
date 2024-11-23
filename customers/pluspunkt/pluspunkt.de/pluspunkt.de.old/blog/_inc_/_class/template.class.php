<?php

	class templateRepeat {
		var $name; 
		var $lines; 
		var $source; 
		var $data;
		
		function templateRepeat($name, $source) {
			$this->name = $name;
			$this->source = $source;
			$this->lines = array();
			$this->data = '';
			$this->parsed = false;
		}
		
		function &addRepeatLine($values) {
			$this->parsed = false;
			$key = count($this->lines);
			$this->lines[$key] = new templateFile(sprintf('repeat:%s:%s', $this->name, $key), $this->source);
			$this->lines[$key]->addKeys($values);
			return $this->lines[$key];
		}
		
		function parse() {
			if($this->parsed == true) {
				return $this->data;
			} else {
				foreach($this->lines as $key => $line) {
					$this->data .= $line->parse();
				}
				$this->parsed = true;
				return $this->data;
			}
		}
	}

	class templateFile {
		var $file, $source, $repeats, $values, $data, $parsed, $startTime, $endTime;
		
		function templateFile($file, $source = '') {
			$this->file = $file;
			if(empty($source)) {
				$this->getSource();
			} else {
				$this->source = $source;
			}
			$this->repeats = array();
			$this->values = array();
			$this->parsed = false;
			$this->data = '';
			$this->startTime = microtime();
		}
		
		function getSource() {
			$this->source = file_get_contents($this->file);
		}
		
		function addIf($if, $show = true) {
			$pattern = sprintf('#(\[if:%s\].*?\[/if:%s\])#s', $if, $if);
			if(!preg_match($pattern, $this->source, $match)) {
				die(sprintf('if "%s" is not defined in file "%s"', $if, $this->name));
			}
			if($show) {
				$this->source = preg_replace(sprintf('#\[/?if:%s\]#', $if), '', $this->source);
			} else {
				$this->source = preg_replace($pattern, '', $this->source);
			}
			return $show;
		}
		
		function addBlock($repeat, $allvalues) {
			foreach($allvalues as $values) {
				$this->addRepeatLine($repeat, $values);
			}
		}
		
		function &addRepeatLine($repeat, $values = array()) {
			$this->parsed = false;
			if(!isset($this->repeats[$repeat])) {
				$pattern = sprintf('#(\[repeat:%s\](.*?)\[/repeat:%s\])#s', $repeat, $repeat);
				if(!preg_match($pattern, $this->source, $match)) {
					die(sprintf('repeat "%s" is not defined in file "%s"', $repeat, $this->file));
				} else {
					$this->repeats[$repeat] = new templateRepeat($repeat, $match[2]);
					$this->source = str_replace($match[1], sprintf('{repeat:%s}', $repeat), $this->source);
				}
			}
			return $this->repeats[$repeat]->addRepeatLine($values);
		}
		
		function addKeys($values) {
			$this->parsed = false;
			foreach($values as $key => $value) {
				$this->values[sprintf('{%s}', $key)] = $value;
			}
		}
		
		function parse() {
			if($this->parsed == true) {
				return $this->data;
			} else {
				$this->data = $this->source;
				$this->data = str_replace(array_keys($this->values), array_values($this->values), $this->data);
				foreach($this->repeats as $repeat) {
					$this->data = str_replace(sprintf('{repeat:%s}', $repeat->name), $repeat->parse(), $this->data);
				}
				$this->data = preg_replace('#\[repeat:.*?\].*?\[/repeat:.*?\]#s', '', $this->data);
				$this->endTime = microtime();
				return $this->data;
			}
		}
		
		function endTime() {
			$endTime = explode(' ', $this->endTime);
			return $endTime[0]; 
		}
		
		function startTime() {
			$startTime = explode(' ', $this->startTime);
			return $startTime[0];
		}
		
		function parseTime($length) {
			return round($this->endTime - $this->startTime, $length);
		}
	}

	class template {
		var $files, $basedir;    
		
		function Template($dir) {
			$this->files = array();
			$this->setBaseDir($dir);
		}
		
		function setBaseDir($dir) {
			if(!is_dir($dir)) {
				die(sprintf('directory "%s" does not exist', $dir));
			}
			$this->basedir = $dir;
		}
		
		function &addFile($file) {
			$file = sprintf('%s/%s', $this->basedir, $file);
			if(!file_exists($file)) {
				die(sprintf('file "%s" does not exist', $file));
			}        
			$this->files[$file] = new templateFile($file);
			return $this->files[$file];
		}
	}

?>