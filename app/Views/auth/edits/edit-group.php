<!-- load main layout -->
<?= $this->extend('auth/layouts/default') ?>

<!-- load main content -->
<?= $this->section('main') ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2">Modificar Router</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="<?= site_url('groups') ?>" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Voltar</a>
        </div>
    </div>

    <div class="card p-5">
        <form action="<?= site_url('groups/update'); ?>" method="POST" accept-charset="UTF-8" onsubmit="Button.disabled = true; return true;">
            <?= csrf_field() ?>


            <div class="form-group row">

            <div class="col">
                <label for="groupname">Nome do Grupo</label>
                <input class="form-control" required type="text" name="groupname" value="<?= $data['groupname'] ?>" />
            </div>
            <div class="col">
                <label for="attribute">Atributo</label>
                <input class="form-control" required type="text" name="attribute" value="<?= $data['attribute'] ?>" />
            </div>
            </div>


            <div class="form-group row">

            <div class="col">
                <label for="operator">Operador de comparação</label>
                <input class="form-control" type="text" name="operator" value="<?= $data['op'] ?>" />
            </div>

            <div class="col">
                <label for="value">String de comparação</label>
                <input class="form-control"  type="text" name="value" value="<?= $data['value'] ?>" />
            </div>
            </div>
            <div class="form-group">
            <div class="text-right">
                <input name="id" type="hidden" value="<?= $data['id'] ?>" readonly/>
                <button type="submit" class="btn btn-primary" name="Button"><i class="fas fa-check-circle"></i> Update</button>
            </div>
        </form>
    </div>

<?= $this->endSection() ?>