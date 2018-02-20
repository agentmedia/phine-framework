<?php

namespace Phine\Framework\Wording\Interfaces;

/**
 * Provides an interface for wording realizers
 *
 * @author klaus
 */
interface IRealizer 
{
    /**
     * Realizes the placeholder with the given args 
     */
    function RealizeArgs($placeholder, array $args = array());
    
    /**
     * Checks for existance of a placeholder replacement
     * @return Returns trur if the placeholer exists
     */
    function HasReplacement($placeholder);
    
     /**
     * Gets the replacement of the placeholder
     * @param string $placeholder The placeholder to be replaced with text
     * @return string The replacement
     */
    function GetReplacement($placeholder);
}
