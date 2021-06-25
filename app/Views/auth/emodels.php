<!-- load main layout with datatable -->
<?= $this->extend('auth/layouts/default-table') ?>

<!-- load main content -->
<?= $this->section('main') ?>

    <div class="row">
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Total de emails</h5>
            <h3 class="card-text"><?= $countemodels ?></h3>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2">Modelos de email</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a class="btn btn-sm btn-primary" href="emodels/create"><i class="fas fa-edit"></i> Adicionar Modelo</a>

        </div>
    </div>

    <div class="card p-3">
        <div class="table-responsive">
            <table width="100%" class="table table-hover" id="dataTables-table" data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Assunto</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item):?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['assunto'] ?></td>

                        <td class="text-right">
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('emodels/edit/').$item['id'] ?>"><i class="fas fa-edit"></i> Editar</a>
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('emodels/delete/').$item['id'] ?>"><i class="fas fa-trash"></i> Apagar</a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

<?= $this->endSection() ?>