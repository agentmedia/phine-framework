<?php

namespace Phine\Framework\Webserver\Apache\Enums;
use Phine\Framework\System\Enum;

/**
 * Represents variables provided by the apache server
 */
class ServerVariable extends Enum
{
    /**
     * The API_VERSION server variable
     * @return ServerVariable Returns the server variable
     */
    static function ApiVersion()
    {
        return new self('API_VERSION');
    }
    
    /**
     * The AUTH_TYPE server variable
     * @return ServerVariable Returns the server variable
     */
    static function AuthType()
    {
        return new self('AUTH_TYPE');
    }
    
    /**
     * The CONTENT_LENGTH server variable
     * @return ServerVariable Returns the server variable
     */
    static function ContentLength()
    {
        return new self('CONTENT_LENGTH');
    }
    
    /**
     * The CONTENT_TYPE server variable
     * @return ServerVariable Returns the server variable
     */
    static function ContentType()
    {
        return new self('CONTENT_TYPE');
    }
    
    /**
     * The DOCUMENT_ROOT server variable
     * @return ServerVariable Returns the server variable
     */
    static function DocumentRoot()
    {
        return new self('DOCUMENT_ROOT');
    }
    
     /**
     * The GATEWAY_INTERFACE server variable
     * @return ServerVariable Returns the server variable
     */
    static function GatewayInterface()
    {
        return new self('GATEWAY_INTERFACE');
    }
    
    /**
     * The IS_SUBREQ server variable
     * @return ServerVariable Returns the server variable
     */
    static function IsSubreq()
    {
        return new self('IS_SUBREQ');
    }
    
     /**
     * The ORIG_PATH_INFO server variable
     * @return ServerVariable Returns the server variable
     */
    static function OrigPathInfo()
    {
        return new self('ORIG_PATH_INFO');
    }
    
     /**
     * The ORIG_PATH_TRANSLATED server variable
     * @return ServerVariable Returns the server variable
     */
    static function OrigPathTranslated()
    {
        return new self('ORIG_PATH_TRANSLATED');
    }
    
    /**
     * The ORIG_SCRIPT_FILENAME server variable
     * @return ServerVariable Returns the server variable
     */
    static function OrigScriptFilename()
    {
        return new self('ORIG_SCRIPT_FILENAME');
    }
    
    
     /**
     * The ORIG_SCRIPT_NAME server variable
     * @return ServerVariable Returns the server variable
     */
    static function OrigScriptName()
    {
        return new self('ORIG_SCRIPT_NAME');
    }
    
    /**
     * The PATH server variable
     * @return ServerVariable Returns the server variable
     */
    static function Path()
    {
        return new self('PATH');
    }
    
    /**
     * The PATH_INFO server variable
     * @return ServerVariable Returns the server variable
     */
    static function PathInfo()
    {
        return new self('PATH_INFO');
    }
    
    
    /**
     * The PHP_SELF server variable
     * @return ServerVariable Returns the server variable
     */
    static function PhpSelf()
    {
        return new self('PHP_SELF');
    }
    
    /**
     * The QUERY_STRING server variable
     * @return ServerVariable Returns the server variable
     */
    static function QueryString()
    {
        return new self('QUERY_STRING');
    }
    
    
    /**
     * The REDIRECT_QUERY_STRING server variable
     * @return ServerVariable Returns the server variable
     */
    static function RedirectQueryString()
    {
        return new self('REDIRECT_QUERY_STRING');
    }
    
    /**
     * The REDIRECT_REMOTE_USER server variable
     * @return ServerVariable Returns the server variable
     */
    static function RedirectRemoteUser()
    {
        return new self('REDIRECT_REMOTE_USER');
    }
    
    
    /**
     * The REDIRECT_STATUS server variable
     * @return ServerVariable Returns the server variable
     */
    static function RedirectStatus()
    {
        return new self('REDIRECT_STATUS');
    }
    
    /**
     * The REDIRECT_URL server variable
     * @return ServerVariable Returns the server variable
     */
    static function RedirectUrl()
    {
        return new self('REDIRECT_URL');
    }
    
    /**
     * The REMOTE_ADDR server variable
     * @return ServerVariable Returns the server variable
     */
    static function RemoteAddr()
    {
        return new self('REMOTE_ADDR');
    }
    
    
    /**
     * The REMOTE_HOST server variable
     * @return ServerVariable Returns the server variable
     */
    static function RemoteHost()
    {
        return new self('REMOTE_HOST');
    }
    
