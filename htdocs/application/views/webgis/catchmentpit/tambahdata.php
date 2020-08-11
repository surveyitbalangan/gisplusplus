<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>static/css/bootstrap.css">
    <script type='text/javascript' src="<?php echo base_url() ?>static/js/jquery-3.4.1.js"></script>
    <script type='text/javascript' src="<?php echo base_url() ?>static/js/popper.min.js"></script>
    <script type='text/javascript' src="<?php echo base_url() ?>static/js/bootstrap.js"></script>
</head>

<body>
    <div>
        <?php
            $requestType = $_SERVER['REQUEST_METHOD'];

            echo $requestType;
        ?>
    </div>
    <div class="container" style="margin-top: 80px">
        <div class="col-md-12">
            <form action="<?php echo base_url() ?>catchmentpit/tambahdata" method='post'>
            <div class="form-group">
                <label for="text">Perusahaan</label>
                <select class='form-control' name="company" id="" value="<?php echo $data_pit->company ?>">
                <option id='lsa' value="lsa">PT. LSA</option>
                <option id='scm' value="scm">PT. SCM</option>
            </select></div>

            <div class="form-group">
                <label for="text">Tanggal</label>
                <input type="date" name="tanggal_terbit" class="form-control">
            </div>

            <div class="form-group row">
                <div class='col-4'>
                <label for="fileSHP">SHP</label>
                <input type="file" name="shp" class="form-control-file">
                </div>
                <div class='col-4'>
                <label for="fileSHX">SHX</label>
                <input type="file" name="shx" class="form-control-file">
                </div>
                <div class='col-4'>
                <label for="fileDBF">DBF</label>
                <input type="file" name="dbf" class="form-control-file">
                </div>
            </div>


            <button type="submit" class="btn btn-md btn-success">Upload</button>
            <button type="reset" class="btn btn-md btn-warning">Reset</button>

            </form>
            
        </div>
    </div>

</body>

</html>