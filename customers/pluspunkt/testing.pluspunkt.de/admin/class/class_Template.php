<?php

class TemplateClass
{
	private $id;
	private $name;
	private $fileName;
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
	public function getTemplates()
	{
		$array = array();

		$template_query = 'SELECT * FROM template';

		if($template_result = $GLOBALS["db"]->query($template_query))
		{
			if($template_result->num_rows > 0)
			{
				while($RowObject = $template_result->fetch_object())
				{
					$myTemplate = new TemplateClass;

					foreach($myTemplate->getClassVars() as $cvar)
					{
						$myTemplate->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myTemplate);
				}
			}
			$template_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getTemplateById($id)
	{
		$template_query = 'SELECT * FROM template WHERE id = '.$id;

		if($template_result = $GLOBALS["db"]->query($template_query))
		{
			if($template_result->num_rows > 0)
			{
				while($RowObject = $template_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$template_result->close();
		}
	}
//############################################################################################################################
//############################################################################################################################
    public function setOldTemplatesUnvisible()
    {
        $template_query = 'UPDATE template SET visible = 0 WHERE DATE_ADD(now(), INTERVAL 5 DAY) > endDate';

	    //echo '<br />'.$template_query.'<br />';
		$GLOBALS["db"]->query($template_query);
    }
//############################################################################################################################
	// insert function
	public function insert()
	{
		$insert_query = 'INSERT INTO template (';

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
		$update_query = 'UPDATE template SET ';

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
		$delete_query = 'DELETE FROM template WHERE id = '.$this->id;
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

	private function get_name()
	{
		return $this->name;
	}
	private function set_name($value)
	{
		$this->name = $value;
	}

	private function get_fileName()
	{
		return $this->fileName;
	}
	private function set_fileName($value)
	{
		$this->fileName = $value;
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
