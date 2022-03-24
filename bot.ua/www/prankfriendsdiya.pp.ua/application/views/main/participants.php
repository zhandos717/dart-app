<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body" id="js-ns-report">
                        <table id="datatable-tabletools" class="table display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID клиента</th>
                                    <th>ФИО</th>
                                    <th>Telegram ID</th>
                                    <th>Дата рождения</th>
                                    <th>Дата регистрации</th>
                                    <th>Фото </th>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <? foreach ($data as $item) : ?>
                                    <tr>
                                        <td><?= $item['id'] ?></td>
                                        <td><?= $item['firstname'] ?> <?= $item['lastname'] ?> <?= $item['patronymic'] ?></td>
                                        <td><?= $item['user_id'] ?></td>
                                        <td> <?= $item['date_of_birth'] ?> </td>
                                        <td><?= date('d.m.Y H:i:s', strtotime($item['date_time'])) ?></td>
                                        <td><a href="/<?= $item['photo'] ?>" target="_blank"> <?= $item['photo'] ?></a></td>
                                        <td>
                                            <button class="btn btn-outline-primary sendmessage" data-user="<?= $item['user_id'] ?>" data-bs-toggle="modal" data-bs-target="#exampleModalCenter"><i class="fab fa-telegram"></i></button>
                                            <button class="btn btn-danger delete_user" data-table='userbot' data-id="<?= $item['id'] ?>"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                <? endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID клиента</th>
                                    <th>ФИО</th>
                                    <th>Telegram ID</th>
                                    <th>Дата рождения</th>
                                    <th>Дата регистрации</th>
                                    <th>Фото </th>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="/participants" method="POST">
                <input type="text" hidden name="user_id">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Введите сообщение</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <span class="input-group-text">Телеграм</span>
                        <textarea required class="form-control" name='message' aria-label="With textarea"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </div>
            </form>
        </div>
    </div>
</div>