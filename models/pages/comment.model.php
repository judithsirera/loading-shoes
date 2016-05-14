<?php
/**
 * Created by PhpStorm.
 * User: Judith
 * Date: 7/4/16
 * Time: 9:53
 */


class PagesCommentModel extends Model{

    public function insertNewComment($subject, $comment, $date, $to, $from)
    {
        $query = <<<QUERY
        INSERT INTO comments (subject, text, date, to_user, from_user)
        VALUES ("$subject", "$comment", "$date", "$to", "$from");
QUERY;
        $this->execute($query);
    }

    public function getAllCommentsToOrderByDate($to)
    {
        $query = <<<QUERY
             SELECT *
             FROM comments
             WHERE to_user = "$to"
             ORDER BY date DESC;
QUERY;
        return $this->getAll($query);
    }

    public function deleteCommentById($id)
    {
        $query = <<<QUERY
             DELETE FROM comments
             WHERE id_comment = "$id"
QUERY;
        $this->execute($query);

    }

    public function getCommentById($id)
    {
        $query = <<<QUERY
             SELECT *
             FROM comments
             WHERE id_comment = "$id"
QUERY;
        return $this->getAll($query);
    }

    public function updateComment($id, $subject, $comment)
    {
        $query = <<<QUERY
            UPDATE comments
            SET subject = "$subject",
                text = "$comment"
            WHERE id_comment = "$id"
QUERY;

        if ($subject != "" && $comment == "")
        {
            $query = <<<QUERY
            UPDATE comments
            SET subject = "$subject"
            WHERE id_comment = "$id"
QUERY;
        }elseif($comment != "" && $subject == "")
        {
            $query = <<<QUERY
            UPDATE comments
            SET text = "$comment"
            WHERE id_comment = "$id"
QUERY;
        }
        $this->execute($query);

    }

    public function getCommentByToAndFrom($to, $from)
    {
        $query = <<<QUERY
             SELECT COUNT(*) as numComments
             FROM comments
             WHERE to_user = "$to"
                AND from_user = "$from"
QUERY;
        return $this->getAll($query);
    }
}