<?php
class Category {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAll() {
        return $this->db->query("SELECT * FROM categories ORDER BY name");
    }

    public function getNames() {
        $result = $this->db->query("SELECT DISTINCT name FROM categories ORDER BY name");
        $names = [];
        while ($row = $result->fetch_assoc()) {
            $names[] = $row['name'];
        }
        return $names;
    }
}