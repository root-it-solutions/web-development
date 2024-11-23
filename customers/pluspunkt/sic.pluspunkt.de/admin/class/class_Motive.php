<?php

class MotiveClass
{
	private $id;
	private $name;
	private $alt;
	private $title;
	private $fileName;
	private $date;


##############################################################################################################################
	function __construct($id = 0)
        {
            if($id != 0)
            {
                $this->getMotiveById($id);
            }
	}

	public function getClassVars()
	{
		return array_keys(get_class_vars(__CLASS__));
	}

##############################################################################################################################
	public function getMotive()
	{
		$array = array();

		$motive_query = "SELECT * FROM motive ORDER BY name ASC";

		if($motive_result = $GLOBALS["db"]->query($motive_query))
		{
			if($motive_result->num_rows > 0)
			{
				while($RowObject = $motive_result->fetch_object())
				{
					$myMotive = new MotiveClass;

					foreach($myMotive->getClassVars() as $cvar)
					{
						$myMotive->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myMotive);
				}
			}
			$motive_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getMotiveById($id)
	{
		$motive_query = "SELECT * FROM motive WHERE id = ".$id;

		if($motive_result = $GLOBALS["db"]->query($motive_query))
		{
			if($motive_result->num_rows > 0)
			{
				while($RowObject = $motive_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$motive_result->close();
		}
	}
##############################################################################################################################
##############################################################################################################################
	# insert function
	public function insert()
	{
		$insert_query = "INSERT INTO motive (";

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
		$update_query = "UPDATE motive set ";

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
		$delete_query = "DELETE FROM motive WHERE id = ".$this->id;
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

	private function get_alt()
	{
		return $this->alt;
	}
	private function set_alt($value)
	{
		$this->alt = $value;
	}

	private function get_title()
	{
		return $this->title;
	}
	private function set_title($value)
	{
		$this->title = $value;
	}

	private function get_fileName()
	{
		return $this->fileName;
	}
	private function set_fileName($value)
	{
		$this->fileName = $value;
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
