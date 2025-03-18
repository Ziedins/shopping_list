<?php

class Model
{
    public const DATE_TIME_FORMAT = "Y-m-d H:i:s";

    private ?PDO $db;

    /**
     * @param PDO $db A PDO database connection
     */
    function __construct(PDO $db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }
}
