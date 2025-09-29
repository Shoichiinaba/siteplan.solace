<!--   Core JS Files   -->
<script src="<?= base_url('assets_adm/'); ?>js/core/popper.min.js"></script>
<script src="<?= base_url('assets_adm/'); ?>js/core/bootstrap.min.js"></script>
<script src="<?= base_url('assets_adm/'); ?>js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?= base_url('assets_adm/'); ?>js/plugins/smooth-scrollbar.min.js"></script>
<script src="<?= base_url('assets_adm/'); ?>vendor/select2/select2.min.js"></script>


<script>
var win = navigator.platform.indexOf('Win') > -1;
if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
        damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
}
</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<script src="<?= base_url('assets_adm/'); ?>js/soft-ui-dashboard.min.js?v=1.1.1"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
</script>
<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

<!-- date range picker JS -->
<script src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
</script>

</body>

</html>