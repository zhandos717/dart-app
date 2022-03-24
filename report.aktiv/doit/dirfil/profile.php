<?
include("../../bd.php");
if ($_SESSION['logged_user']->status == 1) :
    include "header.php";
    include "menu.php"; ?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Профиль пользователя
            </h1>
            <br>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-12 answer" style="display:none;">
                    <div class="alert alert-success">
                        <h4> Данные добавлены!</h4>
                        Для отображения данных нужно перезайти
                    </div>
                </div>

                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="/assets/dist/img/default-50x50.gif" alt="User profile picture">
                            <h3 class="profile-username text-center"><?= $fio ?></h3>
                            <p class="text-muted text-center"><?= $_SESSION['logged_user']['doljnost'] ?></p>
                            <!-- 
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Продаж</b> <a class="pull-right">1,322</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Обслужино клиентов</b> <a class="pull-right">543</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Сотрудников</b> <a class="pull-right">13,287</a>
                                </li>
                            </ul> -->

                            <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->

                    <!-- About Me Box -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Информация о филиале</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <strong><i class="fa fa-map-marker margin-r-5"></i> Расположение</strong>
                            <p class="text-muted"><?= $region ?> <?= $adress ?></p>
                            <hr>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#settings" data-toggle="tab">Настройки </a></li>
                        </ul>
                        <div class="tab-content">
                            <div class=" active tab-pane" id="settings">
                                <form class="form-horizontal" id="report" method="POST" action="/doit/function/edit_dir_user.php">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Ф.И.О</label>
                                        <div class="col-sm-10">
                                            <input type="text" required class="form-control" name="fio" id="inputName" value="<?= $fio ?>" placeholder="Введите ФИО">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone" class="col-sm-2 control-label">Телефон</label>
                                        <div class="col-sm-10">
                                            <input type="tel" required class="form-control tel" id="inputPhone" name="phone" value="<?= $_SESSION['logged_user']['phone'] ?>" placeholder="+7 747 747 74 47">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Почта</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" name="email" value="<?= $email ?>" placeholder="example@gmail.com *не обязательно">
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">О себе</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="inputExperience" value="" placeholder="Experience"></textarea>
                                        </div>
                                    </div> -->
                                    <!-- <div class="form-group">
                                        <label for="inputSkills" class="col-sm-2 control-label"> Цели на будущее </label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                        </div>
                                    </div> -->
                                    <!-- <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                                </label>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-success">Отправить</button>
                                        </div>
                                    </div>
                                </form>
                            </div><!-- /.tab-pane -->
                        </div><!-- /.tab-content -->
                    </div><!-- /.nav-tabs-custom -->
                </div><!-- /.col -->
            </div><!-- /.row -->

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <script>
        window.addEventListener("DOMContentLoaded", function() {
            [].forEach.call(document.querySelectorAll('.tel'), function(input) {
                var keyCode;

                function mask(event) {
                    event.keyCode && (keyCode = event.keyCode);
                    var pos = this.selectionStart;
                    if (pos < 3) event.preventDefault();
                    var matrix = "+7 (___) ___ ____",
                        i = 0,
                        def = matrix.replace(/\D/g, ""),
                        val = this.value.replace(/\D/g, ""),
                        new_value = matrix.replace(/[_\d]/g, function(a) {
                            return i < val.length ? val.charAt(i++) || def.charAt(i) : a
                        });
                    i = new_value.indexOf("_");
                    if (i != -1) {
                        i < 5 && (i = 3);
                        new_value = new_value.slice(0, i)
                    }
                    var reg = matrix.substr(0, this.value.length).replace(/_+/g,
                        function(a) {
                            return "\\d{1," + a.length + "}"
                        }).replace(/[+()]/g, "\\$&");
                    reg = new RegExp("^" + reg + "$");
                    if (!reg.test(this.value) || this.value.length < 5 || keyCode > 47 && keyCode < 58) this.value = new_value;
                    if (event.type == "blur" && this.value.length < 5) this.value = ""
                }
                input.addEventListener("input", mask, false);
                input.addEventListener("focus", mask, false);
                input.addEventListener("blur", mask, false);
                input.addEventListener("keydown", mask, false)
            });
        });

        $('form').submit(function(e) {
            var $form = $(this);
            $.ajax({
                type: $form.attr('method'),
                url: $form.attr('action'),
                data: $form.serialize()
            }).done(function(data) {
                $('.answer').css('display', 'block');
                console.log(data);
            }).fail(function(err) {
                alert('Ошибка' + err);
            });
            e.preventDefault();
        });
    </script>
<? include "footer.php";
else :
    header('Location: /');
endif; ?>