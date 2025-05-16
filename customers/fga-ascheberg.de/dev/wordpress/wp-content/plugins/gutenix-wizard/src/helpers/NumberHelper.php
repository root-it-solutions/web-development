<?php

namespace zw\helpers;

class NumberHelper
{
    public static function unitToInt($s = '')
    {
        return (int)preg_replace_callback('/(\-?\d+)(.?)/', function ($m) {
            return $m[1] * pow(1024, strpos('BKMG', $m[2]));
        }, strtoupper($s));
    }
}