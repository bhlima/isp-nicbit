<?= $this->extend('auth/layouts/default-table') ?>

<?= $this->section('main') ?>
    <div class="row">
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Total de Planos</h5>
            <h3 class="card-text"><?= $nplans ?></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Clientes ativos</h5>
            <h3 class="card-text"></h3>
          </div>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2">Planos</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a class="btn btn-sm btn-primary" href="plans/create"><i class="fas fa-edit"></i> Adicionar um Plano</a>
        </div>
    </div>
    
    <div class="card p-3">
        <div class="table-responsive">
            <table width="100%" class="table table-hover" id="dataTables-table" data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Valor</th>
                        <th>Instalação</th>
                        <th>Status</th>

                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $item):?>
                    <tr>
                        <td><?= $item['id_plano'] ?></td>
                        <td><?= $item['nome'] ?></td>
                        <td><?= $item['tipo_plano'] ?></td>
                        <td><?= $item['valor'] ?></td>
                        <td><?= $item['setup'] ?></td>
                        <td>
                            <?php if ($item['active'] == 1) : ?>
                                Ativo
                            <?php else : ?>
                                Parado
                            <?php endif ?>
                        </td>


                        <td class="text-right">
                            <?php if ($item['active'] == 0) : ?>
                                <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('plans/enable/').$item['id'] ?>"><i class="fas fa-user-check"></i> Ativar</a>
                            <?php endif ?>
                            <?php if ($item['active'] == 1) : ?>
                                <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('plans/disable/').$item['id'] ?>"><i class="fas fa-user-check"></i></a>
                            <?php endif ?>
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('plans/edit/').$item['id'] ?>"><i class="fas fa-edit"></i></a>
                            <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('plans/delete/').$item['id'] ?>"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>

<?= $this->endSection() ?>