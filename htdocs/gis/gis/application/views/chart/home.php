<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
	$(window).on("load", function(){
		$('#btnPreview').click(function(){
			show_grafik();
		})

		function show_grafik(){
			var myChart = Highcharts.chart('myChart', {
        chart: {
						plotBackgroundColor: null,
						plotBorderWidth: null,
						plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Jumlah Kandidat Per Lowongan'
        },
        xAxis: {
            categories: ['GA Supervisor', 'Staf Logistik', 'Staf Procurement']
        },
        yAxis: {
            title: {
                text: ''
            }
        },
				plotOptions: {
						pie: {
								size: '80%',
								allowPointSelect: true,
								cursor: 'pointer',
								dataLabels: {
										enabled: true,
										connectorShape: 'fixedOffset',
										format: '<b>{point.name}</b>: {point.y} orang'
								}
						}
				},
        series: [{
						name: 'Posisi',
						colorByPoint: true,
						data: [{
							name:'GA Supervisor',
							y:3
						},{
							name:'Staf Logistik',
							y:5
						},{
							name:'Staf Procurement',
							y:4
						}]
				}]
    	});
		}
	})
</script>
<div class="content-wrapper">

	<section class="content-header">
		<h1>
			Chart
			<!-- <small>Version 2.0</small> -->
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-pie-chart"></i> Report</a></li>
			<li class="active">Rekrutmen</li>
		</ol>
	</section>

	<section class="content">		
		<div class="box box-info">
			<div class="box-header with-border">
	          <h3 class="box-title"></h3>
	          <div class="box-tools pull-right">
	            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
	            <!-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> -->
	          </div>
	        </div>
	        <div class="box-body">
	        	<div class="input-group">			        	        					        
			        <!-- <div class="input-group-btn"> -->
			        	<button class="btn -btn-sm btn-info btn-flat" id="btnPreview"><i class="fa fa-bar-chart-o"></i> Preview</button>

			        	<!-- <button class="btn btn-sm btn-default pull-right"><i class="fa fa-search"></i></button>
			        	<input type="text" id="txtCari" class="form-control input-sm pull-right" style="width:200px;" placeholder="Pencarian..."/>			        	
			          	
			        </div> -->
			    </div>
	        	<div>
	        		<div id="myChart" style="margin-top:15px;"></div>
	        	</div>
	        </div> 		    
	  	</div>	 
	</section>

</div>