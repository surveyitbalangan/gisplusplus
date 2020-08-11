<!DOCTYPE html>
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo $title ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>static/css/bootstrap.css">
    <script type='text/javascript' src="<?php echo base_url() ?>static/js/jquery-3.5.0.js"></script>
    <script type='text/javascript' src="<?php echo base_url() ?>static/js/popper.min.js"></script>
    <script type='text/javascript' src="<?php echo base_url() ?>static/js/bootstrap.js"></script>
    <link rel="stylesheet" href="<?php echo base_url() ?>static/leaflet/leaflet.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>static/leaflet/L.control.Sidebar.css">
    <script src="<?php echo base_url() ?>static/js/sanwkttojson.js"></script>
    <script src="<?php echo base_url() ?>static/leaflet/leaflet.js"></script>
    <script src="<?php echo base_url() ?>static/leaflet/Leaflet.Control.Custom.js"></script>    
    <script src="<?php echo base_url() ?>static/leaflet/L.control.Sidebar.js"></script>
    <script src="<?php echo base_url() ?>static/leaflet/Control.Draw.js"></script>

</head>

<?php

    if ($data_pit->company == 'LSA' || $data_pit->company == 'lsa') {
        $comp = 'lsa';
    } else if($data_pit->company == 'SCM' || $data_pit->company == 'scm' ) {
        $comp = 'scm';
    }

    var_dump($data_pit);
    
?>

<body>
<div>

</div>

    <div class='container'>
        <div class='col-md-12'>
            <?= form_open('shpcrud/update') ?>
        </div>
        <input type="hidden" name="objectid" value='<?= $data_pit->objectid ?>'>
        <div class="form-group">
            <label for="text">Tanggal</label>
            <input type="date" name="date" class="form-control" value="<?php
            if (substr($data_pit->date,4,1) == '/') {
                echo str_replace('/','-',substr($data_pit->date,0,10));
            } else {
                echo substr($data_pit->date,0,10);
            }
             ?>" placeholder="Date">
            <!-- <input type="hidden" value="<?php echo $data_pit->id_pit ?>" name="id_pit"> -->
        </div>

        <div class="form-group">
            <label for="text">Company</label>
            <select class='form-control' name="company" id="" value="<?php echo $data_pit->company ?>">
                <option id='lsa' value="lsa">PT. LSA</option>
                <option id='scm' value="scm">PT. SCM</option>
            </select>
        </div>
        <script>
    comp = "<?= $comp ?>";
    
    leaflet = "<?= $data_pit->st_astext ?>";
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

    var drawControl = new L.Control.Draw({
        edit : {
            featureGroup : mapObjectLayer
        }
    });

    mymap.addControl(drawControl);

    shape = document.getElementById('shape');
    shape.value = leaflet;
</script>
    </div>
</body>
</html>