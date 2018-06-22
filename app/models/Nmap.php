<?php

class Nmap extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $nmap_id;

    /**
     *
     * @var string
     */
    public $nmap_detail;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("va");
        $this->setSource("nmap");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'nmap';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Nmap[]|Nmap|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Nmap|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
