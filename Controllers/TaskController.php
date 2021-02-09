<?php

require_once 'AbstractController.php';

class TaskController extends AbstractController{
    private const GET_ERROR = "Error while trying to get the tasks: ";

    private const ADD_SUCCESS = "Task created successfully";
    private const ADD_ERROR = "Error while trying to create the task: ";

    private const UPDATE_SUCCESS = "Task updated successfully";
    private const UPDATE_ERROR = "Error while trying to update the task: ";

    private const DELETE_SUCCESS = "Task deleted successfully";
    private const DELETE_ERROR = "Error while trying to delete the task: ";

    private const LESS_TASK_NAME = "The field name must be less than " . self::MAX_TASK_NAME . " characters" ;
    private const BIGGER_TASK_NAME = "The field name must be bigger than " . self::MIN_TASK_NAME . " characters" ;

    private const LESS_TASK_DESCRIPTION = "The field description must be less than " . self::MAX_TASK_DESCRIPTION . " characters" ;
    private const BIGGER_TASK_DESCRIPTION = "The field description must be bigger than " . self::MIN_TASK_DESCRIPTION . " characters" ;

    /**
     * @return string
     */
    public function get(): string
    {
        try {
            $query = $this->doSql("SELECT * FROM get_user_tasks WHERE user_id = :user_id");
            $query->execute([":user_id" => $this->getUser("id")]);
            return json_encode($query->fetchAll(PDO::FETCH_ASSOC));
        } catch (PDOException $e) {
            return $this->errorServerMsg(self::GET_ERROR, $e);
        }
    }

    /**
     * @param string $name
     * @param string $description
     * @param string $date
     * @return bool|string
     */
    private function checkFields(string $name, string $description, string $date): bool|string
    {
        if(empty($name) || $date == "") return $this->errorMsg(self::EMPTY_FIELDS);

        if(!is_string($name) && !is_string($description)) return $this->errorMsg(self::GLOBARL_ERROR);

        if($this->lessThan($name, self::MIN_TASK_NAME)) return $this->errorMsg(self::BIGGER_TASK_NAME);
        if($this->biggerThan($name, self::MAX_TASK_NAME)) return $this->errorMsg(self::LESS_TASK_NAME);
        
        if($this->lessThan($description, self::MIN_TASK_DESCRIPTION)) return $this->errorMsg(self::BIGGER_TASK_DESCRIPTION);
        if($this->biggerThan($description, self::MAX_TASK_DESCRIPTION)) return $this->errorMsg(self::LESS_TASK_DESCRIPTION);

        return true;
    }

    /**
     * @param string $name
     * @param string $description
     * @param string $date
     * @return string
     */
    public function add(string $name, string $description, string $date): string
    {
        try {
            $check = $this->checkFields($name, $description, $date);
            if($check !== true) return $check;

            $query = $this->doSql("INSERT INTO tasks VALUES(NULL, :name, :description, :date, :user_id)");
            $query->execute([":name" => $name, ':description' => $description, ':date' => $date, ':user_id' => $this->getUser("id")]);
            return $this->successMsg(self::ADD_SUCCESS);
        } catch (PDOException $e) {
            return $this->errorServerMsg(self::ADD_ERROR, $e);
        }
    }

    // /**
    //  * @param string $name
    //  * @param string $description
    //  * @param string $date
    //  * @return string
    //  */
    // public function update(string $name, string $description, string $date): string
    // {
    //     try {
    //         $check = $this->checkFields($name, $description, $date);
    //         if($check !== true) return $check;

    //         $query = $this->doSql("INSERT INTO tasks VALUES(NULL, :name, :description, :date, :user_id)");
    //         $query->execute([":name" => $name, ':description' => $description, ':date' => $date, ':user_id' => $this->getUser("id")]);
    //         return $this->successMsg(self::UPDATE_SUCCESS);
    //     } catch (PDOException $e) {
    //         return $this->errorServerMsg(self::UPDATE_ERROR, $e);
    //     }
    // }

    /**
     * @param int $id
     * @param string $token
     * @return string
     */
    public function delete(int $id, string $token = null): string
    {
        try {
            $query = $this->doSql("DELETE FROM tasks WHERE id = :id AND user_id = :user_id");
            $query->execute([":id" => $id, ':user_id' => $this->getUser("id")]);
            return $this->successMsg(self::DELETE_SUCCESS);
        } catch (PDOException $e) {
            return $this->errorServerMsg(self::DELETE_ERROR, $e);
        }
    }

    /**
     * @param string $token
     * @return string
     */
    public function deleteAll(string $token): string
    {
        try {
            $query = $this->doSql("DELETE FROM tasks WHERE user_id = :user_id");
            $query->execute([':user_id' => $this->getUser("id")]);
            return $this->successMsg(self::DELETE_SUCCESS);
        } catch (PDOException $e) {
            return $this->errorServerMsg(self::DELETE_ERROR, $e);
        }
    }

}

$task = new TaskController();

echo isset($_POST['get']) ? $task->get() : '';
echo isset($_POST['name']) ? $task->add($_POST['name'], $_POST['description'], $_POST['date']) : '';
echo isset($_POST['delete']) ? $task->delete($_POST['id_delete']) : '';