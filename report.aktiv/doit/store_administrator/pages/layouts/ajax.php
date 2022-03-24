<?php
// Кол-во элементов
$limit = 12;

// Подключение к БД
$dbh = new PDO('mysql:dbname=db_name;host=localhost', 'логин', 'пароль');

// Получение записей для текущей страницы
$page = intval(@$_GET['page']);
$page = (empty($page)) ? 1 : $page;
$start = ($page != 1) ? $page * $limit - $limit : 0;
$sth = $dbh->prepare("SELECT * FROM `prods` LIMIT {$start}, {$limit}");
$sth->execute();
$items = $sth->fetchAll(PDO::FETCH_ASSOC);

foreach ($items as $row) {
?>
    <div class="prod-item">
        <div class="prod-item-img">
            <img src="/images/<?php echo $row['img']; ?>" alt="">
        </div>
        <div class="prod-item-name">
            <?php echo $row['name']; ?>
        </div>
    </div>
<?php
}
