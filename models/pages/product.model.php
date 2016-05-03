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
            INSERT INTO product (name, description, price, stock, limit_date, usuari)
            VALUES ("$productname", "$description", "$price","$stock", "$limit_date", "$username",);
QUERY;


        $this->execute($query);
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
             ORDER BY limit_date DESC;
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

    public function getData($username)
    {
        $query = <<<QUERY
            SELECT *
            FROM product
            WHERE usuari = '$username'
QUERY;
        return $this->getAll($query);

    }

}