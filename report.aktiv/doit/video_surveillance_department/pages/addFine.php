<?
include __DIR__ . '/../../layouts/header.php';
include __DIR__ . '/../../layouts/menu/video_surveillance.php';
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Создание штрафов
    </h1>
    
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">

      <div class="col-md-8">
        <div class="box box-primary">

          <div class="box-body">
            <form action="./functions/UpdateANDaddFinesInTabel.php"  method="POST">
              <div class="col-lg-8 col-md-8">
                  <div class="form-group">
                    <label>Дата штрафа</label>
                    <input type="date" name="segdata" class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label>Выберите ФИО кому нужно проставить штраф</label>
                      <select name="id" class="form-control select2" style="width: 100%;">
                        <option>Выберите из списка ФИО(можно набирать...)</option>
                        <?
                          $result = mysqli_query($connect, "SELECT * FROM employeecard");
                            while ( $data = mysqli_fetch_array($result))
                          {?>
                          <option value="<?=$data['id'];?>"><?=$data['fio'];?> / (<?=$data['doljnost'];?>)</option>
                          <?}?>
                      </select>
                  </div>
                  <div class="form-group">
                    <label>Выберите вид штрафа</label>
                      <select name="vidfine" class="form-control select2" style="width: 100%;">
                        <option>Выберите из списка(можно набирать...)</option>
                        <?
                          $result2 = mysqli_query($connect, "SELECT * FROM fines");
                            while ( $data2 = mysqli_fetch_array($result2))
                          {?>
                          <option value="<?=$data2['name'];?>"><?=$data2['name'];?></option>
                          <?}?>
                      </select>
                  </div>
                  <div class="form-group">
                    <label>Сумма штрафа</label>
                    <input type="number" name="price" class="form-control"  required>
                  </div>
                  <input type="submit" class="btn btn-danger" name="gogogo2" value="Подтвердить штраф">
              </div>


            </form>
          </div>
          <!--.box-body -->
        </div>
        <!--.box -->
      </div>
      <!--.col-md-12 -->


      <!--------------------------------------------------------------------------->
    </div><!-- /.content-wrapper -->
  </section>
</div>
<script>
      $(function () {
        $(".select2").select2();
      });
    </script>
<? include __DIR__ . '/../../layouts/footer.php'; ?>
