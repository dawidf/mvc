<?php

/**
 * Created by PhpStorm.
 * User: dawid
 * Date: 09.07.15
 * Time: 12:15
 */
class User extends Model
{
    public function auth($username, $password)
    {
        $password = md5($password);
        $stmt = $this->db->prepare('
            SELECT * FROM users
            WHERE user_name = :username AND user_password=:password
        ');
        $stmt->bindValue(':username', $username, PDO::PARAM_STR);
        $stmt->bindValue(':password', $password, PDO::PARAM_STR);

        $stmt->execute();
        $user = $stmt->fetch();



        if( $user )
        {
            $userData = array(
                'userId' => $user['user_id'],
                'username' => $user['user_name']
                );
            $userStorage = new UserStorage();
            $userStorage->setUserData($userData);

            return true;
        }

    }

    public function updateUser($params)
    {
        $stmt = $this->db->prepare('
            UPDATE users
            SET user_name = :username,
            user_password = :password,
            user_email = :email,
            user_image = :image
            WHERE user_id = :userId
        ');

        $stmt->bindValue(':username', $params['username'], PDO::PARAM_STR);
        $stmt->bindValue(':password', $params['password'], PDO::PARAM_STR);
        $stmt->bindValue(':email', $params['email'], PDO::PARAM_STR);
        $stmt->bindValue(':image', $params['image'], PDO::PARAM_STR);
        $stmt->bindValue(':carId', $params['carId'], PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();
    }

    public function getUser($userId)
    {
        $stmt = $this->db->prepare('
            SELECT *
            FROM users
            WHERE user_id = :userId
        ');

        $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch();

    }
}