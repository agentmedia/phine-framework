<?php
namespace Phine\Framework\System;

/**
 * Utility class for text operations
 */
class Text
{
    /**
     * Cuts off text of desired length
     * @param string $str Input tect
     * @param int $length Desired length
     * @param bool $respectWords Set true so no words are broken
     * @param bool $noEllipsis true if no ellipsis shall be added
     * @param bool $forceEllipsis True if ellipsis shall be added even if text is shorter then desired
     * @param bool $entityDecode True if an entity decode shall be performed
     * @return string 
     */
    static function Shorten($str, $length = 32, $respectWords = false, $noEllipsis = false, $forceEllipsis = false, $entityDecode = false)
    {
        if ($entityDecode)
            $str = html_entity_decode($str, ENT_COMPAT, 'utf-8');

        $str = Str::Trim(strip_tags($str));
        
        if (strlen ($str) <= $length)
	{
	  if ($forceEllipsis)
	    return self::CorrectSpaces($str) . "...";
	  
          else
	    return self::CorrectSpaces($str);
	}

        $str = mb_substr($str, 0, $length - 3, 'utf-8');
        if ($respectWords)
	{
            $pos = mb_strrpos($str, " ", -1, 'utf-8');
            if ($pos > $length / 2)
                $str = mb_substr($str, 0, $pos, 'utf-8');
        }
        $str = self::CorrectSpaces($str);
        
        if (!$noEllipsis)
            $str = $str . "...";
        
        return $str;
    }
    /**
     * Corrects spaces after syntax characters and erases multiple spaces
     * @param string $text
     * @return string
     */
    static function CorrectSpaces($text)
    {
        $chars = '!,;.?:';
        $charArray = str_split($chars);
        foreach ($charArray as $char)
        {
            $text = Str::Replace($char, $char . ' ', $text);
        }
        return  self::RemoveMultipleSpaces($text);
    }
    
    static function RemoveMultipleSpaces($text)
    {
        return preg_replace('/\s\s+/', ' ', $text);
    }
    static function StripMultipleBreaks($text)
    {
        $br = '<br />';
        
        $text = preg_replace('/<br\s*\/?>\s*/', $br, $text);
        $text = preg_replace('/(<br \/>){3,}/', $br . $br, $text);
        while (Str::EndsWith($br, $text))
        {
            $length = Str::Length($text) - Str::Length($br);
            $text = Str::Start($text, $length);
        }
        return $text;
    }
    static function StripMostTags($text)
    {
        return self::CorrectSpaces(self::StripMultipleBreaks(strip_tags($text, '<b><i><sup><sub><em><strong><u><br><ul><ol><li>')));
    }
    
    static function CountWords($text)
    {
        $text = self::RemoveMultipleSpaces($text);
        return count(explode(' ', $text));
    }
}
