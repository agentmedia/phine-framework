<?php

namespace Phine\Framework\Webserver\Apache\Htaccess;
/**
 * Represents a rewrite condition
 */
class RewriteCondition extends Base\RewriteCommand
{
    protected function Name()
    {
        return 'RewriteCond';
    }
}

