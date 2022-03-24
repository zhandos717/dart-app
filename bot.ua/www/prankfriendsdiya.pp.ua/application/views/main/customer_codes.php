<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body" id="js-ns-report">
                        <table id="datatable-tabletools" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID кода</th>
                                    <th>Код</th>
                                    <th>ID участника</th>
                                    <th>ФИО</th>
                                    <th>телефон</th>
                                    <th>Дата регистрации кода </th>
                                    <th>Неделя</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <? foreach ($data as $item) :
                                    $user = R::load('userbot', $item['table_id']); ?>
                                    <tr>
                                        <td><?= $item['id'] ?></td>
                                        <td><?= $item['user_code'] ?></td>
                                        <td><?= $user['user_id'] ?></td>
                                        <td><?= $user['name'] ?></td>
                                        <td> <a href="tel:<?= $user['contact'] ?>"><?= $user['contact'] ?></a> </td>
                                        <td><?= date('d.m.Y H:i:s', strtotime($item['date_time'])) ?></td>
                                        <td><?= $item['week'] ?></td>
                                        <td><button class="btn btn-danger delete_user" data-table='botcode' data-id="<?= $item['id'] ?>"><i class="fa fa-trash"></i></button></td>
                                    </tr>
                                <? endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID кода</th>
                                    <th>Код</th>
                                    <th>ID участника</th>
                                    <th>ФИО</th>
                                    <th>телефон</th>
                                    <th>Дата регистрации кода </th>
                                    <th>Неделя</th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

