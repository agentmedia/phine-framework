<?php

namespace Phine\Framework\FormElements\Fields;

/**
 * Represents a select box
 */
class Select extends FormField
{
    private $options = array();
    private $optAttributes = array();
    function __construct($name = '', $value = '', array $options = array())
    {
        $this->options = $options;
        parent::__construct($name, $value);
    }
    /**
     * 
     * @param string $optValue The value of the option for which you want to set the attribute
     * @param string $name The name of the attribute
     * @param string $value The value of the attribute
     */
    function SetOptionAttribute($optValue, $name, $value)
    {
        if (!isset($this->optAttributes[$optValue]))
            $this->optAttributes[$optValue] = array();
        
        $this->optAttributes[$optValue][$name] = $value;
    }
    /**
     * Gets the option attributes
     * @param string $optValue The value of the option for which you want to retrive the attributes
     * @return array The attribures as array of names and values
     */
    function GetOptionAttributes($optValue)
    {
        if (isset($this->optAttributes[$optValue]))
            return $this->optAttributes[$optValue];
        
        return array();
    }
    
    /**
     * Adds an option
     * @param string $value
     * @param string $text
     */
    function AddOption($value, $text)
    {
        $this->options[$value] = $text;
    }
        
    function AddOptions(array $options)
    {
        foreach ($options as $value=>$text)
        {
            $this->AddOption($value, $text);
        }
    }
    
    function RemoveOption($value)
    {
        unset($this->options[$value]);
    }
    
    function IsSelected($value)
    {
        return (string)$value == (string)$this->GetValue();
    }
    
    function GetOptions()
    {
        return $this->options;
    }
}
