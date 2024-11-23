<?php

class ContentClass
{
	private $id;
	private $title;
	private $siteTitle;
	private $logoText;
	private $motive_id;
	private $contentShort;
	private $content;
	private $metaSitetitle;
	private $metaKeywords;
	private $metaDescription;
	private $dcDescription;
	private $phpFile;
	private $user_id;
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
	public function getContentParent()
	{
		$array = array();

		$content_query = "SELECT * FROM content WHERE isParent = 1";

		if($content_result = $GLOBALS["db"]->query($content_query))
		{
			if($content_result->num_rows > 0)
			{
				while($RowObject = $content_result->fetch_object())
				{
					$myContent = new ContentClass;

					foreach($myContent->getClassVars() as $cvar)
					{
						$myContent->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myContent);
				}
			}
			$content_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getContentChilds($parent_id, $admin = '1')
	{
		$array = array();

        if($admin)
        {
		    $content_query = "SELECT * FROM content WHERE isParent = 0 AND menu_id = ".$parent_id." ORDER BY position ASC";
        }
        else
        {
		    $content_query = "SELECT * FROM content WHERE isParent = 0 AND menu_id = ".$parent_id." AND visible = '1' ORDER BY position ASC";
        }

		if($content_result = $GLOBALS["db"]->query($content_query))
		{
			if($content_result->num_rows > 0)
			{
				while($RowObject = $content_result->fetch_object())
				{
					$myContent = new ContentClass;

					foreach($myContent->getClassVars() as $cvar)
					{
						$myContent->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myContent);
				}
			}
			$content_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getContentParentByMenuId($menu_id)
	{
		$content_query = "SELECT * FROM content WHERE menu_id = ".$menu_id." AND isParent = 1";

		if($content_result = $GLOBALS["db"]->query($content_query))
		{
			if($content_result->num_rows > 0)
			{
				while($RowObject = $content_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$content_result->close();
		}
	}
##############################################################################################################################
	public function getContentById($id)
	{
		$content_query = "SELECT * FROM content WHERE id = ".$id;

		if($content_result = $GLOBALS["db"]->query($content_query))
		{
			if($content_result->num_rows > 0)
			{
				while($RowObject = $content_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$content_result->close();
		}
	}
##############################################################################################################################
	public function getContentByLinkName($linkName = '')
	{
		$content_query = "SELECT * FROM content WHERE linkName = '".$linkName."'";

		if($content_result = $GLOBALS["db"]->query($content_query))
		{
			if($content_result->num_rows > 0)
			{
				while($RowObject = $content_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$content_result->close();
		}
	}
##############################################################################################################################
    public function positionUpDown($todo = 'positionDown')
    {
        $this->{$todo}();
    }

##############################################################################################################################
	private function getUpDownNeighbour($menu_id = 0, $position = 0)
	{
		$content_query = "SELECT * FROM content WHERE menu_id = ".$menu_id." AND position = ".$position;
        //echo $content_query;

		if($content_result = $GLOBALS["db"]->query($content_query))
		{
			if($content_result->num_rows > 0)
			{
				while($RowObject = $content_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$content_result->close();
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
        $update_query = "UPDATE content SET visible = ".$visible." WHERE id = ".$this->id;
		$GLOBALS["db"]->query($update_query);
    }
##############################################################################################################################
    private function positionUp()
    {
        if(1 < $this->position)
        {
            $myContent = new ContentClass;
            $myContent->getUpDownNeighbour($this->menu_id, $this->position - 1);
            $myContent->position = $this->position;
            $myContent->update();
            $this->position -= 1;
            $this->update();
        }
    }
##############################################################################################################################
    private function positionDown()
    {
        $myContent = new ContentClass;
        $myContent->getUpDownNeighbour($this->menu_id, $this->position + 1);
        if(0 < $myContent->id)
        {
            $myContent->position = $this->position;
            $myContent->update();
            $this->position += 1;
            $this->update();
        }
    }
##############################################################################################################################
##############################################################################################################################
	# insert function
	public function insert()
	{
		$insert_query = "INSERT INTO content (";

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

		//echo "<br/>".$insert_query."<br/>";exit;
		$GLOBALS["db"]->query($insert_query);
		$this->id = $GLOBALS["db"]->insert_id;
	}
	# update function
	public function update()
	{
		$update_query = "UPDATE content set ";

		foreach($this->getClassVars() as $cvar)
		{
			if($cvar <> "id" && $cvar <> "date")
			{
				$update_query .= $cvar." = '".$this->$cvar."', ";
			}
		}
		$update_query = substr($update_query, 0, strlen($update_query)-2).", date = '".date('Y-m-d H:i:s')."'";
		$update_query .= " WHERE id = ".$this->id;

		//echo "<br />".$update_query."<br />";exit;
		$GLOBALS["db"]->query($update_query);
	}
	# delete function
	public function delete()
	{
		$delete_query = "DELETE FROM content WHERE id = ".$this->id;
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

	private function get_title()
	{
		return $this->title;
	}
	private function set_title($value)
	{
		$this->title = $value;
	}

	private function get_siteTitle()
	{
		return $this->siteTitle;
	}
	private function set_siteTitle($value)
	{
		$this->siteTitle = $value;
	}

	private function get_logoText() { return $this->logoText; } private function set_logoText($value) { $this->logoText = $value; }

	private function get_motive_id()
	{
		return $this->motive_id;
	}
	private function set_motive_id($value)
	{
		$this->motive_id = $value;
	}

	private function get_contentShort() { return $this->contentShort; } private function set_contentShort($value) { $this->contentShort = $value; }
	private function get_content() { return $this->content; } private function set_content($value) { $this->content = $value; }
	private function get_metaSitetitle() { return $this->metaSitetitle; } private function set_metaSitetitle($value) { $this->metaSitetitle = $value; }
	private function get_metaKeywords() { return $this->metaKeywords; } private function set_metaKeywords($value) { $this->metaKeywords = $value; }
	private function get_metaDescription() { return $this->metaDescription; } private function set_metaDescription($value) { $this->metaDescription = $value; }
	private function get_dcDescription() { return $this->dcDescription; } private function set_dcDescription($value) { $this->dcDescription = $value; }

	private function get_phpFile()
	{
		return $this->phpFile;
	}
	private function set_phpFile($value)
	{
		$this->phpFile = $value;
	}

	private function get_user_id()
	{
		return $this->user_id;
	}
	private function set_user_id($value)
	{
		$this->user_id = $value;
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
