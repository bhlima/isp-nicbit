
<button type="button" id="btn-click">Clique me</button>
<script>
        var baseUrl = "<?php echo base_url(); ?>";
        var siteUrl = "<?php echo site_url(); ?>";
    </script>
<script src="<?= base_url("vendor/jquery/jquery-3.6.0.min.js") ?>" type="text/javascript"></script>
<script>


$(function(){

    $(document).on("click", "#btn-click",  function(e) {
        e.preventDefault();

        
      $.ajax({
            url: '<?= base_url('index.php/clients/handle-myajax') ?>',

            headers: {'X-Requested-With': 'XHLHttpRequest'},
            type: 'POST',
            dataType: 'JSON',
            data: {
                name: "Sanjay Kumar",
                email: "sanjay@gmail.com" ,

                xhrFields: {
    },
    // This is the important part
    success: function (response) {
        // handle the response
    },
    error: function (xhr, status) {
        // handle errors
    }

            },
            dataType: "JASON",
            success: function(response){
                console.log(response);
            }
      });
  
    });


});

</script>
