<!-- load main layout -->
<?= $this->extend('auth/layouts/default') ?>

<!-- load main content -->
<?= $this->section('main') ?>



    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h2">Modificar Gateway</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="<?= site_url('gateways') ?>" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Return</a>
        </div>
    </div>

    <div class="card p-3">
        <form action="<?= site_url('gateways/update'); ?>" method="POST" accept-charset="UTF-8" onsubmit="Button.disabled = true; return true;">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="client_id">Cliente ID</label>
                <input class="form-control" required type="text" name="client_id" value="<?= $gateway['client_id'] ?>" />
            </div>
            <div class="form-group">
                <label for="client_secret">Cliente Secret</label>
                <input class="form-control" required type="text" name="client_secret" value="<?= $gateway['client_secret'] ?>" />
            </div>
            <div class="form-group">
                <label for="pix_cert">Certificado do PIX</label>
                <input class="form-control" required type="text" name="pix_cert" value="<?= $gateway['pix_cert'] ?>" />
            </div>
            <div class="form-group">
                <label for="timeout">Timeout</label>
                <input class="form-control" required type="text" name="timeout" value="<?= $gateway['timeout'] ?>" />
            </div>
            <div class="form-group">
                <label for="active">Debug</label>
                <select class="form-control" name="active" required>
                    <?php if ($gateway['active'] == 1) : ?>
                        <option value="1" selected>Enable</option>
                    <?php else : ?>
                        <option value="1">Enable</option>
                    <?php endif ?>

                    <?php if ($gateway['active'] == 0) : ?>
                        <option value="0" selected>Disable</option>
                    <?php else : ?>
                        <option value="0">Disable</option>
                    <?php endif ?>
                </select>
              </div>
              <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="terms">
                <label class="form-check-label" for="terms">I agree to the <a href="#">terms and conditions</a></label>
            </div>


            <div class="text-right">
                <input name="id" type="hidden" value="<?= $gateway['id'] ?>" readonly/>
                <button type="submit" class="btn btn-primary" name="Button"><i class="fas fa-check-circle"></i> Update</button>
            </div>
        </form>
    </div>

<?= $this->endSection() ?>