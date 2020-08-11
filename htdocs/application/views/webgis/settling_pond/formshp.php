<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data</title>
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

<body>
    <?php
    $requestType = $_SERVER['REQUEST_METHOD'];

    require_once('Shapefile/ShapefileAutoloader.php');
    Shapefile\ShapefileAutoloader::register();

    use Shapefile\Geometry\Point;
    use Shapefile\Geometry\Linestring;
    use Shapefile\Geometry\Polygon;
    use Shapefile\Shapefile;
    use Shapefile\ShapefileException;
    use Shapefile\ShapefileWriter;
    use Shapefile\ShapefileReader;

    echo 'get neh'; ?>
    <div class="container" style="margin-top: 80px">
        <div class="col-md-12">
            <?php echo form_open_multipart('shpcrud/do_upload'); ?>
            <div class="form-group">
                <label for="text">Perusahaan</label>
                <select class='form-control' name="company" id="" value="<?php echo $data_pit->company ?>">
                    <option id='lsa' value="LSA">PT. LSA</option>
                    <option id='scm' value="SCM">PT. SCM</option>
                </select></div>

            <div class="form-group">
                <label for="text">Tanggal</label>
                <input type="date" name="date" class="form-control">
            </div>

            <div class="form-group row">
                <div class='col-4'>
                    <label for="shp">SHP</label>
                    <input multiple id='shp' type="file" name="shp" class="form-control-file" onchange="copythis()" multiple>
                </div>
                <div class='col-4'>
                    <label for="shx">SHX</label>
                    <input id='shx' type="file" name="shx" class="form-control-file">
                </div>
                <div  class='col-4'>
                    <label for="dbf">DBF</label>
                    <input id='dbf' type="file" name="dbf" class="form-control-file">
                </div>
            </div>
            <script>
                function copythis() {
                    shp = document.getElementById('shp');
                    shx = document.getElementById('shx');
                    dbf = document.getElementById('dbf');

                    shx.value = shp.value.split('.')[0] + '.shx';
                    dbf.value = shp.value.split('.')[0] + '.dbf';
                    console.log(shx.value);
                }
            </script>


            <button type="submit" class="btn btn-md btn-success">Upload</button>
            <button type="reset" class="btn btn-md btn-warning">Reset</button>

            </form>

            <?
            if (isset($upload_data)) {
                var_dump($upload_data);
            } else {
                //not set
            }
            ?>



</body>

</html>