<?php

require_once 'AbstractController.php';

class RegisterController extends AbstractController{
    private const EMPTY_FIELDS = "Please, complete the fields!";
    
    private const EMAIL_ALREADY_USED = "This email is already in use";
    private const EMAIL_IS_NOT_VALID = "The field email is not valid";
    
    private const USERNAME_ALREADY_USED = "This username is already in use";
    private const USERNAME_IS_NOT_VALID = "The field username must only contains LETTERS, NUMBERS and '_'";
    private const LESS_USERNAME = "The field username must be less than " . self::MAX_USERNAME . " characters" ;
    private const BIGGER_USERNAME = "The field username must be bigger than " . self::MIN_USERNAME . " characters" ;
    
    private const NAME_IS_NOT_VALID = "The field name must only contains LETTERS and SPACES";
    private const LESS_NAME = "The field name must be less than " . self::MAX_NAME . " characters" ;
    private const BIGGER_NAME = "The field name must be bigger than " . self::MIN_NAME . " characters" ;
    
    private const LESS_PASSWORD = "The field password must be less than " . self::MAX_PASSWORD . " characters" ;
    private const BIGGER_PASSWORD = "The field password must be bigger than " . self::MIN_PASSWORD . " characters" ;

    private const REGISTER_ERROR = "Error while trying to register, please try again later";
    private const REGISTER_SUCCESS = "The register was successfully";

    
    public function __construct(
        private string $email,
        private string $username,
        private string $name,
        private string $password,
        private string $repassword,

        private string $role = "USER",
        private string $photo = "",
        private int $status = 0,
        private bool $verified = false,
        private int $login_attempts = 0,
        private string $api_token = "",
    ){}

    /**
     * @param null
     * @return bool|string
     */
    private function checkFields(): bool|string
    {
        // Global
        if(empty($this->email) || empty($this->username) || empty($this->name) || empty($this->password) || empty($this->repassword)) return $this->errorMsg(self::EMPTY_FIELDS);

        // Email
        if($this->emailAlreadyExists($this->email)) return $this->errorMsg(self::EMAIL_ALREADY_USED);
        if(!is_string($this->email) || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) return $this->errorMsg(self::EMAIL_IS_NOT_VALID);

        // Username
        $this->username = str_replace(" ", "", $this->username);
        if($this->usernameAlreadyExists($this->username)) return $this->errorMsg(self::USERNAME_ALREADY_USED);
        if($this->lessThan($this->username, self::MIN_USERNAME)) return $this->errorMsg(self::BIGGER_USERNAME);
        if($this->biggerThan($this->username, self::MAX_USERNAME)) return $this->errorMsg(self::LESS_USERNAME);
        if(!is_string($this->username) || !$this->expressionIsValid($this->username, "/[a-zA-Z0-9_]+/")) return $this->errorMsg(self::USERNAME_IS_NOT_VALID);

        // Name
        if($this->lessThan($this->name, self::MIN_NAME)) return $this->errorMsg(self::BIGGER_NAME);
        if($this->biggerThan($this->name, self::MAX_NAME)) return $this->errorMsg(self::LESS_NAME);
        if(!is_string($this->name) || !$this->expressionIsValid($this->name, "/[a-zA-Z ]+/")) return $this->errorMsg(self::NAME_IS_NOT_VALID);

        // Passwords
        if($this->lessThan($this->password, self::MIN_PASSWORD)) return $this->errorMsg(self::BIGGER_PASSWORD);
        if($this->biggerThan($this->password, self::MAX_PASSWORD)) return $this->errorMsg(self::LESS_PASSWORD);
        if(!$this->areEqual($this->password, $this->repassword)) return $this->errorMsg(self::PASSWORDS_NOT_MATCH);

        $this->password = $this->hashPassword($this->password);
    
        return true;
    }

    /**
     * @param null
     * @return string
     */
    public function register(): string
    {
        try {
            $check = $this->checkFields();
            if($check !== true) return $check;

            $query = $this->doSql("INSERT INTO users(email, username, name, password, role, photo, status, verified, login_attempts, api_token)
                                                VALUES(:email, :username, :name, :password, :role, :photo, :status, :verified, :login_attempts, :api_token)");
            $query->execute([
                ":email" => $this->email,
                ":username" => $this->username,
                ":name" => $this->name,
                ":password" => $this->password,
                ":role" => $this->role,
                ":photo" => $this->photo,
                ":status" => $this->status,
                ":verified" => $this->verified,
                ":login_attempts" => $this->login_attempts,
                ":api_token" => $this->api_token,
            ]);
            return $this->successMsg(self::REGISTER_SUCCESS);
        } catch (PDOException $e) {
            return $this->errorServerMsg(self::REGISTER_ERROR, $e);
        }
        
    }
}

if(isset($_POST['username'])){
    $register = new RegisterController($_POST['email'], $_POST['username'], $_POST['name'], $_POST['password'], $_POST['repassword']);
    echo $register->register();
}