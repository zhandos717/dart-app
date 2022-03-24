   <?
    include_once '../../../bd.php';
   $table = 'tickets';
   $data = R::load($table,$_POST['id']);
   
   ?>

   <div class="box">
       <div class="box-body">
           <table class="table table-bordered">
               <tr>
                   <th style="width: 10px">#</th>
                   <th>Параметры</th>
                   <th>Значение</th>
               </tr>
               <tr>
                   <td>1.</td>
                   <td>Ф.И.О</td>
                   <td>
                       <?= $data['fio'] ?>
                   </td>
               </tr>
               <tr>
                   <td>2.</td>
                   <td>ИИН</td>
                   <td>
                       <?= $data['iin'] ?>
                   </td>
               </tr>
               <tr>
                   <td>3.</td>
                   <td>Дата рождения</td>
                   <td>
                       <?= date('d.m.Y', strtotime($data['date_r'])) ?>
                   </td>
               </tr>
               <tr>
                   <td>4.</td>
                   <td>Номер документа</td>
                   <td>
                       <?= $data['numberdocs'] ?>
                   </td>
               </tr>
               <tr>
                   <td>5.</td>
                   <td>Дата выдачи</td>
                   <td>
                       <?= $data['date_vyd'] ?>
                   </td>
               </tr>
               <tr>
                   <td>6.</td>
                   <td>Кем выдан</td>
                   <td>
                       <?= $data['kemvydan'] ?>
                   </td>
               </tr>
               <tr>
                   <td>7.</td>
                   <td>Номер телефона</td>
                   <td>
                       <?= $data['phones'] ?>
                   </td>
               </tr>
           </table>
       </div><!-- /.box-body -->
   </div><!-- /.box -->