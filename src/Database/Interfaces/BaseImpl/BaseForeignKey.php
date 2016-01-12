<?php
namespace Phine\Framework\Database\Interfaces\BaseImpl;
use Phine\Framework\Database\Interfaces\IDatabaseForeignKey;
use Phine\Framework\Database\Interfaces\IDatabaseConnection;
use Phine\Framework\System\Php\WritableClass;

/**
 * Represents a foreign key database
 */
abstract class BaseForeignKey extends WritableClass implements IDatabaseForeignKey
{
    /**
     * The related table
     * @var string
     */
    protected $relatedTable;
    
    /**
     * The related field
     * @var string
     */
    protected $relatedField;
    /**
     * 
     * @param string $relatedTable
     * @param string $relatedField
     */
    function __construct($relatedTable, $relatedField)
    {
        $this->relatedField = $relatedField;
        $this->relatedTable = $relatedTable;
    }
    
    /**
     * The related field name
     * @return string Returns the related field (column name)
     */
    public function RelatedField()
    {
        return $this->relatedField;
    }

    /**
     * The related table
     * @return string Returns the related table
     */
    public function RelatedTable()
    {
        return $this->relatedTable;
    }
    
    /**
     * Gets the constructor parameters
     * @return array Returns the constructor parametes
     */
    protected function GetConstructParams()
    {
        return array($this->relatedTable, $this->relatedField);
    }
}
