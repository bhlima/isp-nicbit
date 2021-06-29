<?= $this->extend('auth/layouts/default-table') ?>
<?= $this->section('modals') ?>
<?= view('App\Views\auth\modals\add-gateway') ?>
<?= $this->endSection() ?>


<?= $this->section('main') ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2">Extrato financeiro</h1>
    </div>
    <div class="card p-3">
        <div class="table-responsive">
            <table width="100%" class="table table-hover" id="dataTables-table" data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                    <th>Pagamento</th>
                        <th>Fatura</th>
                        <th>Metodo</th>
                        <th>protocolo</th>
                        <th>Status</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item):?>
                    <tr>
                    <td><?= $item['payment_at'] ?></td>
                        <td><?= $item['fatura_id'] ?></td>
                        <td><?= $item['method'] ?></td>
                        <td><?= $item['unique_id'] ?></td>
                        <td><?= $item['status'] ?></td>
                        <td><?= $item['valor'] ?></td>
                        <td class="text-right">
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