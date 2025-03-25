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

        $parameters = [
            ':name' => $name,
            ':checked' => $checked ? 1 : 0,
            'created_at' => date(DATE_FORMAT)
        ];

        $query->execute($parameters);
    }

    public function getItem(string $name) : ?array {
        $sql = "SELECT * FROM items WHERE name = :name";
        $query = $this->db->prepare($sql);

        $parameters = [
            ':name' => $name
        ];

        $query->execute($parameters);

        $r = $query->fetch(PDO::FETCH_ASSOC);

        return $r ?: null;
    }

    public function deleteItem(string $name) : bool {
        $sql = "DELETE FROM items WHERE name = :name";
        $query = $this->db->prepare($sql);

        $parameters = [
            ':name' => $name
        ];

        return $query->execute($parameters);
    }

    public function updateItem(string $name, bool $checked = false) : bool
    {
        $sql = "UPDATE items SET checked = :checked WHERE name = :name";
        $query = $this->db->prepare($sql);

        $parameters = [
            ':name' => $name,
            ':checked' => $checked ? 1 : 0,
        ];

        $query->execute($parameters);

        return true;
    }

    public function getItems() : array {
        $sql = "SELECT * FROM items";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
