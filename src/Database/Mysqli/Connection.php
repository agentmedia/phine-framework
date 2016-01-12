<?php

namespace Phine\Framework\Database\Mysqli;

use Phine\Framework\Database\Interfaces as DBInterfaces;
use Phine\Framework\Database\Exceptions as DBExceptions;

use Phine\Framework\Database\Sql;
use Phine\Framework\System\Php;
use Phine\Framework\Database\Enums\Engine;
use Phine\Framework\Database\Enums\ConstraintRule;
use Phine\Framework\Database\Mysql\SqlLimiter;
use Phine\Framework\Database\Mysql\TypeDef;
use Phine\Framework\Database\Mysql\KeyInfo;
use Phine\Framework\Database\Mysql\Constraint;
use Phine\Framework\Database\Mysql\FieldInfo;
use Phine\Framework\Database\Mysql\ForeignKey;
/**
 * The connection class using PHP's mysqli database
 */
class Connection extends Php\WritableClass implements DBInterfaces\IDatabaseConnection
{

    /**
     * The underlying mysqli instance
     * @var \mysqli
     */
    private $db;

    /**
     * The database name currently connected
     * @var string
     */
    private $dbName;

    /**
     * The instance to escape strings correctly to the database
     * @var Escaper;
     */
    private $escaper;

    /**
     * 
     * @var bool
     */
    private $connected = false;

    /**
     * 
     * @var string
     */
    private $lastQuery = '';

    /**
     * 
     * @var bool
     */
    private $inTransaction = false;

    /**
     * The host name
     * @var string
     */
    private $server;
    
    /**
     * The mysql port
     * @var int
     */
    private $port;
    
    /**
     * The socket name
     * @var string
     */
    private $socket;
    
    /**
     * The name of the connected user
     * @var string
     */
    private $username;
    
    /**
     * The password of the connected user
     * @var string
     */
    private $password;
    
    /**
     * Returns the MySQL database engine
     * @return Engine
     */
    public function Engine()
    {
        return Engine::MySQL();
    }

    /**
     * Throws an exception on db error or db connect error
     */
    private function AssertSuccess()
    {
        if ($this->db)
        {
            if ($this->IsConnected())
            {
                $errorCode = $this->db->errno;
                if ($errorCode != 0)
                {
                    if ($this->inTransaction)
                        $this->RollBack();

                    throw new DBExceptions\DatabaseException($this->db->error, $errorCode, $this->lastQuery);
                }
            }
            else
            {
                $errorCode = $this->db->connect_errno;
                if ($errorCode != 0)
                {
                    throw new DBExceptions\DatabaseException($this->db->connect_error, $errorCode);
                }
            }
        }
    }

    /**
     * Creates a new mysqli based connection and tries to access it
     * @param string $server The datbase server (often called host)
     * @param string $username The username to connect to the database
     * @param string $password The password of the user to connect
     * @param string $dbName The name of the database that is initially selected
     * @param int $port The port number
     * @param string $socket The socket name
     */
    function __construct($server, $username, $password, $dbName, $port = 3306, $socket = '')
    {
        $this->server = $server;
        $this->username = $username;
        $this->password = $password;
        $this->dbName = $dbName;
        $this->port = $port;
        $this->socket = $socket;
        
        $this->db = @new \mysqli($server, $username, $password, $dbName, $port, $socket);
        $this->AssertSuccess();
        //We do not accept any other encoding for the moment...
        $this->db->set_charset('utf8');
        $this->AssertSuccess();
      
        $this->connected = true;
        $this->db->select_db($dbName);
        $this->AssertSuccess();
        $this->escaper = new Escaper($this->db);
    }
    
    /**
     * The database server machine identifier
     * @return string Returns the server (host) name
     */
    function Server()
    {
        return $this->server;
    }
    
    /**
     * The login name of the connected user
     * @return string Returns the name of the current database user
     */
    function Username()
    {
        return $this->username;
    }
    
    
    /**
     * The login password of the connected user
     * @return string Returns the password of the current database user
     */
    function Password()
    {
        return $this->password;
    }
    
