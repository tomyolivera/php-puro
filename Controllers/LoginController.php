<?php

require_once 'AbstractController.php';
require_once '../Models/User.php';

class LoginController extends User{
    private const LOGIN_ERROR = "Error while trying to login";
    private const LOGIN_SUCCESS = "The login was successfully";

    private const USER_NOT_EXISTS = "The username or the password are incorrect";

    public function __construct(
        private string $username,
        private string $password
    )
    {}

    /**
     * @param null
     * @return bool|string
     */
    private function checkFields(): bool|string
    {
        if(empty($this->username) || empty($this->password)) return $this->errorMsg(self::EMPTY_FIELDS);

        $this->username = str_replace(" ", "", $this->username);

        $query = $this->doSql("SELECT username, password FROM users WHERE username = :username");
        $query->execute([":username" => $this->username]);
        $result = $query->fetchAll();

        if(count($result) <= 0 || !password_verify($this->password, $result[0]['password'])) return $this->errorMsg(self::USER_NOT_EXISTS);

        return true;
    }

    /** 
     * @param null
     * @return string
    */
    public function login(): string
    {
        try {
            $check = $this->checkFields();
            if($check !== true) return $check;

            $query = $this->doSql("SELECT * FROM users WHERE username = :username");
            $query->execute([":username" => $this->username]);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION['user'] = $result;

            $this->setStatus(1);

            return $this->successMsg(self::LOGIN_SUCCESS);
        } catch (PDOException $e) {
            return $this->errorServerMsg(self::LOGIN_ERROR, $e);
        }
    }
}

if(isset($_POST['username']))
{
    $login = new LoginController($_POST['username'], $_POST['password']);
    echo $login->login();
}