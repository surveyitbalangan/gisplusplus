<!DOCTYPE html>
<html lang="en">

<head>
    <title>
        <?= $title ?>
    </title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type='text/javascript' src="static/js/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>static/css/bootstrap.css">
    <script src="<?= base_url() ?>static/js/bootstrap.js"></script>
    <link rel="stylesheet" href="<?= base_url() ?>static/leaflet/leaflet.css">
    <script src="<?= base_url() ?>static/leaflet/leaflet.js"></script>
    <script src="<?= base_url() ?>static/js/sanwkttojson.js"></script>
    <script src="<?= base_url() ?>static/js/script.js"></script>
    <style>
        
        body {
            background-color: #ffffff;
        }
        
        html, body {
            margin: 0;
            padding: 0;
        }
        
        .row a:link {
            color: #525252;
            text-decoration: none;
        }
        
        .row a:visited {
            color: #525252;
            text-decoration: none;
        }
        
        .row a:hover {
            color: #525252;
            text-decoration: none;
        }
        
        .row a:active {
            color: #525252;
            text-decoration: none;
        }
        
        #navbar {
            z-index: 100;
            position: fixed;
            width: 100%;
        }
    </style>

    