<?php
namespace Phine\Framework\Database\Enums;
use Phine\Framework\System\Enum;

/**
 * Enum of database engines
 */
class Engine extends Enum
{
    /**
     * Represents the MySQL engine
     * @return Engine The mysql engine
     */
    static function MySQL()
    {
        return new self(__FUNCTION__);
    }
    
    /**
     * Represents the PostgreSQL engine
     * @return Engine The PostgreSQL engine
     */
    static function PostgreSQL()
    {
        return new self(__FUNCTION__);
    }
    
    
    
    /**
     * Represents the MS SQL Server engine
     * @return Engine The MS SQL Server engine
     */
    static function SQLServer()
    {
        return new self(__FUNCTION__);
    }
    
    /**
     * Represents an engine supported by ODBC
     * @return Engine The ODBC engine
     */
    static function ODBC()
    {
        
        return new self(__FUNCTION__);
    }
    
    /**
     * Represents the Informix engine
     * @return Engine The Informix engine
     */
    static function Informix()
    {
        return new self(__FUNCTION__);
    }
    
     /**
     * Represents the SQLite engine
     * @return Engine The SQLite engine
     */
    static function SQLite()
    {
        return new self(__FUNCTION__);
    }
    
    static function ByPdoDriver($name)
    {
        switch ($name)
        {
            case 'PDO_MYSQL':
                return self::MySQL();
                
            case 'PDO_INFORMIX':
                return self::Informix();                
                
            case 'PDO_ODBC':
                return self::ODBC();
                
            case 'PDO_SQLITE':
                return self::SQLite();
                
            case 'PDO_SQSRV':
                return self::SQLServer();
                
            case 'PDO_PGSQL':
                return self::PostgreSQL();
        }
        
        throw new \Exception('No valid Engine for PDO driver '.  $name);
    }
    /**
     * 
     * @return string
     */
    function PdoDriverName()
    {
        switch ($this)
        {
            case self::MySQL():
                return 'PDO_MYSQL';
                
            case self::Informix():
                return 'PDO_INFORMIX';                
                
            case self::ODBC():
                return 'PDO_ODBC';
                
            case self::SQLite():
                return 'PDO_SQLITE';
                
            case self::SQLServer():
                return 'PDO_SQSRV';
           
            case self::PostgreSQL():
                return 'PDO_PGSQL';
        }
        throw new \Exception('No valid PDO driver for Engine '.  $this->Value());
    }
}
