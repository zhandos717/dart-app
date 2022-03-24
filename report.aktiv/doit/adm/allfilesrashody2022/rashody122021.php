<?php
include("../../../bd.php");
if ($status == 3) :
  include "header.php";
  include "menu.php";
  $s = $_GET["s"];
?>
  <script type="text/javascript" src="linkedselect.js"></script>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Расходы за ДЕКАБРЬ 2021 год
      </h1>
    </section>
    <!-- Main content -->
    <section class="content" id="app">

      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Расходы филиалов</h3>
            </div>
            <div class="box-body">
              <table id="datatable-tabletools" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Регион</th>
                    <!-- <th>Филиал</th> -->
                    <th>Расход Филиала</th>
                    <th>Дата расхода</th>
                    <th>Примечение</th>
                  </tr>
                </thead>
                <tbody>
                  <? $result = mysqli_query($connect, "SELECT region, comments, datarashoda, SUM(summarf)  AS summarf FROM rashodfillial122021 GROUP BY comments ");
                  while ($data = mysqli_fetch_array($result)) { ?>
                    <tr>
                      <td><?= $data['region']; ?></td>
                      <!-- <td><?= $data['adress']; ?></td> -->
                      <td><?= number_format(round($data['summarf'], 2), 0, '.', ' '); ?>
                      </td>
                      <td><?= date("d.m.Y", strtotime($data['datarashoda'])); ?></td>
                      <td><?= $data['comments']; ?></td>
                    </tr>
                  <? } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>


  </div>

<?
  include "footer.php";
else :
  header('Location: /');
endif; ?>
