<?php

namespace Phine\Framework\Database\Mysql;

use Phine\Framework\Database\Interfaces\BaseImpl\BaseType;
use Phine\Framework\System;

/**
 * Represents a mysql timestamp type
 */
class TimeStamp implements BaseType
{

    /**
     * @return System\Date
     * (non-PHPdoc)
     * @see Phine/Framework/Database/Interfaces/IDatabaseType#FromDBString($value)
     */
    function FromDBString($value)
    {
        if ($value === null)
            return null;

        return System\Date::FromTimeStamp((int) $value);
    }

    /**
     * Returns the database string representation of the date.
     * @return string
     * @param System\Date $value
     * (non-PHPdoc)
     * @see Phine/Framework/Database/Interfaces/IDatabaseType#ToDBString($value)
     */
    function ToDBString($value)
    {
        //Type save:
        return $this->_ToDBString($value);
    }

    /**
     * 
     * @param Date $value
     * @return strng
     */
    private function _ToDBString(System\Date $value = null)
    {
        if ($value === null)
            return $value;

        return (string) $value->TimeStamp();
    }

    /**
     *
     * @return \Phine\Framework\System\Date 
     */
    function DefaultInstance()
    {
        return new System\Date(0, 0, 0, 0, 0, 0);
    }

}
