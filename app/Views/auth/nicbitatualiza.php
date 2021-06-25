<?= $this->extend('auth/layouts/default') ?>

<?= $this->section('main') ?>

<div class="container-sm">
<main role="main" class="container">

<div class="row">
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Uptime</h5>
            <h6 class="card-text"><?= $uptime ?></h6>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Nome do Servidor</h5>
            <h6 class="card-text"><?= $hostname ?></h6>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Data do sistema</h5>
            <h6 class="card-text"> <?= $datetime ?></h6>
          </div>
        </div>
      </div>
    </div>


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
    <h1>nicbit - ispm</h1>

    </div>

    <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Versão</th>
      <th scope="col">Plano</th>
      <th scope="col">Contratação</th>
      <th scope="col">Status</th>


    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1.1.0 (recente)</th>
      <td>MAX Provedor</td>
      <td>27/06/1972</td>
      <td>Em Produção</td>

    </tr>
    <tr>
      <th scope="row">1.1.0</th>
      <td>MAX SMNP</td>
      <td>27/06/1972</td>
      <td>Contratar</td>

    </tr>
  </tbody>
</table>
<hr>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
    <h1>Informações do Servidor</h1>
</div>


    <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Tarefa</th>
      <th scope="col">Carga atual</th>



    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">System Load</th>
      <td><?= $systemload ?></td>


    </tr>
  </tbody>
</table>
<hr>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
    <h1>Capacidade de Memória</h1>
</div>

<table class="table table-bordered">
  <thead>

  </thead>
  <tbody>
    <tr>
      <th scope="row">Momória total</th>
      <td><?= $memtotal ?></td>
    </tr>
    <tr>
      <th scope="row">Memória livre</th>
      <td><?= $memfree ?></td>
    </tr>
    <tr>
      <th scope="row">SMenória usada</th>
      <td><?= $memused ?></td>
    </tr>
  </tbody>
</table>



<?php
//	$meminfo = $memory;
?>



<hr>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
    <h1>Informações do HDD</h1>
</div>
<table class="table table-bordered">
  <thead>

</thead>
  <tbody>
    <tr>
      <th scope="row">Espaço livre</th>
      <td><?= $hddfreemb ?></td>
    </tr>
  </tbody>
</table>
<br>

</main>
</div>
<?= $this->endSection() ?>