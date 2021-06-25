<!-- load main layout with datatable -->
<?= $this->extend('auth/layouts/default-table') ?>

<!-- load main content -->
<?= $this->section('main'); 

//cho '<pre>';
//print_r($data);
//exit;
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
        <h1 class="h3">Perfil <?= $data['nome'] ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <a href="<?= site_url('clients') ?>" class="btn btn-sm btn-secondary"><i class="fas fa-arrow-left"></i> Return</a>
        </div>
    </div>
    <canvas class="my-4 w-100" id="myChart" width="900" height="180"></canvas>

  <div class="btn-group" role="group" aria-label="Grupo de botões com dropdown aninhado">
  <button type="button" class="btn btn-secondary">Bloquear</button>
  <button type="button" class="btn btn-secondary">Testar conexão</button>
  <button type="button" class="btn btn-secondary">ping</button>
  <button type="button" class="btn btn-secondary">Desconectar</button>
  <button type="button" class="btn btn-secondary">Atualizar buffer</button>
  <button type="button" class="btn btn-secondary">Trocar senha de conexão</button>
  <button type="button" class="btn btn-secondary">Ping</button>

  <div class="btn-group" role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Ferramentas
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <a class="dropdown-item" href="#">Testar produtividade</a>
      <a class="dropdown-item" href="#"></a>
    </div>
  </div>
</div>

    <div class="row">
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Usename PPOe</h5>
            <h3 class="card-text"><?= $data['username'] ?></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">IP/Concetrador</h5>
            <h3 class="card-text"> 10.30.0.1</h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Status na rede</h5>
            <h3 class="card-text"><?= $data['localidadeatt']?></h3>
          </div>
        </div>
      </div>
    </div><br>
    <div class="row">
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Cliente desde:</h5>
            <h3 class="card-text"><?= $data['created_at'] ?></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Telefone</h5>
            <h3 class="card-text"> <?= $data['telefone1']?></h3>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="card mt-3">
          <div class="card-body">
            <h5 class="card-title">Localidade</h5>
            <h3 class="card-text"><?= $data['localidadeatt']?></h3>
          </div>
        </div>
      </div>
    </div><br>
    <div class="card p-3">
<b>Endereço: <?= $data['endereco'] ?> | Bairro: <?= $data['endereco'] ?> | Cidade: <?= $data['cidade'] ?> 
| Endereço: <?= $data['estado'] ?>  </b>


</div>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-3">
    </div>

    <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nome</th>
      <th scope="col">Adesão</th>
      <th scope="col">Consumo</th>
      <th scope="col">Status</th>


    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>Internet Turbinada 100MB</td>
      <td>27/06/1972</td>
      <td>540MB/12GB</td>
      <td>Ativo</td>

    </tr>
    <tr>
    <th scope="row">1</th>
      <td>Mais Domingo bonus de 50MB</td>
      <td>27/06/1972</td>
      <td>540MB/12GB</td>
      <td>Ativo</td>
    </tr>
  </tbody>
</table>
    <div class="card p-3">
        <div class="table-responsive">
            <table width="100%" class="table table-hover" id="dataTables-table" data-order='[[ 0, "asc" ]]'>
                <thead>
                    <tr>
                        <th>Assunto</th>
                        <th>Data do envio</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    </br>
            <hr>

            !-- Gráficos -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
        type: 'line',
        data: {
          labels: <?= $labels?>,
          datasets: [
            
            {
            data: <?= $grafico1 ?>,
            label: 'MB Upload',
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#00b300',
            borderWidth: 2,
            pointBackgroundColor: '#00b300'            
          },
          {
            data: <?= $grafico2 ?>,
            lineTension: 0,
            label: 'MB Download',
            backgroundColor: 'transparent',
            borderColor: '#3399ff',
            borderWidth: 2,
            pointBackgroundColor: '#3399ff'            
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