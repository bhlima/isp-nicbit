<?= $this->extend('auth/layouts/default-table') ?>
<?= $this->section('modals') ?>
<?= view('App\Views\auth\modals\add-gateway') ?>
<?= $this->endSection() ?>


<?= $this->section('main') ?>
    <div class="row">
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Tamanho do Mapeamento</h5>
            <h3 class="card-text"><?= $totalmapeamento ?></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Clientes ativos</h5>
            <h3 class="card-text"></h3>
          </div>
        </div>
      </div>
    </div>


    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2">Mapa de Usuários/Grupos</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#creategatewayformmodal"><i class="fas fa-user-plus"></i> Adicionar gateway</button>
        </div>
    </div>


    <div class="card p-3">
        <div class="table-responsive">
            <table width="100%" class="table table-hover" id="dataTables-table" 
            data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                        <th>Usuário</th>
                        <th>Nome do Grupo</th>
                        <th>Prioridade</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item):?>
                    <tr>
                        <td><?= $item['username'] ?></td>
                        <td><?= $item['groupname'] ?></td>
                        <td><?= $item['priority'] ?></td>

                        <td class="text-right">
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('groups/editgroups/').$item['username'] ?>"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('groups/delete/').$item['username'] ?>"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>



<?= $this->endSection() ?>