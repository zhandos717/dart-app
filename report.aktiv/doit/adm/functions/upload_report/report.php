<? include_once '../../../../bd.php';

switch ($_POST['report']) {
    case 1:
        include 'sales_report.php';
    break;
    case 2:
        include 'sales_report.php';
    break;
}
?>



<script src="plugins/table/dataTables.buttons.min.js"></script>
<script src="plugins/table/jszip.min.js"></script>
<script src="plugins/table/buttons.html5.min.js"></script>
<script src="plugins/table/buttons.print.min.js"></script>
<script src="plugins/table/examples.datatables.tabletools.js"></script>