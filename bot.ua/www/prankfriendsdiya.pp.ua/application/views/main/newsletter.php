            <div class="page-content">
                <div class="main-wrapper">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body" id="js-ns-report">
                                    <button type="button" class="btn btn-outline-warning mb-2" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                        <i class="fa fa-plus"></i> Добавить приз
                                    </button>
                                    <div class="table-responsive">
                                        <table id="zero-conf" id="datatable-tabletools" class="table display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Сообщение</th>
                                                    <th>Файл</th>
                                                    <th>Примечение</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <? foreach ($data as $item) : ?>
                                                    <tr>
                                                        <td><?= $item['id'] ?></td>
                                                        <td><?= $item['message'] ?></td>
                                                        <td> <? if($item['extension']){?><a href="/public/files/<?= $item['id'] ?>.<?= $item['extension'] ?>" download>Файл</a> <?} ?> </td>
                                                        <td><?= $item['note'] ?></td>
                                                        <td>
                                                            <button class="btn btn-outline-primary" @click='newsletter(<?= $item['id'];?>)'><i class="fab fa-telegram"></i></button>
                                                            <button class="btn btn-danger delete_user" data-table='messages' data-id="<?= $item['id'] ?>">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <? endforeach; ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Сообщение</th>
                                                    <th>Файл</th>
                                                    <th>Примечение</th>
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
            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Добавление сообщения</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="/newsletter" method="POST">
                            <div class="modal-body">
                                <div class="col-md-12">
                                    <label for="message" class="form-label">Сообщение</label>
                                    <textarea name="message" class="form-control" id="message" required></textarea>

                                </div>
                                <div class="col-md-12">
                                    <label for="file" class="form-label">Файл</label>
                                    <input type="file" class="form-control" name="file" id="file">
                                </div>
                                <div class="col-md-12">
                                    <label for="note" class="form-label">Примечение</label>
                                    <input type="text" class="form-control" name="note" id="note">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>