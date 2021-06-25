<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="nicbit - isp - Sistema de Gerenciamento de Provedores">
    <meta name="author" content="Flavio Lima - Radius - ITA (Instituto tecnologico da Aeronáutica">
    <meta name="generator" content="nicbit | sistemas em CodeIgniter 4">
    <title>Nicbit - isp <- Radius</title>

    <!-- load extended styles -->
    <?= $this->renderSection('style') ?>

    <!-- default styles  -->
    <link rel="stylesheet" href="<?= base_url('vendor/fontawesome/css/fontawesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/fontawesome/css/solid.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/fontawesome/css/brands.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/nicbit.css'); ?>">    
    <link rel="stylesheet" href="<?= base_url('vendor/select2/dist/css/select2.min.css'); ?>">




    <script src="https://cdn.tiny.cloud/1/ofrnrwzd79wxhrgnzstet5k3lvjnsgm80gzwg7zbnhkhw796/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  tinymce.init({
    selector: 'textarea#editor',
    menubar: false
  });
</script>

</head>

<body class="bg-light">
    <!-- navbar -->
    <?= view('App\Views\auth\components\navbar') ?>

    <main role="main" class="container">
      <!-- notifications -->
      <?= view('App\Views\auth\components\notifications') ?>

      <!-- load content from other views -->
      <?= $this->renderSection('main') ?>
    </main>

    <script src="<?= base_url("vendor/select2/dist/js/select2.full.min.js") ?>" type="text/javascript"></script>
    <script src="<?= base_url("vendor/jquery/jquery.min.js") ?>" type="text/javascript"></script>
    <script src="<?= base_url("vendor/bootstrap/js/bootstrap.bundle.min.js") ?>" type="text/javascript"></script>
    <!-- load extended scripts -->
    <?= $this->renderSection('script') ?>
    <!-- navbar -->
    <br>

    <?= view('App\Views\auth\components\footer') ?>

</body>

</html>