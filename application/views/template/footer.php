<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?=base_url()?>public/assets/vendor/jquery/jquery-3.6.0.min.js"></script>
<script src="<?=base_url()?>public/assets/vendor/jquery/jquery.mask.min.js"></script>
<script src="<?=base_url()?>public/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Boostrap Select -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/i18n/defaults-pt_BR.min.js"></script>

<!-- DataTable -->
<script src="<?=base_url()?>public/assets/vendor/DataTables/datatables.min.js"></script>
<script src="<?=base_url()?>public/assets/vendor/DataTables/DataTables-1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script src="<?=base_url()?>public/assets/vendor/DataTables/SearchPanes/js/searchPanes.bootstrap5.js"></script>
<script src="<?=base_url()?>public/assets/vendor/DataTables/Select/js/select.bootstrap5.min.js"></script>
<script src="<?=base_url()?>public/assets/vendor/DataTables/Buttons/js/buttons.bootstrap5.min.js"></script>
<script src="<?=base_url()?>public/assets/vendor/DataTables/FixedHeader/js/fixedHeader.bootstrap5.min.js"></script>

<script src="<?=base_url()?>public/assets/vendor/sweetalert2/dist/sweetalert2.all.min.js"></script>


<!-- Template Main JS File -->
<script src="<?=base_url()?>public/assets/js/main.js?v=1.92"></script>

<?php
    if(isset($js)){
        foreach($js as $value){
            print "<script src='".base_url()."$value'></script>\n";
        }
    }
?>

<?=$this->session->userdata('ativaMenuFucos')?>

<?php if($this->session->userdata('msg_obs') != null){ 
    $array = explode('####', $this->session->userdata('msg_obs'));
    $msg = $array[0];
    if(isset($array[1])){
        $type = $array[1];
    }else{
        $type = 'error';
    }
    ?>
    <script>
        alertPersona('<?=$type?>', '<?=$msg?>', 3000);
    </script>
<?php 
    $this->session->unset_userdata('msg_obs');
    } 
?>

<script>
    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl)
    })

</script>

<footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Leonardo Santos</span></strong>. All Rights Reserved
    </div>
</footer>
</body>
</html>