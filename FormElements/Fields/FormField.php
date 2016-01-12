<?php

namespace Phine\Framework\FormElements\Fields;

use Phine\Framework\System;
use Phine\Framework\Validation;
use Phine\Framework\FormElements\Interfaces as FormInterfaces;

abstract class FormField extends FormElement implements FormInterfaces\IFormField
{
    private $name;
    private $value;
    
    private $description;
    private $label;
    
    /**
    *
    * @var array
    */
    private $attributes = array();

    /**
    *
    * @var array
    */
    private $classes = array();
    
    function __construct($name = '', $value = '')
    {
        $this->name = $name;
        $this->value = $value;
    }

    function GetName()
    {
        return $this->name;
    }
    function SetName($name)
    {
        $this->name = $name;
    }
    function GetValue()
    {
        return $this->value;
    }
    function SetValue($value)
    {
        $this->value = $value;
    }
    
    function GetLabel()
    {
        return $this->label;
    }

    function SetLabel($label)
    {
        $this->label = $label;
    }

    function GetDescription()
    {
        return $this->description;
    }

    function SetDescription($description)
    {
        $this->description = $description;
    }
    /**
     * Marks this field as not required by removing required validator if it was previously set 
     */
    public function SetNotRequired()
    {
        $unsetIndices = array();
        foreach($this->validators as $index=>$validator)
        {
            if ($validator instanceof Validation\Required)
                $unsetIndices[] = $index;
        }
        foreach($unsetIndices as $index)
        {
            unset($this->validators[$index]);
        }
    }
    /**
     * Marks this field as required by adding a validator 
     * @return type 
     */
    public function SetRequired($errorLabelPrefix = '')
    {
        foreach($this->validators as $validator)
        {
            if ($validator instanceof Validation\Required)
                return;
        }
        $this->validators[] = new Validation\Required($errorLabelPrefix);
    }
    
    /**
     * Gets true if the field is marked as required
     * @return boolean 
     */
    public function GetRequired()
    {
        return (bool)$this->GetRequiredValidator();
    }
    /**
     * Searches and returns  a required validator
     * @return Validation\Required
     */

    function Check($value)
    {
        $this->SetValue($value);
        $required = $this->GetRequiredValidator();
        if ($required && !$required->Check($value))
        {
            $this->checkFailed = true;
            return false;
        }
        return parent::Check($value);
    }
    /**
     *
     * Sets an html attribute
     * @param string $name The name of the html attribute
     * @param string $value The value; if null, the attribute is unset.
     */
    function SetHtmlAttribute($name, $value)
    {
        if ($value === null)
        {
            if (isset($this->attributes[$name]))    
                unset($this->attributes[$name]);
        }
        else
            $this->attributes[$name] = $value;
    }
        
        /**
         * Gets a specific html attribute
         * @param string $name
         * @return string
         */
        function GetHtmlAttribute($name)
        {
            if (isset($this->attributes[$name]))
                    return $this->attributes[$name];
            
            return null;
        }
        
        /**
         * The attributes that should be rendered to html
         * @return array 
         */
        function GetHtmlAttributes()
        {   
            return $this->attributes;
        }
        
        function HtmlAttributesAsString()
        {
            $result = '';
            foreach ($this->attributes as $key=>$val)
            {
                if ($result)
                    $result .= ' ';
                
                $result .= System\String::ToHtml($key) . '="' . System\String::ToHtml($val) .   '"';
            }
            
            return $result;
        }
        
        function AddCssClass($class)
        {
            if (!$this->HasCssClass($class))
                $this->classes[] = $class;
        }
        
        
        function RemoveCssClass($class)
        {
            $key = array_search($class, $this->classes);
            if ($key !== false)
                unset($this->classes[$key]);
        }
        
        function HasCssClass($class)
        {
            return (array_search($class, $this->classes) !== false);
        }
        
        function GetCssClasses()
        {
            return $this->classes;
        }
        
       
}