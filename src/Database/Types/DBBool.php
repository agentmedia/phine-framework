<?php
namespace Phine\Framework\Database\Types;
use Phine\Framework\Database\Interfaces\BaseImpl\BaseType;

class DBBool extends BaseType
{
    function FromDBString($value)
    {
        if ($value === null)
            return null;

        return (bool)$value;
    }

    function ToDBString($value)
    {
        if ($value === null)
            return null;

        return $value ? '1' : '0';
    }
    
    function DefaultInstance()
    {
        return false;
    }
}