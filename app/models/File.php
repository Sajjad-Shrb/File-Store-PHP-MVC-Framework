<?php 

namespace app\app\models;

use app\core\Model;

class File extends Model
{
    private ?int $id = null;
    private int $user_id = 0;
    private string $name = '';
    private string $type = '';
    private float $size = 0;
    private string $path = '';
    private string $url = '';
    private float $price = 0;
    private int $downloads = 0;
    private bool $is_verified = false;
    private bool $is_private = false;

    public static function tableName(): string
    {
        return 'File';
    }

    public function attributes(): array
    {
        return ['id', 'user_id', 'name', 'type', 'size', 'path', 'url', 'price', 'downloads', 'is_verified', 'is_private'];
    }
}