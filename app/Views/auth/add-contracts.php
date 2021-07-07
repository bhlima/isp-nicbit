<!-- load main layout -->
<?= $this->extend('auth/layouts/default') ?>
<!-- load main content -->
<?= $this->section('main') ?>

<script>
    $(function() {
        $(".btn-toggle").click(function(e) {
            e.preventDefault();
            el = $(this).data('element');
            $(el).toggle();
        });
    });
</script>


<div class="container mt-4 mb-4">
    <div class="row justify-content-md-center">
        <div class="col-md-12 col-lg-12">
            <h1 class="h2 mb-4">Contratar um plano para : <?= $username ?></h1>
            <form action="<?= site_url('contracts/create'); ?>" method="POST" accept-charset="UTF-8" onsubmit="Button.disabled = true; return true;">
                <?= csrf_field() ?>

                <div class="row">
                    <div class="col">
                        <label for="tipo_plano">Região de atuação do contrato</label>
                        <select required name="tipo_plano" id="tipo_plano" class="form-control">
                            <option value="assinatura">Assinatura</option>
                            <option value="bonus">Até o teŕmino da carga</option>
                            <option value="prepago">Assinatura controlada</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label for="tipo_plano">Selecione o Plano do Contrato</label>
                        <select required name="tipo_plano" id="tipo_plano" class="form-control">
                            <option value="assinatura">Assinatura</option>
                            <option value="bonus">Até o teŕmino da carga</option>
                            <option value="prepago">Assinatura controlada</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="grupo_plano">Grupo de Resposta ao Servidor Radius</label>
                    <select required name="grupo_plano" id="grupo_plano" class="form-control">
                        <? //= $data 
                        ?>
                    </select>
                </div>
        </div>
    </div>
    <hr>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="<?= site_url('plans') ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Voltar</a>
</div>
</div>



</div>

<?= $this->endSection() ?>