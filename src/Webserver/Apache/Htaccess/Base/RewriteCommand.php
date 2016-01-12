<?php
namespace Phine\Framework\Webserver\Apache\Htaccess\Base;
use Phine\Framework\Webserver\Apache\Htaccess\CommandFlag;
/**
 * Abstract base class for htaccess command with lhs value and flags
 */
abstract class RewriteCommand extends Content
{
    /**
     * The left hand side of the condition
     * @var string
     */
    private $lhs;
    
    /**
     * The right hand side of the condition
     * @var string
     */
    private $rhs;
    
    /**
     * The flags
     * @var CommandFlag[] An optional array of flagss
     */
    private $flags;
    
    /**
     * Creates the condition
     * @param string $lhs The left hand side of the condition
     * @param string $rhs The right hand side of the condition
     */
    function __construct($lhs, $rhs)
    {
        $this->lhs = $lhs;
        $this->rhs = $rhs;
        $this->flags = array();
    }
    /**
     * Adds a flag to the condition
     * @param CommandFlag $flag
     */
    function AddFlag(CommandFlag $flag)
    {
        $this->flags[] = $flag;
    }
    /**
     * Gets the attached flags
     * @return Flag[] Returns the flags attached to the command
     */
    function Flags()
    {
        return $this->flags;
    }
    
    /**
     * The left hand side of the command
     * @return string
     */
    function Lhs()
    {
        return $this->lhs;
    }
    
    /**
     * The right hand side of the command
     * @return string
     */
    function Rhs()
    {
        return $this->lhs;
    }
    /**
     * The command name (either condition or rule)
     */
    protected abstract function Name();
    
    public function ToString()
    {
        $result = $this->Name();
        $result .= ' ' . $this->lhs;
        $result .= ' ' . $this->rhs;
        $strFlags = $this->FlagsString();
        if ($strFlags)
        {
            $result .= ' ' . $strFlags;
        }
        return $result . "\r\n";
    }
    /**
     * Converts flags to string
     * @return string
     */
    private function FlagsString()
    {
        $result = '';
        foreach ($this->flags as $flag)
        {
            if ($result)
            {
                $result .= ',';
            }
            $result .= $flag->ToString();
        }
        if ($result)
        {
            $result = '[' . $result . ']';
        }
        return $result;
    }
    
}
