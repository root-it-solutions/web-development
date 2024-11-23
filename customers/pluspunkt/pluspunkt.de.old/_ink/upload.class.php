<?php

	class fileUpload {
		var $f_file;
		var $f_path;
		var $f_mode;
		var $f_name;
		var $f_error;
		var $f_extension;
		
		function fileUpload($file, $path, $name = ''){
			$this->f_file = $file;
			$this->f_path = $path;
			$this->f_name = ( empty($name) ) ? $this->f_file['name'] : $name;
			$this->f_extension = $this->getExtension();
			if( !preg_match('/.' . $f_extension . '$/', $this->f_name) ) {
				$this->f_name .= '.' . $f_extension;
			}	
			$this->upload();
		}
		
		function upload() {
			if( $this->f_file == NULL ) {
				trigger_error('no file to upload', E_USER_ERROR);
				return;
			}
			if( file_exists($this->f_path . $this->f_name) ) {
				trigger_error('file exists', E_USER_ERROR);
				return;
			}
			@move_uploaded_file($this->f_file['tmp_name'], $this->f_path . $this->f_name);
			$this->f_error = $this->f_file['error'];
		}
		
		function chmod($mode) {
			if( empty($mode) ) {
				trigger_error('one argument missing', E_USER_ERROR);
				return;
			}
		 	if( !preg_match('/^[0|1|2|4]?[0-7]{3}+$/', $mode) ) {
		 		trigger_error('wrong chmod', E_USER_ERROR);
		 		return;
			}
			$this->mode = $mode;
			chmod($this->f_path . $this->f_name, $mode);
		}
				
		function getExtension() {
			$f_explode = explode('.', $this->f_file['name']);
			$f_extension = $f_explode[count($f_explode) - 1];
			return $f_extension;
		}
		
		function getFileName() {
			return $this->f_name;	
		}
		
		function error() {
			return $this->f_error;
		}
	}
	
	class image extends fileUpload {	
		var $i_compression;	
		function image($file, $path, $compression = '100', $name = ''){
			$this->f_file = $file;
			$this->f_path = $path;
			$this->f_name = ( empty($name) ) ? $this->f_file['name'] : $name;
			$this->f_extension = $this->getExtension();
			$this->i_compression = $compression;
			if( !preg_match('/.' . $this->f_extension . '$/', $this->f_name) ) {
				$this->f_name .= '.' . $this->f_extension;
			}
			if( !preg_match('/[.jpg|.jpeg|.gif|.png]$/', $this->f_name) ) {
				trigger_error('no image given', E_USER_ERROR);
				return;
			}
			$this->upload();
		}
		
		function resize($maxSize) {
			$i_oldsize = getimagesize($this->f_path . $this->f_name);
			$i_oldwidth	= $i_oldsize[0];	
			$i_oldheight = $i_oldsize[1];
			if( $i_oldwidth > $i_oldheight ) {
				$i_newwidth = $maxSize;
				$i_newheight = intval($i_oldheight * $maxSize / $i_oldwidth);
			} else {
				$i_newheight = $maxSize;
				$i_newwidth = intval($i_oldwidth * $maxSize / $i_oldheight);
			}
			if( $this->f_extension == 'jpg' OR $this->f_extension == 'jpeg' ) {
				$i_old = imagecreatefromjpeg($this->f_path . $this->f_name);
			} elseif ( $this->f_extension == 'gif' ) {
				$i_old = imagecreatefromgif($this->f_path . $this->f_name);
			} elseif( $this->f_extension == 'png' ) {
				$i_old = imagecreatefrompng($this->f_path . $this->f_name);
			}	
			$i_new = imagecreatetruecolor ($i_newwidth, $i_newheight);
			imagecopyresized($i_new, $i_old, 0, 0, 0, 0, $i_newwidth, $i_newheight, $i_oldwidth, $i_oldheight);
			imagejpeg($i_new, $this->f_path . $this->f_name, $this->i_compression);					
		}
		
		function resizeWidth($maxSize) {
			$i_oldsize = getimagesize($this->f_path . $this->f_name);
			$i_oldwidth	= $i_oldsize[0];	
			$i_oldheight = $i_oldsize[1];
			$i_newwidth = $maxSize;
			$i_newheight = intval($i_oldheight * $maxSize / $i_oldwidth);
			if( $this->f_extension == 'jpg' OR $this->f_extension == 'jpeg' ) {
				$i_old = imagecreatefromjpeg($this->f_path . $this->f_name);
			} elseif ( $this->f_extension == 'gif' ) {
				$i_old = imagecreatefromgif($this->f_path . $this->f_name);
			} elseif( $this->f_extension == 'png' ) {
				$i_old = imagecreatefrompng($this->f_path . $this->f_name);
			}	
			$i_new = imagecreatetruecolor ($i_newwidth, $i_newheight);
			imagecopyresized($i_new, $i_old, 0, 0, 0, 0, $i_newwidth, $i_newheight, $i_oldwidth, $i_oldheight);
			imagejpeg($i_new, $this->f_path . $this->f_name, $this->i_compression);					
		}
		
		function thumb($maxSize, $extension) {
			$i_newname = ( is_dir($this->f_path . $extension) ) ? $this->f_path . $extension . $this->f_name : $this->f_path . $extension . $this->f_name;
			$i_oldsize = getimagesize($this->f_path . $this->f_name);
			$i_oldwidth	= $i_oldsize[0];	
			$i_oldheight = $i_oldsize[1];
			if( $i_oldwidth > $i_oldheight ) {
				$i_newwidth = $maxSize;
				$i_newheight = intval($i_oldheight * $maxSize / $i_oldwidth);
			} else {
				$i_newheight = $maxSize;
				$i_newwidth = intval($i_oldwidth * $maxSize / $i_oldheight);
			}
			if( $this->f_extension == 'jpg' OR $this->f_extension == 'jpeg' ) {
				$i_old = imagecreatefromjpeg($this->f_path . $this->f_name);
			} elseif ( $this->f_extension == 'gif' ) {
				$i_old = imagecreatefromgif($this->f_path . $this->f_name);
			} elseif( $this->f_extension == 'png' ) {
				$i_old = imagecreatefrompng($this->f_path . $this->f_name);
			}	
			$i_new = imagecreatetruecolor ($i_newwidth, $i_newheight);
			imagecopyresized($i_new, $i_old, 0, 0, 0, 0, $i_newwidth, $i_newheight, $i_oldwidth, $i_oldheight);
			imagejpeg($i_new, $i_newname,  $this->i_compression);	
			chmod($i_newname, 0777);				
		}
	} 

?>