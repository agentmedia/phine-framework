<?php
namespace Phine\Framework\System\Http;
use Phine\Framework\System\String;
use Phine\Framework\System\IO\Path;

class Request
{    
    /**
     * Gets a single GET parameter value by name
     * @param string $name The parameter name
     * @param int $filter One of php FILTER values
     * @param mixed $options will be passed to php filter_input
     * @return mixed
     */
    static function GetData($name, $filter = FILTER_DEFAULT, $options = null)
    {
        return filter_input(INPUT_GET, $name, $filter, $options);
    }
    
    /**
     * Gets a single POST parameter value by name
     * @param string $name The parameter name
     * @param int $filter One of php FILTER values
     * @param mixed $options will be passed to php filter_input
     * @return mixed
     */
    static function PostData($name, $filter = FILTER_DEFAULT, $options = null)
    {
        return filter_input(INPUT_POST, $name, $filter, $options);
    }
    /**
     * Gets the GET parameters as array
     * @param string name The name of the array variable; if omitted, complete GET is returned
     * @return array
     */
    static function GetArray($name = null)
    {
        $get = filter_input_array(INPUT_GET);
        if (!$name)
        {
            return $get === null ? array() : $get;
        }
        else if (isset($get[$name]) && is_array($get[$name]))
        {
            return $get[$name];
        }
        return array();
    }
    
    /**
     * Gets the posted data as array
     * @param string name The name of the array variable; if omitted, complete POST is returned
     * @return array
     */
    static function PostArray($name = null)
    {
        $post = filter_input_array(INPUT_POST);
        if (!$name)
        {
            return $post;
        }
        else if (isset($post[$name]) && is_array($post[$name]))
        {
            return $post[$name];
        }
        return array();
    }
    
    static function IsPost()
    {
        return (string)self::Method() == (string)RequestMethod::Post();
    }
    
    static function IsGet()
    {
        return (string)self::Method() == (string)RequestMethod::Get();
    }
    
    static function IsHead()
    {
        return (string)self::Method() == (string)RequestMethod::Head();
    }
    
    static function IsPut()
    {
        return (string)self::Method() == (string)RequestMethod::Put();
    }
      /**
     * Returns GET or POST data
     * @param RequestMethod $method The request method
     * @param string $name parameter name
     * @return string Returns the request data filtered by name
     * @throws \InvalidArgumentException Raises an error if method is neither post nor get
     */
    static function MethodData(RequestMethod $method, $name, $filter = FILTER_DEFAULT, $options = null)
    {
        switch ($method)
        {
            case RequestMethod::Get():
                return self::GetData($name, $filter, $options);
            
            case RequestMethod::Post():
                return self::PostData($name, $filter, $options);
            
            default:
                throw new \InvalidArgumentException('Request::MethodData is available for request methods POST and GET, only');
        }
    }
    /**
     * Returns GET or POST data array
     * @param RequestMethod $method The request method
     * @param string $name Optional parameter name
     * @return array Returns either the full request array or an array filtered by name
     * @throws \InvalidArgumentException Raises an error if method is neither post nor get
     */
    static function MethodArray(RequestMethod $method, $name = '')
    {
        switch ($method)
        {
            case RequestMethod::Get():
                return self::GetArray($name);
            
            case RequestMethod::Post():
                return self::PostArray($name);
            
            default:
                throw new \InvalidArgumentException('Request::MethodArray is available for request methods POST and GET, only');
        }
    }
    
    static function IsHttps()
    {
        $https = Server::Variable('HTTPS');
        return $https && $https != 'off';
    }
    /**
     * Gets the current request method
     * @return RequestMethod
     */
    static function Method()
    {   
        return RequestMethod::FromString(Server::Variable('REQUEST_METHOD'));
    }
    
    /**
     * Gets the current request uri as string
     * @return string 
     */
    static function Uri()
    {
        return Server::Variable('REQUEST_URI');
    }
    
    /**
     * Gets the current request query string
     * @return string 
     */
    static function QueryString()
    {
        return Server::Variable('QUERY_STRING');
    }
    
    /**
     * The current Http host
     * @param boolean $forwarded If true, the original host (not e.g. cache proxy) is evaluated
     * @return string Returns the host name
     */
    static function Host($forwarded = false)
    {
        if ($forwarded)
        {
            return Server::Variable('HTTP_X_FORWARDED_HOST');
        }
        return Server::Variable('HTTP_HOST');
    }
    
    static function Port()
    {
        return Server::Variable('SERVER_PORT');
    }
    
    /**
     * The url protocol string without versioning
     * @return string returns either http or https
     */
    static function Protocol()
    {
        $sp = Server::Variable('SERVER_PROTOCOL');
        $protocol = substr($sp, 0, strpos($sp, '/'));
        if (self::IsHttps() && !String::EndsWith('s', $protocol))
        {
            $protocol .= 's';
        }
        return String::ToLower($protocol);
    }
    
    /**
     * The base url, f.e. https://sub.domain.com:81
     * @return string
     */
    static function BaseUrl()
    {
        $port = self::Port();
        
        $result =  self::Protocol() . '://' . self::Host();
        if ($port != 80 && $port != 443)
        {
            $result .= ':' . $port;
        }
        return $result;
    }
    
    static function FullUrl()
    {
        return Path::Combine(self::BaseUrl(), self::Uri());
    }
}
