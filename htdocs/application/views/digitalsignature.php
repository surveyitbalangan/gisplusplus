<div class="content-wrapper">
    <section class="content-header">
        <?php
        


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
        <div class='form-actions'>
            <form class="form-form-group-lg" action="digitalsignature/receive" id='formSignature' method="POST">
                <h4>Nama : </h4>
                <input type="text" name='nama'>
                <h4>Tanggal : </h4>
                <input type="date" name='tanggal'>
                <h4>Nama Dokumen : </h4>
                <input type="text" name='nama_dokumen'>
                <h4>Nomor Dokumen : </h4>
                <input type="text" name='nomor_dokumen'>
                <h4>PIN : </h4>
                <input type="password" name='pin'><br>
                <button type="submit" class='btn btn-info mt-2'>
                    Submit
                </button>
            </form>
        </div>
        <script>
            form = document.getElementById('formSignature');
            form.onsubmit = console.log(form)
        </script>

    </section>
</div>