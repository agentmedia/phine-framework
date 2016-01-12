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
    
    private static $allowedTypes = array(self::TypeText, 
        self::TypePassword,
        self::TypeFile,
        self::TypeHidden);
    
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
}