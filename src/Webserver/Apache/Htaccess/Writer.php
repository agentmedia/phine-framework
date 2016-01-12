<?php

namespace Phine\Framework\Webserver\Apache\Htaccess;
use Phine\Framework\Webserver\Apache\Htaccess\Base\Content;

/**
 * Provides methods to write htaccess rewrite commands
 */
class Writer
{
    /**
     * The list of contents
     * @var Content[]
     */
    private $contents;
    function __construct()
    {
        $this->contents = array();
    }
    
    /**
     * Adds content to the writer
     * @param Content $content
     */
    function AddContent(Content $content)
    {
        $this->contents[] = $content;
    }
    /**
     * 
     * @return string Returns the composed htaccess content
     */
    function ToString()
    {
        $result = '';
        foreach ($this->contents as $content)
        {
            $result .= $content->ToString();
        }
        return $result;
    }
    /*
    function ToFile(CommentLine $startMarker, CommentLine $endMarker)
    {
        
    }
     * 
     */
}