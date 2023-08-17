<?php

class Database
{
    private $db;
    private $host;
    private $dbname;
    private $charset;
    private $userName;
    private $password;

    public function __construct($config)
    {
        $this->host = $config['host'];
        $this->dbname = $config['dbname'];
        $this->charset = $config['charset'];
        $this->userName = $config['userName'];
        $this->password = $config['pwd'];
    }

    public function connect()
    {
        $dsn = $this->createDsn();
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        ];

        $this->db = new PDO($dsn, $this->userName, $this->password, $options);

        return $this->db;
    }

    public function closeConnection()
    {
        $this->db = null;
    }

    private function createDsn()
    {
        return "mysql:host={$this->host};dbname={$this->dbname};charset={$this->charset}";
    }
}
