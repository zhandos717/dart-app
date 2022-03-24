       <?if($_SESSION['logged_user']->root == 1):?>
       <!-- Content Wrapper. Contains page content -->
       <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <section class="content-header">
           <h1>
             Отчет по звонкам
             <a href="index.php?id=3" class="btn btn-primary"> <i class="fa fa-plus"></i> Добавить отчет</a>
             <!-- 
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-default">
                <i class="fa fa-plus"></i> Добавить отчет </button> -->
           </h1>
           <!-- modal -->
           <div class="modal fade" id="modal-default">
             <div class="modal-dialog">
               <div class="modal-content">
                 <div class="modal-header">
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                   <h4 class="modal-title">Добавление данных в отчет по звонкам</h4>
                 </div>
                 <form action="functions/add_coment.php" method="post">
                   <div class="modal-body">
                     <div class="input-group">
                       <span class="input-group-addon"> <i class="fa fa-user"></i> </span>
                       <input type="text" name="officer" class="form-control" list="officer" placeholder="Выберите сотрудника">
                       <datalist id="officer">
                         <option value="Рахат">
                         <option value="Алемгуль">
                         <option value="Ринат">
                         <option value="Дамира">
                         <option value="Назар">
                         <option value="Назира">
                         <option value="Мади">
                         <option value="Алина">
                       </datalist>
                     </div>
                     <br>
                     <div class="row">
                       <div class="col-xs-12 col-sm-6">
                         <div class="input-group">
                           <span class="input-group-addon"> День &#9728; </span>
                           <input type="date" name="day" required class="form-control">
                         </div>
                       </div>
                       <div class="col-xs-12 col-sm-6">
                         <div class="input-group">
                           <span class="input-group-addon"> Ночь &#9790; </span>
                           <input type="date" name="night" required class="form-control">
                         </div>
                       </div>
                     </div>
                     <br>
                     <div class="row">
                       <div class="col-xs-12 col-sm-6">
                         <div class="input-group">
                           <span class="input-group-addon"> <i class="fa fa-phone"></i></span>
                           <input type="number" name="total_day" class="form-control" placeholder="Количество звонков днем">
                         </div>
                       </div>
                       <div class="col-xs-12 col-sm-6">
                         <div class="input-group">
                           <span class="input-group-addon"> <i class="fa fa-phone"></i></span>
                           <input type="number" name="total_night" class="form-control" placeholder="Количество звонков ночью">
                         </div>
                       </div>
                     </div>
                   </div>
                   <div class="modal-footer">
                     <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Закрыть</button>
                     <button type="submit" class="btn btn-primary" name="go_add" value="1">Сохранить</button>
                   </div>
                 </form>
               </div>
               <!-- /.modal-content -->
             </div>
             <!-- /.modal-dialog -->
           </div>
           <!-- /.modal -->
           <ol class="breadcrumb">
             <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
             <li><a href="index.php">Регионы</a></li>
             <li class="active">Филиалы</li>
           </ol>
         </section>
         <!-- Main content -->
         <section class="content">
           <!-- Уведомление  -->
           <?if($_SESSION['error'] OR $_SESSION['message'] ):
          if($_SESSION['error'])
            { 
              $color = 'danger';
              $message = 'Ошибка!';
              $ico = 'ban';
            }
          else
            {
              $color = 'success';
              $message = 'Успех!';
              $ico = 'check';
            };
          ?>
           <div class="alert alert-<?= $color; ?> alert-dismissible">
             <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
             <h4><i class="icon fa fa-<?= $ico; ?>"></i>
               <?= $message; ?>! </h4>
             <?= $_SESSION['error'] ?> <?= $_SESSION['message'] ?>
           </div>
           <?endif;unset($_SESSION['error'], $_SESSION['message']);?>
           <!-- Уведомление  -->
           <div class="row">
             <div class="col-md-12">
               <div class="box box-primary">
                 <div class="box-header">
                   <h3 class="box-title"> Отчет по сотрудникам </h3>
                 </div><!-- /.box-header -->
                 <div class="col-xs-12">
                 </div>
                 <div class="box-body">
                   <div class="table-responsive">
                     <table id="example" class="table table-striped table-bordered">
                       <thead>
                         <tr class="info">
                           <th class="text-center">Дата</th>
                           <th>Оператор 1/Рахат</th>
                           <th>Оператор 2/Алемгуль</th>
                           <th>Оператор 3/Ринат</th>
                           <th>Оператор 4/Айсулу</th>
                           <th>Оператор 5/Назар</th>
                           <th>Оператор 6/Назира</th>
                           <th>Оператор 7/Санжар</th>
                           <th>Оператор 8/Алина</th>
                           <th>ИТОГ</th>
                           <th>Филиалы</th>
                           <th>ИТОГ</th>
                           <th>Действие</th>
                         </tr>
                       </thead>
                       <tbody>
                         <? $tables= R::findAll('callreports',"datereport BETWEEN '$month_start' AND '$month_end'" );
                            foreach ($tables as $table) {
                            $datereport= $table['datereport'];
                          ?>
                         <tr>
                           <td><?= date('d.m.Y', strtotime($datereport)); ?>
                             <?if($table['days'] == 1){echo'<span class="label label-warning">День</span>';}else{echo'<span class="label bg-navy">Ночь</span>';}?>
                           </td>
                           <?$i =1; while($i<=8):?>
                           <td>
                             <? $total = $table['operator'. $i++]; 
                                echo $total;
                                $total1 +=$total;
                              ?>
                             <?endwhile;?>
                           </td>
                           <td class="success">
                             <?= $total1; ?>
                           </td>
                           <td>
                             <?= $table['filial']; ?>
                           </td>
                           <td class="warning">
                             <?echo $total1+$table['filial'];   unset($total1);?>
                           </td>
                           <td style="white-space:nowrap;">
                             <form action="index.php?id=3" method="post" style="display: inline;">
                               <input type="text" name="idx" value="<?= $table['id']; ?>" hidden>
                               <button class="btn btn-warning" title="Редактировать">
                                 <i class="fa fa-pencil"></i>
                               </button>
                             </form>
                             <form action="functions/add_report.php" method="post" style="display: inline;">
                               <input type="text" name="id_delete" value="<?= $table['id']; ?>" hidden>
                               <button class="btn bg-red" title="Удалить" type="submit">
                                 <i class="fa fa-trash"></i>
                               </button>
                             </form>
                           </td>
                         </tr>
                         <?}?>
                       </tbody>
                       <tfoot>
                         <?
                          $result = $pdo->query("SELECT 
                          SUM(operator1),SUM(operator2),SUM(operator3),
                          SUM(operator4),SUM(operator5),SUM(operator6),
                          SUM(operator7),SUM(operator8),SUM(filial)
                          FROM callreports WHERE datereport BETWEEN '$month_start' AND '$month_end' ")->fetch(PDO::FETCH_ASSOC);
                          ?>
                         <tr class="danger">
                           <th>Итого</th>
                           <?$i =1; while($i<=8):?>
                           <td>
                             <? $operator =$result['SUM(operator' . $i++ . ')']; 
                                  echo $operator;
                                  $operator1 += $operator;
                              ?>
                           </td>
                           <?endwhile;?>
                           <td>
                             <?= $operator1; ?>
                           </td>
                           <td><?= $result['SUM(filial)']; ?></td>
                           <td> <?= $operator1 + $result['SUM(filial)']; ?></td>
                           <td></td>
                         </tr>
                       </tfoot>
                     </table>
                   </div>
                 </div><!-- /.box-body -->
               </div><!-- /.box -->
             </div><!-- /.col-md-6 -->
           </div><!-- /.content-wrapper -->
           <div class="row">
             <div class="col-md-6">
               <div class="box box-primary">
                 <!--<div class="box-header">
                    <h3 class="box-title">Отчет по звонкам</h3>
                  </div> /.box-header -->
                 <div class="col-xs-12">
                 </div>
                 <div class="box-body">
                   <div class="table-responsive">
                     <table id="example" class="table table-striped table-bordered">
                       <thead>
                         <tr class="info">
                           <th class="text-center">Дата</th>
                           <th>День</th>
                           <th>Ночь</th>
                           <th>Магазин</th>
                           <th>Филиал</th>
                         </tr>
                       </thead>
                       <tbody>
                         <?
                          $result = $pdo->query("SELECT datereport,
                          SUM(operator1),SUM(operator2),SUM(operator3),
                          SUM(operator4),SUM(operator5),SUM(operator6),
                          SUM(operator7),SUM(operator8),SUM(filial),SUM(shop)
                          FROM callreports WHERE datereport BETWEEN '$month_start' AND '$month_end' GROUP BY datereport")->fetchAll(PDO::FETCH_BOTH);
                          ?>
                         <? foreach ($result as $n): 
                             $datereport = $n['datereport'];
                             $result11 = $pdo->query("SELECT 
                          SUM(operator1),SUM(operator2),SUM(operator3),
                          SUM(operator4),SUM(operator5),SUM(operator6),
                          SUM(operator7),SUM(operator8)
                          FROM callreports WHERE days = '1' AND datereport = '$datereport' AND datereport BETWEEN '$month_start' AND '$month_end' ")->fetch(PDO::FETCH_ASSOC);
                            ?>
                         <tr>
                           <td><?= date('d.m.Y', strtotime($datereport)); ?></td>
                           <td>
                             <?$i =1;$c =1; while($i<=8):?>
                             <?  $op = $result11['SUM(operator' . $i++ . ')'];
                                  $op2 = $n['SUM(operator'.$c++.')']; 
                                  $op3 += $op2-$op;
                                  $op1 += $op;
                              ?>
                             <?endwhile;?>
                             <?echo $op1;  ?>
                           </td>
                           <td>
                             <?= $op3;
                              $op44 += $op3;
                              $op11 += $op1;
                              unset($op3, $op1); ?>
                           </td>
                           <td> <?= $n['SUM(shop)']; ?>
                             <? $sh +=$n['SUM(shop)']; ?>
                           </td>
                           <td> <?= $n['SUM(filial)']; ?>
                             <? $fl +=$n['SUM(filial)']; ?>
                           </td>
                         </tr>
                         <? endforeach;?>
                       </tbody>
                       <tfoot>
                         <tr class="warning">
                           <th>Общее</th>
                           <td>
                             <?= $op11; ?>
                           </td>
                           <td>
                             <?= $op44; ?>
                           </td>
                           <td>
                             <?= $sh; ?>
                           </td>
                           <td> <?= $fl; ?> </td>
                         </tr>
                       </tfoot>
                     </table>
                   </div>
                 </div><!-- /.box-body -->
               </div><!-- /.box -->
             </div><!-- /.col-md-6 -->
             <div class="col-md-6">
               <div class="box box-primary">
                 <!--  <div class="box-header">
                    <h3 class="box-title">Проторгованные товары</h3> -->
                 <!--</div> /.box-header -->
                 <div class="box-body">
                   <div class="table-responsive">
                     <table class="table table-bordered">
                       <thead>
                         <tr class="danger">
                           <th>Дата</th>
                           <th>КЦ</th>
                           <th>Филиалы</th>
                           <th>Общее</th>
                         </tr>
                       </thead>
                       <?
                          $result = $pdo->query("SELECT datereport,
                          SUM(operator1),SUM(operator2),SUM(operator3),
                          SUM(operator4),SUM(operator5),SUM(operator6),
                          SUM(operator7),SUM(operator8),SUM(filial),SUM(shop)
                          FROM callreports WHERE datereport BETWEEN '$month_start' AND '$month_end' GROUP BY datereport")->fetchAll(PDO::FETCH_BOTH);
                          ?>
                       <tbody>
                         <?foreach ($result as $n): ?>
                         <tr>
                           <td><?= date('d.m.Y', strtotime($n['datereport'])); ?></td>
                           <td>
                             <?$i =1;$c =1; while($i<=8):?>
                             <?  $op += $n['SUM(operator'.$i++.')'];?>
                             <?endwhile;?>
                             <?= $op; ?>
                           </td>
                           <td>
                             <?= $n['SUM(filial)']; ?>
                           </td>
                           <td>
                             <?= $n['SUM(filial)'] + $op; ?>
                             <? $op1 +=$op;  unset($op); ?>
                           </td>
                         </tr>
                         <?endforeach;?>
                       </tbody>
                       <tfoot>
                         <tr class="warning">
                           <th>Итого</th>
                           <th><?= $op1; ?></th>
                           <th><?= $fl; ?></th>
                           <th><?= $op1 + $fl; ?></th>
                         </tr>
                       </tfoot>
                     </table>
                   </div>
                 </div><!-- /.box-body -->
               </div><!-- /.box -->
             </div><!-- /.col-md-6 -->
           </div><!-- /.row -->
         </section>
       </div><!-- /.content-wrapper -->
       <?endif;?>