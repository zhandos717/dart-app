<? include_once  '../../../bd.php';
    
    if($_POST['report']>=1){

        if(empty($_POST['region'])){
  
           switch ($_POST['report']) {
                case 1:
                    $table = "productreport";
                    $sql = "datereg BETWEEN :date1 AND :date2";
                    $placeholder = [':date1'=>$_POST['date1'],':date2'=>$_POST['date2'] ];
                break;
                case 2:
                     $table = 'tickets';
                    $sql = 'NOT status = 11 AND  dataseg BETWEEN :date1 AND :date2';
                    $placeholder = [':date1'=>$_POST['date1'],':date2'=>$_POST['date2'] ];
                    break;
                case 4:
                     $table = 'tickets';
                    $sql = 'NOT status = 11 AND  datavykup BETWEEN :date1 AND :date2';
                    $placeholder = [':date1'=>$_POST['date1'],':date2'=>$_POST['date2'] ];
                    break;
                case 5:
                    $table = 'tickets';
                    $sql = "status =:status AND datesale BETWEEN :date1 AND :date2";
                    $placeholder = [':date1'=>$_POST['date1'],':status'=>$_POST['report'],':date2'=>$_POST['date2'] ];
                break;
                case 6:
                    $table = 'salecomision';
                    $sql = 'dataa BETWEEN :date1 AND :date2';
                    $placeholder = [':date1'=>$_POST['date1'],':date2'=>$_POST['date2'] ];
                break;  
                 case 7:
                    $table = 'sales12';
                    $sql = 'data BETWEEN :date1 AND :date2';
                    $placeholder = [':date1'=>$_POST['date1'],':date2'=>$_POST['date2'] ];
                    break;
            };
        }else{
             switch ($_POST['report']) {
                case 1:
                    $table = "productreport";
                    $sql = "region = :region AND adress = :filial AND datereg BETWEEN :date1 AND :date2";
                    $placeholder = [':filial'=>$_POST['filial'],':region'=>$_POST['region'],':date1'=>$_POST['date1'],':date2'=>$_POST['date2'] ];
                break;
                case 2:
                case 4:
                case 5:
                    $table = 'tickets';
                    if($_POST['report'] == 2){
                        $sql = 'NOT status = 11 AND salecomision IS NULL AND region = :region AND adressfil = :filial  AND dataseg BETWEEN :date1 AND :date2';
                        $placeholder = [':filial'=>$_POST['filial'],':region'=>$_POST['region'],':date1'=>$_POST['date1'],':date2'=>$_POST['date2'] ];
                    }else {
                        if($_POST['report'] == 4) $value = 'datavykup';
                        else $value = 'datesale';   
                        $sql = "status =:status AND salecomision IS NULL AND region = :region AND adressfil = :filial  AND $value  BETWEEN :date1 AND :date2";
                        $placeholder = [':filial'=>$_POST['filial'],':status'=>$_POST['report'],':region'=>$_POST['region'],':date1'=>$_POST['date1'],':date2'=>$_POST['date2'] ];
                    };
                break;
                case 6:
                    $table = 'salecomision';
                    $sql = 'region = :region AND filial = :filial  AND dataa BETWEEN :date1 AND :date2';
                    $placeholder = [':filial'=>$_POST['filial'],':region'=>$_POST['region'],':date1'=>$_POST['date1'],':date2'=>$_POST['date2'] ];
                break;
                case 7:
                       if($_POST['region'] == 'Нур-Султан'){
                                $_POST['region'] = 'Астана';
                            }
                    $table = 'sales12';
                    $sql = 'statustovar IS NULL AND region = :region AND adress = :filial AND data BETWEEN :date1 AND :date2';
                    $placeholder = [':filial'=>$_POST['filial'],':region'=>$_POST['region'],':date1'=>$_POST['date1'],':date2'=>$_POST['date2'] ];
                    break;
                case 8:
                if($_POST['region'] == 'Нур-Султан'){
                                $_POST['region'] = 'Астана';
                            }
                    $table = 'sales';
                    $sql = 'statustovar IS NULL AND region = :region AND adress = :filial AND data BETWEEN :date1 AND :date2';
                    $placeholder = [':filial'=>$_POST['filial'],':region'=>$_POST['region'],':date1'=>$_POST['date1'],':date2'=>$_POST['date2'] ];
                    break;
            };
        };
    
        $data = R::find($table,$sql,$placeholder);
    };
