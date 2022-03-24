<!DOCTYPE html>
<html lang="RU-ru">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Фейк Дия">
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
    <!-- Styles -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
    <link href="/public/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/plugins/font-awesome/css/all.min.css" rel="stylesheet">
    <link href="/public/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="/public/plugins/DataTables/datatables.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="public/plugins/bootstrap/css/font-awesome.min.css"> -->
    <!-- Theme Styles -->
    <link href="/public/css/main.min.css" rel="stylesheet">
    <link href="/public/css/custom.css" rel="stylesheet">
</head>
<div class="page-container">
    <div class="page-header">
        <nav class="navbar navbar-expand-lg d-flex justify-content-between">
            <div class="" id="navbarNav">
                <ul class="navbar-nav" id="leftNav">
                    <li class="nav-item">
                        <a class="nav-link" id="sidebar-toggle" href="#"><i data-feather="arrow-left"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/">Главная</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="participants">Участники</a>
                    </li>
                </ul>
            </div>
            <div class="logo">
                <a class="navbar-brand" href="/"></a>
            </div>
            <div class="" id="headerNav">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link notifications-dropdown" href="#" id="notificationsDropDown" role="button" data-bs-toggle="dropdown" aria-expanded="false">G</a>
                        <div class="dropdown-menu dropdown-menu-end profile-drop-menu" aria-labelledby="profileDropDown">
                            <a class="dropdown-item" href="/logout"><i data-feather="log-out"></i>Выход</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <div class="page-sidebar">
        <ul class="list-unstyled accordion-menu">
            <li>
                <a href="/participants"><i data-feather="users"></i>Участники</a>
            </li>
            <li>
                <a href="/logout"><i data-feather="log-out"></i>Выход</a>
            </li>
        </ul>
    </div>
    <?= $content; ?>
</div>
<!-- VUE -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.17/vue.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script src="/public/js/export.js?<?= time(); ?>"></script>
<!-- Javascripts -->
<script src="/public/plugins/jquery/jquery-3.4.1.min.js"></script>
<script src="/public/js/form.js?<?= time(); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="public/plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/feather-icons"></script>
<script src="/public/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
<script src="/public/plugins/DataTables/datatables.js"></script>
<script src="/public/js/main.min.js"></script>
<script src="/public/js/pages/datatables.js"></script>

<script src="/public/plugins/table/dataTables.buttons.min.js"></script>
<script src="/public/plugins/table/jszip.min.js"></script>
<script src="/public/plugins/table/buttons.html5.min.js"></script>
<script src="/public/plugins/table/buttons.print.min.js"></script>
<script src="/public/plugins/table/examples.datatables.tabletools.js"></script>


</body>

</html>