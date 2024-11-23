<?php

class Masternode
{
    private $id;
    private $ownerAuthAddress;
    private $operatorAuthAddress;
    private $creationHeight;
    private $resignHeight;
    private $state;
    private $mintedBlocks;
    private $targetMultiplier1;
    private $targetMultiplier2;
    private $targetMultiplier3;
    private $targetMultiplier4;
    private $timelock;

    function __construct()
    {
    }
    
    public function getClassVars(): array
    {
        return array_keys(get_class_vars(get_class($this)));
    }

    public function getMasternodes(string $where = '', string $order = ''): array
    {
        $query = 'SELECT * FROM masternode_list '.$where.' '.$order.';';
//         echo $query;exit;

        $array = array();
        if($result = $GLOBALS["db"]->query($query))
        {
            if($result->num_rows > 0)
            {
                while($RowObject = $result->fetch_object())
                {
                    $mn = new Masternode;
                    
                    foreach($mn->getClassVars() as $cvar)
                    {
                        $mn->$cvar = $RowObject->$cvar;
                    }
                    array_push($array, $mn);
                }
            }
            $result->close();
            return $array;
        }
        else
        {
            return array();
        }
    }

    /**
     * @throws Exception
     */
    public function getMasternodeId($ownerAuthAddress): string
    {
        if($ownerAuthAddress === '')
        {
            throw new Exception('Please give Matsternode Owneraddress');
        }
        $query = "SELECT id FROM masternode_list WHERE ownerAuthAddress = '".$ownerAuthAddress."'";

        if($result = $GLOBALS["db"]->query($query))
        {
            if ($result->num_rows > 0)
            {
                return ($result->fetch_row())[0];
            }
            else
            {
                throw new Exception('Masternode ID nicht gefunden');
            }
        }
        return '';
    }
    public function getTMSpread(): array
    {
        $query = <<<EOT
SELECT 
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 1 or targetMultiplier2 = 1 or targetMultiplier3 = 1 or targetMultiplier4 = 1) as '1',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 2 or targetMultiplier2 = 2 or targetMultiplier3 = 2 or targetMultiplier4 = 2) as '2',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 3 or targetMultiplier2 = 3 or targetMultiplier3 = 3 or targetMultiplier4 = 3) as '3',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 4 or targetMultiplier2 = 4 or targetMultiplier3 = 4 or targetMultiplier4 = 4) as '4',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 5 or targetMultiplier2 = 5 or targetMultiplier3 = 5 or targetMultiplier4 = 5) as '5',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 6 or targetMultiplier2 = 6 or targetMultiplier3 = 6 or targetMultiplier4 = 6) as '6',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 7 or targetMultiplier2 = 7 or targetMultiplier3 = 7 or targetMultiplier4 = 7) as '7',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 8 or targetMultiplier2 = 8 or targetMultiplier3 = 8 or targetMultiplier4 = 8) as '8',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 9 or targetMultiplier2 = 9 or targetMultiplier3 = 9 or targetMultiplier4 = 9) as '9',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 10 or targetMultiplier2 = 10 or targetMultiplier3 = 10 or targetMultiplier4 = 10) as '10',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 11 or targetMultiplier2 = 11 or targetMultiplier3 = 11 or targetMultiplier4 = 11) as '11',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 12 or targetMultiplier2 = 12 or targetMultiplier3 = 12 or targetMultiplier4 = 12) as '12',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 13 or targetMultiplier2 = 13 or targetMultiplier3 = 13 or targetMultiplier4 = 13) as '13',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 14 or targetMultiplier2 = 14 or targetMultiplier3 = 14 or targetMultiplier4 = 14) as '14',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 15 or targetMultiplier2 = 15 or targetMultiplier3 = 15 or targetMultiplier4 = 15) as '15',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 16 or targetMultiplier2 = 16 or targetMultiplier3 = 16 or targetMultiplier4 = 16) as '16',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 17 or targetMultiplier2 = 17 or targetMultiplier3 = 17 or targetMultiplier4 = 17) as '17',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 18 or targetMultiplier2 = 18 or targetMultiplier3 = 18 or targetMultiplier4 = 18) as '18',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 19 or targetMultiplier2 = 19 or targetMultiplier3 = 19 or targetMultiplier4 = 19) as '19',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 20 or targetMultiplier2 = 20 or targetMultiplier3 = 20 or targetMultiplier4 = 20) as '20',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 21 or targetMultiplier2 = 21 or targetMultiplier3 = 21 or targetMultiplier4 = 21) as '21',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 22 or targetMultiplier2 = 22 or targetMultiplier3 = 22 or targetMultiplier4 = 22) as '22',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 23 or targetMultiplier2 = 23 or targetMultiplier3 = 23 or targetMultiplier4 = 23) as '23',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 24 or targetMultiplier2 = 24 or targetMultiplier3 = 24 or targetMultiplier4 = 24) as '24',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 25 or targetMultiplier2 = 25 or targetMultiplier3 = 25 or targetMultiplier4 = 25) as '25',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 26 or targetMultiplier2 = 26 or targetMultiplier3 = 26 or targetMultiplier4 = 26) as '26',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 27 or targetMultiplier2 = 27 or targetMultiplier3 = 27 or targetMultiplier4 = 27) as '27',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 28 or targetMultiplier2 = 28 or targetMultiplier3 = 28 or targetMultiplier4 = 28) as '28',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 29 or targetMultiplier2 = 29 or targetMultiplier3 = 29 or targetMultiplier4 = 29) as '29',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 30 or targetMultiplier2 = 30 or targetMultiplier3 = 30 or targetMultiplier4 = 30) as '30',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 31 or targetMultiplier2 = 31 or targetMultiplier3 = 31 or targetMultiplier4 = 31) as '31',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 32 or targetMultiplier2 = 32 or targetMultiplier3 = 32 or targetMultiplier4 = 32) as '32',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 33 or targetMultiplier2 = 33 or targetMultiplier3 = 33 or targetMultiplier4 = 33) as '33',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 34 or targetMultiplier2 = 34 or targetMultiplier3 = 34 or targetMultiplier4 = 34) as '34',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 35 or targetMultiplier2 = 35 or targetMultiplier3 = 35 or targetMultiplier4 = 35) as '35',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 36 or targetMultiplier2 = 36 or targetMultiplier3 = 36 or targetMultiplier4 = 36) as '36',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 37 or targetMultiplier2 = 37 or targetMultiplier3 = 37 or targetMultiplier4 = 37) as '37',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 38 or targetMultiplier2 = 38 or targetMultiplier3 = 38 or targetMultiplier4 = 38) as '38',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 39 or targetMultiplier2 = 39 or targetMultiplier3 = 39 or targetMultiplier4 = 39) as '39',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 40 or targetMultiplier2 = 40 or targetMultiplier3 = 40 or targetMultiplier4 = 40) as '40',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 41 or targetMultiplier2 = 41 or targetMultiplier3 = 41 or targetMultiplier4 = 41) as '41',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 42 or targetMultiplier2 = 42 or targetMultiplier3 = 42 or targetMultiplier4 = 42) as '42',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 43 or targetMultiplier2 = 43 or targetMultiplier3 = 43 or targetMultiplier4 = 43) as '43',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 44 or targetMultiplier2 = 44 or targetMultiplier3 = 44 or targetMultiplier4 = 44) as '44',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 45 or targetMultiplier2 = 45 or targetMultiplier3 = 45 or targetMultiplier4 = 45) as '45',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 46 or targetMultiplier2 = 46 or targetMultiplier3 = 46 or targetMultiplier4 = 46) as '46',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 47 or targetMultiplier2 = 47 or targetMultiplier3 = 47 or targetMultiplier4 = 47) as '47',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 48 or targetMultiplier2 = 48 or targetMultiplier3 = 48 or targetMultiplier4 = 48) as '48',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 49 or targetMultiplier2 = 49 or targetMultiplier3 = 49 or targetMultiplier4 = 49) as '49',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 50 or targetMultiplier2 = 50 or targetMultiplier3 = 50 or targetMultiplier4 = 50) as '50',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 51 or targetMultiplier2 = 51 or targetMultiplier3 = 51 or targetMultiplier4 = 51) as '51',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 52 or targetMultiplier2 = 52 or targetMultiplier3 = 52 or targetMultiplier4 = 52) as '52',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 53 or targetMultiplier2 = 53 or targetMultiplier3 = 53 or targetMultiplier4 = 53) as '53',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 54 or targetMultiplier2 = 54 or targetMultiplier3 = 54 or targetMultiplier4 = 54) as '54',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 55 or targetMultiplier2 = 55 or targetMultiplier3 = 55 or targetMultiplier4 = 55) as '55',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 56 or targetMultiplier2 = 56 or targetMultiplier3 = 56 or targetMultiplier4 = 56) as '56',
	(SELECT count(*) FROM masternode_list ml WHERE targetMultiplier1 = 57 or targetMultiplier2 = 57 or targetMultiplier3 = 57 or targetMultiplier4 = 57) as '57'
