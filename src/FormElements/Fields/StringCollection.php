<?php
namespace Phine\Framework\FormElements\Fields;
use Phine\Framework\System;

/**
 * Provides a textarea whose lines shall serve as string collection
 */
class StringCollection extends Textarea
{
    
    /**
     * Checks each line of the given value with the given validators
     * @param string $value
     * @return bool 
     */
    function Check($value)
    {
        $success = true;
        $strings = System\Str::SplitLines($value);
        foreach ($strings as $string)
        {
            $success = parent::Check($string);
            if (!$success)
                break;
        }
        
        //The value is temporarily set to the substrings
        //when calling the parent check function above,
        //so we have to store it here, not before the loop:
        $this->SetValue($value);
        return $success;
    }
}
