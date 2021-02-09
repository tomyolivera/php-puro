<?php

require_once 'AbstractController.php';

class AdminController extends AbstractController{
    
    /**
     * @return string
     */
    public function getUsers(): string
    {
        $query = $this->doSql("SELECT * FROM get_admin");
        $query->execute();
        return json_encode($query->fetchAll(PDO::FETCH_ASSOC));
    }
    
    /**
     * @param int $id
     * @return string
     */
    public function getUserById(int $id): string
    {
        $query = $this->doSql("SELECT * FROM get_admin WHERE id = :id");
        $query->execute([":id" => $id]);
        return json_encode($query->fetchAll(PDO::FETCH_ASSOC));
    }
}

$admin = new AdminController();

echo isset($_POST['getUsers']) ? $admin->getUsers() : '';

echo isset($_POST['search_by_id']) ? $admin->getUserById($_POST['search_by_id']) : '';