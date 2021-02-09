<?php

require_once 'AbstractController.php';

class FriendsController extends AbstractController{
    private const SEARCH_ERR = "Error while trying to search people";

    private const REQUEST_SEND_SUCCESSFULLY = "Friend request sended successfully";
    private const ADDED_SUCCESSFULLY = "Friend added successfully, wait a moment...";
    

    /**
     * @param string $name
     * @return string
     */
    public function searchByName(string $name): string
    {
        $id = $this->getUser("id");
        try {
            $query = $this->doSql("SELECT id, photo, name, status, verified
                                    FROM users 
                                    WHERE name LIKE :name AND id != :id
                                    AND id NOT IN (SELECT send_id FROM friends WHERE receive_id = :receive_id OR send_id = :send_id) 
                                    AND id NOT IN (SELECT receive_id FROM friends WHERE receive_id = :receive_id_ OR send_id = :send_id_)
                                    LIMIT 5
            ");
            $query->execute(
                    [
                        ":name" => "%$name%", 
                        ":id" => $id,
                        ":receive_id" => $id,
                        ":receive_id_" => $id,
                        ":send_id" => $id,
                        ":send_id_" => $id,
                    ]
                );
            return json_encode($query->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            return $this->errorServerMsg(self::SEARCH_ERR, $e);
        }
    }

    /**
     * @param int $id
     * @return string
     */
    public function sendRequest(int $id): string
    {
        try {
            $query = $this->doSql("INSERT INTO friends VALUES(null, :receive_id, :send_id, DEFAULT, 0, null)");
            $query->execute([":receive_id" => $id, ":send_id" => $this->getUser("id")]);
            return $this->successMsg(self::REQUEST_SEND_SUCCESSFULLY);
        } catch (PDOException $e) {
            return $this->errorServerMsg(self::GLOBARL_ERROR, $e);
        }
    }

    /**
     * @return string
     */
    public function getMyFriends(): string
    {
        $res = [];
        $query = $this->doSql("SELECT r.name, r.status, r.photo, r.verified
                                FROM friends f
                                JOIN users s ON s.id = f.send_id
                                JOIN users r ON r.id = f.receive_id
                                WHERE s.id = :id AND f.accepted = 1
                                ORDER BY r.status = 1 DESC
                            ");
        $query->execute([":id" => $this->getUser("id")]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $result != [] ? array_push($res, $result) : '';

        $query = $this->doSql("SELECT s.name, s.status, s.photo, s.verified
                                FROM friends f
                                JOIN users s ON s.id = f.send_id
                                JOIN users r ON r.id = f.receive_id
                                WHERE r.id = :id AND f.accepted = 1
                                ORDER BY s.status = 1 DESC
                            ");
        $query->execute([":id" => $this->getUser("id")]);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        $result != [] ? array_push($res, $result) : '';

        return json_encode($res);
    }

    /**
     * @return string
     */
    public function getFriendsRequests(): string
    {
        $query = $this->doSql("SELECT * FROM get_user_fr_requests WHERE my_id = :id");
        $query->execute([":id" => $this->getUser("id")]);
        return json_encode($query->fetchAll(PDO::FETCH_ASSOC));
    }

    /**
     * @param int $id
     * @return string
     */
    public function accept(int $id): string
    {
        try {
            $query = $this->doSql("UPDATE friends SET accepted = 1 WHERE send_id = :send_id AND receive_id = :receive_id");
            $query->execute([":send_id" => $id, ":receive_id" => $this->getUser("id")]);
            return $this->successMsg(self::ADDED_SUCCESSFULLY);
        } catch (PDOException $e) {
            return $this->errorServerMsg(self::GLOBARL_ERROR, $e);
        }
    }
}

$friends = new FriendsController();

echo isset($_POST['search']) ? $friends->searchByName($_POST['search']) : '';

echo isset($_POST['sendRequest']) ? $friends->sendRequest($_POST['id']) : '';

echo isset($_POST['getMyFriends']) ? $friends->getMyFriends() : '';
echo isset($_POST['getFriendsRequests']) ? $friends->getFriendsRequests() : '';

echo isset($_POST['accept']) ? $friends->accept($_POST['id']) : '';