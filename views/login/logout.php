<?php

require_once '../../Controllers/AbstractController.php';

class Logout extends AbstractController{
    public function __construct()
    {
        $this->setStatus(0);
        include('config.php');
        
        //Reset OAuth access token
        $google_client->revokeToken();
        
        //Destroy entire session data.
        session_destroy();
        
        //redirect page to index.php
        $this->redirectToRoute("../../home");
    }
}

new Logout();