<?php
namespace Phine\Framework\Database\Mysql;

use Phine\Framework\Database\Types as DBTypes;
use Phine\Framework\Database\Interfaces\BaseImpl\BaseTypeDef;

class TypeDef extends BaseTypeDef
{   
    
    /**
     * Parses pure parse name and set or length from full type name.
     * @param $fullName
     * @return TypeDef Returns the type def
     */
    static function ParseFullName($fullName)
    {
        $fullName = strtolower($fullName);
        $name = $fullName;
        $length = 0;
        $set = array();
        
        $modifiers = '';
        $bracePos1 = strpos($fullName, '(');
        $bracePos2 = 0;
        if ($bracePos1 > 0)
        {
            $name = trim(substr($fullName, 0, $bracePos1));
            $bracePos2 = strpos($fullName, ')', $bracePos1);
        }
        if ($bracePos1 && $bracePos2)
        {
            $inBrace = trim(substr($fullName, $bracePos1 + 1, $bracePos2 - $bracePos1 - 1));
            self::ParseInBrace($inBrace, $set, $length);
            if ($bracePos2 < strlen($fullName) - 1)
            {
                $modifiers = trim(strtolower(substr($fullName, $bracePos2 + 1)));
            }
        }
        $type = self::CalcType($name, $length);
        return new self($name, $type, $set, $length, $modifiers);
    }
    
    private static function ParseInBrace($inBrace, array &$set, &$length)
    {
        if (ctype_digit($inBrace))
        {
            $length = (int)$inBrace;
        }
        else
        {
            $set = array();
            $sets = explode(',', $inBrace);
            foreach ($sets as $element)
            {
                $set[] = trim($element, " '");
            }
        }
    }
    
    static function CalcType($name, $length)
    {
        switch (strtolower($name))
        {
            case 'bigint':
            case 'int':                
            case 'tinyint':
                if ($length == 1) //Save as bool
                {
                    return new DBTypes\DBBool();
                }
                else if ($length > 11) //Save as Big int then.
                {
                    return new DBTypes\DBBigInt();
                }
                else
                {
                    return new DBTypes\DBInt();    
                }
            case 'datetime':
                return new DateTime();
            
            case 'date':
                return new Date();

            case 'timestamp':
                return new TimeStamp();
            
            default:
                return new DBTypes\DBString();
        }
    }
}