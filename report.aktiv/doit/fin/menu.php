<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <!-- <li class="header">Навигация</li> -->
      <li class="treeview">
        <a href="index.php">
          <i class="fa fa-files-o"></i>
          <span>Главная</span>
        </a>
      </li>
      <? if ($_SESSION['logged_user']->fio == 'Тасыбаева Жанна') : ?>
        <li class="treeview">
          <a href="report_fin.php">
            <i class="fa fa-file-powerpoint-o"></i>
            <span>Отчет по торгам</span>
          </a>
        </li>
      <? endif; ?>
      <li class="treeview">
        <a href="a_report.php">
          <i class="fa fa-cc-visa"></i>
          <span>Способы оплаты</span>
        </a>
      </li>
      <li class="treeview">
        <a href="test.php">
          <i class="fa fa-edit"></i> <span>Товары на реализации</span><small class="label pull-right bg-yellow"></small>
        </a>
      </li>
      <li class="treeview">
        <a href="sale_product.php">
          <i class="fa fa-shopping-cart"></i> <span>Реализация</span>
        </a>
      </li>
      <li class="treeview">
        <a href="sale_excel.php">
          <i class="fa fa-shopping-cart"></i> <span>Реализация <i class="fa fa-file-excel-o" aria-hidden="true"></i> </span>
        </a>
      </li>
      <!-- <li class="<?= $active; ?> treeview">
          <a href="sale_product.php">
            <i class="fa fa-shopping-cart"></i> <span>Реализация</span> <i class="fa fa-angle-left pull-right"></i>
          </a> 
          <ul class="treeview-menu">
            <li><a href="sale_product.php"><i class="fa fa-cart-arrow-down"></i>Продажа</a></li>
            <li><a href="сancel_implementation.php"><i class="fa fa-mail-reply-all "></i>Отмена реализации</a></li> 
          <li><a href="prtovary.php"><i class="fa fa-credit-card"></i>Проданные товары</a></li>
        </ul>
        </li>-->
      <li class="<?= $active1; ?> treeview">
        <a href="#">
          <i class="fa fa-clone"></i> <span>Отчет</span> <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <!-- <li><a href="findv.php"><i class="fa fa-circle-o"></i>Финансовые передвижения</a></li> -->
          <!-- <li><a href="a_report.php?id=1"><i class="fa fa-usd"></i>Движение средств</a></li> -->
          <li><a href="a_report.php?id=2"><i class="fa fa-file-text"></i>Отчет по реализации</a></li>
          <!-- <li><a href="abcommis.php"><i class="fa fa-external-link"></i>Детальный ОТЧЕТ</a></li> -->
          <li><a href="svodka.php"><i class="fa fa-external-link"></i>Ежедневная сводка</a></li>
          <li><a href="report.php"><i class="fa fa-external-link"></i>Отчеты по продажам</a></li>
        </ul>
      </li>


      <li class="treeview">
        <a href="update_ticket.php">
          <span> Изменение статуса и цены </span>
        </a>

      </li>


      <li class="treeview">
        <a href="not_sold.php">
          <span> Не проторгованные </span>
        </a>

      </li>

<!--       
      <li class="treeview">
        <a href="/doit/chat/">
          <span> Рабочий чат </span>
        </a>

      </li> -->


      <li class="treeview">
        <a href="/">
          <i class="fa fa-share"></i>
          <span>Выход</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>