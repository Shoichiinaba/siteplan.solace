<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
<script src="<?= base_url('assets_adm/'); ?>js/core/bootstrap.min.js"></script>
<script src="<?= base_url('assets_adm/'); ?>js/soft-ui-dashboard.min.js"></script>
<script src="<?= base_url('assets_adm/'); ?>js/soft-ui-dashboard.min.js.map"></script>
<script src="<?= base_url('assets_adm/'); ?>js/plugins/perfect-scrollbar.min.js"></script>
<script src="<?= base_url('assets_adm/'); ?>js/plugins/smooth-scrollbar.min.js"></script>
<script>
var win = navigator.platform.indexOf('Win') > -1;
if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
        damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
}
</script>
<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>