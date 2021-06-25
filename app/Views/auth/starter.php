<?= $this->extend('auth/layouts/default') ?>

<?= $this->section('main') ?>
<canvas class="my-4 w-100" id="myChart" width="900" height="180"></canvas>

<div class="row">
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Total de clientes</h5>
            <h3 class="card-text"><?= $totalusers ?></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Clientes OnLine</h5>
            <h3 class="card-text"><?= $activeusers ?></h3>

          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Uptime</h5>
            <h4 class="card-text"><?= $uptime ?></h4>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Tráfego Ontem</h5>
            <h3 class="card-text">13</h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Tráfego Hoje</h5>
            <h3 class="card-text"> R$ 220,00</h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Pagamentos em 30 dias</h5>
            <h3 class="card-text">R$ 785,00</h3>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Logins Hoje</h5>
            <h3 class="card-text">2</h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Falha na NAS</h5>
            <h3 class="card-text"> 1</h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Status do Radius</h5>
            <h5 class="card-text"><?= shell_exec('/etc/init.d/freeradius status | grep Status'); ?>
</h5>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
  <div class="col-sm-8">col-sm-8</div>
  <div class="col-sm-4">col-sm-4</div>
</div>
<div class="row">
  <div class="col-sm">col-sm</div>
  <div class="col-sm">col-sm</div>
  <div class="col-sm">col-sm</div>
</div>



 <!-- Gráficos -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: <?= $labels?>,
          datasets: [
            
            {
            data: <?= $grafico2 ?>,
            label: 'GB Upload',
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#00b300',
            borderWidth: 2,
            pointBackgroundColor: '#00b300'            
          },
          {
            data: <?= $grafico1 ?>,
            lineTension: 0,
            label: 'GB Download',
            backgroundColor: 'transparent',
            borderColor: '#3399ff',
            borderWidth: 2,
            pointBackgroundColor: '#3399ff'            
          },
          {
            data: <?= $grafico3 ?>,
            lineTension: 0,
            label: 'GB Trafego',
            backgroundColor: '#e6ffff',
            borderColor: '#e6ffff',
            borderWidth: 0,
            pointBackgroundColor: ''            
          }
        
        ]
        },
        options: {
          responsive: true,
          interaction: {
            mode: 'index',
            interesect:false,
          },
          stacked: false,
          plugins: {
            title: {
              display:true,
              text: 'nicbit'
            }
          },
          scales: {
            y:{
              type: 'linear',
              dysplay: true,
              position: 'right',
              grid: {
                drawOnChartArea: false,
              },
            },
            yAxes: [{
              ticks: {
                beginAtZero: false
              }
            }]
          },
          legend: {
            display: true,
          }
        }
      });
    </script>








<?= $this->endSection() ?>