//var_dump($data); 
if($_POST['report'] ==1){ ?>
<table class="table table-bordered" id="datatable-tabletools">
    <thead>
        <tr>
            <th>id
            </th>
            <th>id_product
            </th>
            <th>datereport
            </th>
            <th>datereg
            </th>
            <th>user
            </th>
            <th>category
            </th>
            <th>name
            </th>
            <th>price
            </th>
            <th>pribl
            </th>
            <th>counttovar
            </th>
            <th>purchaseamount
            </th>
            <th>region
            </th>
            <th>buyer
            </th>
            <th>buyeriin
            </th>
            <th>buyertel
            </th>
            <th>saler
            </th>
            <th>adress
            </th>
            <th>kassa
            </th>
            <th>salerstatus
            </th>
        </tr>
    </thead>
    <tbody>
        <?foreach ($data as $value) {?>
        <tr>
            <th>
                <?= $value['id']; ?>
            </th>
            <th><?= $value['id_product']; ?></th>
            <th><?= date('d.m.Y H:i:s', strtotime($value['datereport'])); ?></th>
            <th><?= date('d.m.Y', strtotime($value['datereg'])); ?></th>
            <th><?= $value['user']; ?></th>
            <th><?= $value['category']; ?></th>
            <th><?= $value['name']; ?></th>
            <th><?= $value['price']; ?></th>
            <th><?= $value['price'] - $value['purchaseamount']; ?></th>
            <th><?= $value['counttovar']; ?></th>
            <th><?= $value['purchaseamount']; ?></th>
            <th><?= $value['region']; ?></th>
            <th><?= $value['buyer']; ?></th>
            <th><?= $value['buyeriin']; ?></th>
            <th><?= $value['buyertel']; ?></th>
            <th><?= $value['saler']; ?></th>
            <th><?= $value['adress']; ?></th>
            <th><?= $value['kassa']; ?></th>
            <th><?= $value['salerstatus']; ?></th>
        </tr>
        <?}?>
    </tbody>
</table>
<?}elseif($_POST['report'] ==2 OR $_POST['report'] == 4 OR $_POST['report'] ==5){?>
<table class="table table-bordered" id="datatable-tabletools">
    <thead>
        <tr>
            <th>id
            </th>
            <th>ip
            </th>
            <th>nomerdoc
            </th>
            <th>nomerzb
            </th>
            <th>region
            </th>
            <th>adressfil
            </th>
            <th>kassa
            </th>
            <th>eo
            </th>
            <th>iin
            </th>
            <th>fio
            </th>
            <th>numberdocs
            </th>
            <th>date_vyd
            </th>
            <th>kemvydan
            </th>
            <th>date_r
            </th>
            <th>phones
            </th>
            <th>adress
            </th>
            <th>type

            </th>
            <th>category
            </th>
            <th>
                tovarname
            </th>
            <th>
                hdd
            </th>
            <th>
                upakovka
            </th>
            <th>
                ekran
            </th>
            <th>
                korpus
            </th>
            <th>
                opisanie
            </th>
            <th>
                srok
            </th>
            <th>
                sn
            </th>
            <th>
                imei
            </th>
            <th>
                sostoyanie_bu
            </th>
            <th>
                complect
            </th>
            <th>
                ocenka
            </th>
            <th>
                summa_vydachy
            </th>
            <th>
                status
            </th>
            <th>
                p1
            </th>
            <th>
                n08
            </th>
            <th>
                proczasutki
            </th>
            <th>
                obshproczasutki
            </th>
            <th>
                reg_data
            </th>
            <th>
                dataseg
            </th>
            <th>dv
            </th>
            <th>reg_hi
            </th>
            <th>cena_pr
            </th>
            <th>profit
            </th>
            <th>
                comment
            </th>
            <th>
                data_pos
            </th>
            <th>dateshop
            </th>
            <th>datesale
            </th>
            <th>saler
            </th>
            <th>salerstatus
            </th>
            <th>datavykup
            </th>
            <th>proc
            </th>
            <th>statusremont
            </th>
            <th>dateremont
            </th>
            <th>
                remontmessage
            </th>
            <th>dataatime
            </th>
            <th>salerkassa
            </th>
            <th>zadatok
            </th>
            <th>datazadatok
            </th>
            <th>residualvalu
            </th>
            <th>cena_update
            </th>
            <th>cena_updateuser
            </th>
            <th>cena_ip
            </th>
            <th>cena_old
            </th>
            <th>dom
            </th>
            <th>kvartira
            </th>
        </tr>
    </thead>
    <tbody>
        <?foreach ($data as $value) {?>
        <tr>
            <th><?= $value['id']; ?></th>
            <th><?= $value['ip']; ?></th>
            <th><?= $value['nomerdoc']; ?></th>
            <th><?= $value['nomerzb']; ?></th>
            <th><?= $value['region']; ?></th>
            <th><?= $value['adressfil']; ?></th>
            <th><?= $value['kassa']; ?></th>
            <th><?= $value['eo']; ?></th>
            <th><?= $value['iin']; ?></th>
            <th><?= $value['fio']; ?></th>
            <th><?= $value['numberdocs']; ?></th>
            <th><?= date('d.m.Y', strtotime($value['date_vyd'])); ?> </th>
            <th><?= $value['kemvydan']; ?></th>
            <th><?= date('d.m.Y', strtotime($value['date_r'])); ?> </th>
            <th><?= $value['phones']; ?></th>
            <th><?= $value['adress']; ?></th>
            <th><?= $value['type']; ?></th>
            <th><?= $value['category']; ?></th>
            <th><?= $value['tovarname']; ?></th>
            <th><?= $value['hdd']; ?></th>
            <th><?= $value['upakovka']; ?></th>
            <th><?= $value['korpus']; ?></th>
            <th><?= $value['ekran']; ?></th>
            <th><?= $value['opisanie']; ?></th>
            <th><?= $value['srok']; ?></th>
            <th><?= $value['sn']; ?></th>
            <th><?= $value['imei']; ?></th>
            <th><?= $value['sostoyanie_bu']; ?></th>
            <th><?= $value['complect']; ?></th>
            <th><?= $value['ocenka']; ?></th>
            <th><?= $value['summa_vydachy']; ?></th>
            <th><?= $value['status']; ?></th>
            <th><?= $value['p1']; ?></th>
            <th><?= $value['n08']; ?></th>
            <th><?= $value['proczasutki']; ?></th>
            <th><?= $value['obshproczasutki']; ?></th>
            <th><?= date('d.m.Y', strtotime($value['reg_data'])); ?></th>
            <th><?= date('d.m.Y', strtotime($value['dataseg'])); ?></th>
            <th><?= date('d.m.Y', strtotime($value['dv'])); ?></th>
            <th><?= $value['reg_hi']; ?></th>
            <th><?= $value['cena_pr']; ?></th>
            <th><?= $value['profit']; ?></th>
            <th><?= $value['comment']; ?></th>
            <th><?= date('d.m.Y', strtotime($value['data_pos'])); ?></th>
            <th><?= date('d.m.Y', strtotime($value['dateshop'])); ?> </th>
            <th><?= date('d.m.Y', strtotime($value['datesale'])); ?> </th>
            <th><?= $value['saler']; ?></th>
            <th><?= $value['salerstatus']; ?></th>
            <th>
                <?if(!empty($value['datavykup'])){echo date('d.m.Y', strtotime($value['datavykup']));}  ?>
            </th>
            <th><?= $value['proc']; ?></th>
            <th><?= $value['statusremont']; ?></th>
            <th><?= $value['dateremont']; ?></th>
            <th><?= $value['remontmessage']; ?></th>
            <th><?= date('d.m.Y H:i:s', strtotime($value['dataatime'])); ?> </th>
            <th><?= $value['salerkassa']; ?></th>
            <th><?= $value['zadatok']; ?></th>
            <th><?= $value['datazadatok']; ?></th>
            <th><?= $value['residualvalu']; ?></th>
            <th><?= date('d.m.Y H:i:s', strtotime($value['cena_update'])); ?></th>
            <th><?= $value['cena_updateuser']; ?></th>
            <th><?= $value['cena_ip']; ?></th>
            <th><?= $value['cena_old']; ?></th>
            <th><?= $value['dom']; ?></th>
            <th><?= $value['kvartira']; ?></th>
        </tr>
        <?}?>
    </tbody>
</table>
<?}elseif($_POST['report'] ==6){?>
<table class="table table-bordered" id="datatable-tabletools">
    <thead>
        <tr>
            <th>id</th>
            <th>dataa</th>
            <th>codetovar</th>
            <th>tovarname</th>
            <th>summaprihod </th>
            <th>summareal</th>

            <th>pribl</th>
            <th>saler</th>
            <th>pokupatel</th>
            <th>pokupateliin</th>
            <th>pokupateltel</th>
            <th>kassa</th>
            <th> filial</th>
            <th>region</th>
            <th> regdate</th>
            <th> kassir</th>
            <th> zadatok</th>
        </tr>
    </thead>
    <tbody>

        <?foreach ($data as $value) {?>
        <tr>
            <th><?= $value['id']; ?></th>
            <th> <?= date('d.m.Y', strtotime($value['dataa'])); ?></th>
            <th><?= $value['codetovar']; ?></th>
            <th><?= $value['tovarname']; ?></th>
            <th><?= $value['summaprihod']; ?></th>
            <th><?= $value['summareal']; ?></th>
            <th><?= $value['pribl']; ?></th>
            <th><?= $value['saler']; ?></th>
            <th><?= $value['pokupatel']; ?></th>
            <th><?= $value['pokupateliin']; ?></th>
            <th><?= $value['pokupateltel']; ?></th>
            <th><?= $value['kassa']; ?></th>
            <th><?= $value['filial']; ?></th>
            <th><?= $value['region']; ?></th>
            <th><?= $value['regdate']; ?></th>
            <th><?= $value['kassir']; ?></th>
            <th><?= $value['zadatok']; ?></th>
        </tr>
        <?}?>
    </tbody>
</table>
<?}elseif($_POST['report'] ==7 OR $_POST['report'] == 8){?>
<table class="table table-bordered" id="datatable-tabletools">
    <thead>
        <tr>
            <th>id</th>
            <th>ip</th>
            <th>data</th>
            <th> fio</th>
            <th> region</th>
            <th> adress</th>
            <th> kassa</th>
            <th>codetovar</th>
            <th> tovarname</th>
            <th> summaprihod</th>
            <th>predoplata</th>
            <th> summareal</th>
            <th> pribl</th>
            <th>vid</th>
            <th>saler</th>
            <th> pokupatel</th>
            <th> summazaden </th>
            <th> reg_date</th>
            <th>reg_date2</th>
            <th>reg_date3</th>
            <th> fromtovar</th>
            <th>regionlombard</th>
            <th> adresslombard</th>
            <th> statustovar</th>
        </tr>
    </thead>
    <tbody>

        <?foreach ($data as $value) {?>
        <tr>
            <th><?= $value['id']; ?></th>
            <th><?= $value['ip']; ?></th>
            <th><?= date('d.m.Y', strtotime($value['data'])); ?> </th>
            <th><?= $value['fio']; ?></th>
            <th><?= $value['region']; ?></th>
            <th><?= $value['adress']; ?></th>
            <th><?= $value['kassa']; ?></th>
            <th><?= $value['codetovar']; ?></th>
            <th><?= $value['tovarname']; ?></th>
            <th><?= $value['summaprihod']; ?></th>
            <th><?= $value['predoplata']; ?></th>
            <th><?= $value['summareal']; ?></th>
            <th><?= $value['pribl']; ?></th>
            <th><?= $value['vid']; ?></th>
            <th><?= $value['saler']; ?></th>
            <th><?= $value['pokupatel']; ?></th>
            <th><?= $value['summazaden']; ?></th>
            <th><?= $value['reg_date']; ?> </th>
            <th><?= date('d.m.Y', strtotime($value['reg_date2'])); ?> </th>
            <th><?= date('H:i:s', strtotime($value['reg_date3'])); ?> </th>
            <th><?= $value['fromtovar']; ?></th>
            <th><?= $value['regionlombard']; ?></th>
            <th><?= $value['adresslombard']; ?></th>
            <th><?= $value['statustovar']; ?></th>
        </tr>
        <?}?>
    </tbody>


</table>
<?};?>







<script src="plugins/table/dataTables.buttons.min.js"></script>
<script src="plugins/table/jszip.min.js"></script>
<script src="plugins/table/buttons.html5.min.js"></script>
<script src="plugins/table/buttons.print.min.js"></script>
<script src="plugins/table/examples.datatables.tabletools.js"></script>