    /**
     * The selected database for subsequent queries
     * @return string Returns the name of the selected database
     */
    function DatabaseName()
    {
        return $this->dbName;
    }
    
    /**
     * The port of the MySql service or demon; usually 3306
     * @return int Returns the MySql port
     */
    function Port()
    {
        return $this->port;
    }
    
    /**
     * The socket of the MySql service or demon; often empty
     * @return string Returns the MySql socket
     */
    function Socket()
    {
        return $this->socket;
    }

    /**
     * Cleans up resources by performing a disconnect
     */
    function __destruct()
    {
        if ($this->connected)
        {
            $this->Close();
        }
    }

    /**
     * (non-PHPdoc)
     * @see Phine/Framework/Database/Interfaces/IDatabaseConnection#Close()
     */
    function Close()
    {
        if ($this->connected)
        {
            if ($this->inTransaction)
                $this->Commit();

            $this->db->close();
            /* $this->AssertSuccess(); */
            $this->connected = false;
        }
    }

    /**
     * (non-PHPdoc)
     * @see Phine/Framework/Database/Interfaces/IDatabaseConnection#IsConnected()
     */
    function IsConnected()
    {
        return $this->connected;
    }

    /**
     * (non-PHPdoc)
     * @see Phine/Framework/Database/Interfaces/IDatabaseConnection#ExecuteQuery($query)
     */
    function ExecuteQuery($query)
    {
        $this->lastQuery = $query;
        $result = mysqli_query($this->db, $query);
        $this->AssertSuccess();

        if ($result instanceof \mysqli_result)
            return new Reader($result);

        return null;
    }

    /**
     * (non-PHPdoc)
     * @see Phine/Framework/Database/Interfaces/IDatabaseConnection#StartTransaction()
     */
    function StartTransaction()
    {
        $this->ExecuteQuery("set autocommit = 0");
        $this->ExecuteQuery("start transaction");
        $this->inTransaction = true;
    }

    /**
     * (non-PHPdoc)
     * @see Phine/Framework/Database/Interfaces/IDatabaseConnection#Commit()
     */
    function Commit()
    {
        $this->ExecuteQuery("commit");
        $this->ExecuteQuery("set autocommit = 1");
        $this->inTransaction = false;
    }

    /**
     * (non-PHPdoc)
     * @see Phine/Framework/Database/Interfaces/IDatabaseConnection#RollBack()
     */
    function RollBack()
    {
        $this->ExecuteQuery("rollback");
        $this->ExecuteQuery("set autocommit = 1");
        $this->inTransaction = false;
    }

    /*
      private function GetColumnSetString(array $columnValues = array())
      {
      $resultArr = array();
      foreach ($columnValues As $key=>$val)
      {
      if ($val === null)
      $resultArr[] = $key . " = NULL";
      else
      $resultArr[] = $key . " = " . $this->escaper->EscapeValue($val) ;
      }
      return join(', ', $resultArr);
      }
     * 
     */

    function LastInsertId($table)
    {
        $reader = $this->ExecuteQuery("SELECT LAST_INSERT_ID() FROM " . $this->escaper->EscapeIdentifier($table));
        if ($reader->Read())
            return $reader->ByIndex(0);

        return 0;
    }

    /**
     * (non-PHPdoc)
     * @see Phine/Framework/Database/Interfaces/IDatabaseConnection#GetEscaper()
     */
    function GetEscaper()
    {
        return $this->escaper;
    }

    /**
     * Gets the limiter to restrict results
     * @return SqlLimiter
     */
    function GetSqlLimiter()
    {
        return new SqlLimiter();
    }

