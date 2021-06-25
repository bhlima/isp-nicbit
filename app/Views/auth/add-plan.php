<!-- load main layout -->
<?= $this->extend('auth/layouts/default') ?>

<!-- load main content -->
<?= $this->section('main') ?>

 <div class="container mt-4 mb-4">
    <div class="row justify-content-md-center">
        <div class="col-md-12 col-lg-12">
            <h1 class="h2 mb-4">Plano de contrato</h1>
            <form action="<?= site_url('plans/c'); ?>" method="POST" accept-charset="UTF-8" onsubmit="Button.disabled = true; return true;">
            <?= csrf_field() ?>

            <div class="row">
                <div class="col">
                    <label for="nome">Nome do Plano</label>
                    <input type="text" name="nome" class="form-control" id="nome" placeholder="Crie um nome Comercial para o Plano">
                </div>

                <div class="col">
                    <label for="id_plano">Código</label>
                    <input type="id_plano" name="id_plano" class="form-control" id="id_plano" placeholder="Ex: NIC001">
                </div>
              
                <div class="col">
                    <label for="tipo_plano">Tipo do Plano</label>
                    <select required name="tipo_plano" id="tipo_plano" class="form-control">
                        <option value="assinatura">Assinatura</option>
                        <option value="bonus">Até o teŕmino da carga</option>
                        <option value="prepago">Assinatura controlada</option>
                    </select> 
                 </div>
              </div>
            <div class="row">
            <div class="col">
                    <label for="valor">Valor do Plano</label>
                    <input type="valor" name="valor" class="form-control" id="valor" placeholder="0,00">
                </div>
                <div class="col">
                    <label for="setup">Valor da instalação</label>
                    <input type="setup" name="setup" class="form-control" id="setup" placeholder="0,00">
                </div>
                <div class="col">
                    <label for="imposto">Imposto</label>
                    <input type="imposto" name="imposto" class="form-control" id="imposto" placeholder="0,00">
                </div>
                </div>
            <br>
            <h4 class="h4 mb-4">Detalhes para planos controlados</h4>
            <p>Somente para Planos controle - Para ilimitado coloque 0</p>
        <hr>
            <div class="row">
                <div class="col">
                    <label for="plano_horas">Total de Horas (h)</label>
                    <input type="text" name="plano_horas" class="form-control" id="plano_horas" placeholder="0">
                </div>
                <div class="col">
                    <label for="plano_trafego">Total de tráfego (GB)</label>
                    <input type="plano_trafego" name="plano_trafego" class="form-control" id="plano_trafego" placeholder="0">
                </div>
                <div class="col">
                    <label for="plano_banda_up">Upload Máximo (MB)</label>
                    <input type="text" name="plano_banda_up" class="form-control" id="plano_banda_up" placeholder="0">
                </div>            
                <div class="col">
                    <label for="plano_banda_dw">Download Máximo (MB)</label>
                    <input type="plano_banda_dw" name="plano_banda_dw" class="form-control" id="plano_banda_dw" placeholder="0">
                </div>
            </div>
            <br>
            <h4 class="h4 mb-4">Servidor Radius</h4>
            <div class="form-group">
    <label for="grupo_plano">Grupo de Resposta ao Servidor Radius</label>
    <select required name="grupo_plano" id="grupo_plano" class="form-control">
        <?= $data ?>
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