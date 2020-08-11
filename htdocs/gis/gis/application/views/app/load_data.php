<?php foreach($data->result_array() as $isi){ ?>
<li class="item">
    <div class="product-img">
        <img src="http://mocan1.simocan.com/api/foto_registrasi/<?=$isi['FOTO'];?>" alt="Foto Relawan">
    </div>
    <div class="product-info">
        <a href="javascript:void(0)" class="product-title">
            <?=$isi['NAMA'];?>
            <span class="label label-info pull-right" style="font-size:12pt;"><?=$isi['TOTAL'];?></span>
        </a>
        <span class="product-description">
            <?=$isi['DAPIL'];?>
        </span>
    </div>
</li>
<? } ?>