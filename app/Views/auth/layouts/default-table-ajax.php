<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Nicbit - isp</title>

    <!-- load extended styles -->
    <?= $this->renderSection('style') ?>

    <!-- default styles  -->
    <link rel="stylesheet" href="<?= base_url('vendor/fontawesome/css/fontawesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/fontawesome/css/solid.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/fontawesome/css/brands.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/datatables/datatables.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/nicbit.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/select2/dist/css/select2.min.css'); ?>">


<!-- jQuery baseUrl -->
<script>
        var baseUrl = "<?php echo base_url(); ?>";
        var siteUrl = "<?php echo site_url(); ?>";
    </script>


</head>

<body class="bg-light">
    <!-- load extended modals -->
    <?= $this->renderSection('modals') ?>

    <!-- navbar -->
    <?= view('App\Views\auth\components\navbar2') ?>

    <main role="main" class="container">
      <!-- notifications -->
      <?= view('App\Views\auth\components\notifications') ?>

      <!-- load content from other views -->
      <?= $this->renderSection('main') ?>
    </main>

    <script src="<?= base_url("vendor/select2/dist/js/select2.full.min.js") ?>" type="text/javascript"></script>

    <script src="<?= base_url("vendor/jquery/jquery.min.js") ?>" type="text/javascript"></script>
    <script src="<?= base_url("vendor/bootstrap/js/bootstrap.bundle.min.js") ?>" type="text/javascript"></script>
    <script src="<?= base_url("vendor/datatables/datatables.min.js") ?>" type="text/javascript"></script>
   
    <!-- inline js code -->
    <script type="text/javascript">
        $('#dataTables-table').DataTable({responsive: true,pageLength: 15,lengthChange: false,searching: true,ordering: true});
    </script>
      <?= csrf_field() ?>

<script type="text/javascript">

    $(function(){
        $('#vendor').change(function(){
            var vendor = $('#vendor').val();
            $.ajax({
                url: baseUrl + '/dicatt',
                method: "POST",
                data: vendor
            });

            alert(vendor);
        });
    });
    </script> 
    
    <!-- load extended scripts -->
    <?= $this->renderSection('script') ?>






</body>

</html>