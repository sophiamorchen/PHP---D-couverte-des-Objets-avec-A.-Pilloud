<?php

namespace App\Repository;
use App\Database\DbConnection;
use PDO;

class PollRepository
{
   public function findAll() {
        return DbConnection::getPDO()->query("SELECT * FROM poll")->fetchAll(PDO::FETCH_OBJ);
    }
}