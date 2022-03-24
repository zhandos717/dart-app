<?include ("../../bd.php");
  if($_SESSION['logged_user']->status == 14) : 
    try {
    // берем переданный роут
    $route = trim($_REQUEST['routes']?? 'home');
    // проверяем, если в конце слеш, то это index роут
    if (substr($route,'-1') == '/') $route.= 'home';
    // минимальная защита от инклуда неожидаемых файлов
    // ограничиваем имена до символов a-b, 0-9, тире, нижнее подчеркивание и слеш
    if (!preg_match('~^[-a-z0-9/_]+$~i', $route)) throw new Exception('Запрещенный маршрут');
    // генерим путь к файлу
    $filePath = dirname(__FILE__).'/pages/'.$route.'.php';
    // если не существует переводим на главную страницу
    if (file_exists($filePath)){
      include __DIR__.'/../layouts/header.php';
      include __DIR__ . '/../layouts/menu/call_center.php';
      include $filePath;
      include __DIR__ . '/../layouts/footer.php';
    }
    // если существует, инклудим файл
    throw new Exception('Маршрут не найден ');
    //include 'pages/back_user.php'; 
    } catch (Throwable $ex) {
    // в случае любых ошибок, показываем 404
    // тут обычно делают разные типы эксепшенов и разделяют 400 и 500 ошибки
      include dirname(__FILE__).'/pages/404.php';
    } 
  else:
  header('Location: /');
  endif; ?>