<div class="page-content">
    <div class="main-wrapper">
        <div class="row">
            <div class="col-md-6 col-xl-3">
                <div class="card stat-widget">
                    <div class="card-body">
                        <h5 class="card-title">Сегодня</h5>
                        <h2><?= $count['code_today'] ?></h2>
                        <p>зарегистированные коды</p>

                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card stat-widget">
                    <div class="card-body">
                        <h5 class="card-title">За все время</h5>
                        <h2><?= $count['total_count'] ?></h2>
                        <p>зарегистированно кодов</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card stat-widget">
                    <div class="card-body">
                        <h5 class="card-title">Участников</h5>
                        <h2><?= $count['count_users'] ?></h2>
                        <p>За все время действия акции</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card stat-widget">
                    <div class="card-body">
                        <h5 class="card-title">Сегодня</h5>
                        <h2><?= $count['users_today'] ?></h2>
                        <p>зарегистированно участников</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Все розыгрыши за период акции</h5>
                        <!-- <p class="card-description">Use contextual classes to color tables, table rows or individual cells.</p> -->
                        <table id="zero-conf" class="table display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Приз</th>
                                    <th>Основные победители</th>
                                    <th>Запасные победители</th>
                                    <th>Неделя проведения</th>
                                    <th>Дата проведения </th>
                                    <th>Статус лотереи</th>

                                </tr>
                            </thead>
                            <tbody>
                                <? foreach ($lottery as $item) : ?>
                                    <tr>
                                        <td><?= $item['prize_ru']; ?></td>
                                        <td><?= $item['major_winners']; ?></td>
                                        <td><?= $item['reserve_winners']; ?></td>
                                        <td><?= $item['week']; ?></td>
                                        <td><?= date('d.m.Y H:i:s', strtotime($item['date_time'])) ?></td>
                                        <td><?= $item['status']; ?></td>

                                    </tr>
                                <? endforeach; ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Приз</th>
                                    <th>Основные победители</th>
                                    <th>Запасные победители</th>
                                    <th>Неделя проведения</th>
                                    <th>Дата проведения </th>
                                    <th>Статус лотереи</th>

                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card table-widget">
                    <div class="card-body">
                        <h5 class="card-title">Последние зарегистрированные коды</h5>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID кода</th>
                                        <th>ID участника</th>
                                        <th>ФИО</th>
                                        <th>телефон</th>
                                        <th>Дата регистрации кода </th>
                                        <th>Неделя</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?
                                    foreach ($data as $item) :
                                        $user = R::load('userbot', $item['table_id']); ?>
                                        <tr>
                                            <td><?= $item['id'] ?></td>
                                            <td><?= $item['user_code'] ?></td>
                                            <td><?= $user['name'] ?></td>
                                            <td><?= $user['contact'] ?></td>
                                            <td><?= date('d.m.Y H:i:s', strtotime($item['date_time'])) ?></td>
                                            <td><?= $item['week'] ?></td>
                                        </tr>
                                    <? endforeach; ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>ID кода</th>
                                        <th>ID участника</th>
                                        <th>ФИО</th>
                                        <th>телефон</th>
                                        <th>Дата регистрации кода </th>
                                        <th>Неделя</th>
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