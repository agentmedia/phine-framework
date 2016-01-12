<?php

namespace Phine\Framework\Validation;

use Phine\Framework\System\IO\Folder;
use Phine\Framework\System\IO\Path;
/**
 * Checks if a file already exists in a folder
 */
class FileExists extends Validator
{
    const ExistsInFolder = 'Validation.FileExists.InFolder_{0}';
    /**
     * The current file, exluded on check
     * @var string
     */
    private $currentFile;
    
    /**
     * The folder with the files to check against
     * @var string
     */
    private $folder;
    /**
     * The file extension
     * @var string
     */
    private $fileExtension;
    /**
     * Creates a new 
     * @param type $folder The folder with the files to check against
     * @param type $currentFile The current file; excluded when checking.
     * @param type $fileExtension The (default) file extension is auto added to the checked value and current file, if given
     * @param string $errorLabelPrefix The error label prefix
     * @param bool $trimValue True if file name value shall be trimmed
     */
    function __construct($folder, $currentFile = '', $fileExtension = '', $errorLabelPrefix = '', $trimValue = true)
    {
        $this->folder = $folder;
        $this->currentFile = $currentFile;
        $this->fileExtension = $fileExtension;
        parent::__construct($errorLabelPrefix, $trimValue);
    }
    
    /**
     * Checks if the file given in the value doesn't exist yet
     * @param string $value The value to check
     * @return boolean True id check passed
     */
    public function Check($value)
    {
        $this->error = '';
        if ($this->currentFile && $value == $this->currentFile)
        {
            return true;
        }
        if (!Folder::Exists($this->folder))
        {
            return true;
        }
        $files = Folder::GetFiles($this->folder);
        if ($this->fileExtension)
        {
            $value = Path::AddExtension($value, $this->fileExtension);
        }
        if (in_array($value, $files))
        {
            $this->error = self::ExistsInFolder;
        }
        return $this->error == '';
    }
    /**
     * Returns the folder name for the message
     * @return array
     */
    protected function ErrorParams()
    {
        if ($this->error == self::ExistsInFolder)
        {
            return array($this->folder);
        }
        return parent::ErrorParams();
    }

}

