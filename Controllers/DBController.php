<?php

require_once 'AbstractController.php';

class DBController extends AbstractController{
    private const CREATE_TABLE_SUCCESS = "New table has been created successfully";
    private const CREATE_TABLE_ERROR = "Error while trying to create a new table";
    
    private const DROP_TABLE_SUCCESS = "The table has been deleted successfully";
    private const DROP_TABLE_ERROR = "Error while trying to delete the table";


    /**
     * @param string $name
     * @return bool|string
     */
    public function create(string $sql): bool|string
    {
        try {
            $query = $this->doSql($sql);
            return $query->execute();
            // return $this->successMsg(self::CREATE_TABLE_SUCCESS);
        } catch (PDOException $e) {
            return $this->errorServerMsg(self::CREATE_TABLE_ERROR, $e);
        }
    }

    /**
     * @param string $sql
     * @return bool|string
     */
    public function createTable(string $sql): bool|string
    {
        try {
            $query = $this->doSql($sql);
            return $query->execute();
            // return $this->successMsg(self::CREATE_TABLE_SUCCESS);
        } catch (PDOException $e) {
            return $this->errorServerMsg(self::CREATE_TABLE_ERROR, $e);
        }
    }

    /**
     * @param string $name
     * @return string *Return json message*
     */
    public function drop(string $name): string
    {
        try {
            $query = $this->doSql("DROP TABLE $name");
            $query->execute();
            return $this->successMsg(self::DROP_TABLE_SUCCESS);
        } catch (PDOException $e) {
            return $this->errorServerMsg(self::DROP_TABLE_ERROR, $e);
        }
    }
}

$control = new DBController();

echo isset($_POST['create']) ? $control->createTable($_POST['sql']) : '';
echo isset($_POST['drop']) ? $control->drop($_POST['name']) : '';