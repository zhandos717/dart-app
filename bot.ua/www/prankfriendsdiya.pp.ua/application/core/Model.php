<?
namespace application\core;
use application\lib\Tbot as TB;
use application\lib\Rb as R;

abstract class Model{
    public $bot;
    public $rb;
    public function __construct(){
        $this->bot = new TB;
        $this->rb = new R;
    }
}
