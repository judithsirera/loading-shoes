<?php
/**
 * Created by PhpStorm.
 * User: Judith
 * Date: 26/2/16
 * Time: 11:57
 */

class PagesUserModel extends Model{

    public function insertInstrument($name, $type, $url){
        $query = <<<QUERY
            INSERT INTO instrument (name, type, url)
            VALUES ("$name", "$type", "$url")
QUERY;

        $this->execute($query);

    }

}