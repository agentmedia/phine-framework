<?php

namespace Phine\Framework\Webserver\Apache\Htaccess;

/**
 * Represents a single rewrite rule
 */
class RewriteRule extends Base\RewriteCommand
{
    protected function Name()
    {
        return 'RewriteRule';
    }
}

