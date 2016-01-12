<?php
namespace Phine\Framework\FormElements\Fields;
use Phine\Framework\FormElements\Interfaces as FormInterfaces;

class Custom extends FormField
{
    /**
     * 
     * @var FormInterfaces\IFormFieldRenderer
     */
    private $fieldRenderer;
    function __construct(FormInterfaces\IFormFieldRenderer $fieldRenderer, $name ='', $value = '')
    {
        $this->fieldRenderer = $fieldRenderer;
        parent::__construct($name, $value);
    }
    
    /**
     * Renders the custom field
     * @return string Returns the custom field
     */
    function Render()
    {
        return $this->fieldRenderer->Render($this->GetName(), $this->GetValue());
    }
}