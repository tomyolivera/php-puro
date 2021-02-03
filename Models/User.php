<?php

require_once '../Controllers/AbstractController.php';

class User extends AbstractController{
    private int $id;
    private string $email;
    private string $username;
    private string $name;
    private bool $ban;
    private bool $disabled;
    private int $status;
    private bool $verified;
    private string $role;
    private string $photo;
    private string $login_attempts;
    private string $api_token;

    public function __construct()
    {
        $this->id = $this->getUser("id");
        $this->email = $this->getUser("email");
        $this->username = $this->getUser("username");
        $this->name = $this->getUser("name");
        $this->ban = $this->getUser("ban");
        $this->disabled = $this->getUser("disabled");
        $this->status = $this->getUser("status");
        $this->verified = $this->getUser("verified");
        $this->role = $this->getUser("role");
        $this->photo = $this->getUser("photo");
        $this->login_attempts = $this->getUser("login_attempts");
        $this->api_token = $this->getUser("api_token");
    }

    public function getId(): string
    {
        return $this->id;
    }
    
    protected function setEmail(string $email): self
    {
        $this->email = $email;
        $_SESSION['user'][0]['email'] = $email;

        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
    
    protected function setUsername(string $username): self
    {
        $this->username = $username;
        $_SESSION['user'][0]['username'] = $username;
        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }
    
    protected function setName(string $name): self
    {
        $this->name = $name;
        $_SESSION['user'][0]['name'] = $name;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }
    
    protected function setBan(bool $ban): self
    {
        $this->ban = $ban;
        $_SESSION['user'][0]['ban'] = $ban;

        return $this;
    }

    public function getBan(): bool
    {
        return $this->ban;
    }
    
    protected function setDisabled(bool $disabled): self
    {
        $this->disabled = $disabled;
        $_SESSION['user'][0]['disabled'] = $disabled;
        return $this;
    }

    public function getDisabled(): bool
    {
        return $this->disabled;
    }
    
    protected function setStatus(int $status): self
    {
        $this->status = $status;
        $_SESSION['user'][0]['status'] = $status;

        return $this;
    }

    public function getStatus(): int
    {
        return $this->status;
    }
    
    protected function setVerified(bool $verified): self
    {
        $this->verified = $verified;
        $_SESSION['user'][0]['verified'] = $verified;
        return $this;
    }

    public function getVerified(): bool
    {
        return $this->verified;
    }
    
    protected function setRole(string $role): self
    {
        $this->role = $role;
        $_SESSION['user'][0]['role'] = $role;

        return $this;
    }

    public function getRole(): string
    {
        return $this->role;
    }
    
    protected function setPhoto(string $photo): self
    {
        $this->$photo = $photo;
        $_SESSION['user'][0]['photo'] = $photo;

        return $this;
    }

    public function getPhoto(): string
    {
        return $this->photo;
    }

    
    /**
     * @param null
     * @return string
     */
    public function showStatus(): string
    {
        switch ($this->status) {
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
        if($this->photo == ""){
            return '<img class="rounded-full w-16 h-16" src=".././../Public/img/users/nopicture.png">';
        }else{
            return '<img class="rounded-full w-16 h-16" src=".././../Public/img/users/nopicture.png">';
        }
    }

}