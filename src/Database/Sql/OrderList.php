<?php
namespace Phine\Framework\Database\Sql;
use Phine\Framework\Database\Interfaces as DBInterfaces;

class OrderList extends SqlObject
{
    /**
     * 
     * @var array[Order]
     */
    private $orders;
    /**
     * Creats a new SQL order list.
     * @param array[Order] $orders 
     */
    protected function __construct(DBInterfaces\IDatabaseConnection $connection, Order $order)
    {
        parent::__construct($connection);
        $this->orders = array($order);
    }
    
    function Add(Order $order)
    {
        $this->orders[] = $order;
    }

    function __toString()
    {
        return join(', ', $this->orders);
    }
}