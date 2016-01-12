<?php

namespace Phine\Framework\Localization;
use Phine\Framework\Localization\Base;

/**
 * Provides methods to store translations within php files
 */
class PhpTranslator extends Base\FormatTranslator
{
    /**
     *
     * @var PhpTranslator
     */
    private static $singleton;
    
    /**
     * The translations
     * @var array 
     */
    private $translations = array();
    
    /**
     * The currently used language
     * @var string 
     */
    private $language;
    
     /**
     * Creates a new instanceof the php translator
     * @return PhpTranslator
     */
    private function __construct()     
    {
    }
    
    /**
     * Returns a singleton instance
     * @return PhpTranslator
     */
    public static function Singleton()
    {
        if (!self::$singleton)
        {
            self::$singleton = new self();
        }
        return self::$singleton;
    }
    
    /**
     * Gets the replacement text of the placeholder (no additional parameters applied)
     * @param string $placeholder The placeholder texts
     * @return string The replacement string that can be used to mix in additional paramaters
     */
    public function GetReplacement($placeholder)
    {
        if(isset($this->translations[$this->language]))
        {
            $langTranslations = $this->translations[$this->language];
            if (isset($langTranslations[$placeholder]))
            {
                return $langTranslations[$placeholder];
            }
        }
        return $placeholder;
    }
    
    /**
     * Gets the current language
     * @return string
     */
    public function GetLanguage()
    {
        return $this->language;
    }
    
    /**
     * Sets the current language
     */
    public function SetLanguage($language)
    {
        $this->language = $language;
    }
    
    /**
     * Adds a translation to the translator
     * @param string $language
     * @param string $placeholder
     * @param string $text 
     */
    public function AddTranslation($language, $placeholder, $text)
    {
        $this->translations[$language][$placeholder] = $text;
    }
}