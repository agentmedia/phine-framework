<?php
namespace Phine\Framework\Localization\Interfaces;

/**
 * The translator interface
 */
interface ITranslator
{
    /**
     * Returns the languange
     * @return mixed An object with language information.
     */
    function GetLanguage();
    
    /**
     * Sets the language. If null, a default language should be set.
     * @param mixed $language The language identifier; typically a string
     */
    function SetLanguage($language);
}