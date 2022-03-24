<? //проверка существовании сессии
include("../../../bd.php");
if ($_SESSION['logged_user']->status == 1) :
  $filial = $_SESSION['logged_user']->adress;

  include "../header.php";
  include "menu.php";
  $today = date("Y-m-d");
  ?>
    <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Рабочий график сотрудников филиала <?= $adress; ?>/<?= $region; ?>
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
                <div class="box-header">
                  <h3 class="box-title">
                    <input type="date" value=<?=$today;?> class="form-control">
                  </h3>
                </div>
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
                       $result = mysqli_query($connect, "SELECT * FROM employeecard WHERE region = '$region' AND adress = '$adress' AND status = '1' ");
                        while ( $data = mysqli_fetch_array($result))

                              {?>
                      <tr>
                        <td><?=$data['fio'];?></td>
                        <td><?=$data['doljnost'];?></td>
                        <form method="post" action="UserUpdate.php">

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
                          <input type="submit" value="Сохранить" name="UserUpdate" class="btn btn-block btn-primary btn-sm">
                          </form>
                          <?
                          $dd1 = 'эксперт-оценщик категории А';
                          $dd2 = 'эксперт-оценщик категории В';
                          $dd3 = 'эксперт-оценщик категории С';
                          if($data['doljnost']=='эксперт-оценщик категории А' OR $data['doljnost']=='эксперт-оценщик категории В' OR $data['doljnost']=='эксперт-оценщик категории C'){?>
                          <br>
                          <form class="" action="relocationEmp.php" method="post">
                            <input type="text" value="<?=$data['id'];?>" name="id" hidden="hidden"  />
                            <input type="submit" value="Перемещение сотрудника" name="peremen" class="btn btn-block btn-danger btn-sm">
                          </form>
                          <?}?>
                        </td>

                      </tr>
                      <?}?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>ФИО</th>
                        <th>Должность</th>
                        <th>Рабочее время</th>
                        <th>Действия</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
  </div>


<? include "../footer.php";
else :
  header('Location: /');
endif; ?>
