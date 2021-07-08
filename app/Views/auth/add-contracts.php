<!-- load main layout -->
<?= $this->extend('auth/layouts/default') ?>
<!-- load main content -->

<?= $this->section('script') ?>
<script type="text/javascript">
    $("#grouparea").on("change", function() {
        var id = $("#grouparea").val();
        $.get('http://190.89.81.70/nicbit/public/index.php/contracts/getS/' + id, function(data, status) {
            if (status == "success") {
                $('#subgrouparea').html(data);
            }
        });
    });
</script>

<script type="text/javascript">
    $("#subgrouparea").on("change", function() {
        var id = $("#subgrouparea").val();
        $.get('http://190.89.81.70/nicbit/public/index.php/contracts/getP/' + id, function(data, status) {
            if (status == "success") {
                $('#plan').html(data);
            }
        });
    });
</script>

<?= $this->endSection('script') ?>

<?= $this->section('main') ?>

<div class="container mt-4 mb-4">
    <div class="row justify-content-md-center">
        <div class="col-md-12 col-lg-12">
            <h1 class="h2 mb-4">Contratar um plano para : <?= $username ?></h1>
            <form action="<?= site_url('contracts/create'); ?>" method="POST" accept-charset="UTF-8" onsubmit="Button.disabled = true; return true;">
                <?= csrf_field() ?>
                <div class="row">
                    <div class="col">
                        <label for="grouparea">Região de atuação do contrato</label>
                        <select required name="grouparea" id="grouparea" class="form-control">
                        <?= $areaoptions ?>
                        </select>
                    </div>
                    <div class="col">
                        <label for="subgrouparea">Sub Região</label>
                        <select required name="subgrouparea" id="subgrouparea" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="plan">Selecione o Plano disponívbel para a Região</label>
                        <select required name="plan" id="plan" class="form-control">
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="grupo_plano">Ativação</label>
                        <select required name="grupo_plano" id="grupo_plano" class="form-control">
                            <option value="assinatura">Imediata</option>
                            <option value="assinatura">Contra pagamento</option>
                            <option value="bonus">Após a conclusão da instalação</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="grupo_plano">Instalação</label>
                        <select required name="grupo_plano" id="grupo_plano" class="form-control">
                            <option value="assinatura">Abrir pedido de Instalação</option>
                            <option value="assinatura">Cliente ja foi instalado</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="grupo_plano">Formato da cobrança</label>
                        <select required name="grupo_plano" id="grupo_plano" class="form-control">
                            <option value="assinatura">Boleto avulso (PagBank)</option>
                            <option value="assinatura">Boleto avulso (Gerencianet)</option>
                            <option value="bonus">Carnê (Gerencianet)</option>
                            <option value="prepago">Assinatura controlada</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="grupo_plano">Geração da Invoice</label>
                        <select required name="grupo_plano" id="grupo_plano" class="form-control">
                            <option value="assinatura">Gerar fatura imediatamente</option>
                            <option value="assinatura">Gerar fatura na data do vencimento</option>
                        </select>
                    </div>
                </div>
        </div>
    </div>
    <hr>
    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="<?= site_url('plans') ?>" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Voltar</a>
</div>

<?= $this->endSection() ?>