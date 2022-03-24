<? require_once  '../function/thumbs.php';
try {
        $image = new Thumbs($_GET['src']);
        //$image->resize($_GET['width'], 0);
        //$image->thumb($_GET['width'], 200);
        //$image->reduce($_GET['width'], 500);
        //$image->thumb(300, 200);
        $image->thumb(300, 200);
        $image->output();
} catch (Exception $error) {
	echo $error; // Выведет: файл не найден
}
?>