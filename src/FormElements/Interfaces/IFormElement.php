<?php
namespace Phine\Framework\FormElements\Interfaces;
use Phine\Framework\Validation\Interfaces as ValidationInterfaces;
/** 
 * 
 * Interface for both form fields and fieldsets
 */
interface IFormElement
{
     /**
     * Add a validator to this field
     * @param ValidationInterfaces\IValidator $validator
     */
    function AddValidator(ValidationInterfaces\IValidator $validator);
    
    /**
     * Get field validators
     * @return ValidationInterfaces\IValidator[]
     */
    function GetValidators();
    
    /**
     * @return void 
     */
    function ClearValidators();
    
    /**
     * @return bool
     */
    function Check($value);
    
     /**
     * @return bool
     */
    function CheckFailed();
}