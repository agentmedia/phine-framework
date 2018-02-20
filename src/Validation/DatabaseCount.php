<?php

namespace Phine\Framework\Validation;
use Phine\Framework\Database\Sql;
use Phine\Framework\Database\Objects\TableObject;
use Phine\Framework\Database\Objects\TableSchema;

class DatabaseCount extends Validator
{
    
    const TooFew = 'Validation.DatabaseCount.TooFew';
    const TooMuch = 'Validation.DatabaseCount.TooMuch';
    /**
     * 
     * @var Sql\Select
     */
    private $prepared = null;
    /**
     * 
     * @var int
     */
    private $minCount = 1;
    
    /**
     * 
     * @var int
     */
    private $maxCount = 1;
    
    /**
     * Number of placeholder appearances
     * @var int
     */
    private $numPlaceholders = 1;
    
    /**
     * Validator for exactly one match.
     * @param Sql\Select $select
     * @return DatabaseCount
     */
    static function UniqueExists(Sql\Select $select, $errorLabelPrefix = '')
    {
        return new self($select, 1, 1, $errorLabelPrefix);
    }
    
    /**
     * Validator for at least one match.
     * @param Sql\Select $select
     * @param string $errorLabelPrefix
     * @return DatabaseCount
     */
    static function Exists(Sql\Select $select, $errorLabelPrefix = '')
    {
        return new self($select, 1, -1, $errorLabelPrefix);    
    }

    /**
     * Validator for no match.
     * @param Sql\Select $select
     * @param string $errorLabelPrefix
     * @return DatabaseCount
     */
    static function NoneExists(Sql\Select $select, $errorLabelPrefix = '')
    {
        return new self($select, 0, 0, $errorLabelPrefix);        
    }
    /**
     * Checks field for uniqueness
     * @param TableObject $object The object needn't exist; if it exists, its primary key value 
     * is used to exclude the entry itself
     * @param string $field The table field name that shall be unique
     * @param Sql\Condition $andCondition An optional condition added to check uniqueness
     * @param string $errorLabelPrefix The prefix for the error labels
     * @return DatabaseCount Returns a database validator to check for uniqueness
     */
    static function UniqueFieldAnd(TableObject $object, $field, Sql\Condition $andCondition = null, $errorLabelPrefix = '')
    {
        $schema = $object->GetSchema();
        $sql = $schema->SqlBuilder();
        
        $table = $object->GetSchema()->Table();
        
        $where = $sql->Equals($table->Field($field), $sql->Placeholder());
        $keyField = $table->Field($schema->KeyField());
        if ($object->Exists())
        {
            $where = $where->And_($sql->EqualsNot($keyField, 
                    $sql->Value($object->KeyValue())));
        }
        if ($andCondition)
        {
            $where = $where->And_($andCondition);
        }
        
        $list = $sql->SelectList($sql->FunctionCount(array($keyField)));
        $select = $sql->Select(false, $list, $table, $where);
        return self::NoneExists($select, $errorLabelPrefix);
    }
    /**
     * Checks field for uniqueness
     * @param TableObject $object The object needn't exist; if it exists, its primary key value 
     * is used to exclude the entry itself
     * @param string $field The table field name that shall be unique
     * @param string $errorLabelPrefix The prefix for the error labels
     * @return DatabaseCount Returns a database validator to check for uniqueness
     */
    static function UniqueField(TableObject $object, $field, $errorLabelPrefix = '')
    {
       return self::UniqueFieldAnd($object, $field, null, $errorLabelPrefix);
    }
    /**
     * Validates number of appearances of the value in a table field
     * @param int $minCount The minimum required appearances
     * @param type $maxCount The maximum required appearances
     * @param TableSchema $schema The table schema
     * @param type $field The field name
     * @param type $errorLabelPrefix The prefix for error message labels
     * @return DatabaseCount Returns the validator
     */
    static function InTableField($minCount, $maxCount, TableSchema $schema, $field, $errorLabelPrefix = '')
    {
        $sql = $schema->SqlBuilder();
        $table = $schema->Table();
        $keyField = $table->Field($schema->KeyField());
        $where = $sql->Equals($table->Field($field), $sql->Placeholder());
        $list = $sql->SelectList($sql->FunctionCount(array($keyField)));
        $select = $sql->Select(false, $list, $table, $where);
        return new self($select, $minCount, $maxCount, $errorLabelPrefix);
    }
    
    /**
     * Checks if there are no appearances of the value in a table field
     * @param TableSchema $schema
     * @param string $field
     * @param type $errorLabelPrefix
     * @return DatabaseCount Returns the validator
     */
    static Function NoneInTableField(TableSchema $schema, $field, $errorLabelPrefix = '')
    {
        return self::InTableField(0, 0, $schema, $field, $errorLabelPrefix);
    }
    /**
     * 
     * @param Sql\Select $prepared
     * @param int $minCount
     * @param int $maxCount
     * @param string $errorLabelPrefix
     */
    function __construct(Sql\Select $prepared, $minCount = 1, $maxCount = 1, $errorLabelPrefix = '')
    {
        $this->prepared = $prepared;
        $this->minCount = (int)$minCount;
        $this->maxCount = (int)$maxCount;
        parent::__construct($errorLabelPrefix);
    }
    /**
     * True if the cnt
     * @param type $cnt
     * @return bool
     */
    private function IsTooFew($cnt)
    {
        return $this->minCount > -1 &&  $cnt < $this->minCount;
    }
    
    private function IsTooMuch($cnt)
    {
        return $this->maxCount > -1 &&  $cnt > $this->maxCount;
    }
    
    /**
     * Needs to be set if multiple placeholder are useds
     * @param int $num 
     */
    public function SetNumPlaceholders($num)
    {
        $this->numPlaceholders = $num;
    }
    
    private function GetCount($value)
    {
        $connection = $this->prepared->Connection();
        $sql = new Sql\Builder($connection);
        $params = array_fill(0, $this->numPlaceholders, $sql->Value($value));
        
        $reader = $connection->ExecutePrepared((string)$this->prepared, $params);
        $result = 0;
        if ($reader->Read())
            $result = (int)$reader->ByIndex(0);

        $reader->Close();
        return $result;
    }
    function Check($value)
    {
        $this->error = '';
        if ($value)
        {
            $cnt = $this->GetCount($value);
            
            if ($this->IsTooFew($cnt))
                $this->error = self::TooFew;

            else if ($this->IsTooMuch($cnt))
                $this->error = self::TooMuch;
        }
        return $this->error == '';
    }
}