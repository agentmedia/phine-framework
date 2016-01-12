<?php

namespace Phine\Framework\Database\Types;

use Phine\Framework\Database\Interfaces\BaseImpl\BaseType;

class String extends BaseType
{
    function FromDBString($value)
    {
        if ($value === null)
            return null;
    
        return (string)$value;
    }
    
    function ToDBString($value)
    {
        if ($value === null)
            return null;

        return (string)$value;
    }
    
    function DefaultInstance()
    {
        return '';
    }
}