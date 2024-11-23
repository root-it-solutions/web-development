<?php

class SeminarClass
{
	private $id;
	private $name;
	private $description;
	private $price;
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
	public function getSeminar()
	{
		$array = array();

		$seminar_query = 'SELECT * FROM seminar ORDER BY name ASC';

		if($seminar_result = $GLOBALS["db"]->query($seminar_query))
		{
			if($seminar_result->num_rows > 0)
			{
				while($RowObject = $seminar_result->fetch_object())
				{
					$mySeminar = new SeminarClass;

					foreach($mySeminar->getClassVars() as $cvar)
					{
						$mySeminar->$cvar = $RowObject->$cvar;
					}
					array_push($array, $mySeminar);
				}
			}
			$seminar_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getSeminarById($id)
	{
		$seminar_query = 'SELECT * FROM seminar WHERE id = '.$id;

		if($seminar_result = $GLOBALS["db"]->query($seminar_query))
		{
			if($seminar_result->num_rows > 0)
			{
				while($RowObject = $seminar_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$seminar_result->close();
		}
	}
//############################################################################################################################
//############################################################################################################################
	// insert function
	public function insert()
	{
		$insert_query = 'INSERT INTO seminar (';

		foreach($this->getClassVars() as $cvar)
		{
			if($cvar != 'id' && $cvar != 'date')
			{
				$insert_query .= $cvar.', ';
			}
		}
		$insert_query = substr($insert_query, 0, strlen($insert_query)-2);
		$insert_query .= ') VALUES (';

		foreach($this->getClassVars() as $cvar)
		{
			if($cvar != 'id' && $cvar != 'date')
			{
				$insert_query .= "'".$this->$cvar."', ";
			}
		}
		$insert_query = substr($insert_query, 0, strlen($insert_query)-2);
		$insert_query .= ')';

		//echo '<br />'.$insert_query.'<br />';
		$GLOBALS["db"]->query($insert_query);
		$this->id = $GLOBALS["db"]->insert_id;
	}
	// update function
	public function update()
	{
		$update_query = 'UPDATE seminar SET ';

		foreach($this->getClassVars() as $cvar)
		{
			if($cvar != 'id' && $cvar != 'date')
			{
				$update_query .= $cvar." = '".$this->$cvar."', ";
			}
		}
		$update_query = substr($update_query, 0, strlen($update_query)-2);
		$update_query .= ' WHERE id = '.$this->id;

	    //echo '<br />'.$update_query.'<br />';
		$GLOBALS["db"]->query($update_query);
	}
	// delete function
	public function delete()
	{
		$delete_query = 'DELETE FROM seminar WHERE id = '.$this->id;
		$GLOBALS["db"]->query($delete_query);
	}
//############################################################################################################################
	// get and set Methods
	public function __set($name,$value)
	{
		$method = 'set_'.$name;
		if(method_exists($this,$method))
		{
			$this->{$method}($value);
		}
	}
	public function __get($name)
	{
		$method = 'get_'.$name;
		if(method_exists($this,$method))
		{
			return $this->{$method}();
		}
	}
//############################################################################################################################


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

	private function get_description()
	{
		return $this->description;
	}
	private function set_description($value)
	{
		$this->description = $value;
	}

	private function get_price()
	{
		return $this->price;
	}
	private function set_price($value)
	{
		$this->price = $value;
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
