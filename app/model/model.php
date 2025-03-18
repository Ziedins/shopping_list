<?php

class Model
{
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

    public function addItem(string $name, bool $checked = false) : bool|array
    {
        $problems = [];

        if(count($problems) == 0) {
            $this->insertItem($name, $checked);

            return true;
        }

        return $problems;
    }

    private function insertItem(string $name, bool $checked) : void {
        $sql = "INSERT INTO items (name, checked, created_at) VALUES (:name, :checked, :created_at)";
        $query = $this->db->prepare($sql);

        $paremeters = [
            ':name' => $name,
            ':checked' => $checked ? 1 : 0,
            'created_at' => date(DATE_FORMAT)
        ];

        $r = $query->execute($paremeters);

    }
}
