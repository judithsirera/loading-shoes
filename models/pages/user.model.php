<?php
/**
 * Created by PhpStorm.
 * User: Judith
 * Date: 7/4/16
 * Time: 9:53
 */


class PagesUserModel extends Model{

    public function insertNewUser($username, $email, $password, $u_twitter, $photo)
    {
        if($u_twitter != "" && $photo != "")
        {
            $query = <<<QUERY
            INSERT INTO usuari (username, email, password, u_twitter, image_path)
            VALUES ("$username", "$email", "$password", "$u_twitter", "$photo");
QUERY;

        }elseif ($u_twitter != ""){

            $query = <<<QUERY
            INSERT INTO usuari (username, email, password, u_twitter)
            VALUES ("$username", "$email", "$password", "$u_twitter");
QUERY;
        }elseif ($photo != "") {

            $query = <<<QUERY
            INSERT INTO usuari (username, email, password, image_path)
            VALUES ("$username", "$email", "$password", "$photo");
QUERY;
        }else {
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

    public function updateMoney($username, $money)
    {
        if ($money < 0) $money = 0;

        $query = <<<QUERY
            UPDATE usuari
            SET money = "$money"
            WHERE username = "$username"
QUERY;
        $this->execute($query);
    }

    public function updateSuccess($username, $success)
    {
        $query = <<<QUERY
            UPDATE usuari
            SET success = "$success"
            WHERE username = "$username"
QUERY;
        $this->execute($query);

    }

    public function getPasswordByName($user_name)
    {
        $query = <<<QUERY
            SELECT password
            FROM usuari
            WHERE username = "$user_name"
QUERY;
        return $this->getAll($query);

    }

    public function getPasswordByEmail($user_name)
    {
        $query = <<<QUERY
            SELECT password
            FROM usuari
            WHERE email = "$user_name"
QUERY;
        return $this->getAll($query);

    }
}