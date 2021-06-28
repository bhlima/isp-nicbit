<?= $this->extend('auth/layouts/default-table') ?>
<?= $this->section('modals') ?>
    <?= view('App\Views\auth\modals\add-groupc') ?>
<?= $this->endSection() ?>

<?= $this->section('main') ?>

    <div class="row">
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Total de Faturas</h5>
            <h3 class="card-text"><?= $countinvoices ?></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Aguardando Pagamento</h5>
            <h3 class="card-text"> 0  </h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Faturas Pagas</h5>
            <h3 class="card-text"> 0</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2">Faturas</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#creategatewayformmodal"><i class="fas fa-user-plus"></i> Criar uma fatura</button>
        </div>
    </div>

    <div class="card p-3">
        <div class="table-responsive">
            <table width="100%" class="table table-hover" id="dataTables-table" 
            data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Gerada</th>
                        <th>Vencimento</th>
                        <th>Status</th>
                        <th>Tipo</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item):?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['user_id'] ?></td>
                        <td><?= $item['date'] ?></td>
                        <td><?= $item['duedate'] ?></td>
                        <td><?= $item['status_id'] ?></td>
                        <td><?= $item['tipo_id'] ?></td>

                        <td class="text-right">
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('invoices/edit/').$item['id'] ?>"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('invoices/delete/').$item['id'] ?>"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>


<?= $this->endSection() ?>