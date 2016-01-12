<?php

namespace Phine\Framework\Webserver\Apache\Htaccess\Base;

/**
 * Represents a assignment type command existing of name and value
 */
abstract class NameValueCommand extends Content
{
    private $value;
    
    /**
     * The value of the assignment
     * @param string $value 
     */
    function __construct($value)
    {
        $this->value = $value;
    }
    /**
     * The command name and left hand side of the assignment
     * @return string Returns the name of the command in htaccess
     */
    protected abstract function Name();
    
    /**
     * Converts the name value command to htaccess representation
     * @return string
     */
    public function ToString()
    {
        return $this->Name() . ' ' . $this->value . "\r\n";
    }
}

