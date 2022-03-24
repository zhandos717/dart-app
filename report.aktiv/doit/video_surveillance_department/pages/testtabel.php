<?
include "pages/layouts/header.php";

$data1 = date('Y-m-d');
$result_region = mysqli_query($connect, "SELECT region FROM cardlc GROUP BY region");
$result_adress = mysqli_query($connect, "SELECT adress FROM cardlc GROUP BY adress");
$result_doljnost = mysqli_query($connect, "SELECT doljnost FROM cardlc GROUP BY doljnost");
?>
<script>
function syncList(){}
syncList.prototype.sync = function()
{
for (var i=0; i < arguments.length-1; i++)	document.getElementById(arguments[i]).onchange = (function (o,id1,id2){return function(){o._sync(id1,id2);};})(this, arguments[i], arguments[i+1]);
document.getElementById(arguments[0]).onchange();
}
syncList.prototype._sync = function (firstSelectId, secondSelectId)
{
var firstSelect = document.getElementById(firstSelectId);
var secondSelect = document.getElementById(secondSelectId);

secondSelect.length = 0;

if (firstSelect.length>0)
{
    var optionData = this.dataList[ firstSelect.options[firstSelect.selectedIndex==-1 ? 0 : firstSelect.selectedIndex].value ];
  for (var key in optionData || null) secondSelect.options[secondSelect.length] = new Option(optionData[key], key);

  if (firstSelect.selectedIndex == -1) setTimeout( function(){ firstSelect.options[0].selected = true;}, 1 );
  if (secondSelect.length>0) setTimeout( function(){ secondSelect.options[0].selected = true;}, 1 );
}
secondSelect.onchange && secondSelect.onchange();
};
</script>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Отметка сотдрудников
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
      <li><a href="index.php">Регионы</a></li>
      <li class="active">Филиалы</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">

      <div class="col-md-12">
        <div class="box box-primary">

          <div class="box-body">
            <form action="" id="report" method="POST">
              <div class="col-lg-2 col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-bank"></i>
                  </span>

                  <select id="List1" class="form-control mb-3" name="city" required="required">
                    <option value="">Выберите город</option>
                    <? while($data_region = mysqli_fetch_array($result_region))
                          {
                            $region = $data_region['region'];
                            ?>
                            <option value="<?=$region;?>"><?=$region;?></option>
                          <?}?>
                  </select>
                </div>
              </div>

              <div class="col-lg-2 col-md-4">
                <div class="input-group">
                  <span class="input-group-addon">
                    <i class="fa fa-tag"></i>
                  </span>
                  <select class="form-control" name="adress" id="List2"></select>

                </div>
              </div>
              <script type="text/javascript">
              // Создаем новый объект связанных списков
              var syncList1 = new syncList;

              // Определяем значения подчиненных списков (2 и 3 селектов)
              syncList1.dataList = {

                'Нур-Султан':{

           <?
           $result_adresspg = mysqli_query($connect, "SELECT adress FROM cardlc WHERE region = 'Нур-Султан'  GROUP BY adress");
           while($data_adresspg = mysqli_fetch_array($result_adresspg))
              	{?>
                    '<?=$data_adresspg['adress'];?>':'<?=$data_adresspg['adress'];?>',
              <?}?>

              },

              'Алматы':{

              <?
              $result_adresspg = mysqli_query($connect, "SELECT adress FROM cardlc WHERE region = 'Алматы'  GROUP BY adress");
              while($data_adresspg = mysqli_fetch_array($result_adresspg))
              {?>
                  '<?=$data_adresspg['adress'];?>':'<?=$data_adresspg['adress'];?>',
              <?}?>
              },

              };

              // Включаем синхронизацию связанных списков
              syncList1.sync("List1","List2","List3");
              </script>
              <div class="input-group input-group-sm">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-info">Подтвердить!</button>
                </span>
              </div>
            </form>
          </div>
          <!--.box-body -->
        </div>
        <!--.box -->
      </div>
      <!--.col-md-12 -->
      <!--------------------------------------------------------------------------->
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <h3 class="box-title"> </h3>
          </div><!-- /.box-header -->
          <div class="box-body">
            <div class="answer">
              asdasdf
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box box-primary -->
      </div><!-- /.col-md-6 -->
      <!--------------------------------------------------------------------------->
    </div><!-- /.content-wrapper -->
  </section>
</div>

<? include "pages/layouts/footer.php"; ?>
