<?php

namespace zw\helpers;

class StringHelper
{
    /**
     * Clean text (special symbol, space and etc.)
     * @param $string
     * @return string
     */
    public static function clean($string)
    {
        $clean = str_replace(array("\n", "\r", "\t", "\0", "'", '"', "\\"), '', $string);
        $clean = preg_replace('/ {2,}/', ' ', $clean);
        $clean = strip_tags($clean);
        $clean = trim($clean);
        return $clean;
    }
}
