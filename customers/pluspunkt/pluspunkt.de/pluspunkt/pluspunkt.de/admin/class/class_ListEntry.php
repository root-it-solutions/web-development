<?php

class ListEntryClass
{
	private $id;
	private $title;
	private $teaser;
	private $text;
	private $link;
	private $linkTarget;
	private $image_id;
	private $list_id;
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
	public function getListEntry()
	{
		$array = array();

		$listEntry_query = 'SELECT * FROM list_entry';

		if($listEntry_result = $GLOBALS["db"]->query($listEntry_query))
		{
			if($listEntry_result->num_rows > 0)
			{
				while($RowObject = $listEntry_result->fetch_object())
				{
					$myListEntry = new ListEntryClass;

					foreach($myListEntry->getClassVars() as $cvar)
					{
						$myListEntry->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myListEntry);
				}
			}
			$listEntry_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getEntriesByListId($list_id)
	{
		$array = array();

		$listEntry_query = 'SELECT * FROM list_entry WHERE list_id = '.$list_id.' ORDER BY date DESC';
        //echo $listEntry_query;

		if($listEntry_result = $GLOBALS["db"]->query($listEntry_query))
		{
			if($listEntry_result->num_rows > 0)
			{
				while($RowObject = $listEntry_result->fetch_object())
				{
					$myListEntry = new ListEntryClass;

					foreach($myListEntry->getClassVars() as $cvar)
					{
						$myListEntry->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myListEntry);
				}
			}
			$listEntry_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getListEntryById($id)
	{
		$listEntry_query = 'SELECT * FROM list_entry WHERE id = '.$id;

		if($listEntry_result = $GLOBALS["db"]->query($listEntry_query))
		{
			if($listEntry_result->num_rows > 0)
			{
				while($RowObject = $listEntry_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$listEntry_result->close();
		}
	}
//############################################################################################################################
//############################################################################################################################
	// insert function
	public function insert()
	{
		$insert_query = 'INSERT INTO list_entry (';

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
				$insert_query .= "'".$GLOBALS["db"]->real_escape_string($this->$cvar)."', ";
			}
		}
		$insert_query = substr($insert_query, 0, strlen($insert_query)-2);
		$insert_query .= ')';

//		echo $insert_query;exit;
		$GLOBALS["db"]->query($insert_query);
		$this->id = $GLOBALS["db"]->insert_id;
	}
	// update function
	public function update()
	{
		$update_query = 'UPDATE list_entry SET ';

		foreach($this->getClassVars() as $cvar)
		{
			if($cvar != 'id' && $cvar != 'date')
			{
				$update_query .= $cvar." = '".$GLOBALS["db"]->real_escape_string($this->$cvar)."', ";
			}
		}
		$update_query = substr($update_query, 0, strlen($update_query)-2);
		$update_query .= ' WHERE id = '.$this->id;

	    //echo '<br />'.$update_query.'<br />';exit;
		return $GLOBALS["db"]->query($update_query);
	}
	// delete function
	public function delete()
	{
		$delete_query = 'DELETE FROM list_entry WHERE id = '.$this->id;
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

	private function get_title()
	{
		return $this->title;
	}
	private function set_title($value)
	{
		$this->title = $value;
	}

	private function get_teaser()
	{
		return $this->teaser;
	}
	private function set_teaser($value)
	{
		$this->teaser = $value;
	}

	private function get_text()
	{
		return $this->text;
	}
	private function set_text($value)
	{
		$this->text = $value;
	}

	private function get_link()
	{
		return $this->link;
	}
	private function set_link($value)
	{
		$this->link = $value;
	}

	private function get_linkTarget()
	{
		return $this->linkTarget;
	}
	private function set_linkTarget($value)
	{
		$this->linkTarget = $value;
	}

	private function get_image_id()
	{
		return $this->image_id;
	}
	private function set_image_id($value)
	{
		$this->image_id = $value;
	}

	private function get_list_id()
	{
		return $this->list_id;
	}
	private function set_list_id($value)
	{
		$this->list_id = $value;
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
