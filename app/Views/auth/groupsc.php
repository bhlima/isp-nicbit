<?= $this->extend('auth/layouts/default-table') ?>
<?= $this->section('modals') ?>
    <?= view('App\Views\auth\modals\add-groupc') ?>
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
            <table width="100%" class="table table-hover" id="dataTables-table" 
            data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Atributo</th>
                        <th>op</th>
                        <th>Value</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item):?>
                    <tr>
                        <td><?= $item['id'] ?></td>
                        <td><?= $item['groupname'] ?></td>
                        <td><?= $item['attribute'] ?></td>
                        <td><?= $item['op'] ?></td>
                        <td><?= $item['value'] ?></td>

                        <td class="text-right">
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('groupsc/edit/').$item['id'] ?>"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('groupsc/delete/').$item['id'] ?>"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>


<?= $this->endSection() ?>