    /**
     * Gets all tables in the database
     * @return string[] Returns all tabe names in the database
     */
    function GetTables()
    {
        $tables = array();
        $sql = new Sql\Builder($this);
        $tbl = $sql->Table('information_schema.tables', array('TABLE_SCHEMA', 'TABLE_NAME'));
        $cond = $sql->Equals($tbl->Field('TABLE_SCHEMA'), $sql->Value($this->dbName));
        $what = $sql->SelectList($tbl->Field('TABLE_NAME'));

        $select = $sql->Select(true, $what, $tbl, $cond);
        $reader = $this->ExecuteQuery((string) $select);
        while ($reader->Read())
        {
            $tables[] = $reader->ByIndex(0);
        }
        return $tables;
    }
    /**
     * Gets the identifiers of all foreign keys
     * @param string $table The table the foreign keys are searched for
     * @return string[] Returns all foreign key identifiers for a table
     */
    function GetForeignKeys($table)
    {
        $sql = new Sql\Builder($this);
        $fields = array('TABLE_SCHEMA', 'TABLE_NAME', 'REFERENCED_COLUMN_NAME', 'CONSTRAINT_NAME');
        
        $tbl = $sql->Table('information_schema.key_column_usage', $fields);
        
        $where = $sql->Equals($tbl->Field('TABLE_SCHEMA'), $sql->Value($this->dbName))->
                And_($sql->Equals($tbl->Field('TABLE_NAME'), $sql->Value($table)))->
                And_($sql->IsNotNull($tbl->Field('REFERENCED_COLUMN_NAME')));
        $what = $sql->SelectList($tbl->Field('CONSTRAINT_NAME'));
        
        
        $select = $sql->Select(true, $what, $tbl, $where);
        $result = array();
        $reader = $this->ExecuteQuery((string)$select);
        while ($reader->Read())
        {
            $result[] = $reader->ByIndex(0);
        }
        return $result;
    }
    
    /**
     * Drops a foreign key
     * @param string $table The name of the table
     * @param string $foreignKey The identifier of the foreign key
     */
    function DropForeignKey($table, $foreignKey)
    {
        $escaper = $this->GetEscaper();
        $query = 'ALTER TABLE ' . $escaper->EscapeIdentifier($table) . 
                ' DROP FOREIGN KEY ' . $escaper->EscapeIdentifier($foreignKey);
        $this->ExecuteQuery($query);
    }
    /**
     * Gets all fields in a table
     * @param string $table The table name
     * @return string[] Returns the field (column) names for the table
     */
    function GetFields($table)
    {
        $fields = array();
        $sql = new Sql\Builder($this);
        $tbl = $sql->Table('information_schema.columns', array('TABLE_SCHEMA', 'TABLE_NAME', 'COLUMN_NAME'));
        $cond = $sql->Equals($tbl->Field('TABLE_SCHEMA'), $sql->Value($this->dbName))
                ->And_($sql->Equals($tbl->Field('TABLE_NAME'), $sql->Value($table)));
        $what = $sql->SelectList($tbl->Field('COLUMN_NAME'));
        $select = $sql->Select(true, $what, $tbl, $cond);
        $reader = $this->ExecuteQuery((string) $select);
        while ($reader->Read())
        {
            $fields[] = $reader->ByIndex(0);
        }
        return $fields;
    }

    /**
     * Gets the full field information set for the given field
     * @param string $table The table name
     * @param string $field The field (column) name
     * @return FieldInfo Returns the field information or null on failure
     */
    function GetFieldInfo($table, $field)
    {
        $isUnique = false;
        $isPrimary = false;
        $isNullable = false;
        $defaultValue = null;
        $fullName = '';
        if (!$this->GetBasicFieldInfo($table, $field, $fullName, $defaultValue, $isPrimary, $isUnique, $isNullable))
        {
            return null;
        }
        $typeDef = TypeDef::ParseFullName($fullName);
        if (!$typeDef)
        {
            return null;
        }
        $keyName = $this->GetKeyName($table, $field);
        if (!$keyName)
        {
            return new FieldInfo($field, $typeDef, $defaultValue, $isNullable, null, null, null);
        }
        $keyInfo = new KeyInfo($keyName, $isPrimary, $isUnique);
        $constraintName = '';
        $refTable = '';
        $refField = '';
        if (!$this->GetForeignKey($table, $field, $constraintName, $refTable, $refField))
        {
            return new FieldInfo($field, $typeDef, $defaultValue, $isNullable, $keyInfo, null, null);
        }
        
        $onUpdate = null;
        $onDelete = null;
        $this->GetConstraintRules($constraintName, $onUpdate, $onDelete);
        $foreignKey = new ForeignKey($refTable, $refField);
        $constraint = new Constraint($constraintName, $onUpdate, $onDelete);
        return new FieldInfo($field, $typeDef, $defaultValue, $isNullable, $keyInfo, $foreignKey, $constraint);
    }
    
