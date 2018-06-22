<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class TestController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for test
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Test', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "nmap_id";

        $test = Test::find($parameters);
        if (count($test) == 0) {
            $this->flash->notice("The search did not find any test");

            $this->dispatcher->forward([
                "controller" => "test",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $test,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a test
     *
     * @param string $nmap_id
     */
    public function editAction($nmap_id)
    {
        if (!$this->request->isPost()) {

            $test = Test::findFirstBynmap_id($nmap_id);
            if (!$test) {
                $this->flash->error("test was not found");

                $this->dispatcher->forward([
                    'controller' => "test",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->nmap_id = $test->nmap_id;

            $this->tag->setDefault("nmap_id", $test->nmap_id);
            $this->tag->setDefault("nmap_detail", $test->nmap_detail);
            
        }
    }

    /**
     * Creates a new test
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "test",
                'action' => 'index'
            ]);

            return;
        }

        $test = new Test();
        $test->nmapDetail = $this->request->getPost("nmap_detail");
        

        if (!$test->save()) {
            foreach ($test->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "test",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("test was created successfully");

        $this->dispatcher->forward([
            'controller' => "test",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a test edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "test",
                'action' => 'index'
            ]);

            return;
        }

        $nmap_id = $this->request->getPost("nmap_id");
        $test = Test::findFirstBynmap_id($nmap_id);

        if (!$test) {
            $this->flash->error("test does not exist " . $nmap_id);

            $this->dispatcher->forward([
                'controller' => "test",
                'action' => 'index'
            ]);

            return;
        }

        $test->nmapDetail = $this->request->getPost("nmap_detail");
        

        if (!$test->save()) {

            foreach ($test->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "test",
                'action' => 'edit',
                'params' => [$test->nmap_id]
            ]);

            return;
        }

        $this->flash->success("test was updated successfully");

        $this->dispatcher->forward([
            'controller' => "test",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a test
     *
     * @param string $nmap_id
     */
    public function deleteAction($nmap_id)
    {
        $test = Test::findFirstBynmap_id($nmap_id);
        if (!$test) {
            $this->flash->error("test was not found");

            $this->dispatcher->forward([
                'controller' => "test",
                'action' => 'index'
            ]);

            return;
        }

        if (!$test->delete()) {

            foreach ($test->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "test",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("test was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "test",
            'action' => "index"
        ]);
    }

}
