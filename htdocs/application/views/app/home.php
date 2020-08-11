<script type="text/javascript">
    $(window).on("load", function() {
        // alert('AJAX');
        var intervalKordinat;
        
        getAllRelawan();
        
        intervalKordinat = setInterval(function () {
            // getAllRelawan();
            // alert('update');
        }, 5000); // update setiap 5 detik
        
        $('#btnRefresh').click(function(){
            getAllRelawan();
        })
        
        $('#btnHome').click(function(){
            window.location.replace('/');
        })
        
        $('#txtCari').keyup(function(){
			var isi = $(this).val();
			if (isi!='') {
				getAllRelawan();
			}
		})
        
        function getAllRelawan()  {
            var cari = $('#txtCari').val();
            $.ajax({
				type	: "POST",
				url		: "<?=base_url();?>app/getAllRelawan",
				data    : {'cari':cari},
				cache 	: false,
				beforeSend: function() {
			        NProgress.start();
			    },
				success : function(ok){
				    // alert('update top 10');
					$('#isi_data').animate({ opacity: "show" }, "slow");
					$('#isi_data').html(ok);
				},
				error:function(event, textStatus, errorThrown) {
                   // alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
                },	      
			    complete: function() {
			        NProgress.done();
			    }
			})
        }
    })
</script>

<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Pencapaian All Relawan
			<!--<small>Ver 1.0</small>-->
			<!-- <small>Sistem Informasi Monitoring Canvasser</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#"> Dashboard</a></li>
			<li class="active">All Relawan</li>
		</ol>
	</section>

	<section class="content">
		
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box box-primary-">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <div class="row">
                                <div class="input-group">
                                    <div class="col-md-4">
                                        <button class="btn btn-sm btn-info btn-flat" id="btnHome"><i class="fa fa-home"></i></button>
                                        <button class="btn btn-sm btn-success btn-flat" id="btnRefresh"><i class="fa fa-refresh"></i></button>
                                    </div>
                                    <div class="col-md-8">
                    		        	<div class="form-group has-feedback">
                                            <input type="text" id="txtCari" class="form-control input-sm pull-right" style="width:300px;" placeholder="Cari Nama Relawan..."/>
                                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                                        </div>
                		            </div>
                    		    </div>
                		    </div>
                        </h3>
        
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                            <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>-->
                        </div>
                    </div>
                    
                    <div class="box-body">
                        <ul class="products-list product-list-in-box" id="isi_data">
                        
                        </ul>
                    </div>
                    
                    <!--<div class="box-footer text-center">-->
                    <!--  <a href="javascript:void(0)" class="uppercase">View All Relawan</a>-->
                    <!--</div>-->
                    
                  </div>
            </div>
		</div>
    	
	</section>
</div>