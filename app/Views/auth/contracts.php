<?= $this->extend('auth/layouts/default-table') ?>

<?= $this->section('main') ?>
    <div class="row">
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Total de contratos</h5>
            <h3 class="card-text"><?= $ncontracts ?></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Clientes contratados</h5>
            <h3 class="card-text">0</h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Clientes sem contrato</h5>
            <h3 class="card-text">0</h3>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2">Contratos</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-primary" 
            href="<?= site_url('contract/create/') ?>">
            <i class="fas fa-user-plus"></i>  Contratar</button>
        </div>
    </div>

    <div class="card p-3">
        <div class="table-responsive">
            <table width="100%" class="table table-hover" id="dataTables-table" data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Plano</th>
                        <th>Vencimento</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>


                    <?php foreach ($data as $item):?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['username'] ?></td>
                        <td><?= $item['id_plano'] ?></td>
                        <td><?= $item['vencimentofat'] ?></td>
                        <td><?= $item['status_instalacao'] ?></td>




                        <td class="text-right">
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('contract/edit/').$item['id'] ?>"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('contract/delete/').$item['id'] ?>"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

<?= $this->endSection() ?>