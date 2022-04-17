<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?=($this->config->config["pageTitle"] != 'Atualizar 1.0')?$this->config->config["pageTitle"]:'Pagina / Não Existe 404'?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?=base_url()?>public/assets/img/favicon.png?v=<?=date('H:m:s')?>" rel="icon">
  <link href="<?=base_url()?>assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?=base_url()?>public/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?=base_url()?>public/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="<?=base_url()?>public/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="<?=base_url()?>public/assets/vendor/remixicon/remixicon.css" rel="stylesheet">

  <!-- Boostrap Select -->
  <!-- <link href="<?=base_url()?>public/assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet"> -->

  <!-- DataTable -->
  <link href="<?=base_url()?>public/assets/vendor/DataTables/datatables.min.css" rel="stylesheet">
  <link href="<?=base_url()?>public/assets/vendor/DataTables/DataTables-1.11.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">
  <link href="<?=base_url()?>public/assets/vendor/DataTables/SearchPanes/css/searchPanes.bootstrap5.min.css" rel="stylesheet">
  <link href="<?=base_url()?>public/assets/vendor/DataTables/Select/css/select.bootstrap5.min.css" rel="stylesheet">
  <link href="<?=base_url()?>public/assets/vendor/DataTables/Buttons/css/buttons.bootstrap5.min.css" rel="stylesheet">
  <link href="<?=base_url()?>public/assets/vendor/DataTables/FixedHeader/css/fixedHeader.bootstrap5.min.css" rel="stylesheet">

  
  <link href="<?=base_url()?>public/assets/vendor/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="<?=base_url()?>public/assets/css/style.css?v=0.1" rel="stylesheet">


  <style>
    @media only screen and (max-width: 500px) {
        .btn-group {
            width: 100% !important;
        }
    }
</style>

  <?php
    function dump($expressao, $die = null)
    {
        echo '<pre>';
        print_r($expressao);
        if($die){
            die;
        }
    }

    function hint($text){
      return '<span class="d-inline-block" tabindex="0" data-bs-toggle="popover" title="Info do Sistema" data-bs-html="true" data-bs-trigger="hover focus" data-bs-content="'.$text.'"> <i class="bx bxs-help-circle"></i> </span>';
    }
  ?>
</head>

<body id="btnmenubody">
  <input type="hidden" name="base_url" id="base_url" value="<?=base_url()?>">

  <div class="modal fade" id="verticalycentered" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Body
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
