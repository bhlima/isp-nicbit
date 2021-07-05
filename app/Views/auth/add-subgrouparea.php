<!-- load main layout -->
<?= $this->extend('auth/layouts/default') ?>

<!-- load main content -->
<?= $this->section('main') ?>

 <div class="container mt-4 mb-4">
    <div class="row justify-content-md-center">
        <div class="col-md-12 col-lg-12">
            <h1 class="h2 mb-4">Adicionar um Sub Grupo</h1>
            <form action="<?= site_url('areas/createsub'); ?>" method="POST" accept-charset="UTF-8" onsubmit="Button.disabled = true; return true;">
            <?= csrf_field() ?>

            <div class="row">
            <div class="col">
                    <label for="subgroup_name">Nome do Sub Grupo</label>
                    <input type="text" name="subgroup_name" class="form-control" id="subgroup_name" placeholder="Digite um nome para o subgrupo">
                </div>
            </div>
            <br>
    

</div>      
</div>
        <hr>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="<?= site_url('areas') ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>
    </div>



</div>

<?= $this->endSection() ?>