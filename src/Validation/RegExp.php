<?php
namespace Phine\Framework\Validation;
/**
 * 
 */
class RegExp extends Validator
{
    /**
     *
     * @var string
     */
    private $pattern;
    
    
    const NoMatch ='Validation.RegExp.NoMatch';
    /**
     * 
     * @param type $pattern
     * @param string $errorLabelPrefix
     * @param bool $trimValue The value is trimmed before evaluation
     */
    function __construct($pattern, $trimValue = true,  $errorLabelPrefix = '')
    {
        $this->pattern = $pattern;
        parent::__construct($errorLabelPrefix, $trimValue);
    }
    
    
    
    /**
     * Checks the value against the pattern of this reg exp validator
     * @param string $value
     * @return bool
     */
    public function Check($value)
    {
        if ($this->trimValue)
            $value = trim($value);
        $result = array();
        if (!preg_match($this->pattern, $value))
            $this->error = self::NoMatch;
        
        return $this->error == '';
    }
    
    /**
     * Reg exp validator for strings with letter characters (A-Z, a-z), only
     * @param string $additionalChars Additional allowed chars; This string is simply added to reg exp pattern
     * @param string $errorLabelPrefix The error label prefix
     * @param bool $trimValue True if value shall be trimmed before validation
     * @return RegExp
     */
    static function Letters($additionalChars = '', $errorLabelPrefix = '', $trimValue = true)
    {
        return new self("/^[A-Za-z$additionalChars]*$/", $errorLabelPrefix, $trimValue);
    }
    
    /**
     * Reg exp validator for strings with numbers (0-9), only
     * @param string $additionalChars Additional allowed chars; This string is simply added to reg exp pattern
     * @param string $errorLabelPrefix The error label prefix
     * @param bool $trimValue True if value shall be trimmed before validation
     * @return RegExp
     */
    static function Numbers($additionalChars = '', $errorLabelPrefix = '', $trimValue = true)
    {
        return new self("/^[0-9$additionalChars]*$/", $errorLabelPrefix, $trimValue);
    }
    
    /**
     * Reg Exp validator for six characters rgb color hex codes
     * @param boolean $noHash True if no hash shall be prefixed (default=false)
     * @param string $errorlLabelPrefix The prefix for errors
     * @param boolean $trimValue True if value shall be trimmed before validation (default=true)
     * @return RegExp Returns a validator for RGB colors written like #a0b1c2, or a0b1c2 if noHash is true
     */
    static function HexRGB($noHash = false, $errorlLabelPrefix = '', $trimValue = true)
    {
        $regStart = $noHash ? '' : '#';
        return new self("/^" . $regStart . "[A-Fa-f0-9]{6}$/", $errorlLabelPrefix, $trimValue);
    }
    
    /**
     * Reg exp validator for strings with letters and numbers, only
     * @param string $additionalChars Additional allowed chars; This string is simply added to reg exp pattern
     * @param string $errorLabelPrefix
     * @param bool $trimValue True if value shall be trimmed before validation
     * @return RegExp
     */
    static function LettersNumbers($additionalChars = '', $errorLabelPrefix = '', $trimValue = true)
    {
        return new self("/^[A-Za-z0-9$additionalChars]*$/", $errorLabelPrefix, $trimValue);
    }
}
