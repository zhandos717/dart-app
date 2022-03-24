<?include ("../../bd.php");
  try {
      if ($_SESSION['logged_user']->status != 11)
        throw new Exception('Not allowed routes');
        // берем переданный роут
        $route = trim($_REQUEST['routes']??'home');
        // проверяем, если в конце слеш, то это index роут
      if (substr($route,'-1') == '/') 
        $route.='index';
      // минимальная защита от инклуда неожидаемых файлов
      // ограничиваем имена до символов a-b, 0-9, тире, нижнее подчеркивание и слеш
      if (!preg_match('~^[-a-z0-9/_]+$~i', $route)) 
        throw new Exception('Not allowed routes');
      // генерим путь к файлу
      $filePath = dirname(__FILE__).'/pages/'.$route.'.php';
      // если не существует переводим на главную страницу
      if (!file_exists($filePath))
        throw new Exception('Route not found');

      include $filePath;
      //если существует, инклудим файл

  } catch (Throwable $ex) {
    header('Location: ../../index.php');
  } 

