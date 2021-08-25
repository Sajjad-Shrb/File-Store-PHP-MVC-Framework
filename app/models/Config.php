<?php

namespace app\app\models;

use app\core\Model;

class Config extends Model
{
    private string $allowed_file_types = '[.jpg, .jpeg, .png, .gif, .pdf, .doc, .docx, .ppt, .pptx, .xls, .xlsx, .mp3, .m4a, .wav, .mp4, .m4v, .mpg, .wmv, .mov, .avi, .swf, .ins, .isf, .te, .xbk, .ist, .kmz, .kes, .flp, .wxr, .xml, .fjsw, .zip, .epub]';
    private float $max_size = 10240;
    private float $life_time = 86400;

       public static function tableName(): string
    {
        return 'Config';
    }

    public function attributes(): array
    {
        return ['allowed_file_types', 'max_size', 'life_time'];
    }
}