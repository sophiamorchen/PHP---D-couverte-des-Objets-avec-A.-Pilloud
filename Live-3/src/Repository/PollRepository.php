<?php

namespace App\Repository;
use App\Database\DbConnection;
use PDO;

class PollRepository
{
   public function findAll() {
        return DbConnection::getPDO()->query("SELECT * FROM poll")->fetchAll(PDO::FETCH_OBJ);
    }

    public function find(int $id): object
    {
        $query = DbConnection::getPDO()->prepare("SELECT * FROM poll where id = :id");
        $query->bindParam('id', $id);
        $query->execute();

        return $query->fetch(PDO::FETCH_OBJ);
    }
}