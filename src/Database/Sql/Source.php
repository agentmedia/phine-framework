<?php

namespace Phine\Framework\Database\Sql;
abstract class Source extends SqlObject
{
    /**
     * String representation as needed in FROM statement
     * @return string
     */
    abstract function ToString();
    function __toString()
    {
        return $this->ToString();
    }
}