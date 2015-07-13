<?php
class Cars extends Model
{
    public function getCar($carId)
    {
        $stmt = $this->db->prepare('
            SELECT * FROM cars
            WHERE car_id=:carId
        ');
        $stmt->bindParam(':carid', $carId, PDO::PARAM_INT);

        return $stmt->fetch();
    }
    public function countCars()
    {
        $stmt = $this->db->query('
            SELECT * FROM cars
        ');

        return $stmt->rowCount();
    }
    public function getCars($from, $limit)
    {

        $stmt = $this->db->prepare('
             SELECT cat_name, car_id, car_model, car_image, car_description, car_name
             FROM cars LEFT JOIN categories USING (cat_id)
             ORDER BY car_id
             LIMIT :from, :limit

        ');

        $stmt->bindValue(':from', $from, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function addCar($params = array(), $fileName = '')
    {
        $stmt = $this->db->prepare('
        INSERT INTO cars (car_model, car_description, car_image, car_name, cat_id)
        VALUES (:model, :opis, :file, :name, :category)
        ');


        $stmt->bindValue(':name', $params['name'], PDO::PARAM_STR);
        $stmt->bindValue(':model', $params['model'], PDO::PARAM_STR);
        $stmt->bindValue(':opis', $params['opis'], PDO::PARAM_STR);
        $stmt->bindValue(':file', $fileName, PDO::PARAM_STR);
        $stmt->bindValue(':category', $params['category'], PDO::PARAM_INT);

        $stmt->execute();


    }

    public function updateCar($params, $fileName = '')
    {
        $stmt = $this->db->prepare('
        UPDATE cars
        SET car_model = :model,
        car_description = :opis,
        car_image = :file,
        car_name = :name,
        cat_id = :category
        WHERE car_id=:carId
        ');



        $stmt->bindValue(':name', $params['name'], PDO::PARAM_STR);
        $stmt->bindValue(':model', $params['model'], PDO::PARAM_STR);
        $stmt->bindValue(':opis', $params['opis'], PDO::PARAM_STR);
        $stmt->bindValue(':file', $fileName, PDO::PARAM_STR);
        $stmt->bindValue(':category', $params['category'], PDO::PARAM_INT);
        $stmt->bindValue(':carId', $params['carId'], PDO::PARAM_INT);

        $stmt->execute();
    }

    public function editCar($carId)
    {
        $stmt = $this->db->prepare('
            SELECT * FROM cars
            WHERE car_id=:carId
        ');
        $stmt->bindParam(':carId', $carId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    public function deleteCar($carId)
    {
        $stmt = $this->db->prepare('
            DELETE FROM cars where car_id=:carId
        ');
        $stmt->bindParam(':carId', $carId, PDO::PARAM_INT);
        $success = $stmt->execute();

        if($success > 0)
        {
            return true;
        }
    }
}