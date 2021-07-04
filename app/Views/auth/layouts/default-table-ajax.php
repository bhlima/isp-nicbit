<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Nicbit - isp</title>

    <!-- load extended styles -->
    <?= $this->renderSection('style') ?>

    <!-- default styles  -->
    <link rel="stylesheet" href="<?= base_url('vendor/fontawesome/css/fontawesome.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/fontawesome/css/solid.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/fontawesome/css/brands.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/bootstrap/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/datatables/datatables.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('css/nicbit.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('vendor/select2/dist/css/select2.min.css'); ?>">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">



<!-- jQuery baseUrl -->
<script>
        var baseUrl = "<?php echo base_url(); ?>";
        var siteUrl = "<?php echo site_url(); ?>";
    </script>


</head>

<body class="bg-light">
    <!-- load extended modals -->
    <?= $this->renderSection('modals') ?>

    <!-- navbar -->
    <?= view('App\Views\auth\components\navbar2') ?>

    <main role="main" class="container">
      <!-- notifications -->
      <?= view('App\Views\auth\components\notifications') ?>

      <!-- load content from other views -->
      <?= $this->renderSection('main') ?>
    </main>
    <script
			  src="https://code.jquery.com/jquery-3.6.0.min.js"
			  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
			  crossorigin="anonymous"></script>
    <script src="<?= base_url("vendor/bootstrap/js/bootstrap.bundle.min.js") ?>" type="text/javascript"></script>
    <script src="<?= base_url("vendor/datatables/datatables.min.js") ?>" type="text/javascript"></script>
 
    <script type="text/javascript">

    $("#estados").on("change" , function(){
        var uf = $("#estados").val();
 
 $.get('http://190.89.81.70/nicbit/public/index.php/clients/getM/'+uf,function(data,status){

    if (status == "success"){
        $('#cidades').html(data);
 }
  
});

    });
</script>

<script>
function ValidaCPF(){	
	var RegraValida=document.getElementById("cpf").value; 
	var cpfValido = /^(([0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2})|([0-9]{11}))$/;	 
	if (cpfValido.test(cpf) == true)	{ 
	console.log("CPF Válido");	
	} else	{	 
	console.log("CPF Inválido");	
	}
    }
  function fMasc(objeto,mascara) {
obj=objeto
masc=mascara
setTimeout("fMascEx()",1)
}

  function fMascEx() {
obj.value=masc(obj.value)
}

   function mCPF(cpf){
cpf=cpf.replace(/\D/g,"")
cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
return cpf
}
</script>


    <!-- inline js code -->
    <script type="text/javascript">
        $('#dataTables-table').DataTable({
            "language": {
          "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
      },
            responsive: true,
            pageLength: 10,
            lengthChange: false,
            searching: true,
            ordering: true});
 
 
 </script>


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true
    });
    $( "#anim" ).on( "change", function() {
      $( "#datepicker" ).datepicker( "option", "showAnim", $( this ).val() );
 
    });
  } );
  </script>

<script>
  $( function() {

  } );
  </script>









      <?= csrf_field() ?>

    
    <!-- load extended scripts -->
    <?= $this->renderSection('script') ?>


</body>

</html>