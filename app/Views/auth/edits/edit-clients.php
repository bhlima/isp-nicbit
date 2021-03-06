<!-- load main layout -->
<?= $this->extend('auth/layouts/default-table-ajax') ?>
<!-- load main content -->
<?= $this->section('script') ?>
<script type="text/javascript">
    $("#estados").on("change", function() {
        var uf = $("#estados").val();
        $.get('http://190.89.81.70/nicbit/public/index.php/clients/getM/' + uf, function(data, status) {

            if (status == "success") {
                $('#cidades').html(data);
            }
        });
    });
</script>

<?= $this->endSection('script') ?>


<!-- load main content -->
<?= $this->section('main') ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
    <h1 class="h2"><?= lang('update') ?>: <?= $data['username'] ?></h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <a href="<?= site_url('clients') ?>" class="btn btn-sm btn-secondary">
            <i class="fas fa-arrow-left"></i> <?= lang('back') ?></a>
    </div>
</div>
<div class="card p-5">
    <form action="<?= site_url('clients/upinfo'); ?>" method="POST" accept-charset="UTF-8" onsubmit="Button.disabled = true; return true;">
        <?= csrf_field() ?>
        <div class="form-group row">
            <div class="col">
                <label for="nome">Nome</label>
                <input class="form-control form-control-sm" required type="text" name="nome" value="<?= $data['nome'] ?>" />
            </div>
            <div class="col">
                <label for="cpf">CPF</label>
                <input class="form-control form-control-sm" type="text" id="cpf" value="<?= $data['cpf'] ?>" name="cpf" onkeydown="javascript: fMasc( this, mCPF );">
            </div>
            <div class="col">
                <label for="aniversario">Data de Nascimento</label>
                <input class="form-control form-control-sm" type="text" id="datepicker" name="aniversario" value="<?= $data['aniversario'] ?>" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <label for="estados">Estado</label>
                <select name='estados' id='estados' class="form-control form-control-sm">
                    <option selected><?= $optionsselectedestados ?></options>
                        <?= $estados ?>
                </select>
            </div>
            <div class="col">
                <label for="cidade">Cidade</label>
                <select name='cidades' id='cidades' class="form-control form-control-sm">
                    <option><?= $data['cidade'] ?></option>
                </select>
            </div>
            <div class="col">
                <label for="bairro">Bairro</label>
                <input class="form-control form-control-sm" type="text" name="bairro" value="<?= $data['bairro'] ?>" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <label for="cep">CEP</label>
                <input class="form-control form-control-sm" type="text" name="cep" value="<?= $data['cep'] ?>" />
            </div>
            <div class="col">
                <label for="endereco">Endere??o</label>
                <input class="form-control form-control-sm" type="text" name="endereco" value="<?= $data['endereco'] ?>" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <label for="localidadeatt">Local do atendimento</label>
                <select name='localidadeatt' id='localidadeatt' class="form-control form-control-sm">
                    <option><?= $data['localidadeatt'] ?></option>
                </select>
            </div>
            <div class="col">
                <label for="referencia">Referencia</label>
                <input class="form-control form-control-sm" type="text" name="referencia" value="<?= $data['referencia'] ?>" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <label for="empresa">Nome da empresa</label>
                <input class="form-control form-control-sm" type="text" name="empresa" value="<?= $data['empresa'] ?>" />
            </div>
            <div class="col">
                <label for="cnpj">Cnpj</label>
                <input class="form-control form-control-sm" type="text" name="cnpj" value="<?= $data['cnpj'] ?>" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col">
                <label for="email">email</label>
                <input class="form-control form-control-sm" type="text" name="email" value="<?= $data['cpf'] ?>" />
            </div>
            <div class="col">
                <label for="telefone1">Telefone</label>
                <input class="form-control form-control-sm" required type="text" name="telefone1" value="<?= $data['telefone1'] ?>" />
            </div>
            <div class="col">
                <label for="telefone2">Telefone 2</label>
                <input class="form-control form-control-sm" type="text" name="telefone2" value="<?= $data['telefone2'] ?>" />
            </div>
        </div>
        <div class="form-group">
            <label for="portalpassord">Senha do portal</label>
            <input class="form-control form-control-sm" type="text" name="portalpassword" value="<?= $data['portalpassword'] ?>" />
        </div>
        <div class="form-group">
            <label for="notes">Descritivo administrativo</label>
            <input class="form-control form-control-sm" type="text" name="notes" value="<?= $data['notes'] ?>" />
        </div>
        <div class="form-check">
            <input type="checkbox" name="changeuserinfo" class="form-check-input" id="changeuserinfo">
            <label class="form-check-label" for="changeuserinfo">Permitir acesso ao portal</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="enableportallogin" class="form-check-input" id="enableportallogin">
            <label class="form-check-label" for="enableportallogin">Permitir acesso ao portal</label>
        </div>
        <div class="text-right">
            <input name="username" type="hidden" value="<?= $data['username'] ?>" readonly />
            <input name="id" type="hidden" value="<?= $data['id'] ?>" readonly />
            <button type="submit" class="btn btn-primary" name="Button"><i class="fas fa-check-circle"></i> Gravar mudan??as</button>
        </div>
</div>
</form>
</div>
<?= $this->endSection() ?>