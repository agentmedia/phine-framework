<?php
namespace Phine\Framework\FormElements\Fields;

/**
 * Represents a list of checkboxes
 */
class CheckList extends FormField
{
    
    /**
     * Attributes for the checkbox labels
     * @var array
     */
    private $labelAttributes = array();
    
    /**
     * Descriptions for the checkbox fields
     * @var array
     */
    private $fieldDescriptions = array();
    
     /**
     * Attributes for the checkbox fields
     * @var array
     */
    private $fieldAttributes = array();
    
    /**
     * The values and texts (labels) of the checkboxes
     * @var array
     */
    private $options = array();
    
    /**
     * Creates a new checklist
     * @param string $name The field name
     * @param array $value The value array
     * @param array $options The options for the check list
     */
    function __construct($name = '', $value = array(), array $options = array())
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
    
    /**
     * Returns true if the value is selected
     * @param string $value
     * @return boolean
     */
    function IsSelected($value)
    {
        return is_array($this->GetValue()) &&
            in_array($value, $this->GetValue());
    }
    /**
     * Gets the options 
     * @return array Returns the option with values as keys, texts as values
     */
    function GetOptions()
    {
        return $this->options;
    }
    /**
     * Sets an attribute directly to a single checkbox
     * @param string $optValue The value of the desired checkbox
     * @param string $attribute
     * @param string $value the value
     */
    function SetCheckboxAttribute($optValue, $attribute, $value) {
        if (!isset($this->fieldAttributes[$optValue])) {
            $this->fieldAttributes[$optValue] = array();
        }
        $this->fieldAttributes[$optValue][$attribute] = $value;
    }
    
    /**
     * Gets the attributes of a single checkbox
     * @param string $optValue The value of the desired checkbox
     * @return array Returns the key value of the html attributes
     */
    function GetCheckboxAttributes($optValue) {
        if (!isset($this->fieldAttributes[$optValue])) {
            return array();
        }
        return $this->fieldAttributes[$optValue];
    }
    
    /**
     * Sets an attribute directly to a single checkbox label
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
    
    function SetCheckboxDescription($optValue, $description) {
        $this->fieldDescriptions[$optValue] = $description;
    }
    
    function GetCheckboxDescription($optValue) {
        if (!isset($this->fieldDescriptions[$optValue])) {
            return '';
        }
        return $this->fieldDescriptions[$optValue];
    }
    
    /**
     * Gets the attributes of a single checkbox label
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

