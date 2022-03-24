<?php
include("../libs/bd.php");
include '../functions/SxGeo.php';

function getIp()
{
    $keys = [
        'HTTP_CLIENT_IP',
        'HTTP_X_FORWARDED_FOR',
        'REMOTE_ADDR'
    ];
    foreach ($keys as $key) {
        if (!empty($_SERVER[$key])) {
            $ip = trim(end(explode(',', $_SERVER[$key])));
            if (filter_var($ip, FILTER_VALIDATE_IP)) {
                return $ip;
            }
        }
    }
}
$SxGeo = new SxGeo('../libs/SxGeoCity.dat');
$ip = getIp();
$city = $SxGeo->getCityFull($ip);

?>
<!doctype html>
<html lang="RU-ru">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>Мой айпи</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Favicons -->
    <meta name="theme-color" content="#7952b3">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body class="bg-light">
    <div class="container">
        <main>
            <div class="py-5 text-center">
                <h2>Форма для заполнения</h2>
                <p class="lead">Заполните свои данные</p>

                <p>Ваша страна: <?= $city['country']['name_ru'] ?></p>
                <img class="d-block mx-auto mb-4" src="https://flagcdn.com/256x192/<?= strtolower($city['country']['iso']) ?>.png" alt="<?= $city['country']['name_en'] ?>" width="72" height="57">
                <p>Ваш город: <?= $city['city']['name_ru'] ?></p>
            </div>
            <div class="row g-5">
                <div class="col-md-12 col-lg-12">
                    <div class="alert alert-success" style="display: none;" role="alert">
                        Данные приняты, спасибо
                    </div>

                    <div class="alert alert-danger" style="display: none;" role="alert">
                        <span class="message"></span>
                    </div>
                    <h4 class="mb-3">IP address</h4>
                    <form class="needs-validation" action="/functions/add_ip.php" method="POST">

                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="ip" class="form-label">Ваш ip адресс</label>
                                <input type="text" class="form-control" id="ip" name="ip" value="<?= $ip; ?>" placeholder="" disabled value="" required>
                            </div>
                            <div class="col-sm-6">
                                <label for="company" class="form-label">ТОО</label>

                                <select name="company" required class="form-control" id="company">
                                    <option>ОБС</option>
                                    <option>ТБС</option>
                                </select>

                            </div>
                            <div class="col-md-4">
                                <label for="region" required class="form-label">Регион</label>
                                <select class="form-control" name='region' id="region">
                                    <option value="">Выберите город</option>
                                    <? $regions = R::getCol('SELECT region FROM diruser GROUP BY region');
                                    foreach ($regions as $city) { ?>
                                        <option><?= $city ?></option>
                                    <? } ?>
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label for="adress" required class="form-label">Филиал</label>
                                <div class="input-group has-validation">
                                    <select name="adress" class="form-control" id="adress">
                                        <option selected>Выберите адрес</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <label for="kassa" class="form-label">Касса <span class="text-muted"></span></label>
                                <select name="kassa" required class="form-control" id="kassa">
                                    <option selected>Касса 1</option>
                                    <option>Касса 2</option>
                                    <option>Касса 3</option>
                                    <option>Касса 4</option>
                                    <option>Касса 5</option>
                                </select>
                            </div>
                        </div>
                        <hr class="my-4">
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Отправить</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
    <script src="/assets/js/ip.js?<?= time() ?>"></script>

</body>

</html>