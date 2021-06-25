<?= $this->extend('auth/layouts/auth') ?>
<?= $this->section('main') ?>

<?= view('App\Views\auth\components\notifications') ?>

<div class="card">
    <div class="card-body text-center">
        <div class="mb-4">
            <img class="brand" height="90" src="/logob.png" alt="nicbit - isp">
        </div>

        <h6 class="mb-4 text-muted">Acesse sua conta</h6>
       
        <form action="<?= site_url('login'); ?>" method="POST" accept-charset="UTF-8">
            <?= csrf_field() ?>
            <div class="form-group">
                <input name="email" type="email" class="form-control" placeholder="Digite seu email" value="<?= old('email') ?>">
            </div>

            <div class="form-group">
                <input name="password" type="password" class="form-control" placeholder="Informe sua senha">
            </div>

            <div class="form-group text-left">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input" id="Lembre-me">
                    <label class="custom-control-label" for="remember-me">Lembre-me</label>
                </div>
            </div>
            
            <button class="btn btn-primary shadow-2 mb-4">Acessar sua conta</button>
        </form>

        <p class="mb-2 text-muted"><a href="<?= site_url('forgot-password'); ?>">Esqueceu a senha?</a></p>
        <p class="mb-0 text-muted">Não tem cadastro?<a href="<?= site_url('register'); ?>"> Cadastre-se</a></p>
    </div>
</div>

<?= $this->endSection() ?>