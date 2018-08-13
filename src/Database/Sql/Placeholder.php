<?php
namespace Phine\Framework\Database\Sql;
use Phine\Framework\Database\Interfaces as DBInterfaces;

class Placeholder extends Selectable
{
    protected function __construct(DBInterfaces\IDatabaseConnection $connection)
    {
        parent::__construct($connection);
    }
    function FullName()
    {
        return '?';
    }
}