<? include_once '../../bd.php';
if ($_SESSION['logged_user']) :
    if ($_POST['delete_id']) {
        $ticket = R::load('tickets', $_POST['delete_id']);
        $client = R::findOneOrDispense('clients', 'iin=?', [$ticket['iin']]);
        $client['name'] =           $ticket['fio'];
        $client['status'] =         $_POST['value'];
        $client['message'] =         $_POST['message'];
        $client['iin'] =            $ticket['iin'];
        $client['date_document'] =  $ticket['date_vyd'];
        $client['issued_by'] =      $ticket['kemvydan'];
        $client['phone'] =          $ticket['phones'];
        $client['street'] =         $ticket['adress'];
        $client['house'] =          $ticket['dom'];
        $client['apartment'] =      $ticket['kvartira'];
        $client['date_add'] =      date('Y-m-d H:i:s');
        $client->add_user          = $fio;
        R::store($client);
        exit('Ok');
    }
    $search = trim($_POST['search']);
    $result = R::findAll(
        'tickets',
        'fio LIKE :search 
            OR nomerzb LIKE :search 
            OR phones LIKE :search  
            OR numberdocs LIKE :search
            OR numberdocs LIKE :search
            OR imei LIKE :search  
            OR sn LIKE :search
            OR tovarname LIKE :search
            OR iin LIKE :search
            GROUP BY iin    
        LIMIT 10',
        [':search' => "%$search%"]
    );
?>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="info">
                    <th>№</th>
                    <th>Дата выдачи документа</th>
                    <th>ИИН</th>
                    <th>Ф.И.О</th>
                    <th>Телефон</th>
                    <th>Номер документа</th>
                    <th>Орган выдачи</th>
                    <th>Адрес</th>
                    <th>Дом</th>
                    <th>Квартира</th>
                    <th>Примечание</th>
                    <th></th>
                </tr>
            </thead>
            <? $i = 1;
            foreach ($result as $data) {
                $client = R::findOne('clients', 'iin=?', [$data['iin']]);
            ?>
                <tr <? if ($client['status'] == 1) {
                        echo 'class="danger"';
                    }; ?>>
                    <td><?= $i++; ?>.</td>
                    <td><?= date("d.m.Y", strtotime($data['date_vyd'])); ?></td>
                    <td><?= $data['iin']; ?></td>
                    <td><?= $data['fio']; ?></td>
                    <td><?= $data['phones']; ?></td>
                    <td><?= $data['numberdocs']; ?></td>
                    <td><?= $data['kemvydan']; ?></td>
                    <td><?= $data['adress']; ?></td>
                    <td><?= $data['dom']; ?></td>
                    <td><?= $data['kvartira']; ?></td>
                    <td><?= $data['message']; ?></td>
                    <td>
                        <? if ($client['status'] != 1) : ?>
                            <button class="btn btn-danger black_list" data-value='1' data-id="<?= $data['id']; ?>" title="В черный список"> <i class="fa fa-times" aria-hidden="true"></i> </button>
                        <? else : ?>
                            <button class="btn btn-primary black_list" data-value='2' data-id="<?= $data['id']; ?>" title="Вернуть из черного списка"> <i class="fa fa-rotate-left" aria-hidden="true"></i> </button>
                        <? endif; ?>
                    </td>
                </tr>
            <? } ?>
        </table>
    </div>
    <script src="/assets/js/black_list.js"></script>
<? endif; ?>