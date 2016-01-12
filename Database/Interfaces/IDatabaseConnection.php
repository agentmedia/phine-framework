<?php

namespace Phine\Framework\Database\Interfaces;
use Phine\Framework\Database\Engine;

interface IDatabaseConnection
{
    /**
     * Returns the engine
     * @return Engine The database engine (type)
     */
    function Engine();
    
    /**
     *
     * Close current connection
     */
    function Close();

    /**
     * Is the database connected?
     * @return bool
     */
    function IsConnected();

    /**
     * Executes the query.
     * @param string $query
     * @return IDatabaseReader result
     */
    public function ExecuteQuery($query);

    /**
     * Executes multiple queries, typically concatenated by semicolon
     * @param string $query The string containing queries
     * @throws \Exception Derived classes should raise an exception if query had flaws.
     */
    public function ExecuteMultiQuery($query);

    /**
     * Start transaction on database.
     */
    function StartTransaction();

    /**
     * Commit transaction On database.
     */
    function Commit();

    /**
     * Commit transaction On database.
     */
    function RollBack();

    /**
     * 
     * @param string $table
     * @returns int
     */
    function LastInsertId($table);

    /**
     * 
     * @return IDatabaseEscaper
     */
    function GetEscaper();

    /**
     * 
     * @return IDatabaseSqlLimiter
     */
    function GetSqlLimiter();

    /**
     * All table names
     * @return array string
     */
    function GetTables();

    /**
     * All field names of the table
     * @param string $table
     * @return array string
     */
    function GetFields($table);

    /**
     * Returns info providing basic information about the field.
     * @sparam string $table Table name
     * @param string $field Field name
     * @return IDatabaseFieldInfo
     */
    function GetFieldInfo($table, $field);

    /**
     * Executes a prepared statement (with placeholders).
     * @param string $prepared Sql statement.
     * @param array[Sql\Value] $values
     * @return IDatabaseReader
     */
    function ExecutePrepared($prepared, array $values);
    
    /**
     * Gets the identifiers of all foreign keys
     * @param string $table The table the foreign keys are searched for
     * @return string[] Returns all foreign key identifiers for a table
     */
    function GetForeignKeys($table);
    
    /**
     * Drops a foreign key
     * @param string $table The name of the table
     * @param string $foreignKey The identifier of the foreign key
     */
    function DropForeignKey($table, $foreignKey);
}
