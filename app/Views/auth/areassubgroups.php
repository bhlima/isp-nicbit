<?= $this->extend('auth/layouts/default-table') ?>
<!-- load modals -->
<?= $this->section('modals') ?>

    <!-- create user modal form -->
    <?= view('App\Views\auth\modals\add-subgrouparea') ?>

<?= $this->endSection() ?>
<?= $this->section('main') ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2">Sub-grupos de: <?= $grouparea ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="<?= site_url('areas') ?>" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> <?=lang('back')?></a>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="<?= site_url('areas/createsub/') . $grouparea ?>" class="btn btn-sm btn-primary">
            <i class="fas fa-user-plus"></i> Criar um Sub Grupo </a>
        </div>
    </div>

    <div class="card p-3">
        <div class="table-responsive">
            <table width="100%" class="table table-hover" id="dataTables-table" 
            data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                    <th>#id</th>
                    <th>Sub Grupo</th>
                    <th>Opções</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item):?>
                    <tr>
                    <td><?= $item['id_grouparea'] ?></td>
                    <td><?= $item['subgroup_name'] ?></td>

                        <td class="text-right">
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('groups/editgroups/').$item['id'] ?>"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('groups/delete/').$item['id'] ?>"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
    
<br>
<?= $this->endSection() ?>