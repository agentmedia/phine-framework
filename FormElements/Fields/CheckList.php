<?php
namespace Phine\Framework\FormElements\Fields;

/**
 * Represents a list of checkboxes
 */
class CheckList extends FormField
{
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
}

