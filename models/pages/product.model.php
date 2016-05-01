<?php
/**
 * Created by PhpStorm.
 * User: Judith
 * Date: 7/4/16
 * Time: 9:53
 */


class PagesProductModel extends Model{

    public function insertNewProduct($productname, $description, $price, $stock, $limit_date, $username)
    {
        $query = <<<QUERY
        INSERT INTO producte (name, description, price, stock, limit_date, usuari)
        VALUES ("$productname", "$description", "$price","$stock", "$limit_date", "$username");
QUERY;
        $this->execute($query);
    }

    public function searchProduct($search)
    {
        $query = <<<QUERY
            SELECT *
            FROM product
            WHERE name LIKE '%$search%'
QUERY;
        return $this->getAll($query);

    }

    public function getProductById($id)
    {
        $query = <<<QUERY
            SELECT *
            FROM product
            WHERE id = "$id"
QUERY;
        return $this->getAll($query);
    }

    public function getAllProductsByIdOrderByDate()
    {
        $query = <<<QUERY
            SELECT *
            FROM product
            ORDER by limit_date
QUERY;
        return $this->getAll($query);
    }

}