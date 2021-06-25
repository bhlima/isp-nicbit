<div class="modal fade" id="createrouterformmodal" tabindex="-1" role="dialog" aria-labelledby="createrouterformmodal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createrouterformmodaltitle">Insira os dados do novo Cliente/OS na tabela NAS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= site_url('router/create-router'); ?>" method="POST" accept-charset="UTF-8" onsubmit="registerButton.disabled = true; return true;">
            <?= csrf_field() ?>




            <div class="form-group row">
                <div class="col">
                    <label for="nasname">NAS IP/Host</label>
                    <input class="form-control" required type="text" name="nasname" value="<?= old('nasname') ?>" placeholder="Endereço Ip do Cliente NAS"/>
                </div>
                <div class="col">
                    <label for="secret">NAS SECRET</label>
                    <input class="form-control" type="text" name="secret" value="<?= old('secret') ?>" placeholder="Endereço IP da Roterboard"/>
                </div>
            </div>

            <div class="form-group row">

                <div class="col">
                    <label for="community">Comunidade</label>
                    <input class="form-control" type="text" name="community" value="<?= old('community') ?>" placeholder="Comunidade NAS (caso tenha)"/>
                </div>

                
                <div class="col">
                    <label for="type">NAS Fabricante</label>
                    <input class="form-control" type="text" name="type" value="<?= old('type') ?>" placeholder="Fabricante do NAS"/>
                </div>
                </div>

              <div class="form-group row">

                <div class="col">
                    <label for="ports">Portas</label>
                    <input class="form-control" type="text" name="ports" value="<?= old('ports') ?>" placeholder="Caso utilize portas especiais para autenticação"/>
                </div>

                <div class="col">
                    <label for="server">Servidor Virtual</label>
                    <input class="form-control" type="text" name="server" value="<?= old('server') ?>" placeholder="Servidor Virtual (caso seja)"/>
                </div>
              </div>

            <div class="form-group">
                <label for="shortname">Apelido</label>
                <input class="form-control"  type="text" name="shortname" value="<?= old('shortname') ?>" placeholder="Nome curto para entendimento rápido"/>
            </div>


            <div class="form-group">
                <label for="description">Descrição</label>
                <input class="form-control" type="text" name="description" value="<?= old('description') ?>" placeholder="Descreva..."/>
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