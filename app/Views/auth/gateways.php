<?= $this->extend('auth/layouts/default-table') ?>
<?= $this->section('modals') ?>
<?= view('App\Views\auth\modals\add-gateway') ?>
<?= $this->endSection() ?>


<?= $this->section('main') ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2">Gateways</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#creategatewayformmodal"><i class="fas fa-user-plus"></i> Adicionar gateway</button>
        </div>
    </div>

    <div class="card p-3">
        <div class="table-responsive">
            <table width="100%" class="table table-hover" id="dataTables-table" data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Cliente ID</th>
                        <th>Secret</th>
                        <th>Teste</th>
                        <th>Debug</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item):?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['client_id'] ?></td>
                        <td><?= $item['client_secret'] ?></td>
   
                        <td><?= $item['sandbox'] ?></td>
                        <td><?= $item['debug'] ?></td>
                        <td>
                            <?php if ($item['active'] == 1) : ?>
                                Ativo
                            <?php else : ?>
                                Parado
                            <?php endif ?>
                        </td>
                        <td class="text-right">
                            <?php if ($item['active'] == 0) : ?>
                                <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('gateways/enable/').$item['id'] ?>"><i class="fas fa-user-check"></i> Ativar</a>
                            <?php endif ?>
                            <?php if ($item['active'] == 1) : ?>
                                <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('gateways/disable/').$item['id'] ?>"><i class="fas fa-user-check"></i></a>
                            <?php endif ?>
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('gateways/edit/').$item['id'] ?>"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('gateways/delete/').$item['id'] ?>"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

<?= $this->endSection() ?>