<?php 

class View{
    public static $layout = 'default';

    public static function render(string $path, string $title = 'Страница', array $vars = [])
    {
        extract($vars);
        $path = __DIR__.'/../templates/' . $path . '.php';
        if (\file_exists($path)) {
            ob_start();
            include_once $path;
            $content = ob_get_clean();
            include_once __DIR__.'/../templates/layouts/' . Self::$layout . '.php';
        } else {
            echo 'Вид не найден:' . $path;
        }
    }
 }