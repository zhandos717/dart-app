      <footer class="main-footer no-print">
          <div class="pull-right hidden-xs">

              <b>Version</b> 1.0.0
          </div>
          <strong> Copyright &copy; 2020 All rights reserved by Activ-Market.KZ
      </footer>
      <!-- Control Sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
      </div><!-- ./wrapper -->
      <!-- Bootstrap 3.3.5 -->
      <script src="/assets/bootstrap/js/bootstrap.min.js"></script>
      <!-- Slimscroll -->
      <script src="/assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
      <!-- FastClick -->
      <script src="/assets/plugins/fastclick/fastclick.min.js"></script>
      <!-- AdminLTE App -->
      <script src="/assets/dist/js/app.min.js"></script>
      <!-- AdminLTE for demo purposes -->
      <script src="/assets/dist/js/demo.js"></script>
      <!-- iCheck -->
      <script src="/assets/plugins/iCheck/icheck.min.js"></script>
      <!-- Bootstrap WYSIHTML5 -->
      <script src="/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
      <!-- Page Script -->
      <script>
          $(function() {
              //Add text editor
              $("#compose-textarea").wysihtml5();

              //Enable iCheck plugin for checkboxes
              //iCheck for checkbox and radio inputs
              $('.mailbox-messages input[type="checkbox"]').iCheck({
                  checkboxClass: 'icheckbox_flat-blue',
                  radioClass: 'iradio_flat-blue'
              });

              //Enable check and uncheck all functionality
              $(".checkbox-toggle").click(function() {
                  var clicks = $(this).data('clicks');
                  if (clicks) {
                      //Uncheck all checkboxes
                      $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
                      $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
                  } else {
                      //Check all checkboxes
                      $(".mailbox-messages input[type='checkbox']").iCheck("check");
                      $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
                  }
                  $(this).data("clicks", !clicks);
              });

              //Handle starring for glyphicon and font awesome
              $(".mailbox-star").click(function(e) {
                  e.preventDefault();
                  //detect type
                  var $this = $(this).find("a > i");
                  var glyph = $this.hasClass("glyphicon");
                  var fa = $this.hasClass("fa");

                  //Switch states
                  if (glyph) {
                      $this.toggleClass("glyphicon-star");
                      $this.toggleClass("glyphicon-star-empty");
                  }

                  if (fa) {
                      let id = $(this).data('id');
                      $.post('./mailbox/function/edit_email.php', {
                              mark_id: id
                          })
                          .done(function(data) {
                              console.log(data)
                          });
                      $this.toggleClass("fa-star");
                      $this.toggleClass("fa-star-o");


                  }
              });

              $('.text').text(function(index, text) {
                  text = text.substr(0, 35).concat('....');
                  return text;
              });


          });
      </script>

      </body>

      </html>