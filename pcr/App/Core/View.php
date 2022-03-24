<?php 
namespace App\Core;

use \Tamtamchik\SimpleFlash\Flash;
use Exception;

class View{

    public $path;
    public $route;
    public $flash;
    public $layout = 'default';

    public function __construct($route)
    {
        $this->flash = new Flash();
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
    }

    public function render(string $title ='Страница', array $vars = []): void
    {
        $path = __DIR__ . '/../../App/templates/' . $this->path . '.php';
        
        if (!file_exists($path)) {
            throw new Exception('Вид не найден:' . $this->path, 404);
        }

        extract($vars);
        ob_start();
        include_once $path;
        $content = ob_get_clean();
        include_once __DIR__.'/../templates/layouts/'.$this->layout.'.php';
    }

    public function redirect(string $url, string $message = null):void
    {
        if($message)
        $this->flash->warning($message);

        header('Location: /' . $url);
        exit;
    }

    public static function errorCode($code,$message): void
    {   
        // http_response_code($code);
        $path = include_once __DIR__ . '/../templates/errors/error.php';
        if (file_exists($path))
            require $path;
        exit;
    }

    public function message($status, $message):string
    {
        exit(json_encode(['status' => $status, 'message' => $message]));
    }

    public function location($url):string
    {
        exit(json_encode(['url' => $url,]));
    }
}