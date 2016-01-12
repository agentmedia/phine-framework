<?php
namespace Phine\Framework\Database\Interfaces;
use Phine\Framework\Database\Enums\ConstraintRule;

/**
 * Represents a constraint for a foreign key
 */
interface IDatabaseConstraint
{
    /**
     * The name of the constraint
     * @return string Returns the name of the constraint
     */
    function Name();
    
    /**
     * Behavior on delete
     * @return ConstraintRule
     */    
    function OnDelete();
    
    /**
     * Behavior on delete
     * @return ConstraintRule
     */    
    function OnUpdate();
}

