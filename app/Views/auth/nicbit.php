<?= $this->extend('auth/layouts/default') ?>

<?= $this->section('main') ?>

<div class="container-sm">
<main role="main" class="container">

<div class="starter-template">

<div class="mb-4">
            <img class="brand" height="70" src="/logob.png" alt="nicbit - isp">
        </div>
  <h1>internet service provider v 1.0.0</h1>
  <p class="lead">Gerenciamento de servidores Radius / Sistema Financeiro.</p>
  <p class="lead">Monitore o desempenho de seus clientes, com sistema de contratação e financeiro, integrado com PagSeguro e Gerencianet
  <h4>Autor</h4>
  <p>Flavio Lima - bhlima2@gmail.com</p>
  <p>https://github.com/bhlima/isp-nicbit</p>

  <h4>Licença</h4>
  <p>This content is released under the MIT License (MIT)</p>

  <h4>Zabbix</h4>
  <p>Este sistema funciona de forma integrada a plataforma Zabbix (não necessária)</p>

  <h4>Apache / PHP</h4>
  <p>Este sistema funciona com apache2 e PHP 7.* - não é compativel com versões menores (necessária)</p>



</div>

</main><!-- /.container -->
</div>
<?= $this->endSection() ?>