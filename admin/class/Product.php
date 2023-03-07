<?php

class Product
{
    private $conn;
    // table
    private $db_table = "product";
    // columns
    public $productID;
    public $price;
    public $name;
    public $picture;
    public $stock;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllProducts()
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() > 0) {
            $products_arr = array();
            $products_arr["products"] = array();
            while ($row = $stmt->fetch()) {
                extract($row);
                $product_item = array(
                    "productID" => $productID,
                    "price" => $price,
                    "name" => $name,
                    "picture" => $picture,
                    "stock" => $stock
                );
                array_push($products_arr["products"], $product_item);
            }
            return $products_arr;
        }
    }

    public function getSingleProductByID($productID)
    {
        $sqlQuery = "SELECT * FROM " . $this->db_table . " WHERE productID = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $productID);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch();
            extract($row);
            $product_item = array(
                "productID" => $productID,
                "price" => $price,
                "name" => $name,
                "picture" => $picture,
                "stock" => $stock
            );
            return $product_item;
        }
    }

    public function createProduct($name, $price, $stock)
    {
        $sqlQuery = "INSERT INTO " . $this->db_table . " (name, price, stock) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $price);
        $stmt->bindParam(3, $stock);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function updateProduct($id, $name, $price, $stock)
    {
        $sqlQuery = "UPDATE " . $this->db_table . " SET name = ?, price = ?, stock = ? WHERE productID = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $name);
        $stmt->bindParam(2, $price);
        $stmt->bindParam(3, $stock);
        $stmt->bindParam(4, $id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function deleteProduct($productID)
    {
        $sqlQuery = "DELETE FROM " . $this->db_table . " WHERE productID = ?";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->bindParam(1, $productID);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
