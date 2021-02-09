<title>Login | FACER</title>

<?php
    require_once '../../views/base/head.php';  
    include('config.php');

    class LoginGoogle extends AbstractController{
        public function __construct()
        {
            include('config.php');
            $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

            if(!isset($token['error'])){
                $google_client->setAccessToken($token['access_token']);
                
                $_SESSION['access_token'] = $token['access_token'];
                
                $google_service = new Google_Service_Oauth2($google_client);
            
                $data = $google_service->userinfo->get();
                
                if(!$this->emailAlreadyExists($data['email'])){
                    $query = $this->doSql("INSERT INTO users(name, email)
                                             VALUES(:name, :email)");
                    $query->execute([":name" => $data['name'], ':email' => $data['email']]);
                }

                $query = $this->doSql("SELECT * FROM users WHERE email = :email");
                $query->execute([":email" => $data['email']]);
                $_SESSION['user'] = $query->fetchAll(PDO::FETCH_ASSOC);
                $this->setStatus(1);
                $this->redirectToRoute("home");
            }
        }
    }

    if(isset($_GET["code"])) new LoginGoogle();

    require_once '../../Components/login.php'; 
?>

<script src="../../Public/js/login.js"></script>
<?php require_once '../../views/base/footer.php'; ?>