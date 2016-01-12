<?php
namespace Phine\Framework\FormElements\Fields;

class Checkbox extends FormField
{
    private $checkedValue;
    /**
     * Creates a new checkbox field
     * @param string $name The field name
     * @param string $checkedValue
     * @param bool $checked
     */
    public function __construct($name = '', $checkedValue = '1', $checked = false)
    {
        $this->checkedValue = $checkedValue;
        parent::__construct($name, $checked ? $checkedValue : '');
    }
    
    /**
     * Gets the value of the checkbox
     * @return string
     */
    public function GetCheckedValue()
    {
        return $this->checkedValue;
    }
    
    /**
     * Sets the value to the "checked" value
     */
    public function SetChecked()
    {
        $this->SetValue($this->GetCheckedValue());
    }
    
    /**
     * Gets the value of the checkbox
     * @return string
     */
    public function SetCheckedValue($checkedValue)
    {
        $this->checkedValue = $checkedValue;
    }
    /**
     *
     * @return bool
     */
    public function IsChecked()
    {
      return $this->GetCheckedValue() == $this->GetValue();
    }
}