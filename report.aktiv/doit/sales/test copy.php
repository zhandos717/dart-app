<?
include("../../bd.php");
if ($status != 5) exit;



var_dump($_POST);
?>



<form action="" id="app" method="POST">
    <div class="box-body">
        <div class="row ">

            <div class="col-md-4">
                <div class="form-group">
                    <label for="codetovar">Код товара:</label>
                    <input class="form-control" v-model="codetovar" id="codetovar" type="text" name="codetovar" placeholder="00-00" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="get_region">Город:</label>


                    <select id="get_region" name="regionlombard" :disabled="status ? '' : disabled" class="form-control" v-model="sale.region" required>
                        <option selected value="">Выберите город</option>
                        <? $regions = R::getCol('SELECT region FROM diruser GROUP BY region');
                        foreach ($regions as $city) { ?>
                            <option><?= $city ?></option>
                        <? } ?>
                    </select>



                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="adress">Филиал:</label>
                    <select id="adress" :disabled="sale.adressfil ? '' : disabled" required name="adresslombard" class="form-control">

                        <option v-if="sale.adressfil" selected>{{sale.adressfil}}</option>

                        <option value="">Выберите город</option>

                    </select>

                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="summaprihod">Приходная сумма:</label>
                    <input class="form-control" v-model="sale.summa_vydachy" required id="summaprihod" type="number" name="summaprihod">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label for="tovarname">Наименование:</label>
                    <textarea class="form-control" id="tovarname" name="tovarname" required>{{sale.category}} {{sale.tovarname}}</textarea>
                </div>
            </div>


        </div>
    </div><!-- /.box-body -->
    <div class="box-footer">
        <button type="submit" class="btn btn-success pull-right">Отправить отчет</button>
    </div><!-- /.box-footer -->
</form>
<script src="/assets/plugins/jQuery/jQuery-2.1.4.min.js" crossorigin="anonymous"></script>
<script src="https://unpkg.com/vue@next" crossorigin="anonymous"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js" crossorigin="anonymous"></script>

<script>
    $('#get_region').change(function() {
        var region = $(this).val();
        $('#adress').load('../function/get_adress.php', {
            value: region
        });
    });
</script>


<script>
    "use strict";
    // Создаём приложение Vue
    const app = Vue.createApp({
        data() {
            return {
                sale: {},
                codetovar: '',
                status: ''
            }
        },
        watch: {
            codetovar: function(val) {
                this.post();
            }
        },
        methods: {
            post: function() {
                if (this.codetovar.includes('-')) {
                    console.log(this.codetovar)
                    axios.post('../function/get_product.php', {
                            code: this.codetovar
                        })
                        .then((response) => {
                            console.log(response.data);
                            this.sale = response.data.ticket;
                            this.status = response.data.status;
                        })
                        .catch((error) => {
                            console.log(error)
                        });
                }
            }
        }
    })

    app.mount('#app')
</script>