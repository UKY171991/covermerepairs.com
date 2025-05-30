  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; <?=date('Y');?>.</strong>
    All rights reserved. 
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?= base_url();?>assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url();?>assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url();?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?= base_url();?>assets/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<!-- <script src="<?= base_url();?>assets/plugins/sparklines/sparkline.js"></script> -->
<!-- JQVMap -->
<script src="<?= base_url();?>assets/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?= base_url();?>assets/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?= base_url();?>assets/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?= base_url();?>assets/plugins/moment/moment.min.js"></script>
<script src="<?= base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?= base_url();?>assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?= base_url();?>assets/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url();?>assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url();?>assets/dist/js/adminlte.js"></script>

<!-- DataTables  & Plugins -->
 <script src="<?= base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url();?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

<script src="<?= base_url();?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url();?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url();?>assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url();?>assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url();?>assets/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url();?>assets/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url();?>assets/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url();?>assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url();?>assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url();?>assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Select2 -->
<script src="<?= base_url();?>assets/plugins/select2/js/select2.full.min.js"></script>

<script src="<?= base_url();?>assets/custom/custom.js"></script>

<?php if($ajax !='none'){ ?>
<!-- <script src="<?= base_url();?>assets/ajax/<?=$ajax?>.js"></script> -->
<?php } ?>

<!-- Custom JS for Part Order page (ensure this is after all other scripts) -->
<script>
window.openAddOrderModal = function() {
  $('#orderModalLabel').text('Add Part Order');
  $('#orderForm')[0].reset();
  $('#orderId').val('');
  $('#orderModal').modal('show');
}
window.openEditOrderModal = function(id, btn) {
  var row = $(btn).closest('tr');
  $('#orderModalLabel').text('Edit Part Order');
  $('#orderId').val(id);
  $('#order_id').val(row.find('td:eq(1)').text());
  $('#part_name').val(row.find('td:eq(2)').text());
  $('#quantity').val(row.find('td:eq(3)').text());
  $('#order_date').val(row.find('td:eq(4)').text());
  $('#status').val(row.find('td:eq(5)').text());
  $('#remarks').val(row.find('td:eq(6)').text());
  $('#orderModal').modal('show');
}
window.deleteOrder = function(id, btn) {
  if(confirm('Are you sure you want to delete this record?')) {
    $.ajax({
      url: '<?=base_url('part/delete_order/')?>' + id,
      type: 'POST',
      dataType: 'json',
      success: function(res) {
        if(res.status === 'success') {
          location.reload();
        }
      }
    });
  }
}
$(document).ready(function() {
  $('#orderForm').submit(function(e) {
    e.preventDefault();
    var id = $('#orderId').val();
    var url = id ? '<?=base_url('part/edit_order/')?>' + id : '<?=base_url('part/add_order')?>';
    $.ajax({
      url: url,
      type: 'POST',
      data: $(this).serialize(),
      dataType: 'json',
      success: function(res) {
        if(res.status === 'success') {
          location.reload();
        }
      }
    });
  });
});
</script>

</body>
</html>