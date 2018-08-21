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
            //   $command = ("nmap.exe -v -A ".$nmap->nmaptarget);
                $command = ("ping ".$nmap->nmaptarget);
                $exe = exec($command,$output);
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