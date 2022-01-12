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
                <br>
                <div class="row">
                    <div class="col">
                        <label for="plan">Selecione o Plano disponívbel para a Região</label>
                        <select required name="plan" id="plan" class="form-control">
                        </select>
                    </div>
                </div>
                <br>
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
                <br>
                <div class="row">
                    <div class="col">
                        <label for="grupo_plano">Formato da cobrança</label>
                        <select required name="grupo_plano" id="grupo_plano" class="form-control">
                            <option value="assinatura">Boleto avulso (PagBank)</option>
                            <option value="assinatura">Boleto avulso (Gerencianet)</option>
                            <option value="bonus">Carnê (Gerencianet)</option>
                            <option value="prepago">Pagamento avulso</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="grupo_plano">Geração da primeira fatura</label>
                        <select required name="grupo_plano" id="grupo_plano" class="form-control">
                            <option value="assinatura">Gerar fatura imediatamente</option>
                            <option value="assinatura">Gerar fatura após a conclusão da instalação</option>
                            <option value="assinatura">Gerar fatura na data do vencimento</option>
                        </select>
                    </div>
                </div>
                <br>
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
                            <option value="assinatura">Gerar fatura após a conclusão da instalação</option>
                            <option value="assinatura">Gerar fatura na data do vencimento</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="vencimento">Vencimento</label>
                        <select required name="vencimento" id="vencimento" class="form-control">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                            <option value="12">12</option>
                            <option value="13">13</option>
                            <option value="14">14</option>
                            <option value="15">15</option>
                            <option value="16">16</option>
                            <option value="17">17</option>
                            <option value="18">18</option>
                            <option value="19">19</option>
                            <option value="20">20</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                            <option value="25">25</option>
                            <option value="26">26</option>
                            <option value="27">27</option>
                            <option value="28">28</option>
                            <option value="29">29</option>
                            <option value="30">30</option>
                        </select>
                    </div>
                </div>

                <h2>Endereço da Instalação<h2>
                <hr> <br>
                <div class="row">
                    <div class="col">
                        <label for="nome">Estado</label>
                        <input type="text" name="nome" class="form-control" id="nome" placeholder="Crie um nome Comercial para o Plano">
                    </div>

                    <div class="col">
                        <label for="id_plano">Cidade</label>
                        <input type="id_plano" name="id_plano" class="form-control" id="id_plano" placeholder="Ex: NIC001">
                    </div>
                </div>
                <br>
                <div class="form_gruoup">
                    <label for="id_plano">Endereço</label>
                    <input type="id_plano" name="id_plano" class="form-control" id="id_plano" placeholder="Ex: NIC001">
                </div>

                <br>


                <div class="form_gruoup">
                    <label for="id_plano">Referência</label>
                    <input type="id_plano" name="id_plano" class="form-control" id="id_plano" placeholder="Ex: NIC001">
                </div>
                <br>

                <div class="form_gruoup">
                    <label for="id_plano">Telefone de contato para instalação</label>
                    <input type="id_plano" name="id_plano" class="form-control" id="id_plano" placeholder="Ex: NIC001">
                </div>

        </div>
    </div>
    <br>

    <hr>
    <button type="submit" class="btn btn-primary">Criar contrato</button>
    <a href="<?= site_url('clients') ?>" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Voltar</a>
</div>
<?= $this->endSection() ?>