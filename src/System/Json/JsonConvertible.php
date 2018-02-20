<?php

namespace Phine\Framework\System\Json;

/**
 * Provides an abstract base class to convert a json string to a conrete class
 */
abstract class JsonConvertible
{

    /**
     * Creates an instance from json string 
     * @param string $json The json string
     * @result JsonConvertible Returns the resulting object
     */
    static function FromString($json)
    {
        $jsonObj = @\json_decode($json);
        if (!is_a($jsonObj, 'stdClass')) {
            return null; 
        }
        $result = new static();
        $class = new \ReflectionClass($result);
        $props = $class->getProperties(\ReflectionProperty::IS_PUBLIC & ~ \ReflectionProperty::IS_STATIC);
        foreach ($props as $prop) {
            $name = $prop->getName();
            if (isset($jsonObj->$name)) {
                $prop->setValue($result, $jsonObj->$name);
            }
        }
        return $result;
    }

    /**
     * Converts this object to a json string
     * @return string
     */
    function __toString()
    {
        return $this->ToString();
    }

    /**
     * Converts this object to a json string
     * @return string Returns the json string representation of this object
     */
    function ToString()
    {
        return \json_encode($this);
    }

}
