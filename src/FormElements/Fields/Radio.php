<?php

namespace Phine\Framework\FormElements\Fields;

/**
 * Represents a radio button input field
 */
class Radio extends FormField
{
    /**
     * Attributes for the checkbox labels
     * @var array
     */
    private $labelAttributes = array();
    
    /**
     * Attributes for the checkbox fields
     * @var array
     */
    private $fieldAttributes = array();
    
    private $options = array();
    function __construct($name = '', $value = '', array $options = array())
    {
        $this->options = $options;
        parent::__construct($name, $value);
    }
        
    function AddOption($value, $text = "")
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
    
    /**
     * Sets an attribute directly to a single radio button
     * @param string $optValue The value of the desired checkbox
     * @param string $attribute
     * @param string $value the value
     */
    function SetButtonAttribute($optValue, $attribute, $value) {
        if (!isset($this->fieldAttributes[$optValue])) {
            $this->fieldAttributes[$optValue] = array();
        }
        $this->fieldAttributes[$optValue][$attribute] = $value;
    }
    
    /**
     * Gets the attributes of a single button
     * @param string $optValue The value of the desired checkbox
     * @return array Returns the key value of the html attributes
     */
    function GetButtonAttributes($optValue) {
        if (!isset($this->fieldAttributes[$optValue])) {
            return array();
        }
        return $this->fieldAttributes[$optValue];
    }
    
    /**
     * Sets an attribute directly to a single button label
     * @param string $optValue The value of the desired checkbox
     * @param string $attribute The attribute
     * @param string $value the value
     */
    function SetLabelAttribute($optValue, $attribute, $value) {
        if (!isset($this->labelAttributes[$optValue])) {
            $this->labelAttributes[$optValue] = array();
        }
        $this->labelAttributes[$optValue][$attribute] = $value;
    }
    
    /**
     * Gets the attributes of a single button label
     * @param string $optValue The value of the desired checkbox
     * @return array Returns the key value array for the html attributes
     */
    function GetLabelAttributes($optValue) {
        if (!isset($this->labelAttributes[$optValue])) {
            return array();
        }
        return $this->labelAttributes[$optValue];
    }
}
