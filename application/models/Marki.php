<?php
/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 08.07.15
 * Time: 11:18
 */

class Marki extends Model
{
    public function getmarki()
    {
        $stmt = $this->db->query('SELECT * FROM categories');

        return $stmt->fetchAll();
    }

    public function addMarke($markName)
    {

        $stmt = $this->db->prepare('
            INSERT INTO categories (cat_name)
            VALUES(:markName)
        ');

        $stmt -> bindValue(':markName', $markName, PDO::PARAM_STR);

        $count = $stmt->execute();

        if ($count > 0)
        {
            echo 'Dodano do bazy';
        }



    }
    public function deleteMarke($idMarki)
    {

        $stmt = $this->db->prepare('
            DELETE FROM categories where cat_id=:catId
        ');
        $stmt->bindParam(':catId', $idMarki, PDO::PARAM_INT);
        $stmt->execute();

    }

    public function updateMarkeAction(array $params)
    {
        var_dump($params);
        $stmt = $this->db->prepare('
            UPDATE categories
            SET cat_name = :markName
            WHERE cat_id = :idMarki
        ');
        $stmt->bindValue(':markName', $params['markName'], PDO::PARAM_STR);
        $stmt->bindValue(':idMarki', $params['idMarki'], PDO::PARAM_INT);

        $stmt->execute();
    }

    public function editMarkeAction($idMarki)
    {
        $stmt = $this->db->prepare('
            SELECT * FROM categories
            WHERE cat_id=:catId
        ');
        $stmt->bindParam(':catId', $idMarki, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }
}