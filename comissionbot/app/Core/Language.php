<?php 
namespace App\Core;

class Language
{
    private array|false $data;

    public $iso;

    public function __construct(string $language)
    {
        $this->iso = $language;
        
        $this->data = parse_ini_file(__DIR__. '/../../lang/system_'.$language.'.ini');
    }

    public function get(string $name)
    {
        return $this->data[$name]?? ' no translation ';
    }
}