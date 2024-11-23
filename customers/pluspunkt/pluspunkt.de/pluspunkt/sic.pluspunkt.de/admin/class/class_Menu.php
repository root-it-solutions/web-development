<?php

class MenuClass
{
	private $id;
	private $lang;
	private $name;
	private $urlName;
	private $parent_id;
	private $position;
	private $content_id;
	private $news_categorie_id;
	private $appointment_id;
	private $seminar_id;
	private $list_id;
	private $template_id;
	private $color;
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
	public function getMenu()
	{
		$array = array();

		$menu_query = "SELECT * FROM menu";

		if($menu_result = $GLOBALS["db"]->query($menu_query))
		{
			if($menu_result->num_rows > 0)
			{
				while($RowObject = $menu_result->fetch_object())
				{
					$myMenu = new MenuClass;

					foreach($myMenu->getClassVars() as $cvar)
					{
						$myMenu->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myMenu);
				}
			}
			$menu_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getMenuParent()
	{
		$array = array();

		$menu_query = "SELECT * FROM menu where parent_id = 0";

		if($menu_result = $GLOBALS["db"]->query($menu_query))
		{
			if($menu_result->num_rows > 0)
			{
				while($RowObject = $menu_result->fetch_object())
				{
					$myMenu = new MenuClass;

					foreach($myMenu->getClassVars() as $cvar)
					{
						$myMenu->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myMenu);
				}
			}
			$menu_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getLanguages()
	{
		$array = array();

		$menu_query = "SELECT lang FROM menu GROUP BY lang";

		if($menu_result = $GLOBALS["db"]->query($menu_query))
		{
			if($menu_result->num_rows > 0)
			{
				while($RowObject = $menu_result->fetch_object())
				{
					array_push($array, $RowObject->lang);
				}
			}
			$menu_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getMenuByParentIdF($parent_id = '0', $lang = 'de')
	{
		$array = array();

		$menu_query = "SELECT * FROM menu WHERE parent_id = ".$parent_id." AND lang = '".$lang."' AND visible = 1 ORDER BY position ASC";
        //echo $menu_query.'<br />';

		if($menu_result = $GLOBALS["db"]->query($menu_query))
		{
			if($menu_result->num_rows > 0)
			{
				while($RowObject = $menu_result->fetch_object())
				{
					$myMenu = new MenuClass;

					foreach($myMenu->getClassVars() as $cvar)
					{
						$myMenu->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myMenu);
				}
			}
			$menu_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getMenuByParentId($parent_id = '0', $lang = 'de')
	{
		$array = array();

		$menu_query = "SELECT * FROM menu WHERE parent_id = ".$parent_id." AND lang = '".$lang."' ORDER BY position ASC";
        //echo $menu_query.'<br />';

		if($menu_result = $GLOBALS["db"]->query($menu_query))
		{
			if($menu_result->num_rows > 0)
			{
				while($RowObject = $menu_result->fetch_object())
				{
					$myMenu = new MenuClass;

					foreach($myMenu->getClassVars() as $cvar)
					{
						$myMenu->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myMenu);
				}
			}
			$menu_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getMenuByUrlName($urlName = '')
	{
		$menu_query = "SELECT * FROM menu WHERE urlName = '".$urlName."' AND visible = 1";

		if($menu_result = $GLOBALS["db"]->query($menu_query))
		{
			if($menu_result->num_rows > 0)
			{
				while($RowObject = $menu_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$menu_result->close();
		}
	}
##############################################################################################################################
	public function getInvisibleMenuByUrlName($urlName = '')
	{
		$menu_query = "SELECT * FROM menu WHERE urlName = '".$urlName."' AND visible = 0";

		if($menu_result = $GLOBALS["db"]->query($menu_query))
		{
			if($menu_result->num_rows > 0)
			{
				while($RowObject = $menu_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$menu_result->close();
		}
	}
##############################################################################################################################
	public function getMenuByFirstPosition()
	{
		$menu_query = "SELECT * FROM menu WHERE parent_id = 0 and position = 1 AND visible = 1";

		if($menu_result = $GLOBALS["db"]->query($menu_query))
		{
			if($menu_result->num_rows > 0)
			{
				while($RowObject = $menu_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$menu_result->close();
		}
	}
##############################################################################################################################
	public function getMenuById($id)
	{
		$menu_query = "SELECT * FROM menu WHERE id = ".$id;

		if($menu_result = $GLOBALS["db"]->query($menu_query))
		{
			if($menu_result->num_rows > 0)
			{
				while($RowObject = $menu_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$menu_result->close();
		}
	}
##############################################################################################################################
	public function checkForchilds()
	{
		$menu_query = "SELECT * FROM menu WHERE parent_id = ".$this->id;
        //echo $menu_query;

		if($menu_result = $GLOBALS["db"]->query($menu_query))
		{
			if($menu_result->num_rows > 0)
			{
                $menu_result->close();
                return true;
			}
            else
            {
                $menu_result->close();
                return false;
            }
		}
	}
##############################################################################################################################
	public function getMenuByUrl($url = 'praxis')
	{
		$menu_query = "SELECT * FROM menu WHERE url = '".$url."'";
        //echo $menu_query;

		if($menu_result = $GLOBALS["db"]->query($menu_query))
		{
			if($menu_result->num_rows > 0)
			{
				while($RowObject = $menu_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$menu_result->close();
		}
	}
##############################################################################################################################
    public function positionUpDown($todo = 'positionDown')
    {
        $this->{$todo}();
    }

##############################################################################################################################
	private function getUpDownNeighbour($parent_id = 0, $position = 0)
	{
		$menu_query = "SELECT * FROM menu WHERE parent_id = ".$parent_id." AND position = ".$position;
        //echo $content_query;

		if($menu_result = $GLOBALS["db"]->query($menu_query))
		{
			if($menu_result->num_rows > 0)
			{
				while($RowObject = $menu_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$menu_result->close();
		}
	}
##############################################################################################################################
    private function positionUp()
    {
        if(1 < $this->position)
        {
            $myMenu = new MenuClass;
            $myMenu->getUpDownNeighbour($this->parent_id, $this->position - 1);
            $myMenu->position = $this->position;
            $myMenu->update();
            $this->position -= 1;
            $this->update();
        }
    }
##############################################################################################################################
    private function positionDown()
    {
        $myMenu = new MenuClass;
        $myMenu->getUpDownNeighbour($this->parent_id, $this->position + 1);
        if(0 < $myMenu->id)
        {
            $myMenu->position = $this->position;
            $myMenu->update();
            $this->position += 1;
            $this->update();
        }
    }
##############################################################################################################################
    public function switchVisible()
    {
        if(1 == $this->visible)
        {
            $visible = 0;
        }
        else
        {
            $visible = 1;
        }
        $update_query = "UPDATE menu SET visible = ".$visible." WHERE id = ".$this->id;
		$GLOBALS["db"]->query($update_query);
    }
##############################################################################################################################
	public function getTemplate()
    {
        $myTemplate_class = new TemplateClass;
        $myTemplate_class->getTemplateById($this->template_id);
        return $myTemplate_class->fileName;
	}
##############################################################################################################################
##############################################################################################################################
	# insert function
	public function insert()
	{
		$insert_query = "INSERT INTO menu (";

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

		//echo "<br>".$insert_query."<br>";
		$GLOBALS["db"]->query($insert_query);
		$this->id = $GLOBALS["db"]->insert_id;
	}
	# update function
	public function update()
	{
		$update_query = "UPDATE menu set ";

		foreach($this->getClassVars() as $cvar)
		{
			if($cvar <> "id" && $cvar <> "date")
			{
				$update_query .= $cvar." = '".$this->$cvar."', ";
			}
		}
		$update_query = substr($update_query, 0, strlen($update_query)-2);
		$update_query .= " WHERE id = ".$this->id;

		//echo "<br>".$update_query."<br>";
		$GLOBALS["db"]->query($update_query);
	}
	# delete function
	public function delete()
	{
		$delete_query = "DELETE FROM menu WHERE id = ".$this->id;
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

	private function get_urlName()
	{
		return $this->urlName;
	}
	private function set_urlName($value)
	{
		$this->urlName = $value;
	}

	private function get_parent_id()
	{
		return $this->parent_id;
	}
	private function set_parent_id($value)
	{
		$this->parent_id = $value;
	}

	private function get_position()
	{
		return $this->position;
	}
	private function set_position($value)
	{
		$this->position = $value;
	}

	private function get_content_id()
	{
		return $this->content_id;
	}
	private function set_content_id($value)
	{
		$this->content_id = $value;
	}

	private function get_news_categorie_id()
	{
		return $this->news_categorie_id;
	}
	private function set_news_categorie_id($value)
	{
		$this->news_categorie_id = $value;
	}

	private function get_appointment_id()
	{
		return $this->appointment_id;
	}
	private function set_appointment_id($value)
	{
		$this->appointment_id = $value;
	}

	private function get_seminar_id()
	{
		return $this->seminar_id;
	}
	private function set_seminar_id($value)
	{
		$this->seminar_id = $value;
	}

	private function get_list_id()
	{
		return $this->list_id;
	}
	private function set_list_id($value)
	{
		$this->list_id = $value;
	}

	private function get_template_id()
	{
		return $this->template_id;
	}
	private function set_template_id($value)
	{
		$this->template_id = $value;
	}

	private function get_color()
	{
		return $this->color;
	}
	private function set_color($value)
	{
		$this->color = $value;
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
