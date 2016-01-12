<?php

namespace Phine\Framework\FormElements;

use Phine\Framework\FormElements\Interfaces as FormInterfaces;

/**
 * A collection of form elements
 */
class Collection extends Fields\FormElement
{

    /**
     * True if the collection's validators failed
     * @var bool
     */
    private $hasCollectionErrors = false;
    private $fields = array();

    function Check($data)
    {
        $success = true;
        foreach ($this->fields as $name => $field)
        {
            if ($field instanceof FormInterfaces\IFormField)
            {
                $value = isset($data[$name]) ? $data[$name] : '';
                $success = $field->Check($value) && $success;
            }
            else if ($field instanceof FormInterfaces\IFormElement)
            {
                $success = $field->Check($data) && $success;
            }
        }
        if ($success)
        {
            $this->hasCollectionErrors = !parent::Check($data);
        }
        $this->checkFailed = !$success || $this->hasCollectionErrors;
        return !$this->checkFailed;
    }

    function HasCollectionErrors()
    {
        return $this->hasCollectionErrors;
    }

    /**
     * 
     * @param FormInterfaces\IFormField $fieldProvider
     */
    function AddField(FormInterfaces\IFormField $field)
    {
        $this->fields[$field->GetName()] = $field;
    }

    /**
     * Gets The fields
     * @return FormInterfaces\IFormElement[]
     */
    function GetElements()
    {
        return $this->fields;
    }

    /**
     * Gets the element by name
     * @param string $name
     * @return FormInterfaces\IFormElement
     */
    function GetElement($name)
    {
        if (array_key_exists($name, $this->fields))
            return $this->fields[$name];
    }
    
    /**
     * Adds a field set to the form elements collection
     * @param string $legend The legend; it is used as a key
     * @param \Phine\Framework\FormElements\Collection $formElements
     */
    function AddFieldset($legend, Collection $formElements)
    {
        $this->fields[$legend] = $formElements;
    }
    
    /**
     * Adds an element to the collection
     * @param string $name
     * @param \Phine\Framework\FormElements\Interfaces\IFormElement $element
     */
    function AddElement($name, FormInterfaces\IFormElement $element)
    {
        $this->fields[$name] = $element;
    }

}
