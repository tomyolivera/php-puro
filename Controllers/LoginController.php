<?php

require_once 'AbstractController.php';

class LoginController extends AbstractController{
    private const LOGIN_ERROR = "Error while trying to login";
    private const LOGIN_SUCCESS = "The login was successfully";

    private const USER_NOT_EXISTS = "The email or the password are incorrect";

    public function __construct(
        private string $email,
        private string $password
    ){}

    /**
     * @param null
     * @return bool|string
     */
    private function checkFields(): bool|string
    {
        if(empty($this->email) || empty($this->password)) return $this->errorMsg(self::EMPTY_FIELDS);

        $this->email = str_replace(" ", "", $this->email);

        $query = $this->doSql("SELECT email, password FROM users WHERE email = :email");
        $query->execute([":email" => $this->email]);
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

            $query = $this->doSql("SELECT * FROM users WHERE email = :email");
            $query->execute([":email" => $this->email]);
            $result = $query->fetchAll(PDO::FETCH_ASSOC);

            $_SESSION['user'] = $result;

            $this->setStatus(1);

            return $this->successMsg(self::LOGIN_SUCCESS);
        } catch (PDOException $e) {
            return $this->errorServerMsg(self::LOGIN_ERROR, $e);
        }
    }
}

if(isset($_POST['email']))
{
    $login = new LoginController($_POST['email'], $_POST['password']);
    echo $login->login();
}