<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Тесты</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Новый тест</li>
                </ol>
            </nav>
        </div>

    </div>
    <!--end breadcrumb-->
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <h6 class="mb-0 text-uppercase">Новый тест</h6>
            <hr />
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal" method="post" action='add_pcr'>
                        
                        <input hidden value='<?= $pcr['id'] ?>' name="id">

                        <label for="lastname">Name Lastname </label>
                        <input class="form-control form-control-lg mb-3" value='<?= $pcr['lastname'] ?>' type="text" placeholder="Name Lastname" id="lastname" name="lastname">

                        <label for="barcode">barcode</label>
                        <input class="form-control form-control-lg mb-3" value='<?= $pcr['barcode'] ?>' type="text" placeholder="barcode" name="barcode" id="barcode">


                        <label for="personal_id">Personal ID/Passport No</label>
                        <input value='<?= $pcr['personal_id'] ?>' class="form-control form-control-lg mb-3" type="text" placeholder="Personal ID" name="personal_id" id="personal_id">

                        <input class="form-control mb-3" value='<?= $pcr['affiliation'] ?>' type="text" placeholder="Принадлежность" name="affiliation">

                        <label for="result">Резултат</label>
                        <select class="form-select mb-3" id='result' name="result">
                            <? if (!empty($pcr['result'])) : ?>
                                <option selected="selected"><?= $pcr['result'] ?></option> <? endif; ?>

                            <option>POSITIVE</option>
                            <option>NEGATIVE</option>
                        </select>

                        <input value='<?= $pcr['passport'] ?>' class="form-control mb-3" type="text" placeholder="№ паспорта" name="passport">

                        <label for="test_date">Дата теста</label>
                        <input value='<?= $pcr['test_date'] ?>' class="form-control mb-3" type="date" placeholder="Дата теста" name='test_date' id='test_date'>

                        <label for="download_date">Дата загрузки</label>
                        <input class="form-control mb-3" value='<?= $pcr['download_date'] ?>' type="date" placeholder="Дата загрузки" aria-label="readonly input example" id='download_date' name='download_date'>

                        <input class="form-control mb-3" value='<?= $pcr['downloader'] ?>' type="text" placeholder="Загрузчик" name='downloader'>

                        <select class="form-select  mb-3" name='gender'>
                            <? if (!empty($pcr['gender'])) : ?>
                                <option selected="selected"><?= $pcr['gender'] ?></option> <? endif; ?>

                            <option value="MALE" selected="selected">MALE</option>
                            <option value="FEMALE">FEMALE</option>
                        </select>

                        <label for="birthday">День рождения</label>
                        <input class="form-control mb-3" id='birthday' value='<?= $pcr['birthday'] ?>' name="birthday" type="date" placeholder="День рождения">

                        <label for="">Дата взятия образца / Sample Collection Date </label>
                        <input class="form-control mb-3" value='<?= $pcr['sample_collection'] ?>' name='sample_collection' type="datetime-local" placeholder="SAMPLE COllection">
                        <label for="">Дата получения образца /Sample Received Date</label>
                        <input class="form-control mb-3" value='<?= $pcr['sample_recived'] ?>' name='sample_recived' type="datetime-local" placeholder="SAMPLE RECIVED">
                        <label for=""> Время, полученное лабораторией /Time Received by Laboratory </label>
                        <input class="form-control mb-3" value='<?= $pcr['result_time'] ?>' type="datetime-local" name='result_time' placeholder="RESULT TIME">

                        <button class="btn btn-success">Подтвердить </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!--end row-->
</div>