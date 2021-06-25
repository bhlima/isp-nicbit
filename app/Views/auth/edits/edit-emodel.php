<!-- load main layout -->
<?= $this->extend('auth/layouts/default-editor') ?>

<!-- load main content -->
<?= $this->section('main') ?>


 <div class="container mt-4 mb-4">
    <div class="row justify-content-md-center">
        <div class="col-md-12 col-lg-8">
            <h1 class="h2 mb-4">Editar modelo de email</h1>
            <form action="<?= site_url('emodels/update'); ?>" method="POST" accept-charset="UTF-8" onsubmit="Button.disabled = true; return true;">
            <?= csrf_field() ?>


            <div class="form-group">

                <label for="assunto">Assunto</label>
                <input type="text" name="assunto" class="form-control" id="assunto" placeholder="Iforme o assunto do email" value="<?= $emodel['assunto'] ?>">
            </div>

            <div class="form-group">
    <label for="mensagem">Mensagem</label>
    <textarea class="form-control" name="mensagem" id="mensagem"  placeholder="Iforme o assunto do email"  rows="5" ><?= $emodel['assunto'] ?>"</textarea>
  </div>





  <input name="id" type="hidden" value="<?= $emodel['id'] ?>" readonly/>

            <hr>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="<?= site_url('emodels') ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Voltar</a>

        </div>
    </div>
</div>

<?= $this->endSection() ?>