<?php

class ImageClass
{
	private $id;
	private $name;
	private $nameFile;
	private $visible;
	private $hits;
	private $sort;
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
	public function getImage()
	{
		$array = array();

		$image_query = "SELECT * FROM image";

		if($image_result = $GLOBALS["db"]->query($image_query))
		{
			if($image_result->num_rows > 0)
			{
				while($RowObject = $image_result->fetch_object())
				{
					$myImage = new ImageClass;

					foreach($myImage->getClassVars() as $cvar)
					{
						$myImage->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myImage);
				}
			}
			$image_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getImagesByAlbumId($album_id = 0, $visible = '1')
	{
		$array = array();

        $keywordsFilter_array = explode(',', $keywordsFilter_str);
        $image_query = "SELECT * FROM image WHERE id IN(SELECT image_id FROM manage_image_album WHERE image_album_id = ".$album_id.") ";
        $image_query .= " AND visible regexp '^[".$visible."]' ORDER BY sort ASC";
        //echo $image_query;

		if($image_result = $GLOBALS["db"]->query($image_query))
		{
			if($image_result->num_rows > 0)
			{
				while($RowObject = $image_result->fetch_object())
				{
					$myImage = new ImageClass;

					foreach($myImage->getClassVars() as $cvar)
					{
						$myImage->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myImage);
				}
			}
			$image_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getImagesToDelete($album_id = 0)
	{
		$array = array();

        $image_query = "SELECT * FROM image WHERE id IN(SELECT image_id FROM manage_image_album WHERE image_album_id = ".$album_id.") AND syncChecked = 0";
        //echo $image_query;

		if($image_result = $GLOBALS["db"]->query($image_query))
		{
			if($image_result->num_rows > 0)
			{
				while($RowObject = $image_result->fetch_object())
				{
					$myImage = new ImageClass;

					foreach($myImage->getClassVars() as $cvar)
					{
						$myImage->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myImage);
				}
			}
			$image_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getImageById($id)
	{
		$image_query = "SELECT * FROM image WHERE id = ".$id;

		if($image_result = $GLOBALS["db"]->query($image_query))
		{
			if($image_result->num_rows > 0)
			{
				while($RowObject = $image_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$image_result->close();
		}
	}
##############################################################################################################################
##############################################################################################################################
	# insert function
	public function insert()
	{
		$insert_query = "INSERT INTO image (";

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
		$update_query = "UPDATE image set ";

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
    // update keywords
    public function updateKeywords($keywordsIds_array = array())
    {
        if(0 < count($keywordsIds_array))
        {
            foreach($keywordsIds_array as $keywordId)
            {
                if(!$this->checkKeyword($keywordId))
                {
                    $insert_query = "INSERT INTO manage_image_keywords (image_id, keywords_id) VALUES (".$this->id.", ".$keywordId.");";
                    //echo $insert_query;
                    $GLOBALS["db"]->query($insert_query);
                }
            }
        }
    }
    private function checkKeyword($keyword_id = 0)
    {
        $image_query = "SELECT * FROM manage_image_keywords WHERE keywords_id = ".$keyword_id." AND image_id = ".$this->id;

		if($image_result = $GLOBALS["db"]->query($image_query))
		{
			if($image_result->num_rows > 0)
			{
                return true;
            }
            else
            {
                return false;
            }
        }
    }
	# delete function
	public function delete()
	{
		$delete_query = "DELETE FROM manage_image_album WHERE image_id = ".$this->id;
		$delete_query2 = "DELETE FROM manage_image_keywords WHERE image_id = ".$this->id;
		$delete_query3 = "DELETE FROM image WHERE id = ".$this->id;
		$GLOBALS["db"]->query($delete_query);
		$GLOBALS["db"]->query($delete_query2);
		$GLOBALS["db"]->query($delete_query3);
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

	private function get_nameFile() { return $this->nameFile; } private function set_nameFile($value) { $this->nameFile = $value; }
	private function get_visible() { return $this->visible; } private function set_visible($value) { $this->visible = $value; }

	private function get_hits()
	{
		return $this->hits;
	}
	private function set_hits($value)
	{
		$this->hits = $value;
	}

	private function get_sort()
	{
		return $this->sort;
	}
	private function set_sort($value)
	{
		$this->sort = $value;
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
