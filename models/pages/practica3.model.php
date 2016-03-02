<?php
/**
 * Created by PhpStorm.
 * User: Judith
 * Date: 26/2/16
 * Time: 12:01
 */


class PagesPractica3Model extends Model{

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

=======
    public function getNumInstrumentsByType($type){
        $query = <<<QUERY
            SELECT count(*)
            FROM instrument
            WHERE type = $type
QUERY;
        $result = $this->getAll($query);

>>>>>>> 88c1f508c1cd7858082d8dbe1842a5d573fbbd67
    }

    public function insertInstrument($name, $type, $url){
        $query = <<<QUERY
            INSERT INTO instrument (name, type, url)
            VALUES ("$name", "$type", "$url")
QUERY;

        $this->execute($query);

    }
}