<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 1.0.9
  </div>
  <strong> Copyright &copy; 2020 All rights reserved by Activ-Market.KZ
</footer>
<!-- Control Sidebar -->
<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div><!-- ./wrapper -->
<!-- jQuery 2.1.4 -->
<script src="../adm/plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="../adm/bootstrap/js/bootstrap.min.js"></script>
<!-- Slimscroll -->
<!-- DataTables -->
<script src="../adm/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../adm/plugins/datatables/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<!-- ChartJS 1.0.1 -->
<script src="../adm/plugins/chartjs/Chart.min.js"></script>
<script src="../adm/plugins/slimScroll/jquery.slimscroll.min.js"></script>

<script src="../adm/plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="../adm/plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="../adm/dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../adm/dist/js/demo.js"></script>
<!-- Sparkline -->
<script src="../adm/plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="../adm/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="../adm/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

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
    $('#example3').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false
    });
  });
</script>
</body>

</html>