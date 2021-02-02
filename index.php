<?php

require_once 'controllers/ViewController.php';

class Index extends ViewController{
    public function __construct()
    {
        $this->redirectToRoute("home");
    }
}

new Index();