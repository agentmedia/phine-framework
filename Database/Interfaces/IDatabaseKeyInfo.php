<?php
namespace Phine\Framework\Database\Interfaces;

/**
 * The database key info
 */
interface IDatabaseKeyInfo
{
    /**
     * Name of the key
     * @return string Returns the key name
     */
    function Name();
    
    /**
     * True if the key is primary
     * @return bool Returns true if it is a primary key
     */
    function IsPrimary();
    
    /**
     * True if the key is unique
     * @return bool Returns true if it is a unique key
     */
    function IsUnique();
}
