<?php

include("../../bd.php");
if ($_SESSION['logged_user']->status == 3) :
  include "header.php";
  include "menu.php";

	$data = R::getAll("SELECT region, COUNT(*) as count , ROUND(AVG(srok)) as srok,SUM(summa_vydachy) FROM tickets GROUP BY srok  ORDER BY SUM(summa_vydachy)   DESC ");
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Отчет за ОКТЯБРЬ 2021
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
            </div>
            <div class="box-body table-responsive">
              <div class="">
		
                <table class="table table-bordered text-center" id='table-export'>
                  <!--  -->
                  <!-- datatable-tabletools  -->
                  <thead>
                <tr class="danger">
					<td>
						Количество
					</td>
						<td>
					Срок
					</td>
						<td>
							Сумма выдачи
					</td>
						<td>
							Регион
					</td>
					  </tr>
                  </thead>
                  <tbody>
					   <tr>
					<? foreach($data as $k){?>
					<td>
						<?=$k["count"]?>
					</td>
						   	<td>
						<?=$k["srok"]?>
					</td>
						   	<td>
						<?=$k["SUM(summa_vydachy)"]?>
					</td>
						   	<td>
						<?=$k["region"]?>
					</td>
                    </tr>
					  <?}?>
                  </tbody>
                </table>
              </div>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section>
  </div>
<?
  include "footer.php";
else :
  header('Location: /');
endif; ?>