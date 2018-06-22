<?php

class NmapController extends \Phalcon\Mvc\Controller
{
    //
    public function indexAction()
    {
    }
    //scan and store into DB
    public function scanAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "test",
                'action' => 'index'
            ]);

            return;
        }
        $nmap = new Nmap();
        $nmap->nmapdetail = $this->request->getPost("nmapdetail");
        
        if (!$nmap->save()) {
            foreach ($nmap->getMessages() as $message) {
                $this->flash->error($message);
            }
            $this->dispatcher->forward([
                'controller' => "nmap",
                'action' => 'index'
            ]);
            return; 
        }

        $this->flash->success("nmap was created successfully");


            //command exection
            $exe= popen($config->application->nmap.'nmap.exe nmap -h',r);
            $this->view->$param = $this->request->getPost("param");
            $this->view->exe = $exe;
    }
    //show result from DB
    public function resultAction()
    {
            
    }
}