<?
include_once 'functions/main.php';
if (is_not_logged_in()) {
    redirect_to('page_login');
}

$news = R::load('news', $_GET['id']);


?>
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="description" content="Chartist.html">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="/admin/public/css/vendors.bundle.css">
    <link id="appbundle" rel="stylesheet" media="screen, print" href="/admin/public/css/app.bundle.css">
    <link id="myskin" rel="stylesheet" media="screen, print" href="/admin/public/css/skins/skin-master.css">
    <link rel="stylesheet" media="screen, print" href="/admin/public/css/fa-solid.css">
    <link rel="stylesheet" media="screen, print" href="/admin/public/css/fa-brands.css">
    <link rel="stylesheet" media="screen, print" href="/admin/public/css/fa-regular.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-primary-gradient">
        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Главная <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
            </ul>
        </div>
    </nav>
    <main id="js-page-content" role="main" class="page-content mt-3">
        <div class="subheader">
            <h1 class="subheader-title">
                <i class='subheader-icon fal fa-plus-circle'></i> Добавить новость
            </h1>
        </div>
        <? if (isset($_SESSION['success'])) : ?>
            <div class="alert alert-success">
                <strong>Уведомление!</strong> <span><? display_flash_message('success') ?></span>
            </div>
        <? endif;
        if (isset($_SESSION['error'])) : ?>
            <div class="alert alert-danger text-dark" role="alert">
                <strong>Уведомление!</strong> <span><? display_flash_message('error') ?></span>
            </div>
        <? endif; ?>
        <form action="create.php" enctype="multipart/form-data" method="POST">
            <div class="row">
                <input type="text" value="<?= $news['id'] ?>" name="id" hidden>
                <div class="col-xl-12">
                    <div id="panel-1" class="panel">
                        <div class="panel-container">
                            <div class="panel-hdr">
                                <h2>Заполните данные</h2>
                            </div>
                            <div class="panel-content row">

                                <div class="form-group col-xl-6">
                                    <label class="form-label" for="title">Title</label>
                                    <input type="text" value="<?= $news['title'] ?>" id="title" name="title" class="form-control">
                                </div>

                                <div class="form-group col-xl-6">
                                    <label class="form-label" for="keywords">Keywords</label>
                                    <input type="text" value="<?= $news['keywords'] ?>" id="keywords" name="keywords" class="form-control">
                                </div>

                                <div class="form-group col-xl-6">
                                    <label class="form-label" for="description">description</label>
                                    <input type="text" value="<?= $news['description'] ?>" id="description" name="description" class="form-control">
                                </div>


                                <div class="form-group col-xl-6">
                                    <label class="form-label" for="h1">H1</label>
                                    <input type="text" value="<?= $news['h1'] ?>" id="h1" name="h1" class="form-control">
                                </div>

                                <div class="form-group col-xl-6">
                                    <label class="form-label" for="simpleinput">Дата</label>
                                    <input type="date" value="<?= $news['date_news'] ?>" id="simpleinput" name="date_news" class="form-control">
                                </div>
                                <div class="form-group col-xl-6">
                                    <label class="form-label" for="simpleinput">Заголовок</label>
                                    <input type="text" value="<?= $news['header'] ?>" id="simpleinput" name="header" class="form-control">
                                </div>
                                <div class="form-group col-xl-12">
                                    <label class="form-label" for="example-select">Текс</label>
                                    <textarea name="text" class="form-control" id="" cols="30" rows="10"><?= $news['text'] ?></textarea>
                                </div>

                                <img id='photo_file' class="bd-placeholder-img card-img-top col-xl-3 col-md-6 col-xs-4" src="/files/<?= $news['photo'] ?>" alt="">

                                <div class="form-group col-xl-6">
                                    <label class="form-label" for="fileinput">Загрузить аватар</label>
                                    <input type="file" name="file" value="" id="fileinput" class="form-control-file">
                                </div>

                            </div>

                        </div>
                        <div class="col-md-12 mt-3 mb-3 d-flex flex-row-reverse">
                            <button class="btn btn-success">Изменить</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </main>



    <script src="/admin/public/js/vendors.bundle.js"></script>
    <script src="/admin/public/js/app.bundle.js"></script>



    <script>
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#photo_file').attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
        $(function() {
            var files; // переменная. будет содержать данные файлов
            // заполняем переменную данными, при изменении значения поля file 
            $('input[type=file]').on('change', function() {
                readURL(this);
            });

        });
    </script>


</body>

</html>