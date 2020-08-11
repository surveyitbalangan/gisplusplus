<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>static/css/bootstrap.css">
    <script type='text/javascript' src="<?php echo base_url() ?>static/js/jquery-3.5.0.js"></script>
    <script type='text/javascript' src="<?php echo base_url() ?>static/js/popper.min.js"></script>
    <script type='text/javascript' src="<?php echo base_url() ?>static/js/bootstrap.js"></script>
</head>

<body>
    <?php echo $this->session->flashdata('notif') ?>
    <a href="<?php echo base_url() ?>disposaledit/do_upload/" class="btn btn-md btn-success">Tambah Data</a>
    <?php

    // var_dump($data_pit);
    $arr = $data_pit;

    ?>
    <legend> Data List : </legend>

    <table class='table table-dark m-4'>
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>Company</th>
                <th>Contributor</th>
                <!-- <th>No.</th> -->
            </tr>
        </thead>

        <?php
        $no = 1;
        foreach ($arr as $x) {
            // print_r($x_value);        
        ?>
            <tr>
                <td><?= $no++ ?></td>
                <td><?= substr($x->date, 0, 7) ?></td>
                <td><?= strtoupper($x->company) ?></td>
                <td></td>
                <td>
                    <a href="<?php echo base_url() ?>disposaledit/edit/<?php echo $x->objectid_1 ?>" class="btn btn-sm btn-success">Edit</a>
                    <!-- <a href="<?php echo base_url() ?>disposaledit/hapus/<?php echo $x->objectid_1 ?>" class="btn btn-sm btn-danger">Hapus</a> -->
                    <a href="#" class="btn btn-sm btn-danger" onclick="ConfirmDialog('Your data will be deleted, Are you sure?', <?php echo $x->objectid_1 ?>)">Hapus</a>
                </td>
            </tr>
        <?php } ?>
    </table>

    <script>
        function ConfirmDialog(message, objectid, handler) {
            $(`<div class="modal fade" id="myModal" role="dialog"> 
     <div class="modal-dialog"> 
       <!-- Modal content--> 
        <div class="modal-content"> 
           <div class="modal-body" style="padding:10px;"> 
             <h4 class="text-center">${message}</h4> 
             <div class="text-center"> 
             <a href="<?php echo base_url() ?>disposaledit/hapus/${objectid}" class="btn btn-danger">Hapus</a>
               <a class="btn btn-default btn-no">no</a> 
             </div> 
           </div> 
       </div> 
    </div> 
  </div>`).appendTo('body');

  console.log(objectid);

            //Trigger the modal
            $("#myModal").modal({
                backdrop: 'static',
                keyboard: false
            });

            //Remove the modal once it is closed.
            $("#myModal").on('hidden.bs.modal', function() {
                $("#myModal").remove();
            });
        }
    </script>

</body>

</html>