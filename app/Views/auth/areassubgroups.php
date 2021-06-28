<?= $this->extend('auth/layouts/default-table') ?>
<?= $this->section('modals') ?>
    <?= view('App\Views\auth\modals\add-group') ?>
<?= $this->endSection() ?>
<?= $this->section('main') ?>

    <div class="row">
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Nome do Fornecedor</h5>
            <h3 class="card-text"><?= $vendor ?></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Total de atributos</h5>
            <h3 class="card-text"> 56  </h3>
          </div>
        </div>
      </div>

    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2">Atributos</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" 
            data-target="#creategroupsformmodal"><i 
            class="fas fa-user-plus"></i>Adicionar atributo para : <?= $vendor ?></button>
        </div>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" 
            data-target="#creategroupsformmodal"><i 
            class="fas fa-user-plus"></i>Adicionar atributo para : <?= $vendor ?></button>
        </div>
    </div>

    <div class="card p-3">
        <div class="table-responsive">
            <table width="100%" class="table table-hover" id="dataTables-table" 
            data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                        <th>Atributo</th>
                        <th>Tipo</th>
                        <th>Formato</th>
                        <th>Valor</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item):?>
                    <tr>
                        <td><?= $item['Attribute'] ?></td>
                        <td><?= $item['Type'] ?></td>
                        <td><?= $item['Format'] ?></td>
                        <td><?= $item['Value'] ?></td>

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