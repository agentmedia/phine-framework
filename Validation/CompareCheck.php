<?php
namespace Phine\Framework\Validation;
use Phine\Framework\System\String;

require_once __DIR__ . '/Validator.php';

class CompareCheck extends Validator
{
    /**
     *
     * @var string
     */
    private $compareValue;
    /**
     *
     * @var bool 
     */
    private $equalsNot = false;
    
    /**
     *
     * @var bool
     */
    private $ignoreCase = false;
            
    const EqualsNot = 'Validation.CompareCheck.EqualsNot_{0}';
    const Equals = 'Validation.CompareCheck.Equals_{0}';
    
    protected function __construct($compareValue, $equalsNot = false, $errorLabelPrefix = '', $trimValue = true, $ignoreCase = false)
    {
        $this->compareValue = $compareValue;
        $this->equalsNot = $equalsNot;
        $this->ignoreCase = $ignoreCase;
        parent::__construct($errorLabelPrefix, $trimValue);
    }
    
    static function Equals($compareValue, $errorLabelPrefix = '', $trimValue = true, $ignoreCase = false)
    {
        return new self($compareValue, false, $errorLabelPrefix, $trimValue, $ignoreCase);
    }
    
    static function EqualsNot($compareValue, $errorLabelPrefix = '', $trimValue = true, $ignoreCase = false)
    {
        return new self($compareValue, true, $errorLabelPrefix, $trimValue, $ignoreCase);
    }
    
    function Check($value)
    {
        $isEqual = String::Compare($value, $this->compareValue, $this->ignoreCase);
       if ($this->equalsNot && $isEqual)
           $this->error = self::Equals;
       
       else if (!$this->equalsNot && !$isEqual)
           $this->error = self::EqualsNot;
       
       return $this->error == '';
    }
    
    function ErrorParams()
    {
        if ($this->error)
            return array($this->compareValue);
        
        return parent::ErrorParams();
    }
}