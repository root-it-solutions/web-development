<?php

class ImageAlbumClass
{
	private $id;
	private $name;
	private $onlineExpireDate;
	private $seoUrl;
	private $publicDate;
	private $copyright;
	private $imgThumbWidth;
	private $imgThumbHeight;
	private $imgNormalWidth;
	private $imgNormalHeight;
	private $imgBigWidth;
	private $imgBigHeight;
	private $visible;
	private $date;


##############################################################################################################################
	function __construct()
	{
	}

	public function getClassVars()
	{
		return array_keys(get_class_vars(__CLASS__));
	}

##############################################################################################################################
	public function getAlbums()
	{
		$array = array();

		$image_album_query = "SELECT * FROM image_album ORDER BY name ASC";

		if($image_album_result = $GLOBALS["db"]->query($image_album_query))
		{
			if($image_album_result->num_rows > 0)
			{
				while($RowObject = $image_album_result->fetch_object())
				{
					$myImage_album = new ImageAlbumClass;

					foreach($myImage_album->getClassVars() as $cvar)
					{
						$myImage_album->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myImage_album);
				}
			}
			$image_album_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getAlbumsByIds($ids = '')
	{
		$array = array();

		$image_album_query = "SELECT * FROM image_album WHERE id IN(".$ids.") ORDER BY name ASC";
        //echo $image_album_query;

		if($image_album_result = $GLOBALS["db"]->query($image_album_query))
		{
			if($image_album_result->num_rows > 0)
			{
				while($RowObject = $image_album_result->fetch_object())
				{
					$myImage_album = new ImageAlbumClass;

					foreach($myImage_album->getClassVars() as $cvar)
					{
						$myImage_album->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myImage_album);
				}
			}
			$image_album_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getExpiredAlbums()
	{
		$array = array();

		$image_album_query = "SELECT * FROM image_album WHERE CURDATE() > onlineExpireDate AND onlineExpireDate != '0000-00-00'";
        //echo $image_album_query;

		if($image_album_result = $GLOBALS["db"]->query($image_album_query))
		{
			if($image_album_result->num_rows > 0)
			{
				while($RowObject = $image_album_result->fetch_object())
				{
					$myImage_album = new ImageAlbumClass;

					foreach($myImage_album->getClassVars() as $cvar)
					{
						$myImage_album->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myImage_album);
				}
			}
			$image_album_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getImageCount()
	{
        $returnVar = 0;
		$image_album_query = "SELECT count(*) AS imageCount FROM manage_image_album WHERE image_album_id = ".$this->id;

		if($image_album_result = $GLOBALS["db"]->query($image_album_query))
		{
			if($image_album_result->num_rows > 0)
			{
				while($RowObject = $image_album_result->fetch_object())
				{
                    $returnVar = $RowObject->imageCount;
				}
			}
			$image_album_result->close();
		}
        return $returnVar;
	}
##############################################################################################################################
	public function getAlbumByName($name = '')
	{
		$image_album_query = "SELECT * FROM image_album WHERE name = '".$name."'";

		if($image_album_result = $GLOBALS["db"]->query($image_album_query))
		{
			if($image_album_result->num_rows > 0)
			{
				while($RowObject = $image_album_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$image_album_result->close();
		}
	}
##############################################################################################################################
	public function getAlbumById($id)
	{
		$image_album_query = "SELECT * FROM image_album WHERE id = ".$id;

		if($image_album_result = $GLOBALS["db"]->query($image_album_query))
		{
			if($image_album_result->num_rows > 0)
			{
				while($RowObject = $image_album_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$image_album_result->close();
		}
	}
##############################################################################################################################
##############################################################################################################################
	# insert function
	public function insert()
	{
		$insert_query = "INSERT INTO image_album (";

		foreach($this->getClassVars() as $cvar)
		{
			if($cvar <> "id" && $cvar <> "date")
			{
				$insert_query .= $cvar.", ";
			}
		}
		$insert_query = substr($insert_query, 0, strlen($insert_query)-2);
		$insert_query .= ") VALUES (";

		foreach($this->getClassVars() as $cvar)
		{
			if($cvar <> "id" && $cvar <> "date")
			{
				$insert_query .= "'".$this->$cvar."', ";
			}
		}
		$insert_query = substr($insert_query, 0, strlen($insert_query)-2);
		$insert_query .= ")";

		#echo "<br>".$insert_query."<br>";
		$GLOBALS["db"]->query($insert_query);
		$this->id = $GLOBALS["db"]->insert_id;
	}
	# update function
	public function update()
	{
		$update_query = "UPDATE image_album set ";

		foreach($this->getClassVars() as $cvar)
		{
			if($cvar <> "id" && $cvar <> "date")
			{
				$update_query .= $cvar." = '".$this->$cvar."', ";
			}
		}
		$update_query = substr($update_query, 0, strlen($update_query)-2);
		$update_query .= " WHERE id = ".$this->id;

		#echo "<br>".$update_query."<br>";
		$GLOBALS["db"]->query($update_query);
	}
	# delete function
	public function delete()
	{
		$deleteImages_query = "DELETE FROM image WHERE id IN(SELECT image_id FROM manage_image_album WHERE image_album_id = ".$this->id.")";
		$deleteManage_query = "DELETE FROM manage_image_album WHERE image_album_id = ".$this->id;
		$delete_query = "DELETE FROM image_album WHERE id = ".$this->id;
		$GLOBALS["db"]->query($deleteImages_query);
		$GLOBALS["db"]->query($deleteManage_query);
		$GLOBALS["db"]->query($delete_query);
	}
##############################################################################################################################
	# get and set Methods
	public function __set($name,$value)
	{
		$method = "set_".$name;
		if(method_exists($this,$method))
		{
			$this->{$method}($value);
		}
	}
	public function __get($name)
	{
		$method = "get_".$name;
		if(method_exists($this,$method))
		{
			return $this->{$method}();
		}
	}
##############################################################################################################################


	private function get_id()
	{
		return $this->id;
	}
	private function set_id($value)
	{
		$this->id = $value;
	}

	private function get_name()
	{
		return $this->name;
	}
	private function set_name($value)
	{
		$this->name = $value;
	}

	private function get_onlineExpireDate()
	{
		return $this->onlineExpireDate;
	}
	private function set_onlineExpireDate($value)
	{
		$this->onlineExpireDate = $value;
	}

	private function get_seoUrl()
	{
		return $this->seoUrl;
	}
	private function set_seoUrl($value)
	{
		$this->seoUrl = $value;
	}

	private function get_publicDate()
	{
		return $this->publicDate;
	}
	private function set_publicDate($value)
	{
		$this->publicDate = $value;
	}

	private function get_copyright()
	{
		return $this->copyright;
	}
	private function set_copyright($value)
	{
		$this->copyright = $value;
	}

	private function get_imgThumbWidth()
	{
		return $this->imgThumbWidth;
	}
	private function set_imgThumbWidth($value)
	{
		$this->imgThumbWidth = $value;
	}

	private function get_imgThumbHeight()
	{
		return $this->imgThumbHeight;
	}
	private function set_imgThumbHeight($value)
	{
		$this->imgThumbHeight = $value;
	}

	private function get_imgNormalWidth()
	{
		return $this->imgNormalWidth;
	}
	private function set_imgNormalWidth($value)
	{
		$this->imgNormalWidth = $value;
	}

	private function get_imgNormalHeight()
	{
		return $this->imgNormalHeight;
	}
	private function set_imgNormalHeight($value)
	{
		$this->imgNormalHeight = $value;
	}

	private function get_imgBigWidth()
	{
		return $this->imgBigWidth;
	}
	private function set_imgBigWidth($value)
	{
		$this->imgBigWidth = $value;
	}

	private function get_imgBigHeight()
	{
		return $this->imgBigHeight;
	}
	private function set_imgBigHeight($value)
	{
		$this->imgBigHeight = $value;
	}

	private function get_visible()
	{
		return $this->visible;
	}
	private function set_visible($value)
	{
		$this->visible = $value;
	}

	private function get_date()
	{
		return $this->date;
	}
	private function set_date($value)
	{
		$this->date = $value;
	}


}

?>
