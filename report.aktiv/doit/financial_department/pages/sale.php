<?php
require_once __DIR__ . '/../../layouts/header.php';
require_once __DIR__ . '/../../layouts/menu/financial_department.php';
?>
<div class="content-wrapper" id="app">
    <section class="content-header">
        <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
            <li><a href="index.php">Регионы</a></li>
            <li class="active">Филиалы</li>
        </ol>
    </section>
    <br>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-info">
                    <div class="box-header with-border">
                        <h3 class="box-title">Поиск товара по базе данных </h3>
                    </div>
                    <div class="box-body">
                        <div class="input-group">
                            <input type="text" v-on:keyup.enter="getSale" v-model="num_contract" class="form-control" placeholder="Введите код товара">
                            <span class="input-group-btn">
                                <button class="btn btn-success" @click="getSale()">Найти!</button>
                            </span>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
            <div v-if="Object.keys(ticket).length" class="col-xs-12">

                <div class="box box-success">
                    <div class="box-header">
                        Информация о товаре
                    </div>
                    <div class="box-body">
                        <table class="table table-striped table-bordered">
                            <tr class="success">
                                <td style="width:20rem;">Код товара</td>
                                <td>{{ticket.tovarname}} </td>
                            </tr>
                            <tr class="danger">
                                <td>Дата выдачи</td>
                                <td>
                                    2021-07-26 </td>
                            </tr>
                            <tr>
                                <td> Наименование товара</td>
                                <td>
                                    {{ticket.category }}
                                    {{ticket.tovarname }}
                                    {{ticket.imei }}
                                    {{ticket.hdd }}
                                    {{ticket.sn }}
                                    {{ticket.opisanie }}
                                </td>
                            </tr>
                            <tr class="danger">
                                <td> Сумма выдачи</td>
                                <td>
                                    {{ticket.summa_vydachy}}
                                </td>
                            </tr>
                            <tr v-if="ticket.zadatok">
                                <td> Сумма задатка</td>
                                <td> {{ticket.zadatok}} тг.
                                </td>
                            </tr>
                            <tr>
                                <td> Сумма продажи</td>
                                <td>
                                    {{ticket.cena_pr}}
                                </td>
                            </tr>
                            <tr class="success">
                                <td> Прибыль</td>
                                <td>
                                    {{ticket.cena_pr-ticket.summa_vydachy}}
                                </td>
                            </tr>
                            <tr class="info">
                                <td> Статус товара</td>
                                <td>
                                    <h4 class="label label-danger">
                                        {{ticket.name}}
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <td> Дата поступления на склад магазина</td>
                                <td>
                                    {{ticket.data_pos}}
                                </td>
                            </tr>
                            <tr>
                                <td> Дата выставления на ветрину</td>
                                <td>
                                    {{ticket.dateshop}}
                                </td>
                            </tr>
                            <tr>
                                <td> Дата продажи</td>
                                <td>{{ticket.datesale}}</td>
                            </tr>
                            <tr>
                                <td>Продавец</td>
                                <td>{{ticket.saler}} </td>
                            </tr>
                            <tr>


                            </tr>

                        </table>
                        <br>
                        <div class="row">

                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="form-group">
                                    <input type="date" class="form-control" value="2021-07-31" name="datesale">
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="form-group">

                                    <div class="input-group">

                                        <input type="number" class="form-control" name="cena_pr" placeholder="Введите сумму реализации">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success" type="submit">Реализовать!</button>
                                        </span>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </section>
</div>
<script>
    Vue.createApp({
        data() {
            return {
                num_contract: '34-12',
                ticket: {},
                s: '1231'
            }
        },
        methods: {
            getSale: function() {
                axios.post('/doit/function/sale.php', {
                        num_contract: this.num_contract
                    })
                    .then((response) => {
                        console.log(response.data);
                        this.ticket = response.data.ticket;
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            }
        },
    }).mount('#app')
</script>

<?php require_once __DIR__ . '/../../layouts/footer.php'; ?>