<!DOCTYPE html>
<html lang="RU-ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Фейк Дия!">
    <meta name="keywords" content="Фейк Дия">
    <meta name="author" content="Zhandos77">

    <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/public/images/favicon/favicon-16x16.png">
    <link rel="manifest" href="/public/images/favicon/site.webmanifest">
    <link rel="mask-icon" href="/public/images/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <title><?php echo $title; ?></title>
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet" crossorigin="anonymous">
    <link href="/public/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/plugins/font-awesome/css/all.min.css" rel="stylesheet">
    <link href="/public/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <!-- Theme Styles -->
    <link href="/public/css/main.min.css" rel="stylesheet">
    <link href="/public/css/custom.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class='loader'>
        <div class='spinner-grow text-primary' role='status'>
            <span class='sr-only'>Loading...</span>
        </div>
    </div>
    <?= $content; ?>
    <!-- Javascripts -->
    <script src="/public/plugins/jquery/jquery-3.4.1.min.js"></script>
    <script src="/public/js/popper.min.js"></script>
    <script src="/public/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="/public/js/feather.min.js" crossorigin="anonymous"></script>
    <script src="/public/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="/public/js/main.js"></script>
    <script src="/public/js/form.js"></script>
</body>

</html>