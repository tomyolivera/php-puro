<?php

require_once 'AbstractController.php';

class ProfileController extends AbstractController{
    private const UPDATE_SUCCESS = "Data updated successfully";
    private const UPDATE_ERROR = "Error while trying to update the data: ";

    public function get()
    {
        $query = $this->doSql("SELECT * FROM get_user_data WHERE id = :id");
        $query->execute([":id" => $this->getUser("id")]);
        return json_encode($query->fetchAll(PDO::FETCH_ASSOC));
    }

    /**
     * @param string $name
     * @param string $username
     * @param int $status
     * @return string
     */
    public function update(string $name, string $username, int $status): string
    {
        try {
            
        } catch (PDOException $e) {
            return $this->errorServerMsg(self::UPDATE_ERROR, $e);
        }
    }

    /**
     * @param string $birthday
     * @return string
     */
    public function birthday(string $birthday): string
    {
        try {
            $query = $this->doSql("UPDATE users SET birthday = :birthday WHERE id = :id");
            $query->execute([":birthday" => $birthday, ":id" => $this->getUser("id")]);

            return $this->successMsg(self::UPDATE_SUCCESS);
        } catch (PDOException $e) {
            return $this->errorServerMsg(self::UPDATE_ERROR, $e);
        }
    }

    /**
     * @param string $backup_email
     * @return string
     */
    public function backupemail(string $backup_email): string
    {
        try {
            if(!is_string($backup_email) || !filter_var($backup_email, FILTER_VALIDATE_EMAIL)) return $this->errorMsg(self::EMAIL_IS_NOT_VALID);
            if($this->emailAlreadyExists($backup_email)) return $this->errorMsg(self::EMAIL_ALREADY_USED);

            $query = $this->doSql("UPDATE users SET backup_email = :backup_email WHERE id = :id");
            $query->execute([":backup_email" => $backup_email, ":id" => $this->getUser("id")]);

            return $this->successMsg(self::UPDATE_SUCCESS);
        } catch (PDOException $e) {
            return $this->errorServerMsg(self::UPDATE_ERROR, $e);
        }
    }
}

$profile = new ProfileController();

echo isset($_POST['getData']) ? $profile->get() : '';
echo isset($_POST['update']) ? $profile->update($_POST['name'], $_POST['username'], $_POST['status']) : '';
echo isset($_POST['birthday']) ? $profile->birthday($_POST['birthday']) : '';
echo isset($_POST['backup_email']) ? $profile->backupemail($_POST['backup_email']) : '';