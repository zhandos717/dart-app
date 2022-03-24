<? //проверка существовании сессии
include("../../bd.php");
if (isset($_SESSION['logged_user'])) :   //если сущесттвует пользователь
include "header.php"; 
include "menu.php"; 
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Поиск товаров
        </h1>
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="index.php">Поиск товаров</a></li>
            <!-- <li class="active">Филиалы</li> -->
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Найдется все</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <br />
                    <div class="box-body">
                        <form id="search_form">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <button class="btn btn-block btn-default" type="submit" id="search">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                                <input type="text" class="form-control" placeholder="Поиск..." id="search_сontent" />
                            </div><!-- /input-group -->
                        </form>
                        <br />
                    </div><!-- /.box -->
                </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-xs-12 ">
                <div class="box">
                    <div class="box-body answer">

                    </div>
                </div>
            </div>
        </div><!-- /.row -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->
<? include "footer.php"; 
else :
header('Location: /');
endif; ?>