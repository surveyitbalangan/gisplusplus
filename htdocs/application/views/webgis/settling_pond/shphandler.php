<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>

    <script src="<?php echo base_url() ?>static/js/jquery-3.5.0.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>static/css/bootstrap.css">
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

<body>

    <?php

    $post = ($_POST);

    class GeoJSONObject
    {
        public $type;
        public $name;
        public $features;

        function __construct($type, $name, $features)
        {
            $this->type = $type;
            $this->name = $name;
            $this->features = $features;
        }
    }

    $features_arr = [];
    $wkt_arr = [];

    // $data = json_encode($upload_data);
    $origname = $upload_data["orig_name"];
    $nama_arr = (explode(".", $origname));
    $nama_file = $nama_arr[0];
    // echo $data;
    // echo "Nama File : " . $nama_file . "<br><br><br><br><br>";

    require_once('Shapefile/ShapefileAutoloader.php');
    Shapefile\ShapefileAutoloader::register();

    use Shapefile\Geometry\Point;
    use Shapefile\Geometry\Linestring;
    use Shapefile\Geometry\Polygon;
    use Shapefile\Shapefile;
    use Shapefile\ShapefileException;
    use Shapefile\ShapefileWriter;
    use Shapefile\ShapefileReader;

    try {
        // Open Shapefile
        $Shapefile = new ShapefileReader('uploads/' . $nama_file, [
            Shapefile::OPTION_SUPPRESS_M            => true,
            Shapefile::OPTION_DBF_NULL_PADDING_CHAR => '*'
        ]);

        // var_dump($Shapefile);

        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";
        // echo "<br>";

        // Read all the records
        while ($Geometry = $Shapefile->fetchRecord()) {
            // Skip the record if marked as "deleted"
            if ($Geometry->isDeleted()) {
                continue;
            }

            // Print Geometry as an Array
            // print_r($Geometry->getArray());

            // Print Geometry as WKT
            // echo "WKT : ";
            // print_r($Geometry->getWKT());
            array_push($wkt_arr, $Geometry->getWKT());

            // echo "<br>";
            // echo "<br>";
            // echo "<br>";
            // echo "<br>";
            // echo "<br>";


            // Print Geometry as GeoJSON
            // echo "geojson : ";
            // print_r($Geometry->getGeoJSON());
            array_push($features_arr, $Geometry->getGeoJSON());

            // echo "<br>";
            // echo "<br>";
            // echo "<br>";
            // echo "<br>";
            // echo "<br>";


            // Print DBF data
            // echo "DBF DATA : ";
            $dbfdata = json_encode($Geometry->getDataArray());

            // echo "Shape Type : ";
            // echo $Shapefile->getShapeType() . " - " . $Shapefile->getShapeType(Shapefile::FORMAT_STR);
            // echo "\n\n";

            // // Get number of Records
            // echo "Records : ";
            // print_r($Shapefile->getTotRecords());
            // echo "\n\n";

            // // Get Bounding Box
            // echo "Bounding Box : ";
            // print_r($Shapefile->getBoundingBox());
            // echo "\n\n";

            // // Get PRJ
            // echo "PRJ : ";
            // print_r($Shapefile->getPRJ());
            // echo "\n\n";

            // // Get Charset
            // echo "Charset : ";
            // print_r($Shapefile->getCharset());
            // echo "\n\n";

            // // Get DBF Fields
            // echo "DBF Fields : ";
            // print_r($Shapefile->getFields());
            // echo "\n\n";
        }
    } catch (ShapefileException $e) {
        // Print detailed error information
        echo "Error Type: " . $e->getErrorType()."<br>"
            . "\nMessage: " . $e->getMessage()."<br>"
            . "\nDetails: " . $e->getDetails();
    }

    $data_uploaded = new GeoJSONObject("FeatureCollection", $nama_file, $features_arr);
    // echo json_encode($data_uploaded);

    ?>
    <div class='container'>
        <div class=''>
            <h3 id='notif' class='notif'>Your file was successfully uploaded!</h3>

            
            <table class='table table-light'>
            <div id='nama-file'>Nama File : <?= $nama_file ?></div>
                <tr>
                    <td>Perusahaan    :</td>
                    <td id='perusahaan'></td>
                </tr>
                <tr>
                    <td>Tanggal    :</td>
                    <td id='tanggal'></td>
                </tr>
            </table>

            <div id='mymap' style="height: 300px; width: 300px;" class="mr">

            </div>
            <p><?php echo anchor('shpcrud/do_upload', 'Upload Another File!'); ?></p>
            <?= form_open('shpcrud/insert_db') ?>
                <input type="hidden" name="date" value="" id='hiddendate'>
                <input type="hidden" name="company" value="" id='hiddencompany'>
                <input type="hidden" name="shape" value="" id='hiddenshape'>                
            <input type="submit" id='final-submit' class='btn btn-light' value='Save to Database'>
            <?= form_close() ?>
        </div>
    </div>



    <script>
        var testobj;
        var dbfdata = <?php echo $dbfdata ?>;
        var posted = <?php echo json_encode($post) ?>

        perusahaan = document.getElementById('perusahaan')
        if (posted.company == 'lsa' || 'LSA') {
            perusahaan.innerHTML = 'PT. Laskar Semesta Alam';
            
        } else perusahaan.innerHTML = 'PT. Semesta Centra Mas';

        hiddencompany.value = posted.company;
        tanggal = document.getElementById('tanggal');
        tanggal.innerHTML = posted.date;
        hiddendate.value = posted.date;
        

        if (typeof posted.date != 'string' || posted.date.length == 0) {
            $('#tanggal').html('error').css('color', 'red')
            $("#notif").html("Please Correct Your Date Input").css('color', 'red')
            // $("#notif").style.color = 'red'
            final = document.getElementById('final-submit');
            final.disabled = true;
        }

        window.onload = function() {
            wkt = <?= json_encode($wkt_arr) ?>;
            hiddenshape.value = wkt;

            feature = {
                type: 'FeatureCollection',
                features: []
            }

            // wkt_converted = convertPhp(wkt);
            if (typeof wkt == 'object' && wkt.length > 0) {
                
                wkt.forEach(el => {
                    el = convertPhp(el);
                    console.log('converPHP')
                    console.log(el)
                    feature.features.push(el);
                })
            }

            var lay = new L.geoJSON(feature).addTo(mymap)
            lay.bindPopup(
                function() {
                    var ol = document.createElement('div');

                    Object.keys(dbfdata).forEach(elo => {
                        var node = document.createElement('p');
                        node.innerHTML = elo + ' : ' + dbfdata[elo];
                        ol.appendChild(node);
                    })
                    return ol;
                }
            )

            mymap.fitBounds(lay.getBounds());


        }

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

        // var mapObjectLayer = L.geoJSON(leaflet_converted).addTo(mymap);
        // mymap.fitBounds(mapObjectLayer.getBounds());

        // var drawControl = new L.Control.Draw({
        //     edit: {
        //         featureGroup: mapObjectLayer
        //     }
        // });

        // mymap.addControl(drawControl);

        // shape = document.getElementById('shape');
        // shape.value = leaflet;
    </script>

</body>

</html>