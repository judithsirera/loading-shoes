<?php
/**
 * Created by PhpStorm.
 * User: Judith
 * Date: 7/4/16
 * Time: 9:53
 */


class PagesPurchaseModel extends Model{

    public function insertNewPurchase($user_sell, $user_buy, $product, $date, $price)
    {
        $query = <<<QUERY
        INSERT INTO purchase (user_sell, user_buy, product, purchase_date, price)
        VALUES ("$user_sell", "$user_buy", "$product", "$date", "$price");
QUERY;
        echo $query;
        $this->execute($query);
    }

    public function getPurchasesByUserBuy($user_buy)
    {
        $query = <<<QUERY
            SELECT *
            FROM purchase
            WHERE user_buy = "$user_buy"
            ORDER BY purchase_date ASC;
QUERY;

        return $this->getAll($query);
    }

}