<?= $this->extend('auth/layouts/default-table') ?>
<?= $this->section('main') ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2">Dicionário de Atributos</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" 
            data-target="#creategroupsformmodal"><i 
            class="fas fa-user-plus"></i>Adicionar um Fornecedor</button>
        </div>
    </div>
    <div class="card p-3">      
<form action="<?= site_url('dicatt'); ?>" method="POST" accept-charset="UTF-8" onsubmit="registerButton.disabled = true; return true;">
<?= csrf_field() ?>
<div class="form-group">
    <label for="vendor1">Fornecedores</label>
    <select required name="vendor1" id="vendor1" class="form-control">
        <?= $data ?>
    </select>

    <hr>

<button name="getattibute" class="btn btn-primary shadow-2 mb-4">Ver os atrributos</button>


</div>
    </div>



<?= $this->endSection() ?>