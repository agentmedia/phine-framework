<?php
namespace Phine\Framework\Database\Interfaces\BaseImpl;

use Phine\Framework\System\Php\WritableClass;
use Phine\Framework\Database\Interfaces\IDatabaseType;
/**
 * Abstract base class for database type
 */
abstract class BaseType extends WritableClass implements IDatabaseType
{
    /**
     * 
     * Base constructor: Database types  must not have constructor parameters
     */
    public final function __construct()
    {
    }
    /**
     * Returns the (empty) constructor parameter list
     * @return array
     */
    protected function GetConstructParams()
    {
        return array();
    }
}
