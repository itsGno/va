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
        $this->view->disable();


            $nmap = new Nmap();
            $nmap->nmapdetail = $this->request->getPost("nmapdetail");
            $nmap->nmaptarget = "192.168.220.1";
    
                //cd exection
                $command =('nmap.exe -v -A -Pn -T5 -oX ');
               $command .= ('C:\xampp\htdocs\va\app\library\nmap\output/192.168.220.1.xml 192.168.220.1');
            //    $command = ("ping 127.0.0.1");
                $exe= exec($command,$output);
                $this->view->command = $command;
                $this->view->exe = $exe;
                $this->view->output = $output;
                $result = '';
                foreach ($output as $output => $value) {
                  $result .= $value."<br>";
                }
                return $result;

 
    }
    //show result from DB
    public function resultAction()
    {
    }
        
}