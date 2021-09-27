  <footer class="main-footer">
    
  </footer>
</div>

<script src="{{ asset('admin_theme/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('admin_theme/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('admin_theme/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('admin_theme/plugins/sparklines/sparkline.js') }}"></script>
<script src="{{ asset('admin_theme/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('admin_theme/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('admin_theme/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('admin_theme/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<script src="{{ asset('admin_theme/dist/js/admin.js') }}"></script>
<script src="{{ asset('admin_theme/dist/js/pages/dashboard.js') }}"></script>
<script src="{{ asset('admin_theme/dist/js/demo.js') }}"></script>

<!-- DataTables -->
<script src="{{ asset('admin_theme/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('admin_theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('admin_theme/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('admin_theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });

  setTimeout(function() {
    $(".flashMsg").fadeOut("fast");
  }, 3000); // <-- time in milliseconds
</script>
</body>
</html>