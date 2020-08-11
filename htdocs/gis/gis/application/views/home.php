<style>
    #map {
        height: 550px;
        width: 100%;
    }
</style>
<script type="text/javascript">
    $(window).on("load", function() {
        // alert('AJAX');
        var intervalKordinat;
        
        // getDocCategorySCM();
        // getDocCategoryLSA();
        // getDocCategoryPCS();
        
        // getTotOpenDokumen();
        // getTotProgDokumen();
        // getTotCloseDokumen();
        // getTotAllDokumen();
        // getLastDok();
                
        intervalKordinat = setInterval(function () {          
          // getTotOpenDokumen();
          // getTotProgDokumen();
          // getTotCloseDokumen();
          // getTotAllDokumen(); 
          // getLastDok();               
        }, 5000); // update setiap 5 detik
        
        function getDocCategorySCM()  {
          var com = "SCM";
          $.ajax({
            type	: "POST",
            url		: "<?=base_url();?>app/getListDocCategory",
            cache : false,
            data  : {"company":com},
            beforeSend: function() {
                  // NProgress.start();
            },
            success : function(ok){
                // alert('update top 10');
              $('#isi_kategori_dokumen_scm').animate({ opacity: "show" }, "slow");
              $('#isi_kategori_dokumen_scm').html(ok);
            },
            error:function(event, textStatus, errorThrown) {
              // alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
            },	      
            complete: function() {
                // NProgress.done();
            }
          })
        }

        function getDocCategoryLSA()  {
          var com = "LSA";
          $.ajax({
            type	: "POST",
            url		: "<?=base_url();?>app/getListDocCategory",
            cache : false,
            data  : {"company":com},
            beforeSend: function() {
                  // NProgress.start();
            },
            success : function(ok){
                // alert('update top 10');
              $('#isi_kategori_dokumen_lsa').animate({ opacity: "show" }, "slow");
              $('#isi_kategori_dokumen_lsa').html(ok);
            },
            error:function(event, textStatus, errorThrown) {
              // alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
            },	      
            complete: function() {
                // NProgress.done();
            }
          })
        }

        function getDocCategoryPCS()  {
          var com = "PCS";
          $.ajax({
            type	: "POST",
            url		: "<?=base_url();?>app/getListDocCategory",
            cache : false,
            data  : {"company":com},
            beforeSend: function() {
                  // NProgress.start();
            },
            success : function(ok){
                // alert('update top 10');
              $('#isi_kategori_dokumen_pcs').animate({ opacity: "show" }, "slow");
              $('#isi_kategori_dokumen_pcs').html(ok);
            },
            error:function(event, textStatus, errorThrown) {
              // alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
            },	      
            complete: function() {
                // NProgress.done();
            }
          })
        }
        
        function getTotDocCategory()  {
          $.ajax({
            type	: "GET",
            url		: "<?=base_url();?>app/getTotDocCategory",
            cache 	: false,
            beforeSend: function() {
                  // NProgress.start();
            },
            success : function(ok){
                // alert('update top 10');
              $('#txtTotKategori').animate({ opacity: "show" }, "slow");
              $('#txtTotKategori').html(ok);
            },
            error:function(event, textStatus, errorThrown) {
              // alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
            },	      
            complete: function() {
                // NProgress.done();
            }
          })
        }
        
        function getTotOpenDokumen()  {
          $.ajax({
            type	: "GET",
            url		: "<?=base_url();?>app/getTotOpenDoc",
            cache 	: false,
            beforeSend: function() {
                  // NProgress.start();
            },
            success : function(ok){
                // alert('update top 10');
              $('#txtTotOpenDok').animate({ opacity: "show" }, "slow");
              $('#txtTotOpenDok').html(ok);
            },
            error:function(event, textStatus, errorThrown) {
              // alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
            },	      
            complete: function() {
                // NProgress.done();
            }
          })
        }

        function getTotProgDokumen()  {
          $.ajax({
            type	: "GET",
            url		: "<?=base_url();?>app/getTotProgDoc",
            cache 	: false,
            beforeSend: function() {
                  // NProgress.start();
            },
            success : function(ok){
                // alert('update top 10');
              $('#txtTotProgDok').animate({ opacity: "show" }, "slow");
              $('#txtTotProgDok').html(ok);
            },
            error:function(event, textStatus, errorThrown) {
              // alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
            },	      
            complete: function() {
                // NProgress.done();
            }
          })
        }

        function getTotCloseDokumen()  {
          $.ajax({
            type	: "GET",
            url		: "<?=base_url();?>app/getTotCloseDoc",
            cache 	: false,
            beforeSend: function() {
                  // NProgress.start();
            },
            success : function(ok){
                // alert('update top 10');
              $('#txtTotCloseDok').animate({ opacity: "show" }, "slow");
              $('#txtTotCloseDok').html(ok);
            },
            error:function(event, textStatus, errorThrown) {
              // alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
            },	      
            complete: function() {
                // NProgress.done();
            }
          })
        }

        function getTotAllDokumen()  {
          $.ajax({
            type	: "GET",
            url		: "<?=base_url();?>app/getTotAllDoc",
            cache 	: false,
            beforeSend: function() {
                  // NProgress.start();
            },
            success : function(ok){
                // alert('update top 10');
              $('#txtTotAllDok').animate({ opacity: "show" }, "slow");
              $('#txtTotAllDok').html(ok);
            },
            error:function(event, textStatus, errorThrown) {
              // alert('Pesan kesalahan : '+ textStatus + ' , HTTP Error : '+errorThrown);
            },	      
            complete: function() {
                // NProgress.done();
            }
          })
        }

        function getLastDok()  {
          $.ajax({
            type	: "GET",
            url		: "<?=base_url();?>app/getLastDokumen",
            cache 	: false,
            beforeSend: function() {
              // NProgress.start();
            },
            success : function(ok){
              // alert('update top 10');
            $('#isi_new_document').animate({ opacity: "show" }, "slow");
            $('#isi_new_document').html(ok);
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>        
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ==" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js" integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew==" crossorigin=""></script>     
<script>
      $(window).on("load", function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
              latlng = new L.LatLng(position.coords.latitude, position.coords.longitude);
          
              var mymap = L.map('map').setView(latlng, 15);

              L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                maxZoom: 18,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                  '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                  'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                id: 'mapbox.streets',
                accessToken: 'pk.eyJ1IjoiYWhtYWRzdWx0b25pIiwiYSI6ImNrM2gyd2dmbzA2cTQzZ2x0OHBubWpqcGsifQ.xnCSMTjJwl3vPwcwsvDZWw'
              }).addTo(mymap);

              L.marker(latlng).addTo(mymap)
                .bindPopup("<b>Balangan Coal</b><br />Cyber 2 Tower").openPopup();

              L.circle(latlng, 500, {
                color: 'red',
                fillColor: '#f03',
                fillOpacity: 0.4
              }).addTo(mymap).bindPopup("I am a circle.");

              var popup = L.popup();

              function onMapClick(e) {
                popup
                  .setLatLng(e.latlng)
                  .setContent("You clicked the map at " + e.latlng.toString())
                  .openOn(mymap);
              }

              mymap.on('click', onMapClick);
            })
        }
      })
</script>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
      GIS			
			<small>Geographical Information System</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Dashboard</li>
		</ol>
	</section>

	<section class="content">		  			
    	<div class="row">
        <div id="map"></div>
      </div>
	</section>

</div>