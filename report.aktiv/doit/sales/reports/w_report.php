    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">

        <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li><a href="index.php">Регионы</a></li>
          <li class="active">Филиалы</li>
        </ol>
        <br>
      </section>
      <!-- Main content -->
      <section class="content">
        <?if(!empty($res)){?>
        <!-- если товары есть показываем их  -->
        <div class="row">
          <div class="col-lg-12">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h4>У вас
                  <?= $res['count']; ?> ед. товара находятся более 10 дней на реализации
                </h4>
                <h3>На общую сумму <?= number_format($res['SUM(cena_pr)'], 0, '.', ' '); ?> тг</h3>
              </div>
              <div class="icon">
                <i class="fa fa-warning"></i>
              </div>
              <a href="a_report.php?id=7" class="small-box-footer"> <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div><!-- ./col -->
        </div><!-- /.row -->
        <?}?>
        <div class="row">
          <!--------------------------------------------------------------------------->
          <div class="col-md-12">
            <div class="box box-primary">
              <!--<div class="box-header">
                <h3 class="box-title"><b></b></h3>
              </div> /.box-header -->
              <div class="box-body">
                <div class="">
                  <!--table-responsive-->
                  <table class="table table-hover table-bordered" id="example1">
                    <thead>
                      <tr class="bg-olive">
                        <th>№</th>
                        <th>Код товара</th>
                        <th>Адрес</th>
                        <th>Описание</th>
                        <th>Дата поступлния в магазин</th>
                        <th>Сумма прихода</th>
                        <th>Сумма продажи</th>
                        <th>Срок на продаже</th>
                      </tr>
                    </thead>
                    <tbody>
                      <? $data = R::findLike('tickets',['status' =>[7,10,14,15], 'region'=>[$region2,$region] ],'ORDER BY dv ASC');
                         $i = 1;
                         foreach($data as $param){
                         $day = (int) round((strtotime(date('Y-m-d')) - strtotime($param['dv'])) / (60 * 60 * 24));
                        if($day >= 10){$color = 'danger'; $color1 = 'red'; $count3 += 1;}
                      ?>
                      <tr class="<?= $color; ?>">
                        <td> <?= $i++; ?>.</td>
                        <td> <?= $param['nomerzb']; ?></td>
                        <td> <?= $param['region']; ?>-<?= $param['adressfil']; ?></td>
                        <td>
                          <? echo $param['type'] .'  '. $param['category'] .'  '. $param['tovarname'] .'  '. $param['opisanie'] .'  '. $param['hdd']; ?>
                        </td>
                        <td> <?= date('d.m.Y', strtotime($param['dv'])); ?></td>
                        <td> <?= $param['summa_vydachy']; ?></td>
                        <td> <?= $param['cena_pr']; ?></td>
                        <td>
                          <span class="badge bg-<?= $color1; ?>">
                            <? echo $day; unset($color,$color1);?>
                          </span>
                        </td>
                      </tr>
                      <?}?>
                    </tbody>
                    </tfoot>
                  </table>
                </div><!-- /.table-responsive -->
              </div><!-- /.box-body -->
            </div><!-- /.box box-primary -->
            <!--------------------------------------------------------------------------->
          </div>
      </section>
    </div><!-- /.content-wrapper -->