<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8" />
    <title><?= $title ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="" name="description" />
    <meta content="" name="author" />
    <link href="/public/pcr/css/pcrtest.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css" integrity="sha512-xnwMSDv7Nv5JmXb48gKD5ExVOnXAbNpBWVAXTo9BJWRJRygG8nwQI81o5bYe8myc9kiEF/qhMGPjkSsF06hyHA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .BoxContent {
            width: 50%;
            margin: 7% auto;
            position: relative;
            background-color: #fff;
            -webkit-box-shadow: 2px 2px 13px 0px rgba(0, 0, 0, .20);
            -moz-box-shadow: 2px 2px 13px 0px rgba(0, 0, 0, .20);
            box-shadow: 2px 2px 13px 0px rgba(0, 0, 0, .20);
        }

        .EnabizLogo {
            padding: 15px;
            height: 70px;
            position: relative;
            left: 0;
            margin-bottom: 50px
        }

        @media (max-width: 991px) {
            .BoxContent {
                width: 100%;
                margin: 0% auto;
                -webkit-box-shadow: none;
                -moz-box-shadow: none;
                box-shadow: none;
            }

            body {
                margin: 0;
                padding: 0;
            }

            .EnabizLogo {
                margin-bottom: 0px
            }
        }
    </style>
</head>

<body>
    <div class="BoxContent">
        <img src="/public/pcr/img/enabiz-logo-giris.png" class="EnabizLogo" />
        <img src="/public/pcr/img/sb-logo-giris.png" style="position: absolute;right:0;height: 100px;" />
        <div class="clearfix"></div>
        <div style="padding:50px;">

            <?= $content; ?>

            <div class="clearfix"></div>
            <div class="clearfix"></div>
        </div>
    </div>
</body>

</html>