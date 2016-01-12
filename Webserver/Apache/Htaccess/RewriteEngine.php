<?php

namespace Phine\Framework\Webserver\Apache\Htaccess;
/**
 * Represents the rewrite engine command
 */
class RewriteEngine extends Base\NameValueCommand
{
    protected function Name()
    {
        return 'RewriteEngine';
    }
}

