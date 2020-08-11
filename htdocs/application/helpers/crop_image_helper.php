<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('crop_image')){
    function cropImage($nw, $nh, $source, $stype, $dest){
        $size   = getimagesize($source);
        $w      = $size[0];
        $h      = $size[1];
        switch ($stype) {
            case 'gif' || 'GIF':
                $simg = imagecreatefromgif($source);
                break;
            case 'jpg' || 'JPG':
                $simg = imagecreatefromjpeg($source);
                break;
            case 'png' || 'PNG':
                $simg = imagecreatefrompng($source);
                break;
            default:
                # code...
                break;
        }
        $dimg   = imagecreatetruecolor($nw, $nh);
        $wm     = $w/$nw;
        $hm     = $h/$nh;

        $h_height = $nh/2;
        $w_height = $nw/2;
        if ($w>$h) {
            $adjusted_width = $w/$hm;
            $half_width     = $adjusted_width/2;
            $int_width      = $half_width-$w_height;
            imagecopyresampled($dimg, $simg,-$int_width,0,0,0, $adjusted_width, $nh, $w, $h);            
        }elseif (($w < $h) || ($w==$h)) {
            $adjusted_height = $h / $wm;
            $half_height    = $adjusted_height/2;
            $int_height     = $half_height-$h_height;
            imagecopyresampled($dimg, $simg,-$int_height,0,0,$nw, $adjusted_height, $w, $h);
        }else{
            imagecopyresampled($dimg, $simg,0,0,0,0, $nw, $nh, $w, $h);
        }
        return imagejpeg($dimg,$dest,100);
    }
}