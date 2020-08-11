<div class="content-wrapper">
    <section class="content-header">
        <?php
        
        // var_dump($_POST);
        include ('phpqrcode/qrlib.php');

        $nama = $_POST['nama'];
        $tanggal = $_POST['tanggal'];
        $nama_dokumen = $_POST['nama_dokumen'];
        $nomor_dokumen = $_POST['nomor_dokumen'];
        $pin = $_POST['pin'];

        if (isset($pin) && isset($nama))
        {
            $SERVERFILEPATH = $_SERVER['DOCUMENT_ROOT'].'/qrcode//';

            $qrtext = $nama.$tanggal.$nama_dokumen.$nomor_dokumen.$pin;
            $folder = $SERVERFILEPATH;
            $file_name1 = $qrtext."-QrCode.png";
            

            $file_name2 = str_replace(' ', '_', $file_name1);

            $filename = $folder.$file_name2;

            QRcode::png($qrtext,$filename);

            echo $file_name1;

            
        }
        else
        {
        echo 'No Text Entered';
        }	

        ?>
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
    <legend>Here's your QR Code </legend>
       <?php 
       
       echo"<center><img src=".'http://192.168.32.54/qrcode/'.$file_name2."></center";

       ?>

    <h4>For Document </h4>
    
    <li>Nama Dokumen : <?= $nama_dokumen ?></li>
    <li>Nomor Dokumen : <?= $nomor_dokumen ?></li>
    </section>
</div>