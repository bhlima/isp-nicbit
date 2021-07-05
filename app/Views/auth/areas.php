<?= $this->extend('auth/layouts/default-table') ?>]
<!-- load modals -->
<?= $this->section('modals') ?>

    <!-- create user modal form -->
    <?= view('App\Views\auth\modals\add-grouparea') ?>

<?= $this->endSection() ?>

<?= $this->section('main') ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2">Grupos de areas de atendimento</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" 
            data-target="#creategroupareaformmodal" data-id='<? ?>'><i 
            class="fas fa-user-plus"></i>Adicionar um grupo</button>
        </div>
    </div>
    <div class="card p-3">      
<form action="<?= site_url('areas/subgrouparea'); ?>" method="POST" accept-charset="UTF-8" onsubmit="registerButton.disabled = true; return true;">
<?= csrf_field() ?>
<div class="form-group">
    <label for="groupareas">Grupos</label>
    <select required name="groupareas" id="groupareas" class="form-control">
        <?= $data ?>
    </select>
    <hr>
<button name="getattibute" class="btn btn-primary shadow-2 mb-4">Listar sub grupos</button>


</div>
    </div>



<?= $this->endSection() ?>