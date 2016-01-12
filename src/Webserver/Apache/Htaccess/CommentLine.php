<?php

namespace Phine\Framework\Webserver\Apache\Htaccess;

class CommentLine extends Base\Content
{
    private $text;
    function __construct($text)
    {
        $this->text = $text;
    }

    public function ToString()
    {
        return '# ' . $this->text . "\r\n";
    }
}

