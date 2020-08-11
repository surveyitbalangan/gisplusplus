<style>
    body,
    html {
        background-color: #ccc;
    }
    
    #myProgress {
        width: 100%;
        background-color: grey;
    }
    
    #mapid {
        height: 100vh;
        width: 100%;
        margin-top: 100px;
        z-index: 0;
    }
    
    .slidecontainer {
        width: 100%;
        /* Width of the outside container */
    }
    /* The slider itself */
    
    .slider {
        -webkit-appearance: none;
        /* Override default CSS styles */
        appearance: none;
        width: 100%;
        /* Full-width */
        height: 25px;
        /* Specified height */
        background: #d3d3d3;
        /* Grey background */
        outline: none;
        /* Remove outline */
        opacity: 0.7;
        /* Set transparency (for mouse-over effects on hover) */
        -webkit-transition: .2s;
        /* 0.2 seconds transition on hover */
        transition: opacity .2s;
    }
    /* Mouse-over effects */
    
    .slider:hover {
        opacity: 1;
        /* Fully shown on mouse-over */
    }
    /* The slider handle (use -webkit- (Chrome, Opera, Safari, Edge) and -moz- (Firefox) to override default look) */
    
    .slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        /* Override default look */
        appearance: none;
        width: 25px;
        /* Set a specific slider handle width */
        height: 25px;
        /* Slider handle height */
        background: #4CAF50;
        /* Green background */
        cursor: pointer;
        /* Cursor on hover */
    }
    
    .slider::-moz-range-thumb {
        width: 25px;
        /* Set a specific slider handle width */
        height: 25px;
        /* Slider handle height */
        background: #4CAF50;
        /* Green background */
        cursor: pointer;
        /* Cursor on hover */
    }
    
    #myBar {
        /* width: 15%; */
        padding: 0;
        height: 30px;
        background-color: #4CAF50;
        text-align: center;
        /* To center it horizontally (if you want) */
        line-height: 30px;
        /* To center it vertically */
        color: white;
    }
    
    .card-body {
        align-items: center;
        justify-content: center;
        text-align: left;
    }
    
    .row {
        margin-left: 0px;
        margin-right: 0px;
    }
</style>

</head>

