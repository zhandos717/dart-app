(function($) {
	'use strict';
	var datatableInit = function() {
		var $table = $('#datatable-tabletools');



		var table = $table.dataTable({
			sDom: '<"text-right mb-md"T><"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
				buttons: [ 'print', 'excel', 'pdf' ]
		});
		$('<div />').addClass('dt-buttons mb-2 pb-1 text-right').prependTo('#datatable-tabletools_wrapper');

		$table.DataTable().buttons().container().prependTo( '#datatable-tabletools_wrapper .dt-buttons' );
		$('#datatable-tabletools_wrapper').find('.btn-secondary').removeClass('btn-secondary').addClass('btn-default');
	};

	var tabletools2 = function() {
	var $table = $('#tabletools2');
	
		var table = $table.dataTable({
			sDom: '<"text-right mb-md"T><"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
			buttons: ["excel"]
		});
		$('<div />').addClass('dt-buttons mb-2 pb-1 text-right').prependTo('#tabletools2_wrapper');

		$table.DataTable().buttons().container().prependTo( '#tabletools2_wrapper .dt-buttons' );
		$('#tabletools2_wrapper').find('.btn-secondary').removeClass('btn-secondary').addClass('btn-default');
	};


	var tabletools = function() {
	var $table = $('#tabletools');
	
		var table = $table.dataTable({
			sDom: '<"text-right mb-md"T><"row"<"col-lg-6"l><"col-lg-6"f>><"table-responsive"t>p',
			buttons: ["excel"]
		});
		$('<div />').addClass('dt-buttons mb-2 pb-1 text-right').prependTo('#tabletools_wrapper');

		$table.DataTable().buttons().container().prependTo( '#tabletools_wrapper .dt-buttons' );
		$('#tabletools_wrapper').find('.btn-secondary').removeClass('btn-secondary').addClass('btn-default');
	};

	$(function() {
		tabletools();
		tabletools2();
		datatableInit();
	});


}).apply(this, [jQuery]);
