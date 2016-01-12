<?php

namespace Phine\Framework\FormElements\Fields;

use Phine\Framework\Validation\Interfaces as ValidationInterfaces;
use Phine\Framework\Validation;
use Phine\Framework\FormElements\Interfaces as FormInterfaces;

abstract class FormElement implements FormInterfaces\IFormElement
{
    protected $validators = array();
    protected $checkFailed = false;
   
    function AddValidator(ValidationInterfaces\IValidator $validator)
    {
        $this->validators[] = $validator;
    }

    /**
     * Gets the validators
     * @return ValidationInterfaces\IValidator[]
     */
    function GetValidators()
    {
        return $this->validators;
    }
    public function ClearValidators()
    {
         $this->validators = array();
    }
    /**
     * 
     * @return Required|null
     */
    protected function GetRequiredValidator()
    {
        foreach($this->validators as $validator)
        {
            if ($validator instanceof Validation\Required)
                return $validator;
        }
        return null;
    }
    function Check($value)
    {
        $required = $this->GetRequiredValidator();
        if (!$required && ($value === '' || $value === null))
        {
            $this->checkFailed = false;
            return true;
        }
        $success = true;
        $validators = $this->GetValidators();
        foreach ($validators as $validator)
        {
            if (!$validator instanceof Validation\Required)
            {
                $succ = $validator->Check($value);
                $success = $success && $succ;
            }
        }
        $this->checkFailed = !$success;
        return $success;
    }
    
    function CheckFailed()
    {
        return $this->checkFailed;
    }
}