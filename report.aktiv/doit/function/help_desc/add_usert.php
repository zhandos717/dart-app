<? include '../../../bd.php'; ?>

<div class="row">
    <div class="col-xs-6">
        <label for="eo">Полное ФИО</label>
        <input type="text" class="form-control" required id="eo" placeholder="Иванов Иван" name="eo">
    </div>
    <div class="col-xs-6">
        <label for="exampleInputEmail1">Должность</label>
        <select class="form-control" required name="root">
            <option value="1">Комиссионер</option>
            <option value="2">Кассир</option>
        </select>
    </div>
    <div class="col-xs-6">
        <label for="region">Город</label>
        <select class="form-control" required name="region" id="region">
            <option><?= $region ?></option>
        </select>
    </div>
    <div class="col-xs-6">
        <label for="adress">Филиал</label>
        <select id="adress" name="adressfil" class="form-control">
            <option><?= $adress ?></option>
        </select>
    </div>
    <div class="col-xs-6">
        <label for="timework">Режим работы</label>
        <input type="text" class="form-control" id="timework" required placeholder="с 9:00 до 20:00" value="с 9:00 до 20:00" name="timework">
    </div>
    <div class="col-xs-6">
        <label for="tel">Тел. филиала </label>
        <input type="text" class="form-control phone" id="tel" required placeholder="+7 771 996 99 96" name="tel">
    </div>
    <div class="col-xs-6">
        <label for="doverennost">Доверенность</label>
        <input type="text" class="form-control" id="doverennost" required placeholder="Д-33 от 29.09.2020" value="Д-00 от 01.01.2020" name="doverennost">
    </div>
    <div class="col-xs-6">
        <label for="kassa">Номер кассы</label>
        <select class="form-control" id="kassa" name="kassa">
            <option value="Касса 1">Касса 1</option>
            <option value="Касса 2">Касса 2</option>
            <option value="Касса 3">Касса 3</option>
            <option value="Касса 4">Касса 4</option>
            <option value="Касса 5">Касса 5</option>
        </select>
    </div>
</div>