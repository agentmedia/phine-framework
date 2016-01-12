<?php
namespace Phine\Framework\Validation;
use Phine\Framework\System\String;
require_once __DIR__ . '/Validator.php';
class Required extends Validator
{
    const Missing ='Validation.Required.Missing';
    
    public function __construct($errorLabelPrefix = '', $trimValues = true)
    {
        parent::__construct($errorLabelPrefix, $trimValues);
    }
    public function Check($value)
    {
        $isArray = is_array($value);
        $this->error = '';
        if ($this->trimValue && !$isArray)
            $value = String::Trim($value);
            
        if ($value === '' || ($isArray && count($value) == 0))
            $this->error = self::Missing;
        
        return $this->error == '';
    }
}