<body class='m-0 p-0'>
    <div class='row m-0'>
        <div id="myProgress" style="border: solid black 1px;">
            <div id="myBar">Loading Data</div>
        </div>
        <div class='col-4 m-1'>
            <div class="card">
                <div class="card-body">
                    <h4>Data List :</h4>
                    <input type="checkbox" id="checkpit" onclick="show('pit')" checked=false>
                    <label for="">PIT:</label>

                    <p id="textpit" style="display:none">Checkbox is CHECKED!</p>
                    <br>

                    <input type="checkbox" id="checkdisposal" onclick="show('disposal')" checked=false>
                    <label for="">DISPOSAL:</label>


                    <p id="textdisposal" style="display:none">Checkbox is CHECKED!</p>
                    <script>
                    </script>
                </div>
            </div>
            <div id='disposalLSAData' class='row'>
                <div class='col-12'>
                    <h4>Date : </h4>
                    <h4 id='date'></h4>
                </div>
                <div class='col-6' style="border: green 1px dashed;">
                    <h3>Disposal LSA</h3>
                    <div>
                        <h5>Unsoilling :</h5>
                        <h5 id='unsoilling_dsplsa'></h5>
                    </div>
                    <div>
                        <h5>Fine Coal Field :</h5>
                        <h5 id='fine_coal_field_dsplsa'></h5>
                    </div>
                    <div>
                        <h5>Area :</h5>
                        <h5 id='area_dsplsa'></h5>
                    </div>
                </div>
                <div class='col-6' style="border: green 1px dashed;">
                    <h3>Disposal SCM</h3>
                    <div>
                        <h5>Unsoilling :</h5>
                        <h5 id='unsoilling_dspscm'></h5>
                    </div>
                    <div>
                        <h5>Fine Coal Field :</h5>
                        <h5 id='fine_coal_field_dspscm'></h5>
                    </div>
                    <div>
                        <h5>Area :</h5>
                        <h5 id='area_dspscm'></h5>
                    </div>
                </div>
                <div class='col-6' style="border: green 1px dashed;">
                    <h3>PIT LSA</h3>
                    <div>
                        <h5>Area :</h5>
                        <h5 id='area_pitlsa'></h5>
                    </div>
                </div>
                <div class='col-6' style="border: green 1px dashed;">
                    <h3>PIT SCM</h3>
                    <div>
                        <h5>Area :</h5>
                        <h5 id='area_pitscm'></h5>
                    </div>
                </div>

            </div>
            <div id='slidecontainer' class='col-12'>
                <input type="range" value='0' min='0' id='range' step='1' class='slider my-4'>

            </div>

        </div>

        <div class='col m-0 p-0'>
            <div id="mapid" class='m-0'>

            </div>
        </div>
    </div>


    <script>
        // init map
        var mymap = L.map('mapid').setView([-2.34, 115.6010420499895], 15);

        var wmsLayer = L.tileLayer.wms('http://192.168.32.54:8080/geoserver/sdb_balangan/wms', {
            layers: 'sdb_balangan:april22',
            format: 'image/png',
            transparent: true,
            attribution: "Survey Balangan Coal @ April 2019"
        }).addTo(mymap);



        // working with Well Known Text Data
    </script>

    </div>
    <script src="<?= base_url() ?>static/js/script.js"></script>
    <script>
        // var datasets = new L.GeoJSON.AJAX("http://192.168.32.54:8000/api/test/", {

        //     onEachFeature: function(feature, layer) {
        //         layer.bindPopup(
        //             "<b>ID : </b>" + feature.properties.name.toString() +
        //             "</br><b>Luas : </b>" + Math.round(feature.properties.area) + "m2" +
        //             "</br>"
        //         );
        //         layer.setStyle({
        //             color: 'Navy',
        //             opacity: 0.5
        //         });

        //         layer.on('mouseover', function() {
        //             this.setStyle({
        //                 color: 'red'
        //             });
        //         });

        //         layer.on('mouseout', function() {
        //             this.setStyle({
        //                 color: 'navy'
        //             })
        //         });

        //         $.ajax({
        //             url: '{% url "coba" %}',
        //             success: function(result) {
        //                 $("#infobar2").html(result);
        //             }
        //         });
        //         layer.on('click', function() {

        //             if (infobar.show == 1) {
        //                 infobar.hide()
        //             } else {
        //                 infobar.show()
        //             }
        //             $.ajax({
        //                 dataType: "json",
        //                 url: '{% url "test" %}',
        //                 data: data,
        //                 success: function(result) {
        //                     console.log(result)
        //                 }
        //             })
        //         });

        //         map.addControl(infobar);
        //         // map.on('click', function() {
        //         //     infobar.hide();

        //         // });
        //     }
        // });
        // datasets.addTo(mymap)

        function br(el) {
            el.createElement('br')
        }
    </script>



</body>

</html>
<!-- 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webgis Balangan Coal</title>
    <script type='text/javascript' src="static/js/jquery-3.4.1.js"></script>
    <link rel="stylesheet" type="text/css" href="static/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="static/css/landingpage.css">
    <script type='text/javascript' src="static/js/bootstrap.js"></script>
    <script type='text/javascript' src="static/js/operation.js"></script> -->
<!-- <link rel="stylesheet" href="static/leaflet/leaflet.css">
    <script src="static/leaflet/leaflet.js"></script>
    <script src="static/js/sanwkttojson.js"></script>
</head>

<body>
    <div id='loading'>
        <div class="spinner-border text-success" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-border text-success" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <div class="spinner-border text-success" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <div id='body'>

        <div class="wrapper fadeInDown row m-0 p-0">
            <div class='col-12 bg-dark text-light' style="height: 6vh;" id='header'>
                <div>
                    <div class="sidebar-header row mr-auto pt-2">
                        <img src="static/img/logo.png" id="icon" alt="User Icon" />
                        <h6 class='pt-2 ml-2'>Balangan Coal Database</h4>
                    </div>
                </div>
            </div>
            <div id='mapid' style="position: fixed; border: solid black 5px; height: 800px; margin-top: 100px;">

            </div>
            <div id='informasitepi' class="col-2 mt-5">
                <div id='slidecontainer' class=''>
                    <input style="justify-self: end; z-index: 1;" type="range" value='0' min='0' id='range' step='1' class='slider my-4'>

                </div>
            </div>

            <script src="/static/js/sanleaflet.js"></script>
        </div>
    </div>

    <script>
        window.onload = () => {
            var loading = document.getElementById('loading')
            var body = document.getElementById('body')
            setTimeout(() => {
                loading.style.display = 'none';
                body.style.display = 'block';
                console.log('a')
            }, 3000)
        }
    </script>
</body>

</html> -->