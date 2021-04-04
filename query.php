<?php

class Query
{
    private $conn;
    private $raw;

    public function __construct($raw, $db)
    {
        $this->conn = $db;
        $this->raw = $raw;
    }

    public function runQuery()
    {
        $stmt = $this->conn->prepare($this->raw);


        $stmt->execute();

        return [$stmt, $stmt->rowCount()];
    }
}
