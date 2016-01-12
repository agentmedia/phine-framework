<?php
namespace Phine\Framework\System\Php;

/**
 * Provides basic methods for a class that can serialize itself to php
 */
abstract class WritableClass
{
    /**
     * Gets the complete new statement as php code
     * @return string Returns a string like 'new \namespace\className(true)'
     */
    final function GetNewStatement()
    {
        $result = 'new \\' . get_class($this);
        $params = $this->GetConstructParams();
        if (!is_array($params))
        {
            throw new \Exception('PHP writable class ' . get_class($this) . ' did not provide an array as construct params');
        }
        $strParams = array();
        foreach ($params as $param)
        {
            $strParams[] = $this->GetParamString($param);
        }
        return $result . '(' .  join(', ', $strParams) . ')';
    }
    /**
     * Serializes the parameter as php code
     * @param mixed $param
     * @return string Returns the php code representation of the parameter
     * @throws \InvalidArgumentException Raises an error if the parameter is neither a primitive type nor a writable class
     */
    private function GetParamString($param)
    {
        if ($param === null)
            return "null";
        if (is_string($param))
            return "'" .  addcslashes($param, "'") . "'";
        
        else if (is_bool($param))
            return $param ? "true" : "false";
        
        else if (is_int($param) || is_float($param))
            return (string)$param;
        
        else if ($param instanceof WritableClass)
            return $param->GetNewStatement();
        
        else if (is_array($param))
        {
            $resultArr = array();
            foreach ($param as $key=>$val)
            {
                $resultArr[] = $this->GetParamString($key) . '=>' . $this->GetParamString($val);
            }
            return 'array(' . join (', ' , $resultArr) .')';
        }
        else if ($param instanceof \Phine\Framework\System\Enum)
        {
            $value = $param->Value();
            $class = get_class($param);
            return "\\$class::ByValue('$value')";
        }
        throw new \InvalidArgumentException('A writable class must have primitive types, Enums, arrays and PhpWritable classes as construct params only.');
    }
    /**
     * Gets all constructor parameters
     * @return array Returns the parameters the current instance was constructed with
     */
    protected abstract function GetConstructParams();
}