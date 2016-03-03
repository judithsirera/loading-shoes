<?php
/**
 * Created by PhpStorm.
 * User: Judith
 * Date: 26/2/16
 * Time: 12:01
 */


class PagesGaleriaModel extends Model{

    public function getData($id){
        $name = "";
        $tipus = "";
        $url_ = "";

        $query = <<<QUERY
            SELECT *
            FROM instrument
            WHERE id = $id
QUERY;

        $result = $this->getAll($query);

        return $result;

    }

    public function getTotalInstruments(){

        $query = <<<QUERY
            SELECT count(*) as total
            FROM instrument
QUERY;

        $result = $this->getAll($query);

        return $result;

    }

    public function getAllData(){

        $query = <<<QUERY
            SELECT *
            FROM instrument
QUERY;

        $result = $this->getAll($query);

        return $result;

    }
}