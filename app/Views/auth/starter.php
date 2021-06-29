<?= $this->extend('auth/layouts/default') ?>

<?= $this->section('main') ?>
<canvas class="my-4 w-100" id="myChart" width="900" height="180"></canvas>

<div class="row">
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Clientes cadastrados</h5>
            <h3 class="card-text"><?= $totalusers ?></h3>
          </div>
        </div>
      </div>

      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Clientes Online</h5>
            <h4 class="card-text"><?= $activeusers ?></h4>
          </div>
        </div>
      </div>


      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Total de contratos</h5>
            <h3 class="card-text">0<?//= $totalcontracts ?></h3>
          </div>
        </div>
      </div>

    </div>

    <div class="row">
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Tempo no ar</h5>
            <h3 class="card-text"><?= $uptime ?></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Download Hoje</h5>
            <h3 class="card-text"><?= $totaldownload ?></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Upload Hoje</h5>
            <h3 class="card-text"><?= $totalupload ?></h3>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Logins Hoje</h5>
            <h3 class="card-text"><?= $logins ?></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Falha na NAS</h5>
            <h3 class="card-text">0</h3>
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