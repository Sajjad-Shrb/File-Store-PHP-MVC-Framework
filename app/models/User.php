<?php

namespace app\app\models;

use app\core\Application;
use app\core\Model;

class User extends Model
{
    public ?int $id = null;
    public string $name = '';
    public string $username = '';
    public string $email = '';
    public int $type = 1;
    public float $credit = 0;
    public bool $is_active = true;
    public int $num_files = 0;
    public string $password = '';

    public static function tableName(): string
    {
        return 'Users';
    }

    public function attributes(): array
    {
        return ['id', 'name', 'username', 'email', 'type', 'credit', 'is_active', 'num_files', 'password'];
    }

    public function insert(): bool
    {
        $this->password = sha1($this->password);
        return parent::insert();
    }

    public function findAllbyUsername()
    {
        $tableName = static::tableName();

        $sql = "SELECT username From $tableName";
        $stm = $this->pdo->query($sql);

        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);

        return $result;
    }

    public function is_login(): bool
    {
        return Application::$app->session->get('id');
    }
}
