    <div class="content-wrapper">
        <div class="card-body">
            <div id="invoice">
                <!-- <hr /> -->
                <div class="invoice">
                    <div style="
                            padding-bottom: 2%;">
                        <div class=" col">
                            <a href="javascript:;">
                                <img src="pcr/img/rtm.png" width="160" alt="" />
                            </a>
                        </div>

                        <div class='head'>
                            <b>REPUBLIC OF TURKEY</b> <br>
                            <b>MINISTRY OF HEALTH</b>
                        </div>

                        <div class="qr-img">
                            <div>
                                <img class='text-justify' width='150' src="https://chart.googleapis.com/chart?cht=qr&chs=180x180&choe=UTF-8&chld=H&chl=https://gov.tr.enabiz.site/Account/PcrTestSonucuDogrula/?barcode=<?= $pcr['barcode'] ?>">
                            </div>
                        </div>
                        <div style="    font-size: 58%;
                            margin-left: 80%;
                            margin-top: -2%;
                            width: 18%;">The information in the document
                            can be verified on the
                            enabiz.gov.tr web page opened by
                            scanning it with any QR code
                            reader</div>

                        <h3 class='head'>Laboratory Result Report</h3>

                        <p class='title'>Sending Institute : <b>PRIVATE ELYSSA GEN LABORATORY</b></p>

                    </div>
                    <main>
                        <div class="row">
                            <div class="col-12">
                                <table class="table text-left" style='width:100%;     
                                font-size: 70%;'>
                                    <thead style='background:#BFBFBF;'>
                                        <tr>
                                            <th style='width:16%; font-weight: 800;'>Patient Information</th>
                                            <th></th>
                                            <th></th>
                                            <th style='width:26%; font-weight: 800;'> Sample Information</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th style='font-weight: 800;'>
                                                Name Lastname
                                            </th>
                                            <td>:</td>
                                            <td> <?= $pcr['lastname'] ?> </td>
                                            <th style='font-weight: 800;'>
                                                Order Reason /
                                                Prediagnosis
                                            </th>
                                            <td>:</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th style='font-weight: 800;'>
                                                Personal ID / Passport
                                                No
                                            </th>
                                            <td>:</td>
                                            <td> <?= $pcr['passport'] ?></td>
                                            <th style='font-weight: 800;'>
                                                Sample Collection Date /
                                                Time
                                            </th>
                                            <td>:</td>
                                            <td> <?= date('d.m.Y / H:i', strtotime($pcr['test_date'])); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style='font-weight: 800;'>
                                                Gender
                                            </th>
                                            <td>:</td>
                                            <td> <?= $pcr['gender'] ?></td>
                                            <th style='font-weight: 800;'>
                                                Sample Received Date /
                                                Time
                                            </th>
                                            <td>:</td>
                                            <td>
                                                <?= date('d.m.Y / H:i', strtotime($pcr['sample_received'])); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style='font-weight: 800;'>
                                                Date of Birth
                                            </th>
                                            <td>:</td>
                                            <td> <?= $pcr['birthday'] ?> </td>
                                            <th style='font-weight: 800;'>
                                                Laboratory No
                                            </th>
                                            <td>:</td>
                                            <td>
                                                3646403103
                                            </td>
                                        </tr>
                                        <tr>
                                            <th style='font-weight: 800;'>
                                                File No
                                            </th>
                                            <td>:</td>

                                            <td> <?= rand(1111111111, 999999999); ?>
                                            </td>
                                            <th style='font-weight: 800;'>
                                                Date/Time Received by
                                                Laboratory
                                            </th>
                                            <td>:</td>
                                            <td>
                                                <?= date('d.m.Y / H:i', strtotime($pcr['sample_received'])); ?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- Table row -->
                        <div style="padding-top: 5%;">
                            <table class="table">
                                <thead class="border text-center">
                                    <tr>
                                        <th>Test</td>
                                        <th style='width:7%;'>Unit</th>
                                        <th>Method</th>
                                        <th>Limit of
                                            Quantification
                                            (LOQ)
                                        </th>
                                        <th>Reference
                                            Value</th>
                                        <th>Test
                                            Results </th>
                                        <th style='width:12%;'>Specimen </th>
                                        <th>Result Date / Time /
                                            Approved by
                                        </th>
                                    </tr>
                                </thead>
                                <tbody style=' font-size: 60%;'>
                                    <tr>
                                        <td>
                                            Real time PCR 1 reaksiyon
                                            (SARS-CoV-2 PCR)
                                        </td>
                                        <td></td>
                                        <td style='white-space:nowrap '>Real time PCR
                                        </td>
                                        <td></td>
                                        <td></td>
                                        <td style='text-align:center '><?= $pcr['result'] ?></td>
                                        <td style='text-align:center '>Combined Throat
                                            And Nose Swab
                                        </td>
                                        <td style='text-align:center '> <?= date('d.m.Y H:i', strtotime($pcr['result_time'])); ?>
                                            / <br>
                                            NAZLI KAYA
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        <div class="line"></div>

                        <div style='width:70%; margin-top: 20%;'>
                            <p style=' font-size: 80%;  text-align:center; font-weight: 700;'>Laboratory Supervisor </p>
                            <p style=' font-size: 80%; text-align:center'>NAZLI KAYA </p>
                            <p style=' font-size: 80%;  text-align:center;'>Microbiology Specialist </p>
                            <p style=' font-size: 60%;'>(*) Signed tests akredited within the ISO 15189</p>
                        </div>

                        <!-- pull-right -->
                        <div style=' width:30%; margin-left: 70%; font-size: 60%; margin-top: -10%;'>
                            <div style='margin-left: 10%; font-size: 60%; margin-top: -20%;'>
                                <img class='text-justify' width='300' src="https://chart.googleapis.com/chart?cht=qr&chs=320x320&choe=UTF-8&chld=H&chl=https://gov.tr.enabiz.site/Account/PcrTestSonucuDogrula/?barcode=<?= $pcr['barcode'] ?>">
                            </div>

                            <div style='margin-top: -8%;  margin-left: 15%;'>
                                <img width='90px' src="/public/pcr/img/eu.png" alt="/public/pcr/img/eu.png">
                            </div>

                            <div style='width:55%;
                            margin-left: 46%;
                            margin-top: -32%;
                            font-size: 95%;'>
                                This QR code has been
                                generated for electronic
                                verification through EU Digital
                                COVID Certificate Program. It
                                is also verifiable through
                                HealthPass app in Turkey.
                            </div>
                        </div>

                        <div style='padding-bottom:1%; padding-top:1%;  font-size: 80%;'>
                            <span> <b>Report Print Date:&nbsp;&nbsp; &nbsp; <?= date('d.m.Y', strtotime($pcr['result_time'])); ?>
                                </b></span>
                            <span class="pull-right"> <b>Page No&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp; &nbsp; 1/1</b></span>
                        </div>
                        <div class="line"></div>
                        <div style=' font-size: 60%;  font-weight: 800;'>
                            Warning! These test results belongs only to the tested sample. This document can not be reproduced without permission of Public Health
                            Headquarters
                        </div>
                        <hr style=' margin-top: -0.5%; '>
                        <div style=' width:60%; margin-top: -1.2%; font-size: 55%; font-weight: 800; '>
                            Halk Sağlığı Genel Müdürlüğü Mikrobiyoloji Referans Lab.ve Biyolojik Ürünlerı Daire Başkanlığı
                            T.C. Sağlık Bakanlığı HSGM Refik Saydam Yerleşkesi<br>
                            Sağlık Mahallesi Adnan Saygun Caddesi No.55 06100 Sıhhiye / Ankara<br>
                            Form No : F87/MRLBÜDB/01

                        </div>
                        <div style=' width:30%; margin-left: 70%; font-size: 60%; margin-top: -6%; font-weight: 900;'>
                            Phone : 0 (312) 565 50 00<br>
                            Electronic Network: www.hsgm.gov.tr
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>