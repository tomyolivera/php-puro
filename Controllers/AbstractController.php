<?php

session_start();

class AbstractController{
    // *Properties*
    public array $colors;

    // *Const*
    // User
    public const MIN_USERNAME = 6;
    public const MAX_USERNAME = 35;
    
    public const MIN_NAME = 3;
    public const MAX_NAME = 40;
    
    public const MIN_PASSWORD = 8;
    public const MAX_PASSWORD = 120;

    // Form
    protected const EMPTY_FIELDS = "Please, complete the fields!";
    protected const PASSWORDS_NOT_MATCH = "The passwords do not match!";

    // *Methods*
    // Global
    public function __construct()
    {
        $this->colors = [
            "login" => "green",
            "register" => "blue",
        ];
    }

    public function getActualSite()
    {
        $server = $_SERVER['PHP_SELF'];
        $server = str_replace("/files/php/facer/", "", $server);

        if( (strpos($server, "views") != true) || (strpos($server, "Views") != true)){
            $server = str_replace("Views/", "", $server);
            $server = str_replace("views/", "", $server);
            $server = str_replace("/index", "", $server);
        }

        return str_replace(".php", "", $server);
    }

    /**
     * @param string $route
     * @param int $wait
     * @return void
     */
    public function redirectToRoute(string $route, int $wait = 0): void
    {
        $wait === 0 ? header("Location: views/$route") : header("refresh:$wait;URL=views/$route");
    }

    // Session
    /**
     * @param null
     * @return bool
     */
    public function checkSession(): bool
    {
        return isset($_SESSION['user']);
    }

    /**
     * @param null
     * @return void
     */
    public function redirectIfSessionExists(): void
    {
        if($this->checkSession()){
            $site = $this->getActualSite();
            if($site == "login" || $site == "register"){
                session_start();
                $this->redirectToRoute("../../home");
            }
        }
    }

    /**
     * @param string $value
     */
    public function getUser(string $value)
    {
        return $_SESSION['user'][0][$value];
    }

    /**
     * @param null
     * @return string
     */
    public function showStatus(): string
    {
        switch ($this->getUser("status")) {
            case 0:
                $status = "<p class='flex align-center my-2'><i class='text-gray-500'>fiber_manual_record</i>Offline</p>";
                break;
                
            case 1:
                $status = "<p class='flex align-center my-2'><i class='text-green-500'>fiber_manual_record</i>Online</p>";
                break;
            default:
                $status = "<p class='flex align-center my-2'><i class='text-orange-500'>fiber_manual_record</i>Busy</p>";
                break;
        }
        return $status;
    }

    /**
     * @param null
     * @return string
     */
    public function showUserPhoto(): string
    {
        if($this->getUser("photo") == ""){
            return '<img class="rounded-full w-16 h-16" src=".././../Public/img/users/nopicture.png">';
        }else{
            return '<img class="rounded-full w-16 h-16" src=".././../Public/img/users/nopicture.png">';
        }
    }

    /**
     * @param string $sql
     * @return PDOStatement|bool
     */
    protected function doSql(string $sql): PDOStatement|bool
    {
        require_once 'DB.php';
        $db = new DB();
        return $db->connect()->prepare($sql);
    }

    // Forms
    /**
     * @param string $field
     * @param int $max
     * @return bool
     */
    protected function lessThan(string $field, int $max): bool
    {
        return strlen($field) < $max;
    }

    /**
     * @param string $field
     * @param int $min
     * @return bool
     */
    protected function biggerThan(string $field, int $min): bool
    {
        return strlen($field) > $min;
    }

    /**
     * @param string|int $field1
     * @param string|int $field2
     * @return bool
     */
    protected function areEqual($field1, $field2): bool
    {
        return $field1 === $field2;
    }

    /**
     * @param string $field
     * @param string $expression
     * @return bool
     */
    protected function expressionIsValid(string $field, string $expression): bool
    {
        $field = explode(",", $field);

        for ($i=0; $i < strlen($field[0]); $i++) { 
            if(!preg_match($expression, $field[0][$i])){
                return false;
            }
        }

        return true;
    }

    /**
     * @param string $password
     * @return string
     */
    protected function hashPassword(string $password): string
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    /**
     * @param string $username
     * @return bool
     */
    protected function usernameAlreadyExists(string $username): bool
    {
        $query = $this->doSql("SELECT id FROM users WHERE username = :username LIMIT 1");
        $query->execute([':username' => $username]);
        return count($query->fetchAll()) > 0;
    }

    /**
     * @param string $email
     * @return bool
     */
    protected function emailAlreadyExists(string $email): bool
    {
        $query = $this->doSql("SELECT id FROM users WHERE email = :email LIMIT 1");
        $query->execute([':email' => $email]);
        return count($query->fetchAll()) > 0;
    }

    // Messages
    /**
     * @param string $msg
     * @return string *return the message in JSON*
     */
    protected function successMsg(string $msg): string
    {
        return json_encode([$msg, "Success"]);
    }

    /**
     * @param string $msg
     * @return string *return the message in JSON*
     */
    protected function errorMsg(string $msg): string
    {
        return json_encode([$msg, "Error"]);
    }

    /**
     * @param string $msg
     * @param PDOException $e
     * @return string
     */
    protected function errorServerMsg(string $msg, PDOException $e): string
    {
        return json_encode([$msg . ": " . $e->getMessage(), "Error"]);
    }
}