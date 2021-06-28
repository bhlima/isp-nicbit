<!-- load main layout with datatable -->
<?= $this->extend('auth/layouts/default-table') ?>

<!-- load modals -->
<?= $this->section('modals') ?>

    <!-- create user modal form -->
    <?= view('App\Views\auth\modals\add-router') ?>
  

    <?= $this->endSection() ?>



<!-- load main content -->
<?= $this->section('main') ?>



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