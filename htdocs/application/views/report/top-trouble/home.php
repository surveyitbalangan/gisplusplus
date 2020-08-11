<script type="text/javascript">
    $(window).on("load", function() {
        // alert('AJAX');
        var intervalKordinat;
                
        getTopTrouble();
                
        intervalKordinat = setInterval(function () {
            getTopTrouble();          
        }, 5000); // update setiap 5 detik
        
        function getTopTrouble()  {
          $.ajax({
            type	: "GET",
            url		: "<?=base_url();?>toptrouble/getTopTrouble",
            cache 	: false,
            beforeSend: function() {
                  // NProgress.start();
            },
            success : function(ok){
                // alert('update top 10');
              $('#isi_open').animate({ opacity: "show" }, "slow");
              $('#isi_open').html(ok);
            },
            error:function(event, textStatus, errorThrown) {
              // alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
            },	      
            complete: function() {
                // NProgress.done();
            }
          })
        }                
    })
</script>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
            Top 10 Trouble <?=$bulan_ini.' '.$tahun_ini;?>
			<!-- <small>Sistem Informasi Monitoring Canvasser</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Report</a></li>
			<li class="active">Top Trouble</li>
		</ol>
	</section>

	<section class="content">		 		
		<div class="row">						
			<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box box-primary-">
                    <div class="box-header with-border">
                        <h3 class="box-title"></h3>
                        <!-- <p>Status : <font color="red">OPEN</font></p> -->
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                        </div>
                    </div>
                
                    <div class="box-body">
                        <ul class="products-list product-list-in-box" id="isi_open">
                        
                        </ul>
                    </div>
                
                    <div class="box-footer text-center">
                        <a href="#" class="uppercase">View All</a>
                    </div>                    
                </div>
            </div>
		</div>				
    	
	</section>

</div>