<?php

class NewsletterClass
{
	private $id;
	private $title;
	private $teaser;
	private $author;
	private $article;
	private $image_id;
	private $publicDate;
	private $link;
	private $newsletter_category_id;
	private $public;
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
	public function getNewsletter()
	{
		$array = array();

		$newsletter_query = 'SELECT * FROM newsletter';

		if($newsletter_result = $GLOBALS["db"]->query($newsletter_query))
		{
			if($newsletter_result->num_rows > 0)
			{
				while($RowObject = $newsletter_result->fetch_object())
				{
					$myNewsletter = new NewsletterClass;

					foreach($myNewsletter->getClassVars() as $cvar)
					{
						$myNewsletter->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myNewsletter);
				}
			}
			$newsletter_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getNewsletterByCategoryIdFE($newsletter_category_id)
	{
		$array = array();

		$newsletter_query = 'SELECT * FROM newsletter WHERE newsletter_category_id = '.$newsletter_category_id.' AND public = 1 ORDER BY publicDate DESC';
        //echo $newsletter_query;

		if($newsletter_result = $GLOBALS["db"]->query($newsletter_query))
		{
			if($newsletter_result->num_rows > 0)
			{
				while($RowObject = $newsletter_result->fetch_object())
				{
					$myNewsletter = new NewsletterClass;

					foreach($myNewsletter->getClassVars() as $cvar)
					{
						$myNewsletter->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myNewsletter);
				}
			}
			$newsletter_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getNewsletterByCategoryId($newsletter_category_id)
	{
		$array = array();

		$newsletter_query = 'SELECT * FROM newsletter WHERE newsletter_category_id = '.$newsletter_category_id.' ORDER BY publicDate DESC';
        //echo $newsletter_query;

		if($newsletter_result = $GLOBALS["db"]->query($newsletter_query))
		{
			if($newsletter_result->num_rows > 0)
			{
				while($RowObject = $newsletter_result->fetch_object())
				{
					$myNewsletter = new NewsletterClass;

					foreach($myNewsletter->getClassVars() as $cvar)
					{
						$myNewsletter->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myNewsletter);
				}
			}
			$newsletter_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getNewsletterById($id)
	{
		$newsletter_query = 'SELECT * FROM newsletter WHERE id = '.$id;

		if($newsletter_result = $GLOBALS["db"]->query($newsletter_query))
		{
			if($newsletter_result->num_rows > 0)
			{
				while($RowObject = $newsletter_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$newsletter_result->close();
		}
	}
##############################################################################################################################
    public function switchVisible()
    {
        if(1 == $this->public)
        {
            $public = 0;
        }
        else
        {
            $public = 1;
        }
        $update_query = "UPDATE newsletter SET public = ".$public." WHERE id = ".$this->id;
		$GLOBALS["db"]->query($update_query);
    }
//############################################################################################################################
//############################################################################################################################
	// insert function
	public function insert()
	{
		$insert_query = 'INSERT INTO newsletter (';

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
		$update_query = 'UPDATE newsletter SET ';

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
		$delete_query = 'DELETE FROM newsletter WHERE id = '.$this->id;
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

	private function get_author()
	{
		return $this->author;
	}
	private function set_author($value)
	{
		$this->author = $value;
	}

	private function get_article()
	{
		return $this->article;
	}
	private function set_article($value)
	{
		$this->article = $value;
	}

	private function get_image_id()
	{
		return $this->image_id;
	}
	private function set_image_id($value)
	{
		$this->image_id = $value;
	}

	private function get_publicDate()
	{
		return $this->publicDate;
	}
	private function set_publicDate($value)
	{
		$this->publicDate = $value;
	}

	private function get_link()
	{
		return $this->link;
	}
	private function set_link($value)
	{
		$this->link = $value;
	}

	private function get_newsletter_category_id()
	{
		return $this->newsletter_category_id;
	}
	private function set_newsletter_category_id($value)
	{
		$this->newsletter_category_id = $value;
	}

	private function get_public()
	{
		return $this->public;
	}
	private function set_public($value)
	{
		$this->public = $value;
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
