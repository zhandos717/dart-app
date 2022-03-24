<?php
include("../../bd.php");
if ($status == 3) :
  include "header.php";
  include "menu.php";
  $dataf = $_POST;
      if (isset($dataf['filtr'])) {

        $den1 = $dataf['den1'];
        $den2 = $dataf['den2'];
        $region1 = $dataf['region1'];
        $adress1 = $dataf['adress1'];



        if (!empty($den1) AND !empty($den2) ){

          $resultq = mysqli_query($connect, "SELECT * FROM newrashodfillial
            WHERE
            -- region = '$region1' AND
            -- adress = '$adress1' AND
            datarashoda BETWEEN '$den1' AND '$den2'
             ");
        }


        if (!empty($den1) AND !empty($den2) AND !empty($region1) ){

          $resultq = mysqli_query($connect, "SELECT * FROM newrashodfillial
            WHERE region = '$region1' AND
            -- adress = '$adress1' AND
            datarashoda BETWEEN '$den1' AND '$den2'
             ");
        }

        if (!empty($den1) AND !empty($den2) AND !empty($region1) AND !empty($adress1)){

          $resultq = mysqli_query($connect, "SELECT * FROM newrashodfillial
            WHERE region = '$region1' AND
            adress = '$adress1' AND
            datarashoda BETWEEN '$den1' AND '$den2'
             ");
        }


  }
  ?>
<script type="text/javascript" src="linkedselect.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Расходы
      </h1>
    </section>

    <!-- Main content -->
            <section class="content">
              <div class="row">
                <div class="col-xs-12">

                  <div class="box">
                    <div class="box-header">
                      <h3 class="box-title">Расходы филиалов</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                          <tr>
                            <th>№</th>
                            <th>Регион</th>
                            <th>Филиал</th>
                            <th>Расход Филиала</th>
                            <th>Дата расхода</th>
                            <th>Примечение</th>
                            <th>Изменить</th>
                            <th>Удалить</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?

                          $resultq1 = mysqli_query($connect, "SELECT * FROM rashodfillial ");
                                while ( $dataq1 = mysqli_fetch_array($resultq1)) {
                                  ?>
                          <tr>
                            <td><?=$dataq1['id'];?></td>
                            <td><?=$dataq1['region'];?></td>
                            <td><?=$dataq1['adress'];?></td>
                            <td><?= number_format(round($dataq1['summarf'], 2), 0, '.', ' '); ?>
                            </td>
                            <td><?=date("d.m.Y", strtotime($dataq1['datarashoda']));?></td>
                            <td><?=$dataq1['comments'];?></td>
                            <td>
                              <form class="" action="reRashod.php" method="post">
                                <input type="text" hidden="hidden" name="id" value="<?=$dataq1['id'];?>">
                                <input type="submit" class="btn btn-block btn-primary btn-sm" name="rerashod" value="Изменить">
                              </form>
                              <!-- <a href="reRashod.php?id=<?=$dataq1['id'];?>"> <span class="btn btn-block btn-primary btn-sm">Изменить</span></a>&nbsp; -->
                            </td>
                            <td>
                              <form class="" action="rashody/deleteRashod.php" method="post">
                                <input type="text" hidden="hidden" name="id" value="<?=$dataq1['id'];?>">
                                <input type="submit" class="btn btn-block btn-danger btn-sm" name="rerashod" value="Удалить">
                              </form>
                            </td>
                          </tr>
                          <?}?>
                        </tbody>
                        <!-- <tfoot>
                          <tr>
                            <th>Rendering engine</th>
                            <th>Browser</th>
                            <th>Platform(s)</th>
                            <th>Platform(s)</th>
                          </tr>
                        </tfoot> -->
                      </table>
                    </div><!-- /.box-body -->
                  </div><!-- /.box -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </section><!-- /.content -->

  </div>

<?
  include "footer.php";
else :
  header('Location: /');
endif; ?>
