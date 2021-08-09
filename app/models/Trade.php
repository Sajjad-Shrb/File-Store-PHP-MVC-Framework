<?php 

namespace app\app\models;

use app\core\Model;

class File extends Model
{
    protected ?int $id = null;
    protected int $file_id = 0;
    protected int $buyer_id = 0;
    protected int $seller_id = 0;

    //TODO: date type
    protected string $date;

    public static function tableName(): string
    {
        return 'Trades';
    }

    public function attributes(): array
    {
        return ['id', 'user_id', 'name', 'type', 'size', 'path', 'url', 'price', 'downloads', 'is_verified', 'is_private'];
    }
}