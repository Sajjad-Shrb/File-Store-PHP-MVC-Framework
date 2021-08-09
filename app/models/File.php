<?php 

namespace app\app\models;

use app\core\Model;

class File extends Model
{
    protected ?int $id = null;
    protected string $username = '';
    protected string $name = '';
    protected string $type = '';
    protected string $extension = '';
    protected float $size = 0;
    protected string $path = '';
    protected string $url = '';
    protected float $price = 0;
    protected int $downloads = 0;
    protected int $is_verified = 0;
    protected int $is_private = 0;

    public static function tableName(): string
    {
        return 'Files';
    }

    public function attributes(): array
    {
        return ['id', 'username', 'name', 'type', 'extension', 'size', 'path', 'url', 'price', 'downloads', 'is_verified', 'is_private'];
    }
}