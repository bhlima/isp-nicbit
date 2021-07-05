<div class="modal fade" id="subgroupareaformmodal" tabindex="-1" role="dialog" aria-labelledby="subgroupareaformmodal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="subgroupareaformmodaltitle">Cadastre um Sub - Grupo</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('areas/createsub'); ?>" method="POST" accept-charset="UTF-8" onsubmit="registerButton.disabled = true; return true;">
            <?= csrf_field() ?>
            <div class="form-group row">
                <div class="col">
                    <label for="subgroup">Nome do Sub - Grupo</label>
                    <input class="form-control" required type="text" name="subgroup" value="<?= old('subgroup') ?>" placeholder="Nome do Sub Grupo"/>
                </div>
            </div>
            <div class="text-right">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Fechar</button>
                <button type="submit" class="btn btn-primary" name="registerButton"><i class="fas fa-plus-circle"></i>Criar sub-grupo</button>
            </div>
            <input name="groupareas" type="hidden" value="<?//= $item['groupareas'] ?>" readonly/>
        </form>
      </div>
    </div>
  </div>
</div>