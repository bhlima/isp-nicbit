<!-- load main layout -->
<?= $this->extend('auth/layouts/default') ?>

<!-- load main content -->
<?= $this->section('main') ?>



<div class="card p-3">
 <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
  <li class="nav-item" role="presentation">
    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Regional</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Geração de faturas</a>
  </li>
  <li class="nav-item" role="presentation">
    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Emails</a>
  </li>
</ul>
<div class="tab-content" id="pills-tabContent">
 
 
  <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">  
  
  <div class="card p-3 my-3">
        <form action="<?= site_url('/settings-update-system'); ?>" method="POST" accept-charset="UTF-8" onsubmit="saveSystem.disabled = true; return true;">
          <?= csrf_field() ?>
          <div class="col-md-6">
            <h5 class="pb-2 mb-0 mt-4">Opções de configuração e automação do sistema</h5>
            <p class="text-muted">Defina dados como hora do sistema, tarefas agendadas, logomarcas etc</p>
            <div class="form-group">
                <label for="language" class="form-control-label">Idioma Padrão</label>
                <select class="form-control" name="language">
                    <option value="en" <?php if ($system['language'] == 'en') : ?> selected <?php endif ?> >Inglês</option>
                    <option value="es" <?php if ($system['language'] == 'pt-br') : ?> selected <?php endif ?> >Brasileiro</option>
                    <option value="fr" <?php if ($system['language'] == 'fr') : ?> selected <?php endif ?> >Francês</option>
                </select>
            </div>
                        <div class="form-group">
                <label for="dateformat" class="form-control-label"> Formato da date_date_set</label>
                <select class="form-control" name="dateformat">
                    <option value="mm-dd-yyyy" <?php if ($system['dateformat'] == 'mm-dd-yyyy') : ?> selected <?php endif ?> >mm-dd-yyyy</option>
                    <option value="dd-mm-yyyy" <?php if ($system['dateformat'] == 'dd-mm-yyyy') : ?> selected <?php endif ?> >dd-mm-yyyy</option>
                    <option value="yyyy-mm-dd" <?php if ($system['dateformat'] == 'yyyy-mm-dd') : ?> selected <?php endif ?> >yyyy-mm-dd</option>
                </select>
            </div>
            <div class="form-group">
                <label for="timeformat" class="form-control-label">Formato do horario</label>
                <select class="form-control" name="timeformat">
                    <option value="12" <?php if ($system['timeformat'] == '12') : ?> selected <?php endif ?> >12 hour (00:00 AM/PM)</option>
                    <option value="24" <?php if ($system['timeformat'] == '24') : ?> selected <?php endif ?> >24 hour (24:00)</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-control-label">IP Restriction</label>
                <textarea class="form-control" name="iprestriction" rows="3" placeholder="Enter IP addresses, if more than one add comma after each IP address"><?= $system['iprestriction'] ?></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" name="id" value="1">
                <button class="btn btn-primary" id="savesystem" type="submit">Salvar alterações</button>
            </div>
        </div>
        </form>
    </div>      
  </div>
  
  
  
  
  
  
  <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
  
  
  <div class="card p-3 my-3">

  </div>
  
  
  
  
  
  
  </div>
  <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab"> 
  <div class="card p-3 my-3">
        <form action="<?= site_url('settings-update-email'); ?>" method="POST" accept-charset="UTF-8" onsubmit="saveEmail.disabled = true; return true;">
          <?= csrf_field() ?>

          <div class="col-md-6">
            <h6 class="pb-2 mb-0 mt-4">Email</h6>
            <p class="text-muted">Email SMTP settings, notifications and others related to email.</p>
            <div class="form-group">
                <label for="fromname" class="form-control-label">Sender's Name</label>
                <input type="text" name="fromname" class="form-control" value="<?= $email['fromname'] ?>">
            </div>
            <div class="form-group">
                <label for="fromemail" class="form-control-label">Sender's Email</label>
                <input type="text" name="fromemail" class="form-control" value="<?= $email['fromemail'] ?>">
            </div>
            <div class="form-group">
                <label for="protocol" class="form-control-label">Protocol</label>
                <select name="protocol" class="form-control">
                    <option value="">Select Protocol</option>
                    <option value="smtp" <?php if ($email['protocol'] == 'smtp') : ?> selected <?php endif ?> >SMTP</option>
                    <option value="sendmail" <?php if ($email['protocol'] == 'sendmail') : ?> selected <?php endif ?> >Sendmail</option>
                    <option value="phpmailer" <?php if ($email['protocol'] == 'phpmailer') : ?> selected <?php endif ?> >PHP Mailer</option>
                </select>
            </div>
            <div class="form-group">
                <label for="host" class="form-control-label">SMTP Host</label>
                <input type="text" name="host" class="form-control" value="<?= $email['host'] ?>">
            </div>
            <div class="form-group">
                <label for="username" class="form-control-label">SMTP Username</label>
                <input type="text" name="username" class="form-control" value="<?= $email['username'] ?>">
            </div>
            <div class="form-group">
                <label for="security" class="form-control-label">SMTP Security</label>
                <select name="security" class="form-control">
                    <option value="">Select SMTP Security</option>
                    <option value="tls" <?php if ($email['security'] == 'tls') : ?> selected <?php endif ?> >TLS</option>
                    <option value="ssl" <?php if ($email['security'] == 'ssl') : ?> selected <?php endif ?> >SSL</option>
                    <option value="none" <?php if ($email['security'] == 'none') : ?> selected <?php endif ?> >None</option>
                </select>
            </div>
            <div class="form-group">
                <label for="port" class="form-control-label">SMTP Port</label>
                <input type="text" name="port" class="form-control" value="<?= $email['port'] ?>">
            </div>
            <div class="form-group">
                <label for="password" class="form-control-label">SMTP Password</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <input type="hidden" name="id" value="1">
                <button class="btn btn-primary" id="saveEmail" type="submit">Save Changes</button>
            </div>
        </div>
        </form>
    </div> 
  
  
  
  
  
  </div>
</div>
<br>

</div>

  

       
<?= $this->endSection() ?>