<?
include_once '../../../bd.php';
include __DIR__. '/../../layouts/header.php';
include __DIR__ . '/../../layouts/menu/video_surveillance.php';

  ?>
    <div class="content-wrapper">

    <section class="content-header">
      <h1>
        Виды штрафов
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
        <li><a href="index.php">Регионы</a></li>
        <li class="active">Виды штрафов</li>
      </ol>
    </section>


      <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">

              <div class="box-body">
                <div class="table-responsive">
                  <!-- <table class="table table-bordered table-hover table-striped"> -->
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>№</th>
                        <th>Наименование штрафа</th>
                        <th>Сумма штрафа</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?
                       $result = mysqli_query($connect, "SELECT * FROM fines");
                        while ( $data = mysqli_fetch_array($result))

                              {?>
                      <tr>
                        <td><?=$data['id'];?></td>
                        <td><?=$data['name'];?></td>
                        <td><?=$data['price'];?></td>
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
