<?
              function num2str($num)
              {
                  $nul = 'ноль';
                  $ten = array(
                      array('', 'один', 'два', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
                      array('', 'одна', 'две', 'три', 'четыре', 'пять', 'шесть', 'семь', 'восемь', 'девять'),
                  );
                  $a20 = array('десять', 'одиннадцать', 'двенадцать', 'тринадцать', 'четырнадцать', 'пятнадцать', 'шестнадцать', 'семнадцать', 'восемнадцать', 'девятнадцать');
                  $tens = array(2 => 'двадцать', 'тридцать', 'сорок', 'пятьдесят', 'шестьдесят', 'семьдесят', 'восемьдесят', 'девяносто');
                  $hundred = array('', 'сто', 'двести', 'триста', 'четыреста', 'пятьсот', 'шестьсот', 'семьсот', 'восемьсот', 'девятьсот');
                  $unit = array( // Units
                      array('тиын', 'тиын', 'тиын',     1),
                      array('тенге', 'тенге', 'тенге', 0),
                      array('тысяча', 'тысячи', 'тысяч', 1),
                      array('миллион', 'миллиона', 'миллионов', 0),
                      array('миллиард', 'милиарда', 'миллиардов', 0),
                  );
                  //
                  list($rub, $kop) = explode('.', sprintf("%015.2f", floatval($num)));
                  $out = array();
                  if (intval($rub) > 0) {
                      foreach (str_split($rub, 3) as $uk => $v) { // by 3 symbols
                          if (!intval($v)) continue;
                          $uk = sizeof($unit) - $uk - 1; // unit key
                          $gender = $unit[$uk][3];
                          list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));
                          // mega-logic
                          $out[] = $hundred[$i1]; # 1xx-9xx
                          if ($i2 > 1) $out[] = $tens[$i2] . ' ' . $ten[$gender][$i3]; # 20-99
                          else $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
                          // units without rub & kop
                          if ($uk > 1) $out[] = morph($v, $unit[$uk][0], $unit[$uk][1], $unit[$uk][2]);
                      } //foreach
                  } else $out[] = $nul;
                  $out[] = morph(intval($rub), $unit[1][0], $unit[1][1], $unit[1][2]); // rub
                  $out[] = $kop . ' ' . morph($kop, $unit[0][0], $unit[0][1], $unit[0][2]); // kop
                  return trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));
              }
              /**
               * Склоняем слово форму
               * @ author ngb
               */
              function morph($n, $f1, $f2, $f5)
              {
                  $n = abs(intval($n)) % 100;
                  if ($n > 10 && $n < 20) return $f5;
                  $n = $n % 10;
                  if ($n > 1 && $n < 5) return $f2;
                  if ($n == 1) return $f1;
                  return $f5;
              }
    ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>База данных клиентов </h1>
    <!-- <ol class="breadcrumb">
          <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
          <li><a href="index.php">Регионы</a></li>
          <li class="active">Филиалы</li>
        </ol> -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <!--<div class="box-header">
                  <h3 class="box-title">Проторгованные товары123</h3>
                </div> /.box-header -->
          <div class="col-xs-12">
          </div>
          <div class="box-body">
            <div class="table-responsive">
              <table id="example" class="table table-bordered">
                <thead>
                  <tr class="info">
                    <th>Адрес</th>
                    <th>Номер договора</th>
                    <th>Ф.И.О клиента</th>
                    <th>Номер телефона</th>
                    <th>Наименование</th>
                    <th>Сумма выдачи</th>
                    <th>Дата выдачи</th>
                    <th>Срок</th>
                    <th>Дата выкупа</th>
                    <th>Сумма продажи</th>
                  </tr>
                </thead>
                <tbody>
                  <?$row = R::load('tickets', $_GET['id']); ?>
                  <tr>
                    <?if(!empty($row['nomerzb'])):?>
                    <td><?= $row['region']; ?> / <?= $row['adressfil']; ?> </td>
                    <td><?= $row['nomerzb']; ?></td>
                    <td><?= $row['fio']; ?> <br> ИИН: <?= $row['iin']; ?> </td>
                    <td><?= $row['phones']; ?></td>
                    <td><?= $row['type']; ?> <?= $row['category']; ?> <?= $row['tovarname']; ?></td>
                    <td><?= $row['summa_vydachy']; ?></td>
                    <td><?= date('d.m.Y', strtotime($row['dataseg'])); ?></td>
                    <td><?= $row['srok']; ?></td>
                    <td><?= date('d.m.Y', strtotime($row['dv'])); ?></td>
                    <td class="success"><?= number_format($row['cena_pr'], 0, '.', ' '); ?> тг.</td>
                    <?else:?>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-center">
                      Данных нет!
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <?endif;?>
                  </tr>
                </tbody>
              </table>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col-md-6 -->
    </div><!-- /.row -->
    <div class="row">
      <div class="col-md-6">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">График изменения цены на товар </h3>

            <div class="box-tools">

            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body table-responsive">
            <table class="table table-hover" id="example3">
              <thead>
                <tr>
                  <th>№</th>
                  <th>Дата</th>
                  <th>Цена товара</th>
                </tr>
              </thead>
              <tbody>
                <?
                $i = 1;
                $d = 1;
                $a = 1;
                $seg = $row['dataseg'];
                $day = $row['srok'];
                while ($i <= $day){
                  ?>
                <tr>
                  <td style="text-align:center;"><?= $i++; ?>.</td>
                  <td style="text-align:center;">
                    <?   $date = date_create($seg);
                      date_modify($date, $d++.'day');
                      $yesterday= date_format($date, 'd.m.Y'); ?>
                    <?= $yesterday; ?>
                  </td>
                  <td style="padding-left:10px;">
                    <? $summ_dolga = $row['summa_vydachy'] + ($row['summa_vydachy']*(0.04+(($a++)/100)));
                      echo number_format($summ_dolga, 0, '.', ' ');?> тенге
                    (<?= num2str($summ_dolga); ?>)
                  </td>
                </tr>
                <?}?>
              </tbody>
            </table>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <div class="col-md-6">
        <!-- DIRECT CHAT PRIMARY -->
        <div class="box box-primary direct-chat direct-chat-primary">
          <div class="box-header with-border">
            <h3 class="box-title">Коментарии по клиенту </h3>
            <? $messages = R::count( 'coment', 'nomerzb=?',[ $row['nomerzb'] ] ); ?>
            <div class="box-tools pull-right">
              <span data-toggle="tooltip" title="<?= $messages; ?>  сообщении" class="badge bg-light-blue"><?= $messages; ?></span>
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>

              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <?if($_SESSION['error']):?>
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              <h4><i class="icon fa fa-ban"></i> Ошибка!</h4>
              <?= $_SESSION['error'] ?>
            </div>
            <?endif;unset($_SESSION['error']);?>
            <!-- Conversations are loaded here -->
            <div class="direct-chat-messages">
              <!-- Message. Default to the left -->
              <?
                $coments= R::findAll('coment', 'iin=?',[ $row['iin'] ] );
                  foreach ($coments as $coment):

                  if($coment->userid != $_SESSION['logged_user']->id):?>
              <div class="direct-chat-msg">
                <div class="direct-chat-info clearfix">
                  <span class="direct-chat-name pull-left"><?= $coment->user; ?></span>
                  <span class="direct-chat-timestamp pull-right"><?= date('d.m.Y H:i:s', strtotime($coment['datetime'])); ?></span>
                </div>
                <!-- /.direct-chat-info -->
                <img class="direct-chat-img" src="../adm/dist/img/avatar5.png" alt="Message User Image"><!-- /.direct-chat-img -->
                <div class="direct-chat-text">
                  <?= $coment->message; ?>
                </div>
                <!-- /.direct-chat-text -->
              </div>
              <!-- /.direct-chat-msg -->
              <?else:?>
              <!-- Message to the right -->
              <div class="direct-chat-msg right">
                <div class="direct-chat-info clearfix">
                  <span class="direct-chat-name pull-right"><?= $coment->user; ?></span>
                  <span class="direct-chat-timestamp pull-left"><?= date('d.m.Y H:i:s', strtotime($coment['datetime'])); ?></span>
                </div>
                <!-- /.direct-chat-info -->
                <img class="direct-chat-img" src="../adm/dist/img/avatar5.png" alt="Message User Image"><!-- /.direct-chat-img -->
                <div class="direct-chat-text" data-toggle="tooltip" title="коментарии к договору №<?= $coment->nomerzb; ?>">
                  Обращение: <?= $coment->appeal; ?> <br>
                  Суть разговора: <?= $coment->conversation; ?> <br>
                  <?= $coment->message; ?>
                </div>
                <!-- /.direct-chat-text -->
              </div>
              <!-- /.direct-chat-msg -->
              <?endif;
                endforeach;?>
            </div>
            <!--/.direct-chat-messages-->
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <form action="functions/add_coment.php" method="post">
              <input type="text" hidden name="nomerzb" value="<?= $row['nomerzb']; ?>">
              <input type="text" hidden name="iin" value="<?= $row['iin']; ?>">
              <input type="text" hidden name="id" value="<?= $_GET['id']; ?>">
              <div class="row">
                <div class="input-group">
                  <div class="col-md-6">
                    <label for="appeal"> Обращение </label>
                    <select name="appeal" id="appeal" class="form-control">
                      <option>Входяший ЗВ</option>
                      <option>Исходящий ЗВ</option>
                      <option>WhatsApp</option>
                      <option>Telegram</option>
                      <option>Instagram</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label for="conversation"> Суть разговора </label>
                    <select name="conversation" id="conversation" class="form-control">
                      <option>Способ получения займа</option>
                      <option>Способ выкупа</option>
                      <option>Информация по займу</option>
                      <option>Продление</option>
                      <option>Консультация</option>
                    </select>
                  </div>
                </div>
              </div>
              <br>
              <div class="input-group">
                <input type="text" name="message" required placeholder="Введите сообщение ..." class="form-control">
                <span class="input-group-btn">
                  <button type="submit" class="btn btn-primary btn-flat">Отправить</button>
                </span>
              </div>
            </form>
          </div>
          <!-- /.box-footer-->
        </div>
        <!--/.direct-chat -->
      </div>
    </div>
    <!-- /.col -->
  </section>
</div><!-- /.content-wrapper -->