    /**
     * Gets basic field info from the information_schema database
     * @param string $table The table name as input parameter
     * @param string &$field The field name as input parameter
     * @param string &$fullName The full name as output paramter
     * @param string &$defaultValue The default value as output paramter
     * @param boolean &$isPrimary The "is primary field" flag as output parameter
     * @param boolean &$isUnique The "is unique field" flag as output parameter
     * @param boolean &$isNullable The "is nullable field" flag as output parameter
     * @return boolean Returns true if field info could be determined
     */
    private function GetBasicFieldInfo($table, $field, &$fullName, &$defaultValue, &$isPrimary, &$isUnique, &$isNullable)
    {
        $sql = new Sql\Builder($this);
        $tbl = $sql->Table('information_schema.columns', array('TABLE_SCHEMA', 'TABLE_NAME', 'COLUMN_NAME', 'COLUMN_DEFAULT', 'IS_NULLABLE', 'COLUMN_TYPE', 'COLUMN_KEY'));

        $cond = $sql->Equals($tbl->Field('TABLE_SCHEMA'), $sql->Value($this->dbName))
                ->And_($sql->Equals($tbl->Field('TABLE_NAME'), $sql->Value($table)))
                ->And_($sql->Equals($tbl->Field('COLUMN_NAME'), $sql->Value($field)));

        $what = $sql->SelectList($tbl->Field('IS_NULLABLE'));
        $what->Add($tbl->Field('COLUMN_TYPE'));
        $what->Add($tbl->Field('COLUMN_KEY'));
        $what->Add($tbl->Field('COLUMN_DEFAULT'));

        $sel = $sql->Select(true, $what, $tbl, $cond);
        $reader = $this->ExecuteQuery((string) $sel);
        if ($reader->Read())
        {
            $fullName = $reader->ByName('COLUMN_TYPE');
            $defaultValue = $reader->ByName('COLUMN_DEFAULT');
            $key = $reader->ByName('COLUMN_KEY');
            $isUnique = ($key == 'UNI');
            $isPrimary = ($key == 'PRI');
            $isNullable = $reader->ByName('IS_NULLABLE') == 'YES';
            return true;
        }
        return false;
    }

    /**
     * Gets foreign key parameters
     * @param string $table The table name as input parameter
     * @param type $field The field name as input parameter
     * @param type $constraintName The constraint name as output parameter
     * @param type $refTable The reference table name as output parameter
     * @param string $refField The reference table field name as output parameter
     * @return boolean Returns true if foreign key infos where found
     */
    private function GetForeignKey($table, $field, &$constraintName, &$refTable, &$refField)
    {
        $sql = new Sql\Builder($this);

        $tbl = $sql->Table('information_schema.key_column_usage', array('TABLE_SCHEMA', 'TABLE_NAME', 'COLUMN_NAME',
            'CONSTRAINT_NAME', 'REFERENCED_TABLE_NAME', 'REFERENCED_COLUMN_NAME'));

        $cond = $sql->Equals($tbl->Field('TABLE_SCHEMA'), $sql->Value($this->dbName))
                ->And_($sql->Equals($tbl->Field('TABLE_NAME'), $sql->Value($table)))
                ->And_($sql->Equals($tbl->Field('COLUMN_NAME'), $sql->Value($field)))
                ->And_($sql->IsNotNull($tbl->Field('REFERENCED_TABLE_NAME')));

        $what = $sql->SelectList($tbl->Field('REFERENCED_TABLE_NAME'));
        $what->Add($tbl->Field('REFERENCED_COLUMN_NAME'));
        $what->Add($tbl->Field('CONSTRAINT_NAME'));
        $select = $sql->Select(true, $what, $tbl, $cond);
        $reader = $this->ExecuteQuery((string) $select);
        if ($reader->Read())
        {
            $constraintName = (string) $reader->ByName('CONSTRAINT_NAME');
            $refTable = (string) $reader->ByName('REFERENCED_TABLE_NAME');
            $refField = (string) $reader->ByName('REFERENCED_COLUMN_NAME');
            return true;
        }
        return false;
    }

