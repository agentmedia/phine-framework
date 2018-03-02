<?php
namespace Phine\Framework\Validation;
use Phine\Framework\System\Conversion\GlobalNumberParser;

class Number extends Validator
{
    private $min = NULL;
    private $max = NULL;
    
    private $withLowerBoundary;
    private $withUpperBoundary;
    
    const NotParsed = 'Validation.Number.NotParsed';
    const ExceedsMin = 'Validation.Number.ExceedsMin_{0}';
    const ExceedsMax = 'Validation.Number.ExceedsMax_{0}';
    
    
    /**
     * Validator for floats greater than or equal 0.
     * @param string $errorLabelPrefix
     * @return Integer
     */
    static function PositiveOrNull($errorLabelPrefix = '')
    {
        return new self(0, NULL, true, true, $errorLabelPrefix);    
    }
    
    /**
     * Validator for floats greater than 0.
     * @param string $errorLabelPrefix
     * @return Integer
     */
    static function Positive($errorLabelPrefix = '')
    {
        return new self(0, NULL, false, true, $errorLabelPrefix);    
    }
    
    /**
     * Validator for floats less than 0.
     * @return Number
     */
    static function Negative($errorLabelPrefix = '')
    {
        return new self(NULL, 0, true, false, $errorLabelPrefix);
    }
    
    /**
     * Validator for negative floats less than or equal 0.0
     * @return Integer
     */
    static function NegativeOrNull($errorLabelPrefix = '')
    {
        return new self(NULL, 0, true, true, $errorLabelPrefix);
    }
    
    static function Any($errorLabelPrefix = '')
    {
        return new self(NULL, NULL, true, true, $errorLabelPrefix);
    }
    /**
     * Creates an Integer validator
     * @param float $min The minimum boundary; if NULL there is no lower limitation
     * @param int $max The maximum boundary; if NULL there is no upper limitation
     * @param bool $withLowerBoundary If true, the lower boundary is still allowed
     * @param bool $withUpperboundary If true, the upper boundary is still allowed
     * @param string $errorLabelPrefix
     */
    function __construct($min, $max, $withLowerBoundary = true, $withUpperboundary = true, $errorLabelPrefix = '')
    {
        $this->min = $min;
        $this->max = $max;
        $this->withLowerBoundary = $withLowerBoundary;
        $this->withUpperBoundary = $withUpperboundary;
        parent::__construct($errorLabelPrefix);
    }
    
    
    /**
     * Checks the given value
     * @param string $value
     * @return bool True if check was passed
     */
    function Check($value)
    {
        $floatValue = 0.0;
        if (!GlobalNumberParser::TryParse($value, $floatValue)) {
            $this->error = self::NotParsed;
        }
        else {
            if (!$this->CheckMin($floatValue)) {
                 $this->error = self::ExceedsMin; 
            } else if (!$this->CheckMax($floatValue)) {
                $this->error = self::ExceedsMax;
            }
        }
        return $this->error == '';
    }
    
    
    private function CheckMin($floatValue) {
        if ($this->min === null) {
            return true;
        }
        if ($this->withLowerBoundary) {
            return $floatValue >= $this->min;
        }
        return $floatValue > $this->min;
    }
    
    
    private function CheckMax($floatValue) {
        if ($this->max === null) {
            return true;
        }
        if ($this->withUpperBoundary) {
            return $floatValue <= $this->max;
        }
        return $floatValue < $this->max;
    }
    
    function ErrorParams()
    {
        if ($this->error == self::ExceedsMax)
            return array($this->max);
        
        else if ($this->error == self::ExceedsMin)
            return array($this->min);
        
        return parent::ErrorParams();
    }
}