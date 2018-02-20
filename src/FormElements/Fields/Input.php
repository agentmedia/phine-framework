<?php

namespace Phine\Framework\FormElements\Fields;

/**
 * Represents one of the form input fields
 */
class Input extends FormField
{
    const TypeText = 'text';
    const TypePassword = 'password';
    const TypeFile = 'file';
    const TypeHidden = 'hidden';
    const TypeColor = 'color';
    
    private static $allowedTypes = array(self::TypeText, 
        self::TypePassword,
        self::TypeFile,
        self::TypeHidden,
        self::TypeColor);
    
    private $type;
    
    /**
     * Creates text input provider
     * @return Input
     */
    static function Text($name = '', $value = '')
    {
        return new self(self::TypeText, $name, $value);
    }
    
    /**
     * Creates password input field
     * @return Input
     */
    static function Password($name = '', $value = '')
    {
        return new self(self::TypePassword, $name, $value);
    }
    
    /**
     * Creates file input field
     * @return Input
     */
    static function File($name = '')
    {
        return new self(self::TypeFile, $name);
    }

    /**
     * Creates hidden input field
     * @return Input
     */
    static function Hidden($name = '', $value = '')
    {
        return new self(self::TypeHidden, $name, $value);
    }
    
    /**
     * Creates a field of type color (not supported e.g. in Edge Browser)
     * @param string $name Field name
     * @param string $value the value
     * @return Input Returns a color field
     */
    static function Color($name = '', $value = '')
    {
        return new self(self::TypeColor, $name, $value);
    }
    
    /**
     * Create new input field
     * @param string $type
     * @param string $name
     * @param string $value
     */
    function __construct($type, $name = '', $value = '')
    {
        if (!in_array($type, self::$allowedTypes)){
            throw new \InvalidArgumentException('Unknown Type for input field: ' . $type);
        }
        $this->type = $type;
        parent::__construct($name, $value);
    }
    
    /**
     * The type as needed in html
     * @return string
     */
    function GetType()
    {
        return $this->type;
    }
    protected function PassThroughEmptyNotRequired()
    {
        return $this->type == self::TypeFile;
    }
}