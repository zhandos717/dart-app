<? //проверка существовании сессии
include("../../../bd.php");
if ($_SESSION['logged_user']->status == 1) :
  $filial = $_SESSION['logged_user']->adress;

  include "../header.php";
  include "menu.php";
  $today = date("Y-m-d");
  $id = $_POST['id'];

  ?>
  <script type="text/javascript" src="linkedselect.js"></script>
    <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Перемещение сотрудника
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="index.php">Регионы</a></li>
        <li class="active">Филиалы</li>
      </ol>
    </section>


    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-body">
              <form method="post" action="UserRelocation.php">
              <?
               $result = mysqli_query($connect, "SELECT * FROM employeecard WHERE id = '$id' ");
                $data = mysqli_fetch_array($result);
                ?>
                  <div class="form-group">
                      <label for="fio">Ф.И.О</label>
                      <input type="text" class="form-control" id="fio" value="<?=$data['fio'];?>" readonly >
                  </div>
                  <div class="form-group">
                      <label for="fio">Должность</label>
                      <input type="text" class="form-control" id="fio" value=<?=$data['doljnost'];?> readonly >
                  </div>
                  <div class="form-group">
                    <select class="form-control" id="List1" name="region" style="width: 100%;">
                      <option>Выберите регион(город)</option>
                      <?
                      $result2 = mysqli_query($connect, "SELECT region FROM diruser GROUP BY region");
                      while ($data2 = mysqli_fetch_array($result2)) { ?>
                        <option value="<?= $data2['region'] ?>"><?= $data2['region'] ?></option>
                      <? } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <select class="form-control" id="List2" name="adress" style="width: 100%;">
                    </select>
                  </div>


                          <script type="text/javascript">
                            var syncList1 = new syncList;

                            syncList1.dataList = {


                              'Актау': {

                                <?
                                $result11 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Актау' AND status='1'");
                                while ($data11 = mysqli_fetch_array($result11)) { ?> '<?= $data11['adress']; ?>': '<?= $data11['adress']; ?>',
                                <? } ?>
                              },

                              'Актобе': {

                                <?
                                $result12 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Актобе' AND status='1'");
                                while ($data12 = mysqli_fetch_array($result12)) { ?> '<?= $data12['adress']; ?>': '<?= $data12['adress']; ?>',
                                <? } ?>
                              },

                              'Алматы': {

                                <?
                                $result13 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Алматы' AND status='1'");
                                while ($data13 = mysqli_fetch_array($result13)) { ?> '<?= $data13['adress']; ?>': '<?= $data13['adress']; ?>',
                                <? } ?>
                              },

                              'Атырау': {

                                <?
                                $result14 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Атырау' AND status='1'");
                                while ($data14 = mysqli_fetch_array($result14)) { ?> '<?= $data14['adress']; ?>': '<?= $data14['adress']; ?>',
                                <? } ?>
                              },

                              'Караганда': {

                                <?
                                $result15 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Караганда' AND status='1'");
                                while ($data15 = mysqli_fetch_array($result15)) { ?> '<?= $data15['adress']; ?>': '<?= $data15['adress']; ?>',
                                <? } ?>
                              },

                              'Кокшетау': {

                                <?
                                $result16 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Кокшетау' AND status='1'");
                                while ($data16 = mysqli_fetch_array($result16)) { ?> '<?= $data16['adress']; ?>': '<?= $data16['adress']; ?>',
                                <? } ?>
                              },


                              'Костанай': {

                                <?
                                $result17 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Костанай' AND status='1'");
                                while ($data17 = mysqli_fetch_array($result17)) { ?> '<?= $data17['adress']; ?>': '<?= $data17['adress']; ?>',
                                <? } ?>
                              },

                              'Кызылорда': {

                                <?
                                $result18 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Кызылорда' AND status='1'");
                                while ($data18 = mysqli_fetch_array($result18)) { ?> '<?= $data18['adress']; ?>': '<?= $data18['adress']; ?>',
                                <? } ?>
                              },


                              'Нур-Султан': {

                                <?
                                $result19 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Нур-Султан' AND status='1'");
                                while ($data19 = mysqli_fetch_array($result19)) { ?> '<?= $data19['adress']; ?>': '<?= $data19['adress']; ?>',
                                <? } ?>
                              },

                              'Павлодар': {

                                <?
                                $result20 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Павлодар' AND status='1'");
                                while ($data20 = mysqli_fetch_array($result20)) { ?> '<?= $data20['adress']; ?>': '<?= $data20['adress']; ?>',
                                <? } ?>
                              },

                              'Петропавловск': {

                                <?
                                $result21 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Петропавловск' AND status='1'");
                                while ($data21 = mysqli_fetch_array($result21)) { ?> '<?= $data21['adress']; ?>': '<?= $data21['adress']; ?>',
                                <? } ?>
                              },


                              'Семей': {

                                <?
                                $result22 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Семей' AND status='1'");
                                while ($data22 = mysqli_fetch_array($result22)) { ?> '<?= $data22['adress']; ?>': '<?= $data22['adress']; ?>',
                                <? } ?>
                              },

                              'Талдыкорган': {

                                <?
                                $result23 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Талдыкорган' AND status='1'");
                                while ($data23 = mysqli_fetch_array($result23)) { ?> '<?= $data23['adress']; ?>': '<?= $data23['adress']; ?>',
                                <? } ?>
                              },

                              'Тараз': {

                                <?
                                $result24 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Тараз' AND status='1'");
                                while ($data24 = mysqli_fetch_array($result24)) { ?> '<?= $data24['adress']; ?>': '<?= $data24['adress']; ?>',
                                <? } ?>
                              },


                              'Темиртау': {

                                <?
                                $result25 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Темиртау' AND status='1'");
                                while ($data25 = mysqli_fetch_array($result25)) { ?> '<?= $data25['adress']; ?>': '<?= $data25['adress']; ?>',
                                <? } ?>
                              },


                              'Туркестан': {

                                <?
                                $result26 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Туркестан' AND status='1'");
                                while ($data26 = mysqli_fetch_array($result26)) { ?> '<?= $data26['adress']; ?>': '<?= $data26['adress']; ?>',
                                <? } ?>
                              },

                              'Уральск': {

                                <?
                                $result27 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Уральск' AND status='1'");
                                while ($data27 = mysqli_fetch_array($result27)) { ?> '<?= $data27['adress']; ?>': '<?= $data27['adress']; ?>',
                                <? } ?>
                              },


                              'Шымкент': {

                                <?
                                $result28 = mysqli_query($connect, "SELECT adress FROM diruser WHERE region = 'Шымкент' AND status='1'");
                                while ($data28 = mysqli_fetch_array($result28)) { ?> '<?= $data28['adress']; ?>': '<?= $data28['adress']; ?>',
                                <? } ?>
                              },

                            };

                            // Включаем синхронизацию связанных списков
                            syncList1.sync("List1", "List2", "List3");
                          </script>



                          <input type="text" name="id" value="<?=$id;?>" hidden="hidden">
                          <input type="submit" value="Переводить сотрдуника" name="UserUpdate" class="btn btn-danger">
                          </form>
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
