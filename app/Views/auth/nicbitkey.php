<?= $this->extend('auth/layouts/default') ?>

<?= $this->section('main') ?>

<div class="container-lg">
<main role="main" class="container">

<div class="starter-template">
  <h1>nicbit - inserir nova chave de licenca</h1>
  <p class="lead">Só insira nova chave em caso de cancelamento ou renovacao.
  <br>As chaves podem ser migradas em novas atualizacoes.</p> <br>
  
  <form class="row g-3">
  <div class="col-auto">
    <input type="text" class="form-control" id="inputPassword2" placeholder="Cole aqui sua chave">
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-primary mb-3">Validar nova chave</button>
  </div>
</form>
<br>

</main><!-- /.container -->
</div>
<?= $this->endSection() ?>