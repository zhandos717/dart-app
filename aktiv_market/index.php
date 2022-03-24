<?
    include ("libs/bd.php"); // Подключеням базу данных
    try {       
                // берем переданный роут
                $route = trim($_REQUEST['route']??'index');     
                // проверяем, если в конце слеш, то это index роут
            if (substr($route,'-1') == '/') 
                $route.='index';
                // минимальная защита от инклуда неожидаемых файлов
                // ограничиваем имена до символов a-b, 0-9, тире, нижнее подчеркивание и слеш
            if (!preg_match('~^[-a-z0-9/_]+$~i', $route)) 
                throw new Exception('Запрещенный маршрут');
            $filePath = dirname(__FILE__).'/pages/'.$route.'.php';   // генерим путь к файлу 
            if (!file_exists($filePath)) 
                include 'pages/home.php';  // если не существует переводим на главную страницу
            include $filePath;  // если существует, инклудим файл
    } 
    catch (Throwable $ex) {
            // в случае любых ошибок, показываем 404 или главную страницу
            include dirname(__FILE__). '/pages/home.php';
    }
?>