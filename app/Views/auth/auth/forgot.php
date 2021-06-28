<?= $this->extend('auth/layouts/auth') ?>
<?= $this->section('main') ?>
<?= view('App\Views\auth\components\notifications') ?>
<div class="card">
    <div class="card-body text-center">
        <div class="mb-4">
            <img class="brand" height="90" src="logob.png" alt="nicbit - isp - recuperação de senha">
        </div>
        <h6 class="mb-4 text-muted"><?= lang('Auth.forgottenPassword') ?></h6>
       
        <form action="<?= site_url('forgot-password'); ?>" method="POST" accept-charset="UTF-8" onsubmit="submitButton.disabled = true; return true;">
            <?= csrf_field() ?>
            <div class="form-group">
                <input type="email" class="form-control" placeholder="Digite seu email" value="<?= old('email') ?>" required>
            </div>
            <button class="btn btn-primary shadow-2 mb-4">Enviar nova senha</button>
        </form>
    </div>
</div>

<?= $this->endSection() ?>
