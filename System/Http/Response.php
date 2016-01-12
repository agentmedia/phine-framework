<?php
namespace Phine\Framework\System\Http;

class Response
{
    const REDIRECT_HEADER_301 = "HTTP/1.1 301 Moved Permanently";
    
    /**
     * Redirects to a target whose path is relatively to the currently running php script
     * @param string $target The redirect target
     * @deprecated since version 2.0.0 This function is not reliable
     */
    static function RedirectRelative($target, $noExit = false)
    {
        session_write_close();
        $dirName =  dirname($_SERVER["PHP_SELF"]);
        if ($dirName == "/")
            $dirName = "";
        header("Location: " .  "http://" . $_SERVER["HTTP_HOST"]
            . $dirName
            . "/" .  $target);
        if (!$noExit)
        {
            exit();
        }
    }

    /**
     * Sends the header string if given and redirects to the target
     * @param string $target
     * @param string $redirectHeader 
     */
    static function Redirect($target, $redirectHeader = "", $noExit = false)
    {
        session_write_close();
        if ($redirectHeader)
        {
            header($redirectHeader);
        }
        header("Location: ". $target);
        if (!$noExit)
        {
            exit();
        }
    }
    
    /**
     * Sends a 301 (Moved permanently) header and redirects to the target
     * @param string $target The valid url of the target
     * @param boolean $noExit If true code execution is not exited
     */
    static function Redirect301($target, $noExit = false)
    {
        self::Redirect($target, self::REDIRECT_HEADER_301, $noExit);
    }
}