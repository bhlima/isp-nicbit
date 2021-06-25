<div class="card p-3">
        <form action="<?= site_url('clients/update'); ?>" method="POST" accept-charset="UTF-8" onsubmit="Button.disabled = true; return true;">
            <?= csrf_field() ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" required type="text" name="username" value="<?= $client['username'] ?>" />
            </div>


            <div class="form-group">
            <label for="type">Escolha a criptografia da senha </label>
            <select class="form-control form-control-sm"  name="type">
              <option>Cleartext-Password</option>
              <option>User-Password</option>
              <option>Crypt-Password</option>
              <option>MD5-Password</option>
              <option>SHA1-Password</option>
              <option>CHAP-Password</option>
            </select>
            </div>

            <div class="form-group">
                <label for="value">Senha</label>
                <input class="form-control" type="text" name="value" value="<?= $client['value'] ?>" />
            </div>




            <div class="form-group">
            <label for="op">Operador da comparação</label>
            <select class="form-control form-control-sm"  name="op">
              <option> := </option>
              <option>  = </option>
              <option> == </option>
              <option> += </option>
              <option> != </option>
              <option> >= </option>
              <option>  < </option>
              <option> <= </option>
              <option> =~ </option>
              <option> !~ </option>
              <option> =* </option>
              <option> !* </option>
            </select>
            </div>









            <div class="text-right">
                <input name="username" type="hidden" value="<?= $client['username'] ?>" readonly/>
                <button type="submit" class="btn btn-primary" name="Button"><i class="fas fa-check-circle"></i> Update</button>
            </div>

</div>