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
            $nmap->nmaptarget = $this->request->getPost("nmaptarget");
    
    
                //cd exection
           //    $command =('nmap.exe -v -A -Pn -T5  ');
            //   $command .= ('C:\xampp\htdocs\va\app\library\nmap\output/192.168.220.1.xml 192.168.220.1');
                $command = ("ping ".$nmap->nmaptarget);
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