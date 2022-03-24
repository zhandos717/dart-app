<?
include_once '../../../bd.php';
include __DIR__. '/../../layouts/header.php';
include __DIR__ . '/../../layouts/menu/video_surveillance.php';

  ?>
    <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Рабочий график сотрудников ОВН
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="index.php">Регионы</a></li>
        <li class="active">Филиалы</li>
      </ol>
    </section>


      <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <!-- <div class="box-header">
                  <h3 class="box-title">Рабочий график сотрудников филиала <?= $adress; ?>/<?= $region; ?></h3>
                </div> -->
              <div class="box-body">
                <div class="table-responsive">
                  <!-- <table id="example1" class="table table-bordered table-striped"> -->
                  <table class="table table-bordered table-hover table-striped">

                  <!-- <table id="datatable-tabletools" class="table table-bordered table-striped"> -->
                    <thead>
                      <tr>
                        <th>ФИО</th>
                        <th>Должность</th>
                        <th>Рабочее время</th>
                        <th>Действия</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?
                      $otdel = 'ОВН';
                       $result = mysqli_query($connect, "SELECT * FROM employeecard WHERE otdel = '$otdel' ");
                        while ( $data = mysqli_fetch_array($result))

                              {?>
                      <tr>
                        <td><?=$data['fio'];?></td>
                        <td><?=$data['doljnost'];?></td>
                        <form method="post" action="../functions/UpdateOvn.php">

                        <td>
                          <input type="text" value="<?=$data['id'];?>" name="id" hidden="hidden"  />
                          <select name="time_work" class="form-control" required="required">
                            <option value="<?=$data['time_work'];?>"><?=$data['time_work'];?></option>
                            <option value="c 9:00 до 18:00">c 9:00 до 18:00</option>
                            <option value="c 9:00 до 18:30">c 9:00 до 18:30</option>
                            <option value="c 9:00 до 19:00">c 9:00 до 19:00</option>
                            <option value="c 9:00 до 20:00">c 9:00 до 20:00</option>
                            <option value="c 20:00 до 09:00">c 20:00 до 09:00</option>
                            <option value="c 12:00 до 22:00">c 12:00 до 22:00</option>
                        </select>
                          </td>
                        <td>
                            <input type="submit" value="Сохранить" name="UserUpdate" class="btn btn-block btn-warning btn-sm">
                        </td>
                          </form>
                      </tr>
                      <?}?>
                    </tbody>
                    
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  </div>

<? include __DIR__. '/../../layouts/footer.php'; ?>
