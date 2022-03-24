<?php
$nav_expanded = 'nav-expanded';
include __DIR__ . '/layouts/header.php';
?>
<div id="app">
	<section role="main" class="content-body">
		<header class="page-header">
			<h2>Залоговые билеты </h2>
			<div class="right-wrapper text-right">
				<ol class="breadcrumbs">
					<li><span>Главная</span></li>
					<li><span>Админ</span></li>
				</ol>
				<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fas fa-chevron-left"></i></a>
			</div>
		</header>
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-header">
						<div class="row">
							<div class="col-2">
								<input type="text" v-on:keyup.enter="onEnter" v-model='search' placeholder="Поиск..." class="form-control">
							</div>
							<div class="col-10">
								<h2 class="card-title text-center">
									Действующие договора
								</h2>
							</div>
						</div>
					</div>
					<div class="card-body answer">
						<div class="table-responsive">
							<table class="table table-bordered table-striped mb-0">
								<thead>
									<tr class="table-info text-center">
										<th style="width:5rem;">Код товара</th>
										<th>Клиент</th>
										<th>Наименование товара</th>
										<th>Приходная сумма</th>
										<th>Дата оформление договора</th>
										<th>Дата окончание договора</th>
										<th>Сумма продажи</th>
										<th>Остаточная стоимость</th>
										<th style="width:8rem;">Статус</th>
									</tr>
								<tbody>
									<tr v-for="item in tickets" :key="item.id">
										<td> <a :href="'ticket?id=' + item.id" class="btn btn-info " style="white-space: nowrap;">{{ item.nomerzb }} </a> </td>
										<td>{{ item.fio }} ИИН: {{ item.iin }} </td>
										<td>{{ item.category }}
											{{ item.tovarname}}
											{{ item.hdd }}
											{{ item.complect }}
											imei: {{ item.imei }}
											{{ item.hdd }}
										</td>
										<td>{{ item.summa_vydachy }}</td>
										<td>{{ item.reg_data }}</td>
										<td>{{ item.dv }}</td>
										<td>{{ item.cena_pr }}</td>
										<td>{{ item.residualvalu }}</td>
										<td>
											<template v-if="item.status == 2">
												<a :href="'ticket_sale?idx=' + item.id" class="mb-1 mt-1 mr-1 btn btn-sm btn-danger"> {{item.name}}</a>
											</template>
											<template v-else-if="item.status == 14">
												<div>
													<button class="modal-with-form btn btn-success btn-sm " @click="getSale(item.id)" data-toggle="modal" data-target="#exampleModal"> {{item.name}} <i class="fas fa-cart-plus"></i> </button>
												</div>
											</template>
											<template v-else>
												<button type="button" class="mb-1 mt-1 mr-1 btn btn-xs btn-default">{{item.name }}</button>
											</template>


										</td>
									</tr>
									<tr>
										<td v-if="Object.keys(tickets).length == 0" class="text-center" colspan="9">
											Таблица пуста, введите данные для поиска!
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<form action="/ticket_sale" method="GET">
								<div class="modal-header">
									<h2 class="card-title">Данные покупателя для покупки №{{ ticket.nomerzb}}</h2>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="card-body" v-if="load == false" data-loading-overlay data-loading-overlay-options='{ "startShowing": true }' style="min-height: 150px;">
										Content.
									</div>

									<div else class="form-row">
										<input hidden name="idx" v-model="ticket.id" />
										<div class="form-group col-md-7">
											<label for="full_name">Ф.И.О</label>
											<input type="text" required class="form-control" name="namebuyer" id="full_name">
										</div>
										<div class="form-group col-md-5 mb-3 mb-lg-0">
											<label for="iinbuyer">ИИН</label>
											<input type="number" minlength="12" size="12" maxlength="12" class="form-control"  required id="iinbuyer" name="iinbuyer">
										</div>
										<div class="form-group col-md-4">
											<label for="telbuyer">Номер телефона</label>
											<input id="telbuyer" v-model='sale.telbuyer' class="form-control phone" name="telbuyer" minlength="6" size="20" required maxlength="20" placeholder="+7(777)777-77-77">
										</div>
										<div class="form-group col-md-8">
											<label for="buyer_product">Наименоание товара</label>
											<p class="form-control">{{ticket.tovarname}} {{ticket.hdd}}</p>
										</div>
									</div>
									<div class="form-row">
										<div class="form-group col-md-7">
											<label for="inputCity">IMEI/SN</label>
											<p class="form-control">{{ticket.imei}}{{ticket.sn}}</p>
										</div>
										<div class="form-group col-md-5">
											<label for="inputZip">Выбор продавца</label>
											<select id="inputState" name="saler" required class="form-control">
												<option v-for="saler in salers" v-bind:value="saler">
													{{ saler }}
												</option>
											</select>
										</div>
										<div class="form-group col-md-6">
											<label for="comment_product">Дополнительное сведение</label>
											<input type="text" v-model='sale.comment_product' class="form-control" name="comment_product" id="comment_product">
										</div>
										<div class="form-group col-md-6">
											<label for="cena_pr">Цена</label>
											<input type="number" v-model='sale.cena_pr' required class="form-control" name="cena_pr" id="cena_pr">
										</div>
										<div class="form-group col-md-12">
											<div class="checkbox-custom">
												<input type="checkbox" name="terms" id="w1-terms" required>
												<label for="w1-terms">Данные верны, все проверил(а)!</label>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
										<button type="submit" class="btn btn-primary">Подтвердить</button>

									</div>
							</form>
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
				sale: {},
				ticket: {},
				tickets: {},
				salers: {},
				load: false,
				search: ''
			}
		},
		methods: {
			getSale: function(val) {
				axios.post('/App/Functions/GetSale.php', {
						id: val
					})
					.then((response) => {
						console.log(response.data);
						this.load = true;
						this.ticket = response.data.ticket;
						this.salers = response.data.salers;
					})
					.catch((error) => {
						console.log(error)
					});
			},
			onEnter: function() {
				axios.post('/App/Functions/SearchTicket.php', {
						search: this.search
					})
					.then((response) => {
						console.log(response.data);
						this.tickets = response.data.tickets
					})
					.catch((error) => {
						console.log(error)
					});
			}
		},
	}).mount('#app')
</script>
<script src="/public/js/phone_validate.js"></script>
</div>
<?php include __DIR__ . '/layouts/footer.php'; ?>