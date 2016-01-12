<?php
namespace Phine\Framework\Webserver\Apache\Htaccess\Base;
/**
 * Abstract base class
 */
abstract class Content
{
    abstract function ToString();
    function __toString()
    {
        return $this->ToString();
    }
}

