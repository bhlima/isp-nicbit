<!DOCTYPE html>
<html lang="pt-br">

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


    <script src="<?= base_url("vendor/jquery/jquery.min.js") ?>" type="text/javascript"></script>
    <script src="<?= base_url("vendor/bootstrap/js/bootstrap.bundle.min.js") ?>" type="text/javascript"></script>
    <script src="<?= base_url("vendor/datatables/datatables.min.js") ?>" type="text/javascript"></script>
    <script src="<?= base_url("vendor/select2/dist/js/select2.full.min.js") ?>" type="text/javascript"></script>

    <!-- inline js code -->
    <script type="text/javascript">
        $('#dataTables-table').DataTable({
            "language": {
          "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
      },
            responsive: true,
            pageLength: 10,
            lengthChange: false,
            searching: true,
            ordering: true});
 
 
 </script>




   
    <!-- load extended scripts -->
    <?= $this->renderSection('script') ?>




    <!-- navbar -->


</body>
<br>
<br>
<br>
    <?= view('App\Views\auth\components\footer') ?>
</html>