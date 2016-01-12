<?php

namespace Phine\Framework\Database\Interfaces\BaseImpl;
use Phine\Framework\Database\Interfaces\IDatabaseTypeDef;
use Phine\Framework\Database\Interfaces\IDatabaseType;
use Phine\Framework\System\Php\WritableClass;
/**
 * The base class for type definitions
 */
abstract class BaseTypeDef extends WritableClass implements IDatabaseTypeDef
{
    /**
     * The name of the type
     * @var string
     */
    protected $name;
    /**
     * A length specification
     * @var int
     */
    protected $length;
    /**
     * Allowed values for Type Enum and Set.
     * @var string[]
     */
    protected $set;
    
    /**
     * Further type modifiers
     * @var string
     */
    protected $modifiers;
    
    /**
     * The database type
     * @var IDatabaseType
     */
    protected $type;
    
    /**
     * 
     * @param string $name The basic type name
     * @param IDatabaseType $type The type mappable to php
     * @param array $set A set of allowed values (needn't be accurate to all databases)
     * @param int $length A length or size specifier 
     * @param type $modifiers Additional modifier strings
     */
    public function __construct($name, IDatabaseType $type, array $set = array(), $length = 0, $modifiers = '')
    {
        $this->name = $name;
        $this->type = $type;
        $this->set = $set;
        $this->length = $length;
        $this->modifiers = $modifiers;
    }
    public function GetLength()
    {
        return $this->length;
    }
    
    /**
     * Modifier of the type
     * @return string
     */
    public function GetModifiers()
    {
        return $this->modifiers;
    }
    
    /**
     * A set definition of defined values; Doesn't apply to all database types
     * @return string[]
     */
    public function GetSet()
    {
        return $this->set;
    }
    
    /**
     * The type
     * @return IDatabaseType Returns the type
     */
    public function GetType()
    {
        return $this->type;
    }

    protected function GetConstructParams()
    {
        return array($this->name, $this->type, $this->set, $this->length, $this->modifiers);
    }
}