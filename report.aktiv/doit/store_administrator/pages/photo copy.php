<? require_once  './function/thumbs.php';


$image = new Thumbs(__DIR__ . '/Параметры Outlook 2021-03-15 14.21.50.png');
$image->thumb(300, 200);
$image->output();