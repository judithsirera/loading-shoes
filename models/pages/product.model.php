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
            INSERT INTO producte (name, description, price,stock,limit_date,usuari)
            VALUES ("$productname", "$description", "$price","$stock", "$limit_date", "$username",);
QUERY;


        $this->execute($query);
    }

    public function getUserByUsername($username)
    {
        $query = <<<QUERY
            SELECT *
            FROM usuari
            WHERE username = "$username"
QUERY;

        return $this->getAll($query);
    }

    public function getUserById($id)
    {
        $query = <<<QUERY
            SELECT *
            FROM usuari
            WHERE id_user = "$id"
QUERY;

        return $this->getAll($query);
    }

    public function getProductByUrl($url)
    {
        $query = <<<QUERY
            SELECT *
            FROM product
            WHERE url = "$url"
QUERY;
        return $this->getAll($query);
    }

    public function getAllProductsByIdOrderByDate()
    {
        $query = <<<QUERY
             SELECT *
             FROM product
             WHERE stock > 0
             ORDER BY limit_date ASC;
QUERY;

         return $this->getAll($query);
     }


    public function updateStock($id, $stock)
    {
        $query = <<<QUERY
            UPDATE product
            SET stock = "$stock"
            WHERE id = "$id"

QUERY;
        $this->execute($query);
    }

    public function updateViews($id, $views)
    {
        $query = <<<QUERY
            UPDATE product
            SET views = "$views"
            WHERE id = "$id"
QUERY;
        $this->execute($query);

    }

    public function getData()
    {
        $query = <<<QUERY
            SELECT *
            FROM producte
QUERY;
        return $this->getAll($query);

    }

}