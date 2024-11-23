<?php

class ListClass
{
	private $id;
	private $lang;
	private $name;
	private $description;
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
	public function getLists($lang = 'de')
	{
		$array = array();

		$list_query = 'SELECT * FROM list WHERE lang = "'.$lang.'" ORDER BY name ASC';

		if($list_result = $GLOBALS["db"]->query($list_query))
		{
			if($list_result->num_rows > 0)
			{
				while($RowObject = $list_result->fetch_object())
				{
					$myList = new ListClass;

					foreach($myList->getClassVars() as $cvar)
					{
						$myList->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myList);
				}
			}
			$list_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getListById($id)
	{
		$list_query = 'SELECT * FROM list WHERE id = '.$id;

		if($list_result = $GLOBALS["db"]->query($list_query))
		{
			if($list_result->num_rows > 0)
			{
				while($RowObject = $list_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$list_result->close();
		}
	}
//############################################################################################################################
//############################################################################################################################
	// insert function
	public function insert()
	{
		$insert_query = 'INSERT INTO list (';

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

		$GLOBALS["db"]->query($insert_query);
		$this->id = $GLOBALS["db"]->insert_id;
	}
	// update function
	public function update()
	{
		$update_query = 'UPDATE list SET ';

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
		return $GLOBALS["db"]->query($update_query);
	}
	// delete function
	public function delete()
	{
		$delete_query = 'DELETE FROM list WHERE id = '.$this->id;
		return $GLOBALS["db"]->query($delete_query);
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

	private function get_lang()
	{
		return $this->lang;
	}
	private function set_lang($value)
	{
		$this->lang = $value;
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
