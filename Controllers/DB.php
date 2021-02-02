<?php

class DB{
    private const CONNECTION_ERROR = "Error while trying to connect to DB: ";

    public function __construct(
        private string $hostdb = "localhost",
        private string $userdb = "root",
        private string $passdb = "2709198712",
        private string $dbname = "php_facer",
    ){}

    /**
     * @param null
     * @return PDO|Exception
     */
    public function connect()
    {
        try {
            $connection = "mysql:host=" . $this->hostdb . ";dbname=" . $this->dbname;
            $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_EMULATE_PREPARES => false];
            return new PDO($connection, $this->userdb, $this->passdb, $options);
        } catch (PDOException $e) {
            throw new Exception(self::CONNECTION_ERROR, $e->getMessage());
        }
    }
}