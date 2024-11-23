<?php

class NewsletterSubscriberClass
{
	private $id;
	private $lastname;
	private $firstname;
	private $email;
	private $gender;
	private $html;
	private $auth;
	private $authLinkClicked;
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
	public function getNewsletterSubscriber()
	{
		$array = array();

		$newsletterSubscriber_query = 'SELECT * FROM newsletter_subscriber';

		if($newsletterSubscriber_result = $GLOBALS["db"]->query($newsletterSubscriber_query))
		{
			if($newsletterSubscriber_result->num_rows > 0)
			{
				while($RowObject = $newsletterSubscriber_result->fetch_object())
				{
					$myNewsletterSubscriber = new NewsletterSubscriberClass;

					foreach($myNewsletterSubscriber->getClassVars() as $cvar)
					{
						$myNewsletterSubscriber->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myNewsletterSubscriber);
				}
			}
			$newsletterSubscriber_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function activateSubscriber($auth)
	{
		$newsletterSubscriber_query = 'SELECT * FROM newsletter_subscriber WHERE auth = "'.$auth.'" AND authLinkClicked = 0';

		if($newsletterSubscriber_result = $GLOBALS["db"]->query($newsletterSubscriber_query))
		{
			if($newsletterSubscriber_result->num_rows > 0)
			{
				while($RowObject = $newsletterSubscriber_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
                }
                $this->authLinkClicked = 1;
                $this->update();
                $newsletterSubscriber_result->close();
                return true;
            }
            else
            {
                $newsletterSubscriber_result->close();
                return false;
            }
		}
	}
##############################################################################################################################
	public function getNewsletterSubscriberById($id)
	{
		$newsletterSubscriber_query = 'SELECT * FROM newsletter_subscriber WHERE id = '.$id;

		if($newsletterSubscriber_result = $GLOBALS["db"]->query($newsletterSubscriber_query))
		{
			if($newsletterSubscriber_result->num_rows > 0)
			{
				while($RowObject = $newsletterSubscriber_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$newsletterSubscriber_result->close();
		}
	}
//############################################################################################################################
//############################################################################################################################
	// insert function
	public function insert()
	{
		$insert_query = 'INSERT INTO newsletter_subscriber (';

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
		$update_query = 'UPDATE newsletter_subscriber SET ';

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
		$delete_query = 'DELETE FROM newsletter_subscriber WHERE id = '.$this->id;
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

	private function get_lastname()
	{
		return $this->lastname;
	}
	private function set_lastname($value)
	{
		$this->lastname = $value;
	}

	private function get_firstname()
	{
		return $this->firstname;
	}
	private function set_firstname($value)
	{
		$this->firstname = $value;
	}

	private function get_email()
	{
		return $this->email;
	}
	private function set_email($value)
	{
		$this->email = $value;
	}

	private function get_gender()
	{
		return $this->gender;
	}
	private function set_gender($value)
	{
		$this->gender = $value;
	}

	private function get_html()
	{
		return $this->html;
	}
	private function set_html($value)
	{
		$this->html = $value;
	}

	private function get_auth()
	{
		return $this->auth;
	}
	private function set_auth($value)
	{
		$this->auth = $value;
	}

	private function get_authLinkClicked()
	{
		return $this->authLinkClicked;
	}
	private function set_authLinkClicked($value)
	{
		$this->authLinkClicked = $value;
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
