<?php
namespace Phine\Framework\Database\Interfaces\BaseImpl;
use Phine\Framework\Database\Interfaces\IDatabaseKeyInfo;
use Phine\Framework\System\Php\WritableClass;

/**
 * Abstract key info
 */
abstract class BaseKeyInfo extends WritableClass implements IDatabaseKeyInfo
{
    /**
     * True if primary key
     * @var boolean
     */
    protected $isPrimary;
    
    /**
     * True if unique key
     * @var boolean
     */
    protected $isUnique;
    
    /**
     * The key name
     * @var string
     */
    protected $name;
    
    /**
     * 
     * 
     * @param string $name The key name
     * @param boolean $isPrimary True if is primary
     * @param boolean $isUnique True if is unique
     */
    function __construct($name, $isPrimary = false, $isUnique = false)
    {
        $this->isPrimary = $isPrimary;
        $this->isUnique = $isUnique;
        $this->name = $name;
    }
    
    /**
     * True if it is a primary key
     * @return bool Returns true for a primary key
     */
    public function IsPrimary()
    {
        return $this->isPrimary;
    }
    
    
    /**
     * True if it is a unique key
     * @return bool Returns true if the key is unique
     */
    public function IsUnique()
    {
        return $this->isUnique;
    }
    /**
     * The key name
     * @return string Returns the key name
     */
    public function Name()
    {
        return $this->name;
    }
    /**
     * The constructor parameters
     * @return array Returns an array of the constructor parameters
     */
    protected function GetConstructParams()
    {
        return array($this->name, $this->isPrimary, $this->isUnique);
    }
}

