<?php
namespace Phine\Framework\FormElements\Interfaces;


interface IFormField
{
    /**
     * Returns value or values
     * @return mixed
     */
    function GetValue();
    
    /**
     * Sets value
     */
    function SetValue($value);
    
    /**
     * Gets field name
     * @return string
     */
    function GetName();
    
    /**
     * Sets field name
     * @param $name
     */
    function SetName($name);
    
    /**
     * 
     * @param string $label
     */
    function SetLabel($label);
    
    /**
     * 
     * @return string
     */
    function GetLabel();
    
    /**
     * Sets description
     * @param string $description
     */
    function SetDescription($description);
    
    /**
     * 
     * @return string
     */
    function GetDescription();
    
       
        
       
        
    
}