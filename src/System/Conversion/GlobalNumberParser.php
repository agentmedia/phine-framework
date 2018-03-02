<?php
namespace Phine\Framework\System\Conversion;

/**
 * A global numer parser accepting both dot and comma, which will handle most number input correctly
 */
class GlobalNumberParser
{
    private static $_separator1 = '.';
    private static $_separator2 = ',';
    
    /**
     * Parses the number globally. Note that Strings like 1.000 or 1,000 will lead to 1.0 as result, while 1.000.000 or 1,000,000 will result in 1 millionen.
     * @param string $string The numerich string
     * @param float $result The result, or null if no parsing possible
     * @return boolean Returns true if number could be parsed
     */
    static function TryParse($string, &$result) {
        $result = null;
        $strNumber = trim($string);
        $decPoint = self::$_separator1;
        $thousandSep = self::$_separator2;
        if (!self::EvaluateSeparators($strNumber, $decPoint, $thousandSep)){
            return false;
        }
        
        $strFiltered = preg_replace("/[^0-9\.\,\-\+]/" , "" , $strNumber);
        $strPrepared = str_replace($thousandSep, '', $strFiltered);
        $strNormalized = str_replace($decPoint, '.', $strPrepared);
        $result = floatval($strNormalized);
        return true;
    }

    /**
     * Parses a string to a number
     * @param string $string
     * @return float Returns the parsed number
     * @throws \InvalidArgumentException Raises an exception if parsing failed
     */
    static function Parse($string) {
        $result = null;
        if (!self::TryParse($string, $result)) {
            throw new \InvalidArgumentException("'$string' could not be converted to a number");
        }
        return $result;
    }


    private static function EvaluateSeparators($string, &$decPoint, &$thousandSep){
        $cntOccur1 = substr_count($string, self::$_separator1);
        $cntOccur2 = substr_count($string, self::$_separator2);
        $lastOccur1 = strrpos($string, self::$_separator1);
        if ($lastOccur1 === false) {
            $lastOccur1 = -1;
        }
        $lastOccur2 = strrpos($string, self::$_separator2);
        if ($lastOccur2 === false) {
            $lastOccur2 = -1;
        }
        if ($cntOccur1 > 1 && $cntOccur2 > 1) {
            return false;
        }
        if ($lastOccur1 < $lastOccur2) {
            if ($cntOccur2 > 1) {
                return false;
            }
            $decPoint = self::$_separator2;
            $thousandSep = self::$_separator1;
        } else if ($lastOccur2 < $lastOccur1) {
            if ($cntOccur1 > 1) {
                return false;
            }
        }
        return true;
    }
}

