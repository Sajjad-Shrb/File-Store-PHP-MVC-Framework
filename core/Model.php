<?php

namespace app\core;

abstract class Model
{
    //TODO: name => Label
    //TODO: Error Handling


    //TODO: convert pdo to prepare func
    //TODO: function signitures

    public \PDO $pdo;

    public function __construct()
    {
        $this->pdo = Application::$app->db->pdo;
    }

    public function loadData($data): void
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public static function tableName();

    public function attributes(): array
    {
        return [];
    }

    public function primaryKey(): string
    {
        return 'id';
    }

    public function insert(): bool
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();

        $params = array_map(fn ($attr) => ":$attr", $attributes);

        $statement = $this->pdo->prepare("INSERT INTO $tableName (" . implode(", ", $attributes) . ") 
                VALUES (" . implode(", ", $params) . ")");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }

        $statement->execute();

        return true;
    }

    //TODO: Hamahangi pdo methods
    //TODO: tartibe tavabe
    public function findAll()
    {
        $tableName = static::tableName();

        $sql = "SELECT * From $tableName";
        $stm = $this->pdo->query($sql);

        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function count(): mixed
    {
        $tableName = $this->tableName();

        $sql = "SELECT COUNT(*) FROM $tableName;";
        $stm = $this->pdo->query($sql);

        return $stm->fetchColumn();
    }

    public function findOne($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);

        $sql = implode(" AND ", array_map(fn ($attr) => "$attr = :$attr", $attributes));
        $statement = $this->pdo->prepare("SELECT * FROM $tableName WHERE $sql");

        foreach ($where as $key => $item)
            $statement->bindValue(":$key", $item);

        $statement->execute();

        return $statement->fetch(\PDO::FETCH_ASSOC) ?? false;
    }

    public function findID($where)
    {
        $tableName = static::tableName();
        $attributes = array_keys($where);

        $sql = implode(" AND ", array_map(fn ($attr) => "$attr = :$attr", $attributes));

        $statement = $this->pdo->prepare("SELECT ID FROM $tableName WHERE $sql");

        foreach ($where as $key => $item) {
            $statement->bindValue(":$key", $item);
        }

        $statement->execute();

        return ($statement->fetch(\PDO::FETCH_ASSOC)['ID'] ?? false);
    }

    public function lastInsertID()
    {
        return $this->pdo->lastInsertId();
    }
}
