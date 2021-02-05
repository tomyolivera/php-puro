<?php

require_once 'AbstractController.php';

class ProfileController extends AbstractController{
    public function get()
    {
        $query = $this->doSql("SELECT * FROM get_user_data WHERE id = :id");
        $query->execute([":id" => $this->getUser("id")]);
        return json_encode($query->fetchAll(PDO::FETCH_ASSOC));
    }

    public function update()
    {

    }
}

$profile = new ProfileController();

echo isset($_POST['getData']) ? $profile->get() : '';