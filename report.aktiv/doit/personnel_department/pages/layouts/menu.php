<aside class="main-sidebar">
  <section class="sidebar">
    <ul class="sidebar-menu">
      <li class="treeview" id="users_edit">
        <a href="#">
          <i class="fa fa-users"></i> <span>Пользователи</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="front_user"><i class="fa fa-circle-o"></i>Комиссионеры ОБС</a></li>
          <li><a href="back_user"><i class="fa fa-circle-o"></i>Сотрудники АЛ</a></li>
          <li><a href="saler"><i class="fa fa-circle-o"></i>Продавцы магазинов</a></li>
        </ul>
      </li>
      <li class="treeview <?= $user_active; ?>">
        <a href="#">
          <i class="fa fa-user-plus"></i> <span>Сотрудники</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="employeecard"><i class="fa fa-user-secret"></i>Добавить сотрудника</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="cahbox">
          <i class="fa fa-user"></i> <span>Кассы</span>
        </a>

      </li>
      <!-- <li class="treeview">
        <a href="branches">
          <i class="fa fa-building"></i> <span>Филиалы</span>
        </a>
      </li> -->

      <li class="treeview">
        <a href="../../logout.php">
          <i class="fa fa-share"></i>
          <span>Выход</span>
        </a>
      </li>
    </ul>
  </section>
</aside>