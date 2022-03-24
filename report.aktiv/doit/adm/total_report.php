<?php
include __DIR__ . '/../../bd.php';
if ($status != 3 or $root != 3)  header('Location: ../../index.php');
include "header.php";
include "menu.php";


?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" id="app">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Отчет за 02 2022
    </h1>
    <ol class="breadcrumb">
      <li><a href="index.php"><i class="fa fa-dashboard"></i> Главная</a></li>
      <li><a href="index.php">Регионы</a></li>
      <li class="active">Филиалы</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">

    <div class="row">
      <div class="col-xs-12">
        <div class="box box-warning box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Актив ломбард</h3>
          </div>
          <div class="box-body">
            <div class="">
              <table class="table table-bordered">
                <!-- <tr>
                <th style="width: 10px">#</th>
                <th></th>
                <th style="width: 40px">Label</th>
                </tr> -->
                <tr>
                  <td>1.</td>
                  <td>Наличность в кассе</td>

                  <td>0</td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>На счете в тенге</td>

                  <td>0</td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>На счете в долларах</td>

                  <td>0</td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>Депозит</td>

                  <td>0</td>
                </tr>
                <tr>
                  <td>5.</td>
                  <td>Наличность в залоге</td>

                  <td>{{ format(lombard.nalvzaloge) }}</td>
                </tr>
                <tr>
                  <td>6.</td>
                  <td>Наличность в аукционисте в Техника</td>

                  <td>{{ format(lombard.auktech) }}</td>
                </tr>
                <tr>
                  <td>7.</td>
                  <td>Наличность в аукционисте в Шубы</td>

                  <td>{{ format(lombard.aukshubs) }}</td>
                </tr>

              </table>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->

      <div class="col-xs-6">
        <div class="box box-info box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">ОБС комиссионый магазин</h3>
          </div>
          <div class="box-body">
            <div class="">
              <table class="table table-bordered">
                <tr>
                  <td>1.</td>
                  <td>Наличность в кассе</td>

                  <td> {{ format(obs.cashbox) }} </td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>На счете в тенге</td>

                  <td>0</td>
                </tr>

                <tr>
                  <td>3.</td>
                  <td>Наличность в залоге</td>

                  <td> {{ format(obs.cash_in_pledge_end) }} </td>
                </tr>

                <tr>
                  <td>4.</td>
                  <td>Наличность в аукционисте</td>


                  <td>{{ format(obs.auctioneer) }}</td>
                </tr>
              </table>
            </div>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div><!-- /.col -->

      <div class="col-xs-6">
        <div class="box box-danger box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">ТБС комиссионый магазин</h3>
          </div>
          <div class="box-body">
            <div class="">
              <table class="table table-bordered">
                <tr>
                  <td>1.</td>
                  <td>Наличность в кассе</td>
                         <td> {{ format(tbs.cashbox) }} </td>
                </tr>
                <tr>
                  <td>2.</td>
                  <td>На счете в тенге</td>
                  <td>0</td>
                </tr>
                <tr>
                  <td>3.</td>
                  <td>Наличность в залоге</td>
                       <td> {{ format(tbs.cash_in_pledge_end) }} </td>
                </tr>
                <tr>
                  <td>4.</td>
                  <td>Наличность в аукционисте</td>
           
                  <td>{{ format(tbs.auctioneer) }}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="box box-primary box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">ИП Иьясова - Алия комиссионка</h3>
          </div>
          <div class="box-body">
            <div class="">
              <table class="table table-bordered">
                <tr>
                  <td>1.</td>
                  <td>На счете в тенге</td>
                  <td> 0 тг.</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<script>
  "use strict";
  const app = Vue.createApp({
    data() {
      return {
        lombard: {},
        tbs: {},
        obs: {},
      }
    },
    created() {
      this.Post('get_cashbox')
    },
    methods: {
      format: function(number) {
        return new Intl.NumberFormat().format(number)
      },
      Post: function() {
        axios.post('../function/total_report.php', )
          .then((response) => {
            console.log(response.data);
            this.lombard = response.data.lombard;
            this.obs = response.data.obs;
            this.tbs = response.data.tbs;

          })
          .catch((error) => {
            console.log(error)
          });
      }
    },
  })
  app.mount('#app')
</script>
<?php include "footer.php"; ?>