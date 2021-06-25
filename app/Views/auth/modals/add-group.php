<div class="modal fade" id="creategroupsformmodal" tabindex="-1" role="dialog" aria-labelledby="creategroupsformmodal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="creategroupsformmodaltitle">Cadastre um Login</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('groups/create'); ?>" method="POST" accept-charset="UTF-8" onsubmit="registerButton.disabled = true; return true;">
            <?= csrf_field() ?>
                <div class="form-goup">
                    <label for="username">Nome do grupo</label>
                    <input class="form-control" required type="text" name="groupname" value="<?= old('groupname') ?>" placeholder="Escolha um nome para o grupo"/>
                </div>

            <div class="form-group">
            <label for="vendor">Selecione o Fabricante</label>
            <select class="form-control form-control"  name="vendor">
              <option>Cleartext-Password</option>
              <option>User-Password</option>
              <option>Crypt-Password</option>
              <option>MD5-Password</option>
              <option>SHA1-Password</option>
              <option>CHAP-Password</option>
            </select>
            </div>
            <div class="form-group">
            <label for="attribute">Escolha o Atributo</label>
            <select class="form-control form-control"  name="attribute">
              <option>Cleartext-Password</option>
              <option>User-Password</option>
              <option>Crypt-Password</option>
              <option>MD5-Password</option>
              <option>SHA1-Password</option>
              <option>CHAP-Password</option>
            </select>
            </div>
            <div class="form-group">
            <label for="op">Operdador</label>
            <select class="form-control form-control"  name="op">
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

            <div class="form-group">
                    <label for="attribute">String de comparação</label>
                    <input class="form-control" required type="text" name="value" value="<?= old('value') ?>" placeholder="..."/>
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