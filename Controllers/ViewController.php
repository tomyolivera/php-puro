<?php

require_once 'AbstractController.php';

class ViewController extends AbstractController{
    private string $site;

    public function __construct()
    {
        $this->site = $this->getActualSite();
        $this->includeViews();
    }
    
    private function includeViews()
    {
        require_once '../../views/base/head.php';
        require_once '../../views/' . $this->site . '/index.php';
        require_once '../../views/base/footer.php';
    }

    private function getActualSite()
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
}