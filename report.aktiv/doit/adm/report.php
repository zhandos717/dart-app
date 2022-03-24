<? //проверка существовании сессии
include("../../bd.php");
if ($_SESSION['logged_user']->status == 3) :
    include "header.php";
    include "menu.php";
?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Отчет за ОКТЯБРЬ 2021
            </h1>
        </section>
        <!-- Main content -->
        <section class="content" id="app" v-cloak>
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select class="form-control" v-model='search.type'>
                                        <option value="1">По регионам</option>
                                        <option value="2">По филиалам</option>
                                    </select>
                                </div>
                            </div>
                            <!-- <div class="col-md-2">
                                <div class="form-group">
                                    <input type="date" class="form-control" v-model='search.date_begin' name="date_begin">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="date" class="form-control" v-model='search.date_end' name="date_end">
                                </div>
                            </div> -->
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button @click='Post' class="btn-success btn ">Применить</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <div class="input-group input-group-sm col-xs-6 col-lg-2">
                                <span class="input-group-btn">
                                    <button @click='toExcel' class="btn btn-success btn-flat"> <i class="fa fa-file-excel-o" aria-hidden="true"></i> </button>
                                </span>
                            </div>
                        </div>
                        <div class="box-body table-responsive">
                            <div class="">
                                <table class="table table-bordered text-center" id='table-export'>
                                    <!--  -->
                                    <!-- datatable-tabletools  -->
                                    <thead>
                                        <tr class="danger">
                                            <th rowspan="2">РЕГИОНЫ</th>
                                            <th colspan="4">Доход</th>
                                            <!-- <th rowspan="2">ДОХОДЫ</th> -->
                                            <th rowspan="2">РАСХОДЫ</th>
                                            <!--    <th>СТАБ.РАСХОДЫ</th>
                                                <th>ТЕК.РАСХОДЫ</th>
                                                <th>ПРИБЫЛЬ</th>  -->
                                            <th>ЧИСТАЯ ПРИБЫЛЬ </th>
                                            <th colspan="2">КЛИЕНТЫ</th>
                                            <th rowspan="2">ЧИСТАЯ <br> ВЫДАЧА</th>
                                            <th colspan="2">АУКЦИОНИСТ</th>
                                            <th rowspan="2">НАЛ В <br> ЗАЛОГЕ</th>
                                        </tr>
                                        <tr class="info">
                                            <th>ЛОМБАРДА</th>
                                            <th>МАГАЗИНА</th>
                                            <!-- <th title="Данные с отчета магазина" class="bg-red">ОТЧЕТ магазина</th> -->
                                            <!-- <th>ДОХОД КОМИССИОНКИ</th> -->
                                            <th>ДОП</th>
                                            <th>ИТОГ</th>
                                            <th>ЛОМБАРДА (-20%)</th>
                                            <!-- <th>TBS (-3%)</th> -->
                                            <!-- <th>OBS (-3%)</th> -->
                                            <!-- <th>ИТОГ</th> -->
                                            <th>ВСЕ </th>
                                            <th>НОВЫЕ</th>
                                            <th>ТЕХНИКА</th>
                                            <th>ШУБА</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for='report in reports'>
                                            <td>
                                                <button v-if='view_adress' class='btn btn-block'>
                                                    {{ report.region }} - {{ String(report.adress) }}
                                                </button>
                                                <button v-else class='btn btn-primary btn-block'>
                                                    {{ report.region }}
                                                </button>
                                            </td>
                                            <td>{{ numStr(report.dl) }}</td>
                                            <td>{{ numStr(report.dm) }}</td>
                                            <!-- <td> </td> -->
                                            <td> {{ numStr(report.dop)}}</td>
                                            <td>{{ numStr(report.income) }} </td>
                                            <td>{{ numStr(report.consumption) }}</td>
                                            <td>{{ numStr(report.profit)  }} </td>
                                            <!-- <td> </td>
                                            <td> </td> -->
                                            <!-- <td> </td> -->
                                            <td>{{ report.allclients }}</td>
                                            <td>{{ report.newclients }}</td>
                                            <td>{{ numStr(report.chv) }} </td>
                                            <td>{{ numStr(report.auktech)  }}</td>
                                            <td>{{ numStr(report.aukshubs) }}</td>
                                            <td>{{ numStr(report.nalvzaloge)   }}</td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr class="text-nowrap bg-gray">
                                            <th>Итог </th>
                                            <th>{{ numStr(total.dl) }}</th>
                                            <th>{{ numStr(total.dm) }}</th>
                                            <!-- <th> </th> -->
                                            <th> {{ numStr(total.dop)}}</th>
                                            <th>{{ numStr(total.income) }} </th>
                                            <th>{{ numStr(total.consumption) }}</th>
                                            <th>{{ numStr(total.profit)  }} </th>
                                            <!-- <th> </th>
                                            <th> </th> -->
                                            <!-- <th> </th> -->
                                            <th>{{ total.allclients }}</th>
                                            <th>{{ total.newclients }}</th>
                                            <th>{{ numStr(total.chv) }} </th>
                                            <th>{{ numStr(total.auktech)  }}</th>
                                            <th>{{ numStr(total.aukshubs) }}</th>
                                            <th>{{ numStr(total.nalvzaloge)   }}</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section>
    </div>
    <script src="/assets/js/get_report.js"> </script>
<?
    include "footer.php";
else :
    header('Location: /');
endif; ?>