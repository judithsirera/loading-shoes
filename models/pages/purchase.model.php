<?php
/**
 * Created by PhpStorm.
 * User: Judith
 * Date: 7/4/16
 * Time: 9:53
 */


class Pages extends Model{

    public function insertNewPurchase($user_sell, $user_buy, $product, $date)
    {
        $query = <<<QUERY
        INSERT INTO purchase (user_sell, user_buy, product, date)
        VALUES ("$user_sell", "$user_buy", "$product", "$date");
QUERY;

        $this->execute($query);
    }

    public function getAllData()
    {
        $query = <<<QUERY
            SELECT *
            FROM purchase
QUERY;

        return $this->getAll($query);
    }

}