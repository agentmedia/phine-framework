<?php

namespace Phine\Framework\Webserver\Apache\Htaccess\Enums;
use Phine\Framework\System\Enum;

class FlagType extends Enum
{
    /**
     * Flag type 'QSA' for Query String Append
     * @return FlagType
     */
    static function Qsa()
    {
        return new self('QSA');
    }
    /**
     * 
     * Flag type 'L' for last rule
     * @return FlagType 
     */
    static function L()
    {
        return new self('L');
    }
    
    /**
     * 
     * Flag type 'R' for redirect rule
     * @return FlagType 
     */
    static function R()
    {
        return new self('R');
    }
    
    
    /**
     * 
     * Flag type 'OR' for OR combination of conditions
     * @return FlagType 
     */
    static function Or_()
    {
        return new self('OR');
    }
    
    /**
     * 
     * Flag type 'NC' for not case sensitive
     * @return FlagType 
     */
    static function NC()
    {
        return new self('NC');
    }
}
