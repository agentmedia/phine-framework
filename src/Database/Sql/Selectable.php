<?php
namespace Phine\Framework\Database\Sql;
use Phine\Framework\Database\Interfaces as DBInterfaces;

abstract class Selectable extends SqlObject
{
    private $alias = '';
    protected function __construct(DBInterfaces\IDatabaseConnection $connection, $alias = '')
    {
        parent::__construct($connection);
        $this->alias = $alias;
    }

    public abstract function FullName();
    
    public function __toString()
    {
        return $this->alias ? $this->Alias() : 
            $this->FullName();
    }

    private function Alias()
    {
        return $this->escaper->EscapeIdentifier($this->alias);
    }

    public function FullNameAsAlias()
    {
        if ($this->alias)
            return $this->FullName() . ' AS ' . $this->Alias();
        
        return $this->FullName();
    }
}