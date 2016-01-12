<?php
namespace Phine\Framework\Progress\Interfaces;
/**
 * The progress reporter interface
 */
interface IReporter
{
    /**
     * Notifies the reporter to store progress information
     * @param int $progress The amount of done progress steps
     * @param int $progressCount The total amount of progress steps 
     */
    function Report($progress, $progressCount);
    
    /**
     * 
     * Gets the progress status
     * @return mixed Returns status information about the progress
     */
    function GetStatus();
}
