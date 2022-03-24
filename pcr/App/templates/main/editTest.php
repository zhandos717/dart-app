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

                        <label for="lastname">Имя фамилия </label>
                        <input class="form-control form-control-lg mb-3" value='<?= $pcr['lastname'] ?>' type="text" placeholder="Name Lastname" id="lastname" name="lastname">
                        <label for="birthday">День рождения</label>
                        <input class="form-control mb-3" value='<?= $pcr['birthday'] ?>' id='birthday' name="birthday" type="text" placeholder="День рождения">
                        <label for="">Пол</label>
                        <select class="form-select  mb-3" name='gender'>
                            <? if (!empty($pcr['gender'])) : ?>
                                <option selected="selected"><?= $pcr['gender'] ?></option> <? endif; ?>

                            <option value="MALE" selected="selected">MALE</option>
                            <option value="FEMALE">FEMALE</option>
                        </select>

                        <label for="barcode">Баркод</label>
                        <input class="form-control form-control-lg mb-3" type="text" placeholder="barcode" name="barcode" value='<?= $pcr['barcode'] ?>' id="barcode">
                        <label for="personal_id">Номер паспорта</label>
                        <input class="form-control form-control-lg mb-3" type="text" placeholder="Personal ID" value='<?= $pcr['passport'] ?>' name="passport" id="personal_id">
                        <label for="result">Резултат</label>
                        <select class="form-select mb-3" id='result' name="result">
                            <? if (!empty($pcr['result'])) : ?>
                                <option selected="selected"><?= $pcr['result'] ?></option> <? endif; ?>

                            <option>POSITIVE</option>
                            <option>NEGATIVE</option>
                        </select>

                        <label for="test_date">Дата теста</label>
                        <input class="form-control mb-3" value='<?= date('Y-m-d', strtotime($pcr['test_date'])); ?>T<?= date('H:i', strtotime($pcr['test_date'])); ?>' type="datetime-local" placeholder="Дата теста" name='test_date' id='test_date'>

                        <label for="">Time Received by Laboratory </label>
                        <input class="form-control mb-3" value='<?= date('Y-m-d', strtotime($pcr['result_time'])); ?>T<?= date('H:i', strtotime($pcr['result_time'])); ?>'  type="datetime-local" name='result_time' placeholder="RESULT TIME">

                        <button class="btn btn-success">Подтвердить </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<!--end row-->
</div>