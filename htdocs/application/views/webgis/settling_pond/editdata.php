<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $app_name ?>
            <!-- <small>Version 2.0</small> -->

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Edit</li>
            <li class="active">settling_pond <?php echo str_replace('/', '-', substr($data_settling_pond->date, 0, 10)) ?></li>
        </ol>
    </section>
    <section class="content">
        <?

        // var_dump($data_settling_pond);

        ?>
        <?php

        // var_dump($data_settling_pond);
        if ($data_settling_pond->company == 'LSA' || $data_settling_pond->company == 'lsa') {
            $comp = 'lsa';
        } else if ($data_settling_pond->company == 'SCM' || $data_settling_pond->company == 'scm') {
            $comp = 'scm';
        }

        ?>
        <div>

        </div>

        <div class='col-md-12'>
            <?= form_open('settling_pond/update') ?>
        </div>
        <input id='objectid' type="hidden" name="objectid" value='<?= $data_settling_pond->objectid ?>'>
        <div class="form-group">
            <label for="text">Tanggal</label>
            <input type="date" name="date" class="form-control" value="<?php echo str_replace('/', '-', substr($data_settling_pond->date, 0, 10)) ?>" placeholder="Date">
            <!-- <input type="hidden" value="<?php echo $data_settling_pond->id_disposal ?>" name="id_disposal"> -->
            <label for="text">Nama</label>
            <input type="text" name="settling_p" class="form-control" value="<?= $data_settling_pond->settling_p ?>" placeholder="settling_p">
            <label for="text">Area pada Pelaporan</label>
            <input type="text" name="luas" class="form-control" value="<?= $data_settling_pond->luas ?>" placeholder="luas">
            <label for="text">Area Data GIS</label>
            <input type="text" name="area" class="form-control" value="<?= $data_settling_pond->area ?>" placeholder="area">
        </div>

        <div class="form-group">
            <label for="text">Company</label>
            <select class='form-control' name="company" id="" value="<?php echo $data_settling_pond->company ?>">
                <option id='lsa' value="lsa">PT. LSA</option>
                <option id='scm' value="scm">PT. SCM</option>
            </select>
        </div>
        <script>
            comp = "<?= $comp ?>";

            leaflet = "<?= $data_settling_pond->st_astext ?>";
            var leaflet_converted = convert2(leaflet);

            if (comp == 'scm') {
                scm = document.getElementById('scm')
                scm.selected = true;
            }
        </script>

        <div id='mymap' style="height: 500px; margin-bottom: 50px">

        </div>

        <input type="hidden" name="shape" id="shape">

        <button type="submit" class='btn btn-md btn-success'> Simpan </button>
        <button type="reset" class='btn btn-md btn-warning'> Reset </button>

        <?= form_close() ?>
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