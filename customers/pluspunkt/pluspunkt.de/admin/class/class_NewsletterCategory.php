<?php

class NewsletterCategoryClass
{
	private $id;
	private $lang;
	private $name;
	private $description;
	private $position;
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
	public function getNewsletterCategories($lang = 'de')
	{
		$array = array();

		$newsletterCategory_query = 'SELECT * FROM newsletter_category WHERE lang = "'.$lang.'" ORDER BY position ASC';
        //echo $newsletterCategory_query;

		if($newsletterCategory_result = $GLOBALS["db"]->query($newsletterCategory_query))
		{
			if($newsletterCategory_result->num_rows > 0)
			{
				while($RowObject = $newsletterCategory_result->fetch_object())
				{
					$myNewsletterCategory = new NewsletterCategoryClass;

					foreach($myNewsletterCategory->getClassVars() as $cvar)
					{
						$myNewsletterCategory->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myNewsletterCategory);
				}
			}
			$newsletterCategory_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getNewsletterCategoryById($id)
	{
		$newsletterCategory_query = 'SELECT * FROM newsletter_category WHERE id = '.$id;

		if($newsletterCategory_result = $GLOBALS["db"]->query($newsletterCategory_query))
		{
			if($newsletterCategory_result->num_rows > 0)
			{
				while($RowObject = $newsletterCategory_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$newsletterCategory_result->close();
		}
	}
//############################################################################################################################
//############################################################################################################################
	// insert function
	public function insert()
	{
		$insert_query = 'INSERT INTO newsletter_category (';

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
		$update_query = 'UPDATE newsletter_category SET ';

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
		$delete_query = 'DELETE FROM newsletter_category WHERE id = '.$this->id;
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

	private function get_position()
	{
		return $this->position;
	}
	private function set_position($value)
	{
		$this->position = $value;
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
