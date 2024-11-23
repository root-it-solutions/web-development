<?php

namespace App\Models;
/**
 *
 */
class RewardReduction
{
    private $block;
    private $reward;

    public function getActualReward($block): string
    {
        $query = 'SELECT reward FROM reward_reduction_list WHERE block = (SELECT MAX(block) FROM reward_reduction_list WHERE block <= '.$block.')';
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

    public function insert()
    {
        $insert_query = "INSERT INTO reward_reduction_list (";

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

    private function getClassVars(): array
    {
        return array_keys(get_class_vars(get_class($this)));
    }

    public function __set($name,$value)
    {
        $method = "set".ucfirst($name);
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
        $method = "get".ucfirst($name);
        if(!method_exists($this,$method))
        {
            throw new Exception('Function get'.ucfirst($name).' doesnt exist!');
        }
        return $this->{$method}();
    }

    /**
     * @return mixed
     */
    private function getBlock()
    {
        return $this->block;
    }

    /**
     * @param mixed $block
     */
    private function setBlock($block): void
    {
        $this->block = $block;
    }

    /**
     * @return mixed
     */
    private function getReward()
    {
        return $this->reward;
    }

    /**
     * @param mixed $reward
     */
    private function setReward($reward): void
    {
        $this->reward = $reward;
    }


}
