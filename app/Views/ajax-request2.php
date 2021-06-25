
<button type="button" id="botao">Clique me</button>
<script>
        var baseUrl = "<?php echo base_url(); ?>";
        var siteUrl = "<?php echo site_url(); ?>";
    </script>
<script src="<?= base_url("vendor/jquery/jquery-3.6.0.min.js") ?>" type="text/javascript"></script>
<script>

$("#botao").click((e)=>{
    e.preventDefault();
    $.get("<?= base_url('index.php/clients/handle-myajax/testetetetete') ?>", function(response){

        console.log(response)
        console.log("Deu cert")
        console.log("Mano!")

        
    });






});






</script>
