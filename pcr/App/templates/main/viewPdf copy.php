<!DOCTYPE html>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Invoice</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="/public/qr/bootsrap/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="/public/qr/bootsrap/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="/public/qr/bootsrap/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="/public/qr/bootsrap/AdminLTE.min.css">
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        /* @media print { */

        .table-borderless>tbody>tr>td,
        .table-borderless>tbody>tr>th,
        .table-borderless>tfoot>tr>td,
        .table-borderless>tfoot>tr>th,
        .table-borderless>thead>tr>td,
        .table-borderless>thead>tr>th {
            border: none;
        }

        thead.border>tr {
            border-top: 1px solid black;
        }

        thead.border>th {
            border-top: 1px solid black;
        }


        /* } */
    </style>
</head>

<body>
    <!-- onload="window.print();" -->
    <div class="wrapper">
        <!-- Main content -->
        <section class="invoice">
            <!-- title row -->
            <div class="row">


                <div class='col-xs-4 text-center'> <img class="printing" height='120' src="/public/qr/Img/rtm.png"></div>

                <div class='col-xs-4 text-center'>
                    <p>REPUBLIC OF TURKEY
                    </p>
                    <p>MINISTRY OF HEALTH
                    </p>
                    <p class='h3 text-nowrap'>Laboratory Result Report</p>

                </div>
                <div class='col-xs-4 text-center'>
                    <b>K7H5-4534-97</b> <br>
                    <img src="https://chart.googleapis.com/chart?cht=qr&chs=120x120&choe=UTF-8&chld=H&chl=ПРивет">
                </div>
            </div>

            <div class="row">
                <div class='col-xs-8'> Sending institute: <b>PRIVATE GENLAB MEDICAL ANALYSIS LABORATORY</b>
                </div>

                <div class='col-xs-3 text-justify'>
                    <b> <small>The information in the
                            Document can be verified by
                            scanning it with any QR code
                            reader.</small> </b>

                </div>
            </div>

            <div class="row invoice-info">
                <div class="col-xs-12">
                    <table class="table table-borderless">
                        <thead>
                            <tr class='bg-gray'>
                                <th colspan="2">Patient Information</th>
                                <th colspan="2"> Sample Information</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>
                                    Name Lastname
                                </th>
                                <td> YULDASHEV ANVAR</td>
                                <th>
                                    Order Reason /
                                    Prediagnosis
                                </th>
                                <td></td>
                            </tr>
                            <tr>
                                <th>
                                    Personal ID / Passport
                                    No
                                </th>
                                <td> FA0020899</td>
                                <th>
                                    Sample Collection Date /
                                    Time

                                </th>
                                <td></td>
                            </tr>
                            <tr>
                                <th>
                                    Gender
                                </th>
                                <td> Male</td>
                                <th>
                                    Sample Received Date /
                                    Time
                                </th>
                                <td>15.01.2022 10:37
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Date of Birth
                                </th>
                                <td> 04.12.1986
                                </td>
                                <th>
                                    Sample Received Date /
                                    Time
                                </th>
                                <td>15.01.2022 10:51
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    File No
                                </th>
                                <td> 763820096

                                </td>
                                <th>
                                    Laboratory No
                                </th>
                                <td>
                                    3646403103

                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Sample Acceptance No
                                </th>
                                <td>570513

                                </td>
                                <th>
                                    Date/Time Received by
                                    Laboratory

                                </th>
                                <td>
                                    15.01.2022 10:51

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.row -->
            </div>
            <!-- Table row -->
            <div class="row">
                <div class="col-xs-12 table-responsive">
                    <table class="table">
                        <thead class="border">
                            <tr>
                                <td>Test</td>
                                <td>Unit</th>
                                <td>Method</td>
                                <td>Limit of
                                    Quantification
                                    (LOQ)
                                </td>
                                <td>Reference
                                    Value</td>
                                <td>Test
                                    Results </td>
                                <td>Specimen </td>
                                <td>Result Date / Time /
                                    Approved by
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Real time PCR 1
                                    reaksyon
                                    (SARS-CoV-2 PCR)

                                </td>
                                <td></td>
                                <td>Real Time
                                    PCR
                                </td>
                                <td></td>
                                <td></td>
                                <td>NEGATIVE</td>
                                <td>Combined Throat And
                                    Nose Swab
                                </td>
                                <td>15.01.2022 16:01:36 /
                                    Tuncer Gökçe
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <hr>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <b>Laboratory Supervisor</b> <br>
                    <b> <small>Tuncer GOKCE </small> </b>
                    <p>Microbiology Specialist
                    </p>
                    <img height='80' src="/public/qr/Img/sing.png">
                </div>
                <div class="col-xs-4 text-center">
                    <img src="/public/qr/Img/genlab.png">
                </div>
                <!-- <div class="col-xs-4">
                </div> -->
                <!-- pull-right -->
                <div class="col-xs-4 ">
                    <img class='text-justify' src="https://chart.googleapis.com/chart?cht=qr&chs=180x180&choe=UTF-8&chld=H&chl=ПРивет"><br>
                    <b class='text-justify'>This QR code has been generated for
                        electronic verification through EU Digital
                        COVID Certificate Program. It is also verifiable through "e-nabiz" website of the Turkish
                        ministry of health.</b>
                </div>
            </div>

            <div>
                <span> <b>Report Print Date:</b> 15.01.2022</span>
                <span class="pull-right "> <b>Page No 1/1</b></span>
            </div>
            <hr>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
</body>

</html>