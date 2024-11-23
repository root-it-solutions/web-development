<?php

class MnTmBlockCount
{
    private $ownerAuthAddress;
    private $tm1;
    private $tm2;
    private $tm3;
    private $tm4;

    /**
     * @throws Exception
     */
    public function __construct($ownerAuthAddress = '')
    {
        if($ownerAuthAddress !== '')
        {
            $this->getTmBlockCount($ownerAuthAddress);
        }
        else
        {
            throw new Exception('Please give a Owneraddress');
        }
    }

    public function getClassVars(): array
    {
        return array_keys(get_class_vars(get_class($this)));
    }

    private function getTmBlockCount($ownerAuthAddress)
    {
        $query = "SELECT * FROM mn_tm_block_count WHERE ownerAuthAddress = '".$ownerAuthAddress."'";

        if($result = $GLOBALS["db"]->query($query))
        {
            $mnTmBlockCount = $result->fetch_object();
            $this->ownerAuthAddress = $mnTmBlockCount->ownerAuthAddress;
            $this->tm1 = $mnTmBlockCount->tm1;
            $this->tm2 = $mnTmBlockCount->tm2;
            $this->tm3 = $mnTmBlockCount->tm3;
            $this->tm4 = $mnTmBlockCount->tm4;
        }
        else
        {
            return false;
        }
    }
##############################################################################################################################
    public function insert()
    {
        $insert_query = "INSERT INTO mn_tm_block_count (";

        foreach($this->getClassVars() as $cvar)
        {
            $insert_query .= $cvar.", ";
        }
        $insert_query = substr($insert_query, 0, strlen($insert_query)-2);
        $insert_query .= ") VALUES (";

        foreach($this->getClassVars() as $cvar)
        {
            $insert_query .= "'".$this->$cvar."', ";
        }
        $insert_query = substr($insert_query, 0, strlen($insert_query)-2);
        $insert_query .= ")";

        $GLOBALS["db"]->query($insert_query);
    }

    public function update()
    {
        $update_query = "UPDATE mn_tm_block_count set ";

        foreach($this->getClassVars() as $cvar)
        {
            if($cvar !== 'ownerAuthAddress')
            {
                $update_query .= $cvar." = '".$this->$cvar."', ";
            }
        }
        $update_query = substr($update_query, 0, strlen($update_query)-2);
        $update_query .= " WHERE ownerAuthAddress = ".$this->ownerAuthAddress;
        #echo "<br>".$update_query."<br>";
        $GLOBALS["db"]->query($update_query);
    }
##############################################################################################################################
    /**
     * @throws Exception
     */
    public function __get($name)
    {
        $name = ucfirst($name);
        $method = "get".$name;
        if(!method_exists($this,$method))
        {
            throw new Exception('Function get'.$name.' doesnt exist!');
        }
        return $this->{$method}();
    }

    /**
     * @return mixed
     */
    private function getOwnerAuthAddress()
    {
        return $this->ownerAuthAddress;
    }

    /**
     * @param mixed $ownerAuthAddress
     */
    private function setOwnerAuthAddress($ownerAuthAddress): void
    {
        $this->ownerAuthAddress = $ownerAuthAddress;
    }

    /**
     * @return mixed
     */
    private function getTm1()
    {
        return $this->tm1;
    }

    /**
     * @param mixed $tm1
     */
    private function setTm1($tm1): void
    {
        $this->tm1 = $tm1;
    }

    /**
     * @return mixed
     */
    private function getTm2()
    {
        return $this->tm2;
    }

    /**
     * @param mixed $tm2
     */
    private function setTm2($tm2): void
    {
        $this->tm2 = $tm2;
    }

    /**
     * @return mixed
     */
    private function getTm3()
    {
        return $this->tm3;
    }

    /**
     * @param mixed $tm3
     */
    private function setTm3($tm3): void
    {
        $this->tm3 = $tm3;
    }

    /**
     * @return mixed
     */
    private function getTm4()
    {
        return $this->tm4;
    }

    /**
     * @param mixed $tm4
     */
    private function setTm4($tm4): void
    {
        $this->tm4 = $tm4;
    }
}