<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?></title>
    <!-- <link rel="stylesheet" href="/public/pcr/css/style.css"> -->
    <style>
        .content-wrapper {
            width: 1000px;
            /* ширина */
            height: 1400px;
            /* высота */
            padding: 0px 20px 30px 30px;
            /*внутренние отступы - верх, право, низ, лево */
            margin: 20px auto;
            /* выравнивание по центру */
            font-family: "Arial";
            /* нужный шрифт */
            ;
            font-size: 130%;
            text-align: justify;
        }

        @page {
            margin: 1cm;
        }

        /* * стилизация содержимого страницы */
        body {
            /* font-family: -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif; */
            font-size: 16px;
            font-weight: 400;
            line-height: 1.5;
            /* color: #292b2c; */
            background-color: #fff;
        }

        table {
            margin: 0 0 15px 0;
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }



        .border {
            width: 100%;
            margin-bottom: 20px;
            border: 2px solid #000;
            border-collapse: collapse;
        }

        .border th {
            padding: 5px;
            font-size: 80%;
            border: 2px solid #000;
        }

        .border td {
            border: 2px solid #000;
            padding: 5px;
            font-size: 80%;
        }

        .text-center {
            text-align: center;
        }

        .text-left {
            text-align: left;
        }

        hr {
            border: 1px solid #000;
        }

        .head {
            font-size: 80%;
            margin-left: 40%;
            margin-top: -18%;
            width: 35%;
        }

        div.head {
            font-size: 80%;
        }

        .qr-img {
            margin-left: 82%;
            margin-top: -5%;
        }

        p.title {
            font-size: 15px;
        }

        h3.head {
            font-size: 100%;
            margin-top: -8%;
            /* padding-bottom: 100px; */
        }

        .pull-right {
            float: right;
        }

        div.line {
            width: 100%;
            border-bottom: 1px solid #000;

        }
    </style>
</head>

<body>
    <?= $content; ?>

</body>

</html>