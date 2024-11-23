<?php

class InspirationClass
{
	private $id;
	private $name;
	private $street;
	private $zipCodeCity;
	private $fon;
	private $email;
	private $amountParents;
	private $parentsNames;
	private $amountChildren;
	private $childrenNames;
	private $ageChildren;
	private $date;


##############################################################################################################################
	function __construct($id = 0)
	{
        if($id != 0)
        {
            $this->getInspirationById($id);
        }
	}

	public function getClassVars()
	{
		return array_keys(get_class_vars(__CLASS__));
	}

##############################################################################################################################
	public function getInspiration()
	{
		$array = array();

		$inspirtation_query = 'SELECT * FROM inspiration';

		if($inspirtation_result = $GLOBALS["db"]->query($inspirtation_query))
		{
			if($inspirtation_result->num_rows > 0)
			{
				while($RowObject = $inspirtation_result->fetch_object())
				{
					$myInspiration = new InspirationClass;

					foreach($myInspiration->getClassVars() as $cvar)
					{
						$myInspiration->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myInspiration);
				}
			}
			$inspirtation_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getInspirationToCSV(&$out)
	{
		$array = array();

        fputcsv($out, array("Name", "Strasse", "PLZ / Stadt", "Telefon", "E-Mail", "Anzahl Erwachsene", "Namen der Erwachsenen", "Anzahl Kinder", "Namen der Kider", "Alter der Kinder"), ';');

		$inspirtation_query = 'SELECT * FROM inspiration';

		if($inspirtation_result = $GLOBALS["db"]->query($inspirtation_query))
		{
			if($inspirtation_result->num_rows > 0)
			{
				while($RowObject = $inspirtation_result->fetch_object())
				{
                    fputcsv($out, array($RowObject->name, $RowObject->street, $RowObject->zipCodeCity, $RowObject->fon, $RowObject->email, $RowObject->amountParents, $RowObject->parentsNames, $RowObject->amountChildren, $RowObject->childrenNames, $RowObject->ageChildren), ';');
				}
			}
			$inspirtation_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getInspirationById($id)
	{
		$inspirtation_query = 'SELECT * FROM inspiration WHERE id = '.$id;

		if($inspirtation_result = $GLOBALS["db"]->query($inspirtation_query))
		{
			if($inspirtation_result->num_rows > 0)
			{
				while($RowObject = $inspirtation_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$inspirtation_result->close();
		}
	}
//############################################################################################################################
//############################################################################################################################
	// insert function
	public function insert()
	{
		$insert_query = 'INSERT INTO inspiration (';

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
		$update_query = 'UPDATE inspiration SET ';

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
		$delete_query = 'DELETE FROM inspiration WHERE id = '.$this->id;
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

	private function get_street()
	{
		return $this->street;
	}
	private function set_street($value)
	{
		$this->street = $value;
	}

	private function get_zipCodeCity()
	{
		return $this->zipCodeCity;
	}
	private function set_zipCodeCity($value)
	{
		$this->zipCodeCity = $value;
	}

	private function get_fon()
	{
		return $this->fon;
	}
	private function set_fon($value)
	{
		$this->fon = $value;
	}

	private function get_email()
	{
		return $this->email;
	}
	private function set_email($value)
	{
		$this->email = $value;
	}

	private function get_amountParents()
	{
		return $this->amountParents;
	}
	private function set_amountParents($value)
	{
		$this->amountParents = $value;
	}

	private function get_parentsNames()
	{
		return $this->parentsNames;
	}
	private function set_parentsNames($value)
	{
		$this->parentsNames = $value;
	}

	private function get_amountChildren()
	{
		return $this->amountChildren;
	}
	private function set_amountChildren($value)
	{
		$this->amountChildren = $value;
	}

	private function get_childrenNames()
	{
		return $this->childrenNames;
	}
	private function set_childrenNames($value)
	{
		$this->childrenNames = $value;
	}

	private function get_ageChildren()
	{
		return $this->ageChildren;
	}
	private function set_ageChildren($value)
	{
		$this->ageChildren = $value;
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
