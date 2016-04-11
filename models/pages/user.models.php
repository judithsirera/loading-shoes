<?php
/**
 * Created by PhpStorm.
 * User: Judith
 * Date: 7/4/16
 * Time: 9:53
 */


class PagesUserModel extends Model{

    public function insertNewUser($username, $email, $password, $u_twitter)
    {
        if($u_twitter != "")
        {
            $query = <<<QUERY
            INSERT INTO usuari (username, email, password, u_twitter)
            VALUES ("$username", "$email", "$password", "$u_twitter");
QUERY;

        }else{
            $query = <<<QUERY
            INSERT INTO usuari (username, email, password)
            VALUES ("$username", "$email", "$password");
QUERY;
        }

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

}