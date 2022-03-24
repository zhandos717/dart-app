<?include ("../../../bd.php");
// Кол-во элементов
$limit = 9;

// Подключение к БД
//$dbh = new PDO('mysql:dbname=db_name;host=localhost', 'логин', 'пароль');
// Получение записей для текущей страницы
// $sth = $dbh->prepare("SELECT * FROM `prods` LIMIT {$start}, {$limit}");
// $sth->execute();
// $items = $sth->fetchAll(PDO::FETCH_ASSOC);

$page = intval(@$_GET['page']);
$page = (empty($page)) ? 1 : $page;
$start = ($page != 1) ? $page * $limit - $limit : 0;
$sth = R::findAll('tovar',"LIMIT {$start}, {$limit}");
foreach ($sth as $row) {?>
<div class="col-sm-6">
    <div class="box box-info">
        <div class="box-header with-border">
            Код товара: <?= $row['codetovar']; ?>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool bg-olive fa fa-edit" data-id="<?= $row['id']; ?>" data-toggle="modal" data-target="#modal-default"></button>
                <button class="btn btn-box-tool bg-red fa fa-trash" data-id="<?= $row['id']; ?>"></button>
            </div>
        </div>
        <div class="box-body">
            <? $photos = explode(' ', $row['photo']);
            if(count($photos)>1){?>
            <img class="img-thumbnail" width="250px" src="https://aktiv-market.kz/imgtovar/<?= $photos[0]; ?>" alt="<?= $row['photo']; ?>">
            <?}else{?>
            <img class="img-thumbnail" width="250px" src="https://aktiv-market.kz/imgtovar/<?= $row['photo']; ?>" alt="<?= $row['photo']; ?>">
            <?}?>
        </div>
        <div class="box-footer">
            <?= $row['tovarname']; ?>
        </div>
    </div>
</div>

<?}?>
<script>
    $(document).ready(function() {

        $('.fa-trash').click(function() {
            $(this).parents('.col-sm-6').css('display', 'none');
            console.log('Есть');
        });

        $('.fa-edit').click(function() {
            let id = $(this).data('id');
            $.post('./function/get_product.php', {
                id: id
            }).done(function(data) {
                $('.modal-body').html(data);
            })
        });

    });
</script>