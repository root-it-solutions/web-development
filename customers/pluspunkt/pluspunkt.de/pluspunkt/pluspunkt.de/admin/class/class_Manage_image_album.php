<?php

class Manage_image_albumClass
{
	private $id;
	private $image_album_id;
	private $image_id;
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
	public function getManage_image_album()
	{
		$array = array();

		$manage_image_album_query = "SELECT * FROM manage_image_album";

		if($manage_image_album_result = $GLOBALS["db"]->query($manage_image_album_query))
		{
			if($manage_image_album_result->num_rows > 0)
			{
				while($RowObject = $manage_image_album_result->fetch_object())
				{
					$myManage_image_album = new Manage_image_albumClass;

					foreach($myManage_image_album->getClassVars() as $cvar)
					{
						$myManage_image_album->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myManage_image_album);
				}
			}
			$manage_image_album_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getManage_image_albumById($id)
	{
		$manage_image_album_query = "SELECT * FROM manage_image_album WHERE id = ".$id;

		if($manage_image_album_result = $GLOBALS["db"]->query($manage_image_album_query))
		{
			if($manage_image_album_result->num_rows > 0)
			{
				while($RowObject = $manage_image_album_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$manage_image_album_result->close();
		}
	}
##############################################################################################################################
##############################################################################################################################
	# insert function
	public function insert()
	{
		$insert_query = "INSERT INTO manage_image_album (";

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
		$update_query = "UPDATE manage_image_album set ";

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
		$delete_query = "DELETE FROM manage_image_album WHERE id = ".$this->id;
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

	private function get_image_album_id()
	{
		return $this->image_album_id;
	}
	private function set_image_album_id($value)
	{
		$this->image_album_id = $value;
	}

	private function get_image_id()
	{
		return $this->image_id;
	}
	private function set_image_id($value)
	{
		$this->image_id = $value;
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
