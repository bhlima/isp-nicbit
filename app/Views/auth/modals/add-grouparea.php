<div class="modal fade" id="creategroupareaformmodal" tabindex="-1" role="dialog" aria-labelledby="creategroupareaformmodal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="creategroupareraformmodaltitle">Cadastre um Grupo</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('areas/create'); ?>" method="POST" accept-charset="UTF-8" onsubmit="registerButton.disabled = true; return true;">
            <?= csrf_field() ?>
                <div class="form-group">
                    <label for="groupareas">Nome do Grupo</label>
                    <input class="form-control" required type="text" name="groupareas" value="<?= old('groupareas') ?>" placeholder="Nome do Grupo"/>
                </div>
              <br>
                <hr>
            <div class="text-right">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Fechar</button>
                <button type="submit" class="btn btn-primary" name="registerButton"><i class="fas fa-plus-circle"></i>Criar grupo</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>