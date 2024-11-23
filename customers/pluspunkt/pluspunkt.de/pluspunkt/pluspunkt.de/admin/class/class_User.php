<?php

class UserClass
{
    private $id;
    private $username;
    private $password;
    private $active;
    private $privilege;
    private $loginAttempts;
    private $auth;
    private $lastlogin;
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
    public function getAllUser()
    {
        $array = array();

        $user_query = "SELECT * FROM user";

        if($user_result = $GLOBALS["db"]->query($user_query))
        {
            if($user_result->num_rows > 0)
            {
                while($RowObject = $user_result->fetch_object())
                {
                    $myUser = new UserClass;

                    foreach($myUser->getClassVars() as $cvar)
                    {
                        $myUser->$cvar = $RowObject->$cvar;
                    }
                    array_push($array, $myUser);
                }
            }
            $user_result->close();
        }
        return $array;
    }
##############################################################################################################################
    public function getUserById($id)
    {
        $user_query = "SELECT * FROM user as u WHERE id = ".$id;
        //echo $user_query;

        if($user_result = $GLOBALS["db"]->query($user_query))
        {
            if($user_result->num_rows > 0)
            {
                while($RowObject = $user_result->fetch_object())
                {
                    foreach($this->getClassVars() as $cvar)
                    {
                        $this->$cvar = $RowObject->$cvar;
                    }
                }
            }
            $user_result->close();
        }
    }
##############################################################################################################################
    public function getUser($username,$password)
    {
        $user_query = "SELECT * FROM user as u WHERE username = '".$username."' AND password = '".$password."' AND active = 1";

        if($user_result = $GLOBALS["db"]->query($user_query))
        {
            if($user_result->num_rows > 0)
            {
                while($RowObject = $user_result->fetch_object())
                {
                    foreach($this->getClassVars() as $cvar)
                    {
                        $this->$cvar = $RowObject->$cvar;
                    }
                }
            }
            $user_result->close();
        }
    }
##############################################################################################################################
    public function setLoginAttempts($username)
    {
        $user_query = "SELECT loginAttempts,active FROM user where username = '".$username."'";

        if($user_result = $GLOBALS["db"]->query($user_query))
        {
            if($user_result->num_rows > 0)
            {
                $RowObject = $user_result->fetch_object();

                if(2 < $RowObject->loginAttempts)
                {
                    $update_query = "UPDATE user SET active = 0 WHERE username = '".$username."'";
                    $GLOBALS["db"]->query($update_query);
                }
            }
        }

        $update_query = "UPDATE user SET loginAttempts + 1 WHERE username ='".$username."'";
        $GLOBALS["db"]->query($update_query);
    }
    public function resetLoginAttempts()
    {
        $update_query = "UPDATE user SET loginAttempts = 0 WHERE id = '".$this->id."'";
        $GLOBALS["db"]->query($update_query);
    }
##############################################################################################################################

##############################################################################################################################
##############################################################################################################################
    # insert function
    public function insert()
    {
        $insert_query = "INSERT INTO user (";

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

        #echo "<br>".$insert_query."<br>";
        $GLOBALS["db"]->query($insert_query);
        $this->id = $GLOBALS["db"]->insert_id;
    }
    # update function
    public function update()
    {
        $update_query = "UPDATE user set ";

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
		parent::update();
    }
    # delete function
    public function delete()
    {
        $delete_query = "DELETE FROM user WHERE id = ".$this->id;
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

    private function get_username()
    {
        return $this->username;
    }
    private function set_username($value)
    {
        $this->username = $value;
    }

    private function get_password()
    {
        return $this->password;
    }
    private function set_password($value)
    {
        $this->password = $value;
    }

    private function get_active()
    {
        return $this->active;
    }
    private function set_active($value)
    {
        $this->active = $value;
    }

    private function get_privilege()
    {
        return $this->privilege;
    }
    private function set_privilege($value)
    {
        $this->privilege = $value;
    }

    private function get_loginAttempts()
    {
        return $this->loginAttempts;
    }
    private function set_loginAttempts($value)
    {
        $this->loginAttempts = $value;
    }

    private function get_auth()
    {
        return $this->auth;
    }
    private function set_auth($value)
    {
        $this->auth = $value;
    }

    private function get_lastlogin()
    {
        return $this->lastlogin;
    }
    public function set_lastlogin()
    {
        $time = date("Y-m-d H:i:s");
        $lastlogin_query = "UPDATE user SET lastlogin = '".$time."' WHERE id = '".$this->id."'";
        $GLOBALS["db"]->query($lastlogin_query);
        $this->lastlogin = $time;
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
