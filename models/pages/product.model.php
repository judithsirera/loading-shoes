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

    public function getUsernameByEmail($email)
    {
        $query = <<<QUERY
            SELECT username
            FROM usuari
            WHERE email = "$email"
QUERY;

        return $this->getAll($query);

    }

    public function activeAccount($id)
    {
        $query = <<<QUERY
            UPDATE usuari
            SET isActive = true
            WHERE id_user = "$id"
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