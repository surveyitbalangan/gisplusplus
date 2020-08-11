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
?>

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
            <?php echo form_open_multipart('pit/do_upload'); ?>
            <div class="form-group col-sm-12">
                <label for="text">Perusahaan</label>
                <select class='form-control' name="company" id="" value="<?php echo $data_pit->company ?>">
                    <option id='lsa' value="LSA">PT. LSA</option>
                    <option id='scm' value="SCM">PT. SCM</option>
                </select></div>

            <div class="form-group col-sm-12">
                <label for="text">Tanggal</label>
                <input type="date" name="date" class="form-control">
            </div>

            <div class="form-group row">
                <div style='margin: 10px; width: 400px' class="alert alert-warning col-sm-12">Make sure your data is using datum GCS WGS 84 as Reference Coordinates System</div>

                <div class='col-sm-12'>
                    <label for="shp">SHP</label>
                    <input multiple id='shp' type="file" name="shp" class="form-control" onchange="copythis()" multiple>
                </div>
                <div class='col-sm-12'>
                    <label for="shx">SHX</label>
                    <input id='shx' type="file" name="shx" class="form-control">
                </div>
                <div class='col-sm-12'>
                    <label for="dbf">DBF</label>
                    <input id='dbf' type="file" name="dbf" class="form-control">
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


            <button style="margin-top: 35px; margin-left: 20px" type="submit" class="btn btn-md btn-success">Upload</button>

            </form>

            <?
            if (isset($upload_data)) {
                var_dump($upload_data);
            } else {
                //not set
            }
            ?>
        </div>
    </section>
</div>