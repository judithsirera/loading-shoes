<?php
/**
 * Created by PhpStorm.
 * User: Judith
 * Date: 26/2/16
 * Time: 12:01
 */


class PagesGaleriaModel extends Model{

    public function selectQuery($table){

        $query = <<<QUERY
            SELECT *
            FROM $table
            ORDER BY id
QUERY;

        $result = $this->getAll($query);

        return $result;

    }

}