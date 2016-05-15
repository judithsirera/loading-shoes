<?php
/**
 * Created by PhpStorm.
 * User: Judith
 * Date: 7/4/16
 * Time: 9:53
 */


class PagesPurchaseModel extends Model{

    public function insertNewPurchase($user_sell, $user_buy, $product, $product_id , $date, $price)
    {
        $query = <<<QUERY
        INSERT INTO purchase (user_sell, user_buy, product, product_id, purchase_date, price)
        VALUES ("$user_sell", "$user_buy", "$product", "$product_id", "$date", "$price");
QUERY;
        $this->execute($query);
    }

    public function getPurchasesByUserBuy($user_buy)
    {
        $query = <<<QUERY
            SELECT *
            FROM purchase
            WHERE user_buy = "$user_buy"
            ORDER BY purchase_date DESC;
QUERY;

        return $this->getAll($query);
    }

    public function getPurchasesByProductId($id)
    {
        $query = <<<QUERY
            SELECT *
            FROM purchase
            WHERE product_id = "$id"
QUERY;
        return $this->getAll($query);
    }

    public function getStadisticsByUserSell($user_sell)
    {
        $query = <<<QUERY
        SELECT COUNT(id) AS total,
            (SELECT COUNT(id)
            FROM purchase
            WHERE user_sell = '$user_sell') AS sells
        FROM purchase
QUERY;
        return $this->getAll($query);
    }

    public function purchasesFromUserToUser($from_user, $to_user)
    {
        $query = <<<QUERY
            SELECT COUNT(*) AS numPurchases
            FROM purchase
            WHERE user_buy = "$from_user"
                AND user_sell = "$to_user";
QUERY;
        return $this->getAll($query);
    }

    public function getTotalPurchases()
    {
        $query = <<<QUERY
            SELECT COUNT(*) AS numPurchases
            FROM purchase
QUERY;
        return $this->getAll($query);
    }

    public function getTotalPurchasesOfAProd($id)
    {
        $query = <<<QUERY
            SELECT COUNT(*) AS numPurchases
            FROM purchase
            WHERE product_id = "$id"
QUERY;
        return $this->getAll($query);
    }
}