    /**
     * The REMOTE_IDENT server variable
     * @return ServerVariable Returns the server variable
     */
    static function RemoteIdent()
    {
        return new self('REMOTE_IDENT');
    }
    
    /**
     * The REMOTE_PORT server variable
     * @return ServerVariable Returns the server variable
     */
    static function RemotePort()
    {
        return new self('REMOTE_PORT');
    }
    
    /**
     * The REMOTE_USER server variable
     * @return ServerVariable Returns the server variable
     */
    static function RemoteUser()
    {
        return new self('REMOTE_USER');
    }
    
    /**
     * The REQUEST_FILENAME server variable
     * @return ServerVariable Returns the server variable
     */
    static function RequestFilename()
    {
        return new self('REQUEST_FILENAME');
    }
    
    /**
     * The REQUEST_METHOD server variable
     * @return ServerVariable Returns the server variable
     */
    static function RequestMethod()
    {
        return new self('REQUEST_METHOD');
    }
    
    /**
     * The REQUEST_TIME server variable
     * @return ServerVariable Returns the server variable
     */
    static function RequestTime()
    {
        return new self('REQUEST_TIME');
    }
    
    /**
     * The REQUEST_URI server variable
     * @return ServerVariable Returns the server variable
     */
    static function RequestUri()
    {
        return new self('REQUEST_URI');
    }
    
    
    /**
     * The SCRIPT_FILENAME server variable
     * @return ServerVariable Returns the server variable
     */
    static function ScriptFilename()
    {
        return new self('SCRIPT_FILENAME');
    }
    
    /**
     * The SCRIPT_GROUP server variable
     * @return ServerVariable Returns the server variable
     */
    static function ScriptGroup()
    {
        return new self('SCRIPT_GROUP');
    }
    
    /**
     * The SCRIPT_NAME server variable
     * @return ServerVariable Returns the server variable
     */
    static function ScriptName()
    {
        return new self('SCRIPT_NAME');
    }
    
    /**
     * The SCRIPT_URI server variable
     * @return ServerVariable Returns the server variable
     */
    static function ScriptUri()
    {
        return new self('SCRIPT_URI');
    }
    
    /**
     * The SCRIPT_URL server variable
     * @return ServerVariable Returns the server variable
     */
    static function ScriptUrl()
    {
        return new self('SCRIPT_URL');
    }

    
    /**
     * The SCRIPT_USER server variable
     * @return ServerVariable Returns the server variable
     */
    static function ScriptUser()
    {
        return new self('SCRIPT_USER');
    }
    
    /**
     * The SERVER_ADDR server variable
     * @return ServerVariable Returns the server variable
     */
    static function ServerAddr()
    {
        return new self('SERVER_ADDR');
    }
    
    /**
     * The SERVER_ADMIN server variable
     * @return ServerVariable Returns the server variable
     */
    static function ServerAdmin()
    {
        return new self('SERVER_ADMIN');
    }
    
    /**
     * The SERVER_NAME server variable
     * @return ServerVariable Returns the server variable
     */
    static function ServerName()
    {
        return new self('SERVER_NAME');
    }
    
    /**
     * The SERVER_PORT server variable
     * @return ServerVariable Returns the server variable
     */
    static function ServerPort()
    {
        return new self('SERVER_PORT');
    }

    /**
     * The SERVER_PROTOCOL server variable
     * @return ServerVariable Returns the server variable
     */
    static function ServerProtocol()
    {
        return new self('SERVER_PROTOCOL');
    }
    
    /**
     * The SERVER_SIGNATURE server variable
     * @return ServerVariable Returns the server variable
     */
    static function ServerSignature()
    {
        return new self('SERVER_SIGNATURE');
    }
    
    /**
     * The SERVER_SOFTWARE server variable
     * @return ServerVariable Returns the server variable
     */
    static function ServerSoftware()
    {
        return new self('SERVER_SOFTWARE');
    }
    
    /**
     * The THE_REQUEST server variable
     * @return ServerVariable Returns the server variable
     */
    static function TheRequest()
    {
        return new self('THE_REQUEST');
    }
    
    /**
     * The TIME server variable
     * @return ServerVariable Returns the server variable
     */
    static function Time()
    {
        return new self('TIME');
    }
    
    /**
     * The TIME_DAY server variable
     * @return ServerVariable Returns the server variable
     */
    static function TimeDay()
    {
        return new self('TIME_DAY');
    }
    
    /**
     * The TIME_HOUR server variable
     * @return ServerVariable Returns the server variable
     */
    static function TimeHour()
    {
        return new self('TIME_HOUR');
    }
    
    
    /**
     * The TIME_MIN server variable
     * @return ServerVariable Returns the server variable
     */
    static function TimeMin()
    {
        return new self('TIME_MIN');
    }
    
    /**
     * The TIME_MON server variable
     * @return ServerVariable Returns the server variable
     */
    static function TimeMon()
    {
        return new self('TIME_MON');
    }
    
    /**
     * The TIME_SEC server variable
     * @return ServerVariable Returns the server variable
     */
    static function TimeSec()
    {
        return new self('TIME_SEC');
    }
    
    /**
     * The TIME _WDAY server variable
     * @return ServerVariable Returns the server variable
     */
    static function TimeWday()
    {
        return new self('TIME_WDAY');
    }

    
    /**
     * The TIME_YEAR server variable
     * @return ServerVariable Returns the server variable
     */
    static function TimeYear()
    {
        return new self('TIME_YEAR');
    }
    
    
    /**
     * The TZ server variable
     * @return ServerVariable Returns the server variable
     */
    static function TZ()
    {
        return new self('TZ');
    }
    
    
    /**
     * The UNIQUE_ID server variable
     * @return ServerVariable Returns the server variable
     */
    static function UniqueID()
    {
        return new self('UNIQUE_ID');
    }
    
    /**
     * The HTTP_ACCEPT server variable
     * @return ServerVariable Returns the server variable
     */
    static function HttpAccept()
    {
        return new self('HTTP_ACCEPT');
    }
    
    /**
     * The HTTP_ACCEPT_CHARSET server variable
     * @return ServerVariable Returns the server variable
     */
    static function HttpAcceptCharset()
    {
        return new self('HTTP_ACCEPT_CHARSET');
    }
    
    /**
     * The HTTP_ACCEPT_ENCODING server variable
     * @return ServerVariable Returns the server variable
     */
    static function HttpAcceptEncoding()
    {
        return new self('HTTP_ACCEPT_ENCODING');
    }
    
    /**
     * The HTTP_ACCEPT_LANGUAGE server variable
     * @return ServerVariable Returns the server variable
     */
    static function HttpAcceptLanguage()
    {
        return new self('HTTP_ACCEPT_LANGUAGE');
    }
    
    /**
     * The HTTP_CACHE_CONTROL server variable
     * @return ServerVariable Returns the server variable
     */
    static function HttpCacheControl()
    {
        return new self('HTTP_CACHE_CONTROL');
    }
    
    /**
     * The HTTP_CONNECTION server variable
     * @return ServerVariable Returns the server variable
     */
    static function HttpConnection()
    {
        return new self('HTTP_CONNECTION');
    }
    
    /**
     * The HTTP_COOKIE server variable
     * @return ServerVariable Returns the server variable
     */
    static function HttpCookie()
    {
        return new self('HTTP_COOKIE');
    }
    
    /**
     * The HTTP_FORWARDED server variable
     * @return ServerVariable Returns the server variable
     */
    static function HttpForwarded()
    {
        return new self('HTTP_FORWARDED');
    }
    
    /**
     * The HTTP_HOST server variable
     * @return ServerVariable Returns the server variable
     */
    static function HttpHost()
    {
        return new self('HTTP_HOST');
    }
    
    /**
     * The HTTP_KEEP_ALIVE server variable
     * @return ServerVariable Returns the server variable
     */
    static function HttpKeepAlive()
    {
        return new self('HTTP_KEEP_ALIVE');
    }
    
    /**
     * The HTTP_PROXY_CONNECTION server variable
     * @return ServerVariable Returns the server variable
     */
    static function HttpProxyConnection()
    {
        return new self('HTTP_PROXY_CONNECTION');
    }
    
    /**
     * The HTTP_REFERER server variable
     * @return ServerVariable Returns the server variable
     */
    static function HttpReferer()
    {
        return new self('HTTP_REFERER');
    }
    
    /**
     * The HTTP_USER_AGENT server variable
     * @return ServerVariable Returns the server variable
     */
    static function HttpUserAgent()
    {
        return new self('HTTP_USER_AGENT');
    }
    
