<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">
            <li class="treeview">
                <a href="index.php">
                    <i class="fa fa-files-o"></i>
                    <span>Заполнить отчет</span>
                </a>
            </li>
            <li class="treeview <?= $active_report; ?>">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Отчеты за 2022</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu activ">
                    <li><a href="view_my_reports.php?month=2&year=2022"><i class="fa fa-circle-o"></i>Февраль <span class="label label-warning pull-right">2022</span></a></li>
                    <li><a href="view_my_reports.php?month=1&year=2022"><i class="fa fa-circle-o"></i>Январь <span class="label label-warning pull-right">2022</span></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Отчеты за 2021</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu activ">
                    <li><a href="view_my_reports.php?month=12&year=2021"><i class="fa fa-circle-o"></i>Декабрь <span class="label label-warning pull-right">2021</span></a></li>
                    <li><a href="view_my_reports.php?month=11&year=2021"><i class="fa fa-circle-o"></i>Ноябрь <span class="label label-warning pull-right">2021</span></a></li>
                    <li><a href="view_my_reports.php?month=10&year=2021"><i class="fa fa-circle-o"></i>Октябрь <span class="label label-warning pull-right">2021</span></a></li>
                    <li><a href="view_my_reports.php?month=9&year=2021"><i class="fa fa-circle-o"></i>Сентябрь <span class="label label-warning pull-right">2021</span></a></li>
                    <li><a href="view_my_reports.php?month=8&year=2021"><i class="fa fa-circle-o"></i>Август <span class="label label-warning pull-right">2021</span></a></li>
                    <li><a href="view_my_reports.php?month=7&year=2021"><i class="fa fa-circle-o"></i>Июль <span class="label label-warning pull-right">2021</span></a></li>
                    <li><a href="view_my_reports.php?month=6&year=2021"><i class="fa fa-circle-o"></i>Июнь <span class="label label-warning pull-right">2021</span></a></li>
                    <li><a href="view_my_reports.php?month=5&year=2021"><i class="fa fa-circle-o"></i>Май <span class="label label-warning pull-right">2021</span></a></li>
                    <li><a href="view_my_reports.php?month=4&year=2021"><i class="fa fa-circle-o"></i>Апрель <span class="label label-warning pull-right">2021</span></a></li>
                    <li><a href="view_my_reports.php?month=3&year=2021"><i class="fa fa-circle-o"></i>Март <span class="label label-warning pull-right">2021</span></a></li>
                    <li><a href="view_my_reports.php?month=2&year=2021"><i class="fa fa-circle-o"></i>Февраль <span class="label label-warning pull-right">2021</span></a></li>
                    <li><a href="view_my_reports.php?month=1&year=2021"><i class="fa fa-circle-o"></i>Январь <span class="label label-warning pull-right">2021</span></a></li>
                </ul>
            </li>
            <li class="treeview <?= $report_2020; ?>">
                <a href="#">
                    <i class="fa fa-file-text"></i> <span>Отчеты за 2020</span><i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu activ">
                    <li><a href="view_report.php?t=sales12"><i class="fa fa-circle-o"></i>Декабрь </a></li>
                    <li><a href="view_report.php?t=sales11"><i class="fa fa-circle-o"></i>Ноябрь </a></li>
                    <li><a href="view_report.php?t=sales10"><i class="fa fa-circle-o"></i>Октябрь </a></li>
                    <li><a href="view_report.php?t=sales09"><i class="fa fa-circle-o"></i>Сентябрь </a></li>
                    <li><a href="view_report.php?t=sales08"><i class="fa fa-circle-o"></i>Август </a></li>
                    <li><a href="view_report.php?t=sales07"><i class="fa fa-circle-o"></i>Июль </a></li>
                    <li><a href="view_report.php?t=sales06"><i class="fa fa-circle-o"></i>Июнь </a></li>
                    <li><a href="view_report.php?t=sales05"><i class="fa fa-circle-o"></i>Май </a></li>
                    <li><a href="view_report.php?t=sales04"><i class="fa fa-circle-o"></i>Апрель </a></li>
                    <li><a href="view_report.php?t=sales03"><i class="fa fa-circle-o"></i>Март </a></li>
                </ul>
            </li>
            <?php $city = R::getCol('SELECT region FROM kassa WHERE status = 1 GROUP BY region');
            if (in_array($region, $city)) { ?>
                <li class="treeview <?= $active; ?>">
                    <a href="#">
                        <i class="fa fa-cubes"></i> <span>Комиссионка</span> <i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="sklad.php"><i class="fa fa-circle-o"></i>Склад</a></li>
                        <li><a href="a_report.php?id=9"><i class="fa fa-circle-o"></i>Все товары</a></li>
                        <li><a href="nakl.php"><i class="fa fa-circle-o"></i>Накладная</a></li>
                        <li><a href="a_report.php?id=7"><i class="fa fa-circle-o"></i>Анализ товаров</a></li>
                        <li><a href="a_report.php?id=8"><i class="fa fa-tag"></i>Аксессуары</a> </li>
                        <li><a href="a_report.php?id=2"><i class="fa fa-shopping-cart"></i>Отчет по реализации</a></li>
                    </ul>
                </li>
            <? }
            if ($root == 1) : ?>

                <li class="treeview">
                    <a href="./total_report.php">
                        <i class="fa fa-file-archive-o" aria-hidden="true"></i>
                        <span>Отчет шуб</span>
                    </a>
                </li>

            <? endif; ?>
            <li class="treeview">
                <a href="search.php">
                    <i class="fa fa-search"></i>
                    <span>Поиск</span>
                </a>
            </li>
            <li class="treeview">
                <a href="order.php">
                    <i class="fa fa-file-o"></i>
                    <span>Заказы</span>
                </a>
            </li>
            <li class="treeview">
                <a href="salers.php">
                    <i class="fa fa-users"></i>
                    <span>Продавцы</span>
                </a>
            </li>
            <li class="treeview">
                <a href="edo/">
                    <i class="fa  fa-envelope"></i> <span> СЛУЖЕБКИ <label class="badge label-danger"><?= $countid; ?></label> </span>
                </a>
            </li>
            <!-- 
            <li class="treeview">
                <a href="/doit/chat/">
                    <span> Рабочий чат </span>
                </a>

            </li> -->

            <li class="treeview">
                <a href="black-list-product.php">
                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>

                    <span> Черный список товаров </span>
                </a>
            </li>


            <li class="treeview">
                <a href="../../logout.php">
                    <i class="fa fa-sign-out"></i>
                    <span>Выход</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>