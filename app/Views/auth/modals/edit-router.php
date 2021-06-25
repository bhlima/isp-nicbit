<div class="modal fade" id="editrouterformmodal" tabindex="-1" role="dialog" aria-labelledby="editrouterformmodal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editrouterformmodaltitle">Modifique os dados diretamente na tabela NAS do Radius</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="<?= site_url('router/update'); ?>" method="POST" accept-charset="UTF-8" onsubmit="Button.disabled = true; return true;">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="nasname">NAS IP/Host</label>
                <input class="form-control" required type="text" name="nasname" value="<?= $router['nasname'] ?>" />
            </div>
            <div class="form-group">
                <label for="secret">NAS SECRET</label>
                <input class="form-control" required type="text" name="secret" value="<?= $router['secret'] ?>" />
            </div>
            <div class="form-group">
                <label for="type">NAS Fabricante</label>
                <input class="form-control" type="text" name="type" value="<?= $router['type'] ?>" />
            </div>
            <div class="form-group">
                <label for="shortname">Apelido</label>
                <input class="form-control"  type="text" name="shortname" value="<?= $router['shortname'] ?>" />
            </div>

            <div class="form-group">
                <label for="server">Servidor Virtual</label>
                <input class="form-control" type="text" name="server" value="<?= $router['server'] ?>" />
            </div>

            <div class="form-group">
                <label for="community">Comunidade</label>
                <input class="form-control"  type="text" name="community" value="<?= $router['community'] ?>" />
            </div>
            <div class="form-group">
                <label for="description">Descrição</label>
                <input class="form-control" type="text" name="description" value="<?= $router['description'] ?>" />
            </div>
            <div class="form-group">
            <div class="text-right">
                <input name="id" type="hidden" value="<?= $router['id'] ?>" readonly/>
                <button type="submit" class="btn btn-primary" name="Button"><i class="fas fa-check-circle"></i> Update</button>
            </div>
        </form>
    </div>
<   /div>
  </div>  
</div>