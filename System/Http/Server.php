<?php
namespace Phine\Framework\System\Http;

class Server
{
    
    static function Variable($name) {
         $var = filter_input(INPUT_SERVER, $name);
        //FCGI mode bug workaround
        if ($var === null) {
            $var = isset($_SERVER[$name]) ? filter_var($_SERVER[$name], FILTER_SANITIZE_STRING) : null;
        }
        return $var;
    }
    
    /**
     * URL name of the server; for example www.mydomain.com.
     * @return string
     */
    static function Name()
    {
        return self::Variable('SERVER_NAME');
    }
    
    /**
     * Server Protocol as called by client; Usually HTTP or HTTPS with version number.
     * @return string
     */
    static function Protocol()
    {
        return self::Variable('SERVER_PROTOCOL');
    }
    
    /**
     * Returns the port of the connection; default = 80
     * @return int 
     */
    static function Port()
    {
        return self::Variable('SERVER_PORT');
    }
    
    static function BaseUrl()
    {
        $result = Request::IsHttps() ? 'https' : 'http';
        $result .= '://' . self::Name();
        $port = $port = self::Port();
        
        if ($port && $port != '80')
        {
            $result .= ':' . $port;
        }
        $result .= '/';
        return $result;
    }
    
    /**
     * The remote ip, if available
     * @return string
     */
    static function RemoteAddress()
    {
        return self::Variable('REMOTE_ADDR');
    }
}