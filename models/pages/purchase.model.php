<?php
/**
 * Created by PhpStorm.
 * User: Judith
 * Date: 7/4/16
 * Time: 9:53
 */


class PagesPurchasesModel extends Model{

    public function insertNewPurchase($user_sell, $user_buy, $product, $date)
    {
        $query = <<<QUERY
        INSERT INTO purchase (user_sell, user_buy, product, date)
        VALUES ("$user_sell", "$user_buy", "$product", "$date");
QUERY;

        $this->execute($query);
    }

    public function getPurchasesByUserBuy($user_buy)
    {
        $query = <<<QUERY
            SELECT *
            FROM purchase
            WHERE user_buy = "$user_buy";
QUERY;

        return $this->getAll($query);
    }

}