<?php
namespace Phine\Framework\Progress\Json;
use Phine\Framework\Progress\Interfaces\IReporter;
use Phine\Framework\System\IO;
use Phine\Framework\Wording\Worder;
/**
 * Progress reporter using json files
 */
class Reporter implements IReporter
{
    private $targetFile;
    private $descriptionLabel;
    private $data;
    
    function __construct($targetFile, array $otherData = array(), $descriptionlabel = '')
    {
        $this->targetFile = $targetFile;
        $this->descriptionLabel = $descriptionlabel;
        $this->data = $otherData;
    }
    
    /**
     * 
     * @param type $progress
     * @param type $progressCount
     */
    function Report($progress, $progressCount)
    {
        $this->data['progress'] = $progress;
        $this->data['progressCount'] = $progressCount;
        if ($this->descriptionLabel)
        {
            $this->data['progressDescription'] = Worder::ReplaceArgs($this->descriptionLabel, array($progress, $progressCount));
        }
        IO\File::CreateWithText($this->targetFile, json_encode($this->data));
    }
    
    /**
     * Gets the current status
     * @return \stdClass Returns an object with progress, progressCount and optional progressDescription
     */
    function GetStatus()
    {
        if (IO\File::Exists($this->targetFile))
        {
            $json = IO\File::GetContents($this->targetFile);
            return json_decode($json);
        }
        return null;
    }
}


