<div id="js-ns-report">
    <div class="page-content">
        <div class="main-wrapper">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <button type="button" class="btn btn-outline-warning mb-2" @click="add_message" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="fa fa-plus"></i> Добавить сообщение
                            </button>
                            <!-- <button class="btn btn-outline-success mb-2" @click="toExcel"> <i class="fa fa-download" aria-hidden="true"></i> </button> -->
                            <table id="zero-conf" class="table display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Наименование</th>
                                        <th>Сообщение</th>

                                        <td></td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <? foreach ($data as $item) : ?>
                                        <tr>
                                            <td><?= $item['id'] ?></td>
                                            <td><?= $item['name'] ?></td>
                                            <td><?= $item['message'] ?></td>
                                            <td>
                                                <button class="btn btn-outline-primary edit" @click="edit_message(<?= $item['id'] ?>)" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-edit"></i></button>
                                            </td>
                                        </tr>
                                    <? endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID</th>
                                        <th>Наименование</th>
                                        <th>Сообщение</th>

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
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form class="row g-3" action="/languages_ru" method="POST">
                    <input type="text" hidden name="id" v-model='message.id'>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Редактирование сообщения</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <label for="name" class="form-label">Наименование</label>
                            <input type="text" class="form-control" v-model='message.name' name="name" id="name" required>
                        </div>

                        <div class="col-md-12">
                            <label for="message" class="form-label">Текст</label>
                            <textarea name="message" class="form-control" id="message">{{message.message}}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button type="submit" class="btn btn-primary">Создать</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>