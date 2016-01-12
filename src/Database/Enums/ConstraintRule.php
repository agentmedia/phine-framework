<?php
namespace Phine\Framework\Database\Enums;
use Phine\Framework\System\Enum;

/**
 * Represents the possible action rule on delete or update
 */
class ConstraintRule extends Enum
{
    
    /**
     * Represents the restrict action behavior
     * @return ConstraintRule Returns the restrict behavior
     */
    static function Restrict()
    {
        return new self ('RESTRICT');
    }
    
    
    /**
     * Represents the no action behavior
     * @return ConstraintRule Returns the no action behavior
     */
    static function NoAction()
    {
        return new self ('NO ACTION');
    }
    /**
     * Represents setting null on actions delete or update
     * @return ConstraintRule
     */
    static function Cascade()
    {
        return new self ('CASCADE');
    }
    
    /**
     * Represents setting null on actions delete or update
     * @return ConstraintRule The Set null action behavior
     */
    static function SetNull()
    {
        return new self ('SET NULL');
    }
}