    /**
     * Gets constraint rules for a foreign key constraint
     * @param string $constraintName The constraint name as input parameter
     * @param ConstraintRule $onUpdate The update rule as output parameter
     * @param ConstraintRule $onDelete The delete rule as output parameter
     */
    private function GetConstraintRules($constraintName, ConstraintRule &$onUpdate = null, ConstraintRule &$onDelete = null)
    {
        $sql = new Sql\Builder($this);
        $tbl = $sql->Table('information_schema.REFERENTIAL_CONSTRAINTS', array('CONSTRAINT_NAME', 'UPDATE_RULE', 'DELETE_RULE'));
       
        $where = $sql->Equals($tbl->Field('CONSTRAINT_NAME'), $sql->Value($constraintName));
        $selectList = $sql->SelectList($tbl->Field('UPDATE_RULE'));
        $selectList->Add($tbl->Field('DELETE_RULE'));
        $select = $sql->Select(false, $selectList, $tbl, $where);
        $reader = $this->ExecuteQuery((string) $select);
        if ($reader->Read())
        {
            $onUpdate = ConstraintRule::ByValue($reader->ByName('UPDATE_RULE'));
            $onDelete = ConstraintRule::ByValue($reader->ByName('DELETE_RULE'));
        }
    }

    private function GetKeyName($table, $field)
    {
        $query = 'SHOW INDEX FROM ' . $this->escaper->EscapeIdentifier($table) .
                ' WHERE ' . $this->escaper->EscapeIdentifier('Column_name') .
                '=' . $this->escaper->EscapeValue($field);

        $reader = $this->ExecuteQuery($query);
        if ($reader->Read())
        {
            return $reader->ByName('Key_name');
        }
        return '';
    }

    /**
     * 
     * Executes a prepared Statement.
     * @param string $prepared A prepared statement with ?-placeholders.
     * @param array[Sql\Value] $values Values as Sql\Value
     * @return Reader
     * 
     */
    function ExecutePrepared($prepared, array $values)
    {
        $prepared = addcslashes($prepared, "'");
        $prepStmt = 'PREPARE stmt FROM \'' . $prepared . '\'';
        $this->ExecuteQuery($prepStmt);

        $cnt = count($values);
        $using = $cnt ? ' USING ' : '';
        for ($idx = 0; $idx < $cnt; ++$idx)
        {
            $var = '@v' . $idx;
            $this->ExecuteQuery('SET ' . $var . ' = ' . $values[$idx]);
            $using .= $var;
            if ($idx < $cnt - 1)
                $using .= ', ';
        }
        $result = $this->ExecuteQuery('EXECUTE stmt' . $using);
        $this->ExecuteQuery('DEALLOCATE PREPARE stmt');
        return $result;
    }

    protected function GetConstructParams()
    {
        return array($this->server, $this->username, $this->password, $this->dbName,
            $this->port, $this->socket);
    }

    /**
     * Executes a multi query string; typically concatenated by semicolon
     * @param sring $query
     * @throws DBExceptions\DatabaseException Raises an exception in case of an error
     */
    public function ExecuteMultiQuery($query)
    {
        $result = $this->db->multi_query($query);
        if ($result)
        {
            while ($this->db->next_result()) {;} //overgo the results!
        }
        if (!$result)
        {
            throw new DBExceptions\DatabaseException('Error in multi query', 101, $query);
        }
    }

}
