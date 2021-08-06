<?php

namespace app\core;

class Config extends Model
{
    private string $URL_PUBLIC_FOLDER = '';
    private string $URL_PROTOCOL = '//';
    private string $URL_DOMAIN;
    private string $URL_SUB_FOLDER;
    private string $URL;

    private string $allowed_file_types;
    private float $max_size;
    private float $life_time;

    public function __construct()
    {
        $this->URL_PUBLIC_FOLDER = '';
        $this->URL_PROTOCOL = '//';
        $this->URL_DOMAIN = $_SERVER['HTTP_HOST'];
        $this->URL_SUB_FOLDER = str_replace($this-> URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME']));
        $this->URL = $this->URL_PROTOCOL . $this->URL_DOMAIN . $this->URL_SUB_FOLDER;

        $this->allowed_file_types = '[.jpg, .jpeg, .png, .gif, .pdf, .doc, .docx, .ppt, .pptx, .xls, .xlsx, .mp3, .m4a, .wav, .mp4, .m4v, .mpg, .wmv, .mov, .avi, .swf, .ins, .isf, .te, .xbk, .ist, .kmz, .kes, .flp, .wxr, .xml, .fjsw, .zip, .epub]';
        $this->max_size = 10240;
        $this->life_time = 86400;
    }

    public static function tableName(): string
    {
        return 'Config';
    }

    public function attributes(): array
    {
        return ['allowed_file_types', 'max_size', 'life_time'];
    }
}
