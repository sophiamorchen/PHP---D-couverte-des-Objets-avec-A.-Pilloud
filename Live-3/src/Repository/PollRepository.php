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
    public function create(string $title, string $description): bool
    {
        $query = DbConnection::getPDO()->prepare('insert into poll(title, description) values(:title, :description)');
        $query->bindParam(':title', $_POST['title'], PDO::PARAM_STR);
        $query->bindParam(':description', $_POST['description'], PDO::PARAM_STR);

        return $query->execute();
    }

    public function update(object $poll) :bool
    {
        $query = DbConnection::getPDO()->prepare('update poll set title=:title, description=:description where id =:id');
        $query->bindParam(':title', $poll->title);
        $query->bindParam(':description', $poll->description);
        $query->bindParam(':id', $poll->id);

        return $query->execute();
    }

}