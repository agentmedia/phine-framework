<?php

namespace Phine\Framework\Webserver\Apache\Htaccess;
/**
 * Represents a flag on htaccess command
 */
class CommandFlag extends Base\Content
{
    /**
     * The flag type
     * @var Enums\FlagType
     */
    private $type;
    /**
     * Optional flag value
     * @var string 
     */
    private $value = '';
    /**
     * Creates flag
     * @param Enum\FlagType $type
     * @param type $value
     */
    function __construct(Enums\FlagType $type, $value = '')
    {
        $this->type = $type;
        $this->value = $value;
    }
    /**
     * Gets the flag as string
     * @return string
     */
    function ToString()
    {
        $result = (string)$this->type;
        if ($this->value)
        {
            $result .= '=' . $this->value;
        }
        return $result;
    }
}
