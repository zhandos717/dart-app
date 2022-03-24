$(document).ready(function(){
	$('#datatable-tabletools').Tabledit({
		url: 'live_edit.php',	
		eventType: 'dblclick',
		columns: {
		  identifier: [0, 'id'],                    
		  editable: [[6, 'cena_pr']]
		},
	});
}); 



