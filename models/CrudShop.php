<?php

require_once "Crud.php";

class ShopCrud {    
    //setting properties with default values
    private $crud;
    private $table;

    public function __construct(Crud $crud, $table = "items") {
        $this->crud = $crud;
        $this->table = $table;
    }

    public function retrieveAllItems() {
        $data = "*";
        $sql = "SELECT $data FROM $this->table";
        $items = $this->crud->runSelectQuery($data, $this->table);
        return $items;
    }

    public function retrieveSpecificItem($column, $itemId) {
        $sql = "SELECT $column FROM $this->table WHERE id = ?";
        $params = [$itemId];
        $data = $this->crud->readOneRow($sql, $params);
        //this fetches object. To make it usable:
        if ($data && isset($data->$column)) {
            return $data->$column;
        } else {
            return null;
        }
    }

    public function insertIntoOrdersTable($userId, $itemId, $amount) {
        $sql = "INSERT INTO orders (user_id, item_id, amount) VALUES (?, ?, ?)";
        $params = [$userId, $itemId, $amount];
        $order = $this->crud->createRow($sql, $params);
        return $order;
    }

    public function retrieveOrderHistory($userId) {
        $sql = "SELECT orders.id, items.item_name, orders.user_id, orders.amount FROM orders
        JOIN items ON orders.item_id = items.id
        WHERE orders.user_id = ?";
        $params = [$userId];
        $orderHistory = $this->crud->readMultipleRows($sql, $params);
        return $orderHistory;
    }

}

?>
