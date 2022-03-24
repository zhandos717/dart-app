<?include ("../../bd.php");
  if($_SESSION['logged_user']->status == 17) : 
    try {
    // берем переданный роут
    $route = trim($_REQUEST['routes']??'index');
    // проверяем, если в конце слеш, то это index роут
    if (substr($route,'-1') == '/') $route.='index';
    // минимальная защита от инклуда неожидаемых файлов
    // ограничиваем имена до символов a-b, 0-9, тире, нижнее подчеркивание и слеш
    if (!preg_match('~^[-a-z0-9/_]+$~i', $route)) throw new Exception('Not allowed routes');
    // генерим путь к файлу
    $filePath = dirname(__FILE__).'/pages/'.$route.'.php';
    // если не существует переводим на главную страницу
    if (!file_exists($filePath)) include 'pages/home.php'; //throw new Exception('Route not found');
    // если существует, инклудим файл
    include $filePath;
    } catch (Throwable $ex) {
    // в случае любых ошибок, показываем 404
    include dirname(__FILE__).'/pages/home.php';
    } 
  else:
  header('Location: /');
  endif; ?>