    /**
     * The HTTPS server variable
     * @return ServerVariable Returns the server variable
     */
    static function Https()
    {
        return new self('HTTPS');
    }
    
    
    /**
     * The SSL_CIPHER server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslCipher()
    {
        return new self('SSL_CIPHER');
    }
    
    /**
     * The SSL_CIPHER_ALGKEYSIZE server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslCipherAlgkeysize()
    {
        return new self('SSL_CIPHER_ALGKEYSIZE');
    }
    
    /**
     * The SSL_CIPHER_EXPORT server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslCipherExport()
    {
        return new self('SSL_CIPHER_EXPORT');
    }
    
    /**
     * The SSL_CIPHER_USEKEYSIZE server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslCipherUsekeysize()
    {
        return new self('SSL_CIPHER_USEKEYSIZE');
    }
    
    /**
     * The SSL_CLIENT_VERIFY server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslClientVerify()
    {
        return new self('SSL_CLIENT_VERIFY');
    }
    
    /**
     * The SSL_PROTOCOL server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslProtocol()
    {
        return new self('SSL_PROTOCOL');
    }
    
    /**
     * The SSL_SERVER_A_KEY variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServerAKey()
    {
        return new self('SSL_SERVER_A_KEY');
    }
    
    /**
     * The SSL_SERVER_A_SIG server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServerASig()
    {
        return new self('SSL_SERVER_A_SIG');
    }
    
    /**
     * The SSL_SERVER_CERT server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServerCert()
    {
        return new self('SSL_SERVER_CERT');
    }
    
    /**
     * The SSL_SERVER_I_DN server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServer_I_DN()
    {
        return new self('SSL_SERVER_I_DN');
    }
    
    /**
     * The SSL_SERVER_I_DN_C server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServer_I_DN_C()
    {
        return new self('SSL_SERVER_I_DN_C');
    }
    
    /**
     * The SSL_SERVER_I_DN_CN server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServer_I_DN_CN()
    {
        return new self('SSL_SERVER_I_DN_CN');
    }
    
    /**
     * The SSL_SERVER_I_DN_L server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServer_I_DN_L()
    {
        return new self('SSL_SERVER_I_DN_L');
    }
    
    /**
     * The SSL_SERVER_I_DN_O server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServer_I_DN_O()
    {
        return new self('SSL_SERVER_I_DN_O');
    }
    
    /**
     * The SSL_SERVER_I_DN_OU server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServer_I_DN_OU()
    {
        return new self('SSL_SERVER_I_DN_OU');
    }
    
    /**
     * The SSL_SERVER_I_DN_ST server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServer_I_DN_ST()
    {
        return new self('SSL_SERVER_I_DN_ST');
    }
    
    /**
     * The SSL_SERVER_M_SERIAL server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServer_M_Serial()
    {
        return new self('SSL_SERVER_M_SERIAL');
    }
    
    /**
     * The SSL_SERVER_M_VERSION server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServer_M_Version()
    {
        return new self('SSL_SERVER_M_VERSION');
    }
    
    /**
     * The SSL_SERVER_S_DN server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServer_S_DN()
    {
        return new self('SSL_SERVER_S_DN');
    }
    
    /**
     * The SSL_SERVER_S_DN_CN server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServer_S_DN_CN()
    {
        return new self('SSL_SERVER_S_DN_CN');
    }
    
    /**
     * The SSL_SERVER_S_DN_O server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServer_S_DN_O()
    {
        return new self('SSL_SERVER_S_DN_O');
    }
    
    /**
     * The SSL_SERVER_S_DN_OU server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServer_S_DN_OU()
    {
        return new self('SSL_SERVER_S_DN_OU');
    }
    
    /**
     * The SSL_SERVER_V_END server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServer_V_End()
    {
        return new self('SSL_SERVER_V_END');
    }
    
    /**
     * The SSL_SERVER_V_START server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServer_V_Start()
    {
        return new self('SSL_SERVER_V_START');
    }
    
    /**
     * The SSL_SERVER_SESSION_ID server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServerSessionID()
    {
        return new self('SSL_SESSION_ID');
    }
    
    /**
     * The SSL_SERVER_VERSION_INTERFACE server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServerVersionInterface()
    {
        return new self('SSL_VERSION_INTERFACE');
    }
    
    /**
     * The SSL_SERVER_VERSION_LIBRARY server variable
     * @return ServerVariable Returns the server variable
     */
    static function SslServerVersionLibrary()
    {
        return new self('SSL_VERSION_LIBRARY');
    }
}