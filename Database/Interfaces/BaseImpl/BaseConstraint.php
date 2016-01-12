<?php
namespace Phine\Framework\Database\Interfaces\BaseImpl;
use Phine\Framework\Database\Interfaces\IDatabaseConstraint;
use Phine\Framework\Database\Interfaces\IDatabaseConnection;

use Phine\Framework\Database\Enums\ConstraintRule;
use Phine\Framework\System\Php\WritableClass;
/**
 * A database constraint
 */
abstract class BaseConstraint extends WritableClass implements IDatabaseConstraint
{
    /**
     * The behaviour when a parent is deleted
     * @var ConstraintRule
     */
    private $onDelete;
    
    /**
     * The behavior when parent is updated
     * @var ConstraintRule
     */
    private $onUpdate;
    
    /**
     * The constraint name
     * @var string
     */
    private $name;
    
    /**
     * Creates a new mysql constraint by behaviors
     * @param string $name The constraint name
     * @param ConstraintRule $onUpdate The update behavior
     * @param ConstraintRule $onDelete The delete behavior
     */
    function __construct($name, ConstraintRule $onUpdate, ConstraintRule $onDelete)
    {
        $this->name = $name;
        $this->onUpdate = $onUpdate;
        $this->onDelete = $onDelete;
    }
    
    
    /**
     * The name of the constraint
     * @return string Returns the constraint name
     */
    function Name()
    {
        return $this->name;
    }
    /**
     * The behavior on delete
     * @return ConstraintRule Returns the behavior on delete
     */
    public function OnDelete()
    {
        return $this->onDelete;
    }

    /**
     * 
     * @return ConstraintRule
     */
    public function OnUpdate()
    {
        return $this->onUpdate;
    }
    /**
     * Gets the constructor parameters
     * @return array Returns the construct parameters
     */
    protected function GetConstructParams()
    {
        return array($this->name, $this->onUpdate, $this->onDelete);
    }
}

