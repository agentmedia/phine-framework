<?php
namespace Phine\Framework\Webserver\Apache\Htaccess;
use Phine\Framework\Webserver\Apache\Enums\ServerVariable;

/**
 * Allows The use of a server variable as htaccess content
 */
class Variable extends Base\Content
{
    /**
     * The server variable
     * @var ServerVariable
     */
    private $variable;
    function __construct(ServerVariable $variable)
    {
        $this->variable = $variable;
    }

    /**
     * The variable as stated in htaccess
     * @return string
     */
    public function ToString()
    {
        return '%{' . $this->variable . '}';
    }

}

