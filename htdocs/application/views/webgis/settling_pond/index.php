<div class="content-wrapper" style="overflow: scroll;">
<!-- <?php
        $handle = curl_init();

        $url = "http://localhost:8000/api/settling_pond_all/?format=json";

        // Set the url
        curl_setopt($handle, CURLOPT_URL, $url);
        // Set the result output to be a string.
        curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

        $output = curl_exec($handle);

        curl_close($handle);

    ?> -->
    <section class="content-header">
        <h1> 
            <?= $app_name ?>
            <!-- <small>Version 2.0</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">List Data settling_pond</li>
        </ol>
    </section>
    <section class="content" >
        <?php echo $this->session->flashdata('notif') ?>
        <a href="<?php echo base_url() ?>/settling_pond/do_upload/" class="btn btn-md btn-success">Tambah Data</a>
        <?php

        // var_dump($data);
        $arr = $data_settling_pond;

        ?>
        <legend> Data List : </legend>
    <div style="overflow: scroll">
    <table class='table table-dark m-4'>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>Company</th>
                    <th>Nama</th>
                    <th>Luasan di Lapangan</th>
                    <th>Luasan di Pelaporan</th>
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
                    <td><?= strtoupper($x->settling_p) ?></td>
                    <td><?= strtoupper($x->area) ?></td>
                    <td><?= strtoupper($x->luas) ?></td>
                    <td></td>
                    <td>
                        <a href="<?php echo base_url() ?>settling_pond/edit/<?php echo $x->objectid ?>" class="btn btn-sm btn-success">Edit</a>
                        <!-- <a href="<?php echo base_url() ?>pit/hapus/<?php echo $x->objectid ?>" class="btn btn-sm btn-danger">Hapus</a> -->
                        <a href="#" class="btn btn-sm btn-danger" onclick="ConfirmDialog('Your data will be deleted, Are you sure?', <?php echo $x->objectid ?>)">Hapus</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
        

        <script>
            function ConfirmDialog(message, objectid, handler) {
                $(`<div class="modal fade" id="myModal" role="dialog"> 
     <div class="modal-dialog"> 
       <!-- Modal content--> 
        <div class="modal-content"> 
           <div class="modal-body" style="padding:10px;"> 
             <h4 class="text-center">${message}</h4> 
             <div class="text-center"> 
             <a href="<?php echo base_url() ?>settling_pond/hapus/${objectid}" class="btn btn-danger">Hapus</a>
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

            
            console.log("<?= $output ?>")
        </script>

    </section>
</div>