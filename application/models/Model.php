<?php

class Model
{
    public $db;

    public function __construct()
    {
        $config = Config::getInstance();
        $config = $config->getConfig();

        $this->db = new PDO("mysql:dbname=" . $config['DB_NAME'] . ";host=" . $config['DB_HOST'] . "", $config['DB_USER'], $config['DB_PASS'] );
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }
}