FROM dual
EOT;
        if($result = $GLOBALS["db"]->query($query))
        {
            if ($result->num_rows > 0)
            {
                $returnArray = array();
                foreach($result->fetch_object() as $key => $value)
                {
                    array_push($returnArray, array("y" => $value, "label" => $key));
                }
                return $returnArray;
            }
        }
        return array();
    }
    ##############################################################################################################################
    public function insert()
    {
        $insert_query = "INSERT INTO masternode_list_1 (";
        
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
        $update_query = "UPDATE masternode_list set ";
        
        foreach($this->getClassVars() as $cvar)
        {
            if($cvar <> "id" && $cvar <> "date")
            {
                $update_query .= $cvar." = '".$this->$cvar."', ";
            }
        }
        $update_query = substr($update_query, 0, strlen($update_query)-2);
        $update_query .= " WHERE id = ".$this->id;
        #echo "<br>".$update_query."<br>";
        $GLOBALS["db"]->query($update_query);
    }
    
    public function truncate()
    {
        $query = "TRUNCATE TABLE masternode_list_1";
        $GLOBALS["db"]->query($query);
    }
    public function rename()
    {
        $query = "ALTER TABLE masternode_list RENAME TO masternode_list_old";
        $GLOBALS["db"]->query($query);
        $query = "ALTER TABLE masternode_list_1 RENAME TO masternode_list";
        $GLOBALS["db"]->query($query);
        $query = "ALTER TABLE masternode_list_old RENAME TO masternode_list_1";
        $GLOBALS["db"]->query($query);
    }
    
    public function __set($name,$value)
    {
        $method = "set_".$name;
        if(method_exists($this,$method))
        {
            $this->{$method}($value);
        }
    }

    /**
     * @throws Exception
     */
    public function __get($name)
    {
        $method = "get_".$name;
        if(!method_exists($this,$method))
        {
            throw new Exception('Function get_'.$name.' doesnt exist!');
        }
        return $this->{$method}();
    }

    private function get_id()
    {
        return $this->id;
    }
    private function set_id($value)
    {
        $this->id = $value;
    }
    ##################################################
    private function get_ownerAuthAddress()
    {
        return $this->ownerAuthAddress;
    }
    private function set_ownerAuthAddress($value)
    {
        $this->ownerAuthAddress = $value;
    }
    ##################################################
    private function get_operatorAuthAddress()
    {
        return $this->operatorAuthAddress;
    }
    
    private function set_operatorAuthAddress($value)
    {
        $this->operatorAuthAddress = $value;
    }
    ##################################################
    private function get_creationHeight()
    {
        return $this->creationHeight;
    }
    private function set_creationHeight($value)
    {
        $this->creationHeight = $value;
    }
    ##################################################
    private function get_resignHeight()
    {
        return $this->resignHeight;
    }
    private function set_resignHeight($value)
    {
        $this->resignHeight = $value;
    }
    ##################################################
    private function get_state()
    {
        return $this->state;
    }
    private function set_state($value)
    {
        $this->state = $value;
    }
    ##################################################
    private function get_mintedBlocks()
    {
        return $this->mintedBlocks;
    }
    private function set_mintedBlocks($value)
    {
        $this->mintedBlocks = $value;
    }
    ##################################################
    private function get_targetMultiplier1()
    {
        return $this->targetMultiplier1;
    }
    private function set_targetMultiplier1($value)
    {
        $this->targetMultiplier1 = $value;
    }
    ##################################################
    private function get_targetMultiplier2()
    {
        return $this->targetMultiplier2;
    }
    private function set_targetMultiplier2($value)
    {
        $this->targetMultiplier2 = $value;
    }
    ##################################################
    private function get_targetMultiplier3()
    {
        return $this->targetMultiplier3;
    }
    private function set_targetMultiplier3($value)
    {
        $this->targetMultiplier3 = $value;
    }
    ##################################################
    private function get_targetMultiplier4()
    {
        return $this->targetMultiplier4;
    }
    private function set_targetMultiplier4($value)
    {
        $this->targetMultiplier4 = $value;
    }
    ##################################################
    private function get_timelock()
    {
        return $this->timelock;
    }
    private function set_timelock($value)
    {
        $this->timelock = $value;
    }
    ##################################################
}

