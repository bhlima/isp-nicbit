<?php if (session()->has('success')) : ?>
    <div class="alert alert-success mt-2 alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h5 class="alert-heading"><?= session('success') ?></h5>

    </div>
<?php endif ?>

<?php if (session()->has('error')) : ?>
    <div class="alert alert-warning mt-3 alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h5 class="alert-heading">Reveja: <?= session('error') ?></h5>
    </div>
<?php endif ?>

<?php if (session()->has('errors')) : ?>
    <div class="alert alert-danger mt-3 alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

        <h5 class="alert-heading">Temos problemas!</h5>

        <ul class="">
            <?php foreach (session('errors') as $error) : ?>
            <li><?= $error ?></li>
            <?php endforeach ?>
        </ul>
    </div>
<?php endif ?>