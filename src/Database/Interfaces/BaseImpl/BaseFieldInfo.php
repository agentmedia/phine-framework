<?php
namespace Phine\Framework\Database\Interfaces\BaseImpl;
use Phine\Framework\Database\Interfaces\IDatabaseFieldInfo;
use Phine\Framework\Database\Interfaces\IDatabaseForeignKey;
use Phine\Framework\Database\Interfaces\IDatabaseTypeDef;
use Phine\Framework\Database\Interfaces\IDatabaseConstraint;
use Phine\Framework\Database\Interfaces\IDatabaseKeyInfo;
use Phine\Framework\Database\Interfaces\IDatabaseConnection;

use Phine\Framework\System\Php\WritableClass;

/**
 * Base class for field info
 */
abstract class BaseFieldInfo extends WritableClass implements IDatabaseFieldInfo 
{
    
    /**
     * The field name
     * @var string
     */
    protected $name;
    /**
     * The foreign key
     * @var IDatabaseForeignKey
     */
    protected $foreignKey;
    
    /**
     * The type def
     * @var IDatabaseTypeDef
     */
    protected $typeDef;
    
    /**
     * The key (index) info
     * @var IDatabaseKeyInfo
     */
    protected $keyInfo;
    
    /**
     * An optional key constraint
     * @var IDatabaseConstraint
     */
    protected $foreignKeyConstraint;
    
    /**
     * True if the field is nullable
     * @var boolean
     */
    protected $isNullable;
    
    /**
     * The column default value
     * @var string
     */
    protected $defaultValue;
    
    /**
     * Creates the field info
     * @param string $name The field name
     * @param IDatabaseTypeDef $typeDef The type definition
     * @param string $defaultValue The default value
     * @param bool $isNullable True if is nullable
     * @param IDatabaseKeyInfo $keyInfo The key info
     * @param IDatabaseForeignKey $foreignKey The foreign key
     * @param IDatabaseConstraint $constraint The foreign key constraint
     */
    public function __construct($name, IDatabaseTypeDef $typeDef, $defaultValue = null, $isNullable = false, IDatabaseKeyInfo $keyInfo = null, IDatabaseForeignKey $foreignKey = null, IDatabaseConstraint $constraint = null)
    {
        $this->name = $name;
        $this->typeDef = $typeDef;
        $this->defaultValue = $defaultValue;
        $this->isNullable = $isNullable;
        $this->keyInfo = $keyInfo;
        $this->foreignKey = $foreignKey;
        $this->foreignKeyConstraint = $constraint;
    }
    
    /**
     * Gets the foreign key if exists
     * @return IDatabaseForeignKey The foreign key if present
     */
    public function ForeignKey()
    {
        return $this->foreignKey;
    }
    
    
    /**
     * Gets the type definition
     * @return IDatabaseTypeDef The type definition
     */
    public function GetTypeDef()
    {
        return $this->typeDef;
    }
    
    /**
     * The foreign key constraint
     * @return IDatabaseConstraint The foreign key constraint
     */
    public function ForeignKeyConstraint()
    {
        return $this->foreignKeyConstraint;
    }
    
    /**
     * True if field is nullable
     * @return bool Returns true if is nullable
     */
    public function IsNullable()
    {
        return $this->isNullable;
    }
    
    /**
     * The key info if any key is present
     * @return IDatabaseKeyInfo Returns the key info if any key is present
     */
    public function KeyInfo()
    {
        return $this->keyInfo;
    }
    
    /**
     * The default value
     * @return string Returns the column default value (or null)
     */
    public function DefaultValue()
    {
        return $this->defaultValue;
    }
    
    public function Name()
    {
        return $this->Name();
    }
    /**
     * Gets the constructor parameters
     * @return array
     */
    protected function GetConstructParams()
    {
        return array($this->name, $this->typeDef, $this->defaultValue, $this->isNullable, $this->keyInfo, $this->foreignKey, $this->foreignKeyConstraint);
    }
}
