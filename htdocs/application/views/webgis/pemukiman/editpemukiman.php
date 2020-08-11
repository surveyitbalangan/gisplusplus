<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $app_name ?>
            <!-- <small>Version 2.0</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Underconstruction</li>
        </ol>
    </section>
    <section class="content">
        <div>
        </div>

        <div class='col-md-12'>
            <?= form_open('pemukiman/update') ?>
        </div>
            <input id='objectid' type="hidden" name="objectid" value='<?= $data_pemukiman->objectid ?>'>
            <label for="text">Name</label>
            <input type="text" name="name" class="form-control" value="<?= $data_pemukiman->name ?>" placeholder="name">
            <label for="text">Area</label>
            <input type="text" name="area" class="form-control" value="<?php echo $data_pemukiman->area ?>" placeholder="area">

        <div id='mymap' style="height: 500px; margin: 50px 50px">

        </div>

        <input type="hidden" name="shape" id="shape">

        <button type="submit" class='btn btn-md btn-success'> Simpan </button>
        <button type="reset" class='btn btn-md btn-warning'> Reset </button>

        <?= form_close() ?>

        <script>

            leaflet = "<?= $data_pemukiman->st_astext ?>";
            var leaflet_converted = convert2(leaflet);

          
        </script>
        <script>
            var mymap = L.map('mymap', {
                // layers: [Foto_Udara, satelite]
            }).setView([-2.34, 115.6010420499895], 15);

            var Foto_Udara = L.tileLayer.wms('http://192.168.32.54:8080/geoserver/sdb_balangan/wms', {
                layers: 'sdb_balangan:Maret_30cm',
                format: 'image/png',
                transparent: true,
                attribution: "Survey Balangan Coal @ April 2019"
            })

            var satelite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}').addTo(mymap)

            var BaseMap = {
                "Foto Udara BC": Foto_Udara,
                "Citra Satelit Esri": satelite
            }

            var mapObjectLayer = L.geoJSON(leaflet_converted).addTo(mymap);

            mymap.fitBounds(mapObjectLayer.getBounds());

            // var drawControl = new L.Control.Draw({
            //     edit: {
            //         featureGroup: mapObjectLayer
            //     }
            // });

            // mymap.addControl(drawControl);

            shape = document.getElementById('shape');
            shape.value = leaflet;
        </script>
    </section>
</div>