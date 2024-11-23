<?php

class AppointmentClass
{
	private $id;
	private $name;
	private $description;
	private $startDate;
	private $endDate;
	private $seminar_id;
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
	public function getSeminar()
	{
		$array = array();

		$appointment_query = 'SELECT seminar_id FROM appointment WHERE visible = 1 GROUP BY seminar_id';

		if($appointment_result = $GLOBALS["db"]->query($appointment_query))
		{
			if($appointment_result->num_rows > 0)
			{
				while($RowObject = $appointment_result->fetch_object())
				{
					array_push($array, $RowObject->seminar_id);
				}
			}
			$appointment_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getAppointmentBySeminarId($seminar_id)
	{
		$array = array();

		$appointment_query = 'SELECT * FROM appointment WHERE visible = 1 AND seminar_id = '.$seminar_id.' ORDER BY startDate ASC';

		if($appointment_result = $GLOBALS["db"]->query($appointment_query))
		{
			if($appointment_result->num_rows > 0)
			{
				while($RowObject = $appointment_result->fetch_object())
				{
					$myAppointment = new AppointmentClass;

					foreach($myAppointment->getClassVars() as $cvar)
					{
						$myAppointment->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myAppointment);
				}
			}
			$appointment_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getActAppointmentIDs($limit = '')
	{
		$array = array();

		$appointment_query = 'SELECT id FROM appointment WHERE startDate > now() AND visible = 1 ORDER BY startDate ASC '.$limit;
		//echo $appointment_query;

		if($appointment_result = $GLOBALS["db"]->query($appointment_query))
		{
			if($appointment_result->num_rows > 0)
			{
				while($RowObject = $appointment_result->fetch_object())
				{
					array_push($array, $RowObject->id);
				}
			}
			$appointment_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getAppointment($limit = '')
	{
		$array = array();

		$appointment_query = 'SELECT * FROM appointment ORDER BY startDate DESC '.$limit;
        //echo $appointment_query;

		if($appointment_result = $GLOBALS["db"]->query($appointment_query))
		{
			if($appointment_result->num_rows > 0)
			{
				while($RowObject = $appointment_result->fetch_object())
				{
					$myAppointment = new AppointmentClass;

					foreach($myAppointment->getClassVars() as $cvar)
					{
						$myAppointment->$cvar = $RowObject->$cvar;
					}
					array_push($array, $myAppointment);
				}
			}
			$appointment_result->close();
		}
		return $array;
	}
##############################################################################################################################
	public function getAppointmentById($id)
	{
		$appointment_query = 'SELECT * FROM appointment WHERE id = '.$id;

		if($appointment_result = $GLOBALS["db"]->query($appointment_query))
		{
			if($appointment_result->num_rows > 0)
			{
				while($RowObject = $appointment_result->fetch_object())
				{
					foreach($this->getClassVars() as $cvar)
					{
						$this->$cvar = $RowObject->$cvar;
					}
				}
			}
			$appointment_result->close();
		}
	}
//############################################################################################################################
//############################################################################################################################
    public function setOldAppointmentsUnvisible()
    {
        $appointment_query = 'UPDATE appointment SET visible = 0 WHERE DATE_ADD(now(), INTERVAL 5 DAY) > endDate';

	    //echo '<br />'.$appointment_query.'<br />';
		$GLOBALS["db"]->query($appointment_query);
    }
//############################################################################################################################
	// insert function
	public function insert()
	{
		$insert_query = 'INSERT INTO appointment (';

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
		$update_query = 'UPDATE appointment SET ';

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
		$delete_query = 'DELETE FROM appointment WHERE id = '.$this->id;
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

	private function get_description()
	{
		return $this->description;
	}
	private function set_description($value)
	{
		$this->description = $value;
	}

	private function get_startDate()
	{
		return $this->startDate;
	}
	private function set_startDate($value)
	{
		$this->startDate = $value;
	}

	private function get_endDate()
	{
		return $this->endDate;
	}
	private function set_endDate($value)
	{
		$this->endDate = $value;
	}

	private function get_seminar_id()
	{
		return $this->seminar_id;
	}
	private function set_seminar_id($value)
	{
		$this->seminar_id = $value;
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
