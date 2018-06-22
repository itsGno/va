<?php

class NmapController extends \Phalcon\Mvc\Controller
{
    //
    public function indexAction()
    {

    }
    //scan and store in DB
    public function scanAction()
    {
            $exe= popen(APP_PATH.'\library\nmap\nmap.exe nmap 192.168.50.1:8888',r);
            $this->view->exe = $exe;
    }
    //show result from DB
    public function resultAction()
    {
            
    }

}

