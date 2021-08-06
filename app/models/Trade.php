<?php 

namespace app\models;

use app\core\Model;

class File extends Model
{
    private $id = null;
    private int $file_id = 0;
    private int $buyer_id = 0;
    private int $seller_id = 0;

    //TODO: date type
    private string $date;

    public static function tableName(): string
    {
        return 'File';
    }

    public function attributes(): array
    {
        return ['id', 'user_id', 'name', 'type', 'size', 'path', 'url', 'price', 'downloads', 'is_verified', 'is_private'];
    }
}