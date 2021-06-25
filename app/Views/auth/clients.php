<!-- load main layout with datatable -->
<?= $this->extend('auth/layouts/default-table') ?>

<!-- load modals -->
<?= $this->section('modals') ?>

    <!-- create user modal form -->
    <?= view('App\Views\auth\modals\add-client') ?>

<?= $this->endSection() ?>

<!-- load main content -->
<?= $this->section('main'); 

?>
    <div class="row">
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Total de usuários</h5>
            <h3 class="card-text"><?= $clientscount ?></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Novos contratos</h5>
            <h3 class="card-text"> <span class="text-small text-muted">(nos últimos 30 dias)</span></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Indigentes</h5>
            <h3 class="card-text"><?= $countClientsIncompletos ?></h3>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2">Usuários do provedor</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createclientformmodal"><i class="fas fa-user-plus"></i>Criar um login</button>
        </div>
    </div>
    <div class="card p-3">
        <div class="table-responsive-sm">
            <table width="100%" class="table table-hover" id="dataTables-table" data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Usuario</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Telefone:</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item):?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['username'] ?></td>
                        <td><?= $item['nome'] ?></td>
                        <td><?= $item['cpf'] ?></td>
                        <td><?= $item['telefone1'] ?></td>

                        <td class="text-right">
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('clients/perfil/').$item['username'] ?>"><i class="fas fa-glasses"></i></a>
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('clients/edit/').$item['username'] ?>"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('clients/delete/').$item['id'] ?>"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

<?= $this->endSection() ?>