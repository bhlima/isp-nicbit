<!-- load main layout with datatable -->
<?= $this->extend('auth/layouts/default-table') ?>

<!-- load modals -->
<?= $this->section('modals') ?>

    <!-- create user modal form -->
    <?= view('App\Views\auth\modals\add-router') ?>
  

    <?= $this->endSection() ?>



<!-- load main content -->
<?= $this->section('main') ?>

    <div class="row">
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Total de Clientes NAS</h5>
            <h3 class="card-text"><?= $routercount ?></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Clientes NAS ativos</h5>
            <h3 class="card-text"> <?= $routerativo ?>  </h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Autenticações hoje</h5>
            <h3 class="card-text"> 64</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2">Clientes da tabela NAS</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#createrouterformmodal"><i class="fas fa-user-plus"></i> Adicionar Router</button>
        </div>
    </div>

    <div class="card p-3">
        <div class="table-responsive-sm">
            <table width="100%" class="table table-hover" id="dataTables-table" data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>nas</th>
                        <th>Tipo</th>
                        <th>Descrição</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item):?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['nasname'] ?></td>
                        <td><?= $item['shortname'] ?></td>
                        <td><?= $item['description'] ?></td>
                        <td class="text-right">
                        <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('router/edit/').$item['id'] ?>"><i class="fas fa-wrench"></i></a>

                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('router/edit/').$item['id'] ?>"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('router/delete/').$item['id'] ?>"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

<?= $this->endSection() ?>