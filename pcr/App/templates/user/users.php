<div class="page-content">

    <div class="row">
        <div class="col">
            <div class="card radius-10 mb-0">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <h5 class="mb-1">Пользователи</h5>
                        </div>
                        <div class="ms-auto">
                            <a href="/add-user" class="btn btn-primary btn-sm radius-30">
                                Добавить
                            </a>
                        </div>
                    </div>

                    <div class="table-responsive mt-3">
                        <table class="table align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>ID</th>
                                    <th>Логин</th>
                                    <th>Имя</th>
                                    <th>Роль</th>
                                    <th>Статус</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <? foreach ($users as $user) : ?>
                                    <tr>
                                        <td><?= $user['id'] ?></td>
                                        <td>
                                            <?= $user['login'] ?>
                                        </td>
                                        <td> <?= $user['name'] ?> </td>
                                        <td class=""> <?= $user['role'] == 1 ? 'Admin' : 'Moderator';  ?></td>
                                        <td> <?= $user['status'] == 1 ? 'Активный':'Закрыт'; ?> </td>
                                        <td>
                                            <div class="d-flex order-actions"> <a href="/delete_user?id=<?= $user['id'] ?>" class="text-danger bg-light-danger border-0"><i class='bx bxs-trash'></i></a>

                                                <a href="/edit_user?id=<?= $user['id'] ?>" class="ms-4 text-primary bg-light-primary border-0"><i class='bx bxs-edit'></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <? endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end row-->
</div>