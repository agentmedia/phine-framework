<?php
namespace Phine\Framework\Localization;
use Phine\Framework\System\IO;

/** 
 * 
 * Provides a translator based on csv files
 * 
 */
class CsvTranslator extends Base\FormatTranslator
{
    /**
     * 
     * The base file path of the csv files
     * @var array
     */
    private $basePaths = array();
    
    /**
     * 
     * The current language
     * @var string
     */
    private $language = '';
    
    /**
     * The csv delimiter
     * @var string
     */
    private $delimiter;
    
    /**
     * The csv enclosure
     * @var string
     */
    private $enclosure;
    
    /**
     *
     * @var array
     */
    private $translations = array();
    
    /**
     * Creates a new csv translator
     * @param $basePath The base path for the filenames; 
     * @param string $lang A language code
     * @example If you name have csv files /root/Translation.en.csv, /root/Translation.de.csv and so on, set basePath=/root/Translation.csv
     */
    function __construct($basePath, $delimiter = ";", $enclosure='"')
    {
        $this->basePaths[] = $basePath;
        $this->delimiter = $delimiter;
        $this->enclosure = $enclosure;
        $this->translations = array();
    }
    /**
     * Adds another csv files base path to the translator; Must be called before method SetLanguage
     * @param string $basePath 
     */
    function AddBasePath($basePath)
    {
        $this->basePaths[] = $basePath;
    }
    
    /**
     * Gets the csv file path for the given language
     * @param string $basePath
     * @return string
     */
    private function LanguageCsvFile($basePath)
    {
        $ext = IO\Path::Extension($basePath);
        $baseFile = IO\Path::RemoveExtension($basePath);
        $langFile = IO\Path::AddExtension($baseFile, $this->language);
        return  IO\Path::AddExtension($langFile, $ext);
    }
    
    /**
     * Reads translations from language file if not already done
     * @param type $language
     * @return type 
     */
    private function ReadTranslations()
    {
        if (isset($this->translations[$this->language]))
        {
            return;
        }
        $this->translations[$this->language] = array();
        foreach ($this->basePaths as $basePath)
        {
            $handle = @fopen($this->LanguageCsvFile($basePath), 'r');
            if (!$handle)
            {
                return;
            }
            while ($line = fgetcsv($handle, 0, $this->delimiter, $this->enclosure))
            {
                $this->ReadCsvLine($line); 
            }
        }
    }
    
    private function ReadCsvLine(array $line)
    {
        if (count($line) != 2)
        {
            throw new \Exception('Translation CSV needs exactly two columns');
        }
        $key = $line[0];
        if (array_key_exists($key, $this->translations[$this->language]))
        {
            throw new \Exception("Translation key '$key' is defined more then once");
        }
        $this->translations[$this->language][$key] = $line[1]; 
    }
    
    public function GetLanguage()
    {
        return $this->language;
    }
    
    public function SetLanguage($language)
    {   
        if ($language != $this->language)
        {
            $this->language = $language;
            $this->ReadTranslations();
        }
    }

    public function GetReplacement($placeholder)
    {
        $transLang = $this->translations[$this->language];
        if ($transLang !== null)
        {
            if (isset($transLang[$placeholder]))
            {
                return $transLang[$placeholder];
            }
        }
        return $placeholder;
    }
}