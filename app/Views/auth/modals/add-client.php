<div class="modal fade" id="createclientformmodal" tabindex="-1" role="dialog" aria-labelledby="createclientformmodal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createclientformmodaltitle">Cadastre um Login</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('clients/create'); ?>" method="POST" accept-charset="UTF-8" onsubmit="registerButton.disabled = true; return true;">
            <?= csrf_field() ?>
            <div class="form-group row">
                <div class="col">
                    <label for="username">Usuario</label>
                    <input class="form-control" required type="text" name="username" value="<?= old('username') ?>" placeholder="username"/>
                </div>
                <div class="col">
                    <label for="attribute">Senha</label>
                    <input class="form-control" required type="text" name="value" value="<?= old('value') ?>" placeholder="senha"/>
                </div>
            </div>

            <div class="form-group">
            <label for="name">Tipo de senha</label>

            <select class="form-control form-control-sm"  name="attribute">
              <option>Cleartext-Password</option>
              <option>User-Password</option>
              <option>Crypt-Password</option>
              <option>MD5-Password</option>
              <option>SHA1-Password</option>
              <option>CHAP-Password</option>
            </select>
            </div>


            <div class="form-group">
            <label for="op">Tipo de senha</label>
            <select class="form-control form-control-sm"  name="op">
              <option> := </option>
              <option>  = </option>
              <option> == </option>
              <option> += </option>
              <option> != </option>
              <option> >= </option>
              <option>  < </option>
              <option> <= </option>
              <option> =~ </option>
              <option> !~ </option>
              <option> =* </option>
              <option> !* </option>
            </select>
            </div>

            <div class="text-right">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times-circle"></i> Fechar</button>
                <button type="submit" class="btn btn-primary" name="registerButton"><i class="fas fa-plus-circle"></i> <?= lang('Auth.register') ?></button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>