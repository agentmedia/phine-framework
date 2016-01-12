<?php

namespace Phine\Framework\FormElements\Fields;

/**
 * Represents a radio button input field
 */
class Radio extends FormField
{
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
}
