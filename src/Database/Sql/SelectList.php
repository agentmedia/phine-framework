<?php

namespace Phine\Framework\Database\Sql;
use Phine\Framework\Database\Interfaces as DBInterfaces;

class SelectList extends SqlObject
{
    /**
     *
     * @var array[Selectable]
     */
    private $selectables = array();
    
    /**
     * 
     * @param DBInterfaces\IDatabaseConnection $connection
     * @param Selectable $selectable
     * 
     */
    protected function __construct(DBInterfaces\IDatabaseConnection $connection, Selectable $selectable)
    {
        parent::__construct($connection);
        $this->selectables = array($selectable);
    }
    
    function Add(Selectable $selectable)
    {
        $this->selectables[] = $selectable;
    }
    function __toString()
    {
        $returnArr = array();
        foreach ($this->selectables as $selectable)
        {
            $returnArr[] = $selectable->FullNameAsAlias();
        }
        return join(', ', $returnArr);
    }    
}