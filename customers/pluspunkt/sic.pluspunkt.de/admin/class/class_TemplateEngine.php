<?php

class TemplateEngine
{
    private $template_dir = "templates";
    private $left_delimiter = "[ ";
    private $right_delimiter = " ]";
    private $template_vars = array();

    function assign($template_vars, $value)
    {
        if(is_array($template_vars))
        {
            foreach($template_vars as $key => $val)
            {
                if($key != "")
                {
                    $this->template_vars[$key] = $val;
                }
            }
        }
        elseif(is_object($template_vars))
        {
            if(get_class($template_vars) == "AgencyClass" || get_class($template_vars) == "Agency_confClass")
            {
                foreach($template_vars->getClassVars() as $cvar)
                {
                    if($cvar == "date" || $cvar == "posted" || $cvar == "publicDate" || $cvar == "birthday")
                    {
                        $this->template_vars["agency".ucfirst($cvar)] = date("d.m.Y",strtotime($template_vars->$cvar));
                    }
                    elseif($cvar == "lastlogin")
                    {
                        $this->template_vars["agency".ucfirst($cvar)] = date("d.m.Y H:i",strtotime($template_vars->$cvar));
                    }
                    else
                    {
                        $this->template_vars["agency".ucfirst($cvar)] = $template_vars->$cvar;
                    }
                }
                //echo var_dump($this);
            }
            else
            {
                foreach($template_vars->getClassVars() as $cvar)
                {
                    if($cvar == "date" || $cvar == "posted" || $cvar == "publicDate" || $cvar == "birthday")
                    {
                        $this->template_vars[$cvar] = date("d.m.Y",strtotime($template_vars->$cvar));
                    }
                    elseif($cvar == "lastlogin")
                    {
                        $this->template_vars[$cvar] = date("d.m.Y H:i",strtotime($template_vars->$cvar));
                    }
                    else
                    {
                        $this->template_vars[$cvar] = $template_vars->$cvar;
                    }
                }
            }
        }
        else
        {
            if($template_vars != "")
            {
                $this->template_vars[$template_vars] = $value;
            }
        }
    }

    function getVar($template_var)
    {
        return $this->template_vars[$template_var];
    }

    function display($template_file)
    {
        $template = getTemp($template_file);
        foreach($this->template_vars as $key => $val)
        {
            $template = str_replace($this->left_delimiter.$key.$this->right_delimiter,$val,$template);
        }
        # U macht den regulären ausdruck nicht-gierig
        $template = preg_replace("/\[ (.*)\ ]/U","",$template);
        return $template;
    }
}

?>
