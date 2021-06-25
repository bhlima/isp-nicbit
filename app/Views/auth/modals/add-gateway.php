<div class="modal fade" id="creategatewayformmodal" tabindex="-1" role="dialog" aria-labelledby="creategatewayformmodal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="creategatewayformmodaltitle">Cadastrar novo Gateway</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('gateways/create-gateway'); ?>" method="POST" accept-charset="UTF-8" onsubmit="registerButton.disabled = true; return true;">
            <?= csrf_field() ?>
            <div class="form-group"> 
                    <label for="client_id">Client id</label>
                    <input class="form-control" required type="text" name="client_id" value="<?= old('client_id') ?>" placeholder="First name"/>
                </div>


                <div class="form-group">
                    <label for="client_secret">Client Secret</label>
                    <input class="form-control" required type="text" name="client_secret" value="<?= old('client_secret') ?>" placeholder="Client Secret"/>
                </div>

            <div class="form-group">
                <label for="pix_cert">Certificado do PIX</label>
                <input class="form-control" required type="text" name="pix_cert" value="<?= old('pix_cert') ?>" placeholder="Certificado do PIX"/>
            </div>

            <div class="form-group">
                <label for="sandbox">Em teste</label>
                <input class="form-control" required type="text" name="sandbox" value="<?= old('sandbox') ?>" placeholder="SandBox"/>
            </div>
            <div class="form-group">
                <label for="debug">Debug</label>
                <input class="form-control" required type="text" name="debug" value="" placeholder="Debug" />
            </div>
            <div class="form-group">
                <label for="timeout">timeout</label>
                <input class="form-control" required type="text" name="timeout" value="" placeholder="Timeout" />
            </div>

            <div class="text-right">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Fechar</button>
                <button type="submit" class="btn btn-primary" name="registerButton"><i class="fas fa-plus-circle"></i> Salvar</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>