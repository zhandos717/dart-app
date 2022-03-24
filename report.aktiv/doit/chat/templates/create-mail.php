<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title">Создать новое сообщение</h3>
    </div><!-- /.box-header -->
    <form action="add-mail" method="post" enctype="multipart/form-data">
        <div class="box-body">
            <div class="form-group">
                <select name="komu" class="form-control select2" style="width: 100%;" required="required">
                    <option disabled>Выберите контакт кому нужно написать</option>
                    <?php
                    foreach ($users as $user) {
                    ?>
                        <option value="<?= $user['login'] ?>"><?= $user['fio'] ?>(<?= $user['doljnost'] ?>)</option>
                    <? } ?>
                </select>
            </div>
            <div class="form-group">
                <input class="form-control" name="tema" placeholder="Тема:" required="required">
            </div>
            <div class="form-group">
                <textarea id="compose-textarea" name="textSms" class="form-control" style="height: 300px"></textarea>
            </div>
            <!-- <div class="form-group">
                <input multiple="true" type="file" class="form-control" id="file" name="file[]">
            </div> -->
            <div class="form-group">
                <div class="btn btn-default btn-file">
                    <i class="fa fa-paperclip"></i> Вложение
                    <input multiple="multiple" type="file" class="form-control" id="file" name="file[]">
                </div>
                <p class="help-block">Max. 32MB</p>
            </div>
        </div><!-- /.box-body -->
        <div class="box-footer">
            <div class="pull-right">
                <!-- <button class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button> -->
                <button type="submit" name="gopismo" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Отправить</button>
            </div>
            <!-- <button class="btn btn-default"><i class="fa fa-times"></i> Discard</button> -->
        </div><!-- /.box-footer -->
    </form>
</div><!-- /. box -->
<script>
    $('#file').change(function() {
        if ($(this).val() != '') $(this).prev().text(' Выбрано файлов: ' + $(this)[0].files.length);
        else $(this).prev().text('Выберите файлы');
    });
</script>