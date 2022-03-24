<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0
  </div>
  <strong> Copyright &copy; 2020 All rights reserved by Activ-Market.KZ
</footer>
<!-- Control Sidebar -->

<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.4 -->
<? if ($closee == false) : ?>
  <script src="/assets/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<? endif; ?>
<!-- Bootstrap 3.3.5 -->
<script src="/assets/bootstrap/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<!-- DataTables -->
<script src="/assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="/assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<!-- ChartJS 1.0.1 -->
<script src="/assets/plugins/chartjs/Chart.min.js"></script>

<script src="/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="/assets/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="/assets/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="/assets/dist/js/demo.js"></script>
<!-- Sparkline -->
<script src="/assets/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="/assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<!--Список городов скассами-->
<!-- page script -->
<script>
  $(function() {
    $("#example1").DataTable();
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
	
        $('#region').change(function() {
          var region = $(this).val();
          console.log(region);
          $('#adress').load('../function/get_adress.php', {
            region: region
          });
        });
</script>
<script src="/assets/plugins/table/dataTables.buttons.min.js"></script>
<script src="/assets/plugins/table/jszip.min.js"></script>
<script src="/assets/plugins/table/buttons.html5.min.js"></script>
<script src="/assets/plugins/table/buttons.print.min.js"></script>
<script src="/assets/plugins/table/examples.datatables.tabletools.js"></script>
<script src="/assets/plugins/jszip/saveAsExcel.js"></script>

</body>

</html>