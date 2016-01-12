<?php

namespace Phine\Framework\FormElements\Fields;
/**
 * Represents a submit input field 
 */
class Submit extends FormField
{
    /**
     *
     * @var string
     */
    private $namingValue;
    function __construct($name = '', $namingValue = '')
    {
        $this->namingValue = $namingValue;
        parent::__construct($name);
    }
    /**
     * Gets the naming value as rendered to the value attribute
     * @return string
     */
    public function GetNamingValue()
    {
        return $this->namingValue;
    }
    
    /**
     * Sets the naming value as rendered to the value attribute
     * @param string $namingValue
     */
    public function SetNamingValue($namingValue)
    {
        $this->namingValue = $namingValue;
    }
}
