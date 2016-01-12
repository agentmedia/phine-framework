<?php

namespace Phine\Framework\Database\Interfaces;

/**
 * Represents a foreign key
 */
interface IDatabaseForeignKey
{
    /**
     * The name of the related table
     * @return string Returns the table name
     */
    public function RelatedTable();
    
    
    /**
     * The field (column) of the related table
     * @return string Returns the column name
     */
    public function RelatedField();
}