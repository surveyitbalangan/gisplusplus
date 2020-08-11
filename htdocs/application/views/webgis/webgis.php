<div class="content-wrapper">
    <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>static/css/bootstrap.css">
    <script type='text/javascript' src="<?php echo base_url() ?>static/js/jquery-3.5.0.js"></script>
    <script type='text/javascript' src="<?php echo base_url() ?>static/js/popper.min.js"></script>
    <script type='text/javascript' src="<?php echo base_url() ?>static/js/bootstrap.js"></script> -->

    <section class="content-header">
        <h1>
            <?= $app_name ?>
            <!-- <small>Version 2.0</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Webgis Dashboard</li>
        </ol>
    </section>
    <section class="content">
        <!-- <link rel="stylesheet" type="text/css" href="static/css/bootstrap.css">
    <script type='text/javascript' src="static/js/jquery-3.4.1.js"></script>
    <script type='text/javascript' src="static/js/popper.min.js"></script>
    <script type='text/javascript' src="static/js/bootstrap.js"></script> -->

        <?php

        function curling($url)
        {

            $handle = curl_init();

            curl_setopt($handle, CURLOPT_URL, $url);

            curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);

            $output = curl_exec($handle);

            curl_close($handle);

            echo $output;
        }


        $url1 = "http://localhost:8000/api/pit/?format=json";

        $url2 = "http://localhost:8000/api/disposal/?format=json";

        $url3 = "http://localhost:8000/api/reklamasiAll/?format=json";

        ?>

        <script>
            var pit = <?= curling($url1); ?>;
            var disposal = <?= curling($url2); ?>;
            var reklamasi = <?= curling($url3); ?>;

            var mapobject = {
                geojsonloaded: {},
                date: [],
                overlayMaps: {},
                basemap: {},
                basemapOverlayered: {}
            }

            loadData2(pit, "Pit");
            loadData2(disposal, "Disposal");
            loadData2(reklamasi, "Reklamasi");

            function loadData2(obj, objType) {
                var lsaArr = [];
                var scmArr = [];
                var pcsArr = [];
                var bothArr = [];

                gjobj = obj.results
                gjobj.features.forEach(el => {
                    if (Object.keys(el.properties).includes("company")) {

                        var geom = convert3(el.geometry);

                        el.geometry = geom;
                        el.properties["object"] = objType;
                        // Change date formating from Date and Time to Date only (YYYY-MM-DD)
                        el.properties.date[10] == 'T' ? date = el.properties.date.split('T') : date = el.properties.date.split(' ')
                        el.properties.date = date[0].replace(/\//g, '-').substr(0, 7);
                        // Push the formatted date to array of mapobject to be used as identifier someday
                        // Check if date already exist on array
                        if (mapobject.date.includes(el.properties.date)) {

                        } else {
                            mapobject.date.push(el.properties.date)
                        }

                        if (el.properties.company == 'LSA' || el.properties.company == 'lsa') {
                            lsaArr.push(el)
                        } else if (el.properties.company == 'SCM' || el.properties.company == 'scm') {
                            scmArr.push(el)
                        } else if (el.properties.company == 'PCS' || el.properties.company == 'pcs' || el.properties.company == ' PCS') {
                            pcsArr.push(el)
                        } else {
                            // console.error('tessssssst')
                            // bothArr.push(el)
                        }
                    } else {
                        console.error('tessssssst')
                        bothArr.push(el)
                    }
                })

                mapobject.geojsonloaded[objType] = {
                    lsa: [],
                    scm: [],
                    pcs: [],
                    both: []
                }

                mapobject.geojsonloaded[objType].lsa.push(lsaArr);
                mapobject.geojsonloaded[objType].scm.push(scmArr);
                mapobject.geojsonloaded[objType].pcs.push(pcsArr);
                mapobject.geojsonloaded[objType].both.push(bothArr);

                // // emptying array
                // lsaArr.length = 0;
                // scmArr.length = 0;
                // pcsArr.length = 0;
                // bothArr.length = 0;
            }

        </script>


        <style>
            body {
                background-color: white;
            }

            #mymap {
                height: 750px
            }
        </style>

        <!-- <div id="sidebar">
    aaaaaaaaaaaaaaaaaaaaaaaaa
</div> -->
        <div id='mymap'>

        </div>
        <script>
            var mymap = L.map('mymap', {
                // layers: [Foto_Udara, satelite]
            }).setView([-2.34, 115.6010420499895], 15);

            var Foto_Udara = L.tileLayer.wms('http://192.168.32.54:8080/geoserver/sdb_balangan/wms', {
                layers: 'sdb_balangan:bctest',
                format: 'image/png',
                transparent: true,
                attribution: "Survey Balangan Coal @ April 2019"
            })

            var satelite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}').addTo(mymap)

            var BaseMap = {
                "Foto Udara BC": Foto_Udara,
                "Citra Satelit Esri": satelite
            }

            // var sidebar = L.control.sidebar('sidebar')
            //     .addTo(mymap)

            // mymap.addControl(sidebar);

            function showData(arr, index) {
                var layer = L.geoJSON(arr[index]);
                layer.addTo(mymap)
            }

            var stringname = [];
            var loopCounter = 0;
            var counter = 2;
            var control_object = {};
            var dateid;

            window.onload = function() {
                dateid = this.mapobject.date[this.mapobject.date.length - counter]
                // var dateid = "2019-12-28"
                dateid = "2019-12"

                gjloaded = this.mapobject.geojsonloaded;
                this.mapobject.date.sort()

                texttanggal = document.getElementById("texttanggal")
                texttanggal.value = dateid;

                // layercontrol_basemap = L.control.layers(BaseMap).addTo(mymap)
                this.loadToMap(mapobject.geojsonloaded);
                // layerscontrol2 = L.control.layers(null, this.mapobject.basemapOverlayered).addTo(mymap);
            }

            function loadToMap(layerLoaded) {
                var leafletObject = [];
                for (key in layerLoaded) {
                    for (seckey in layerLoaded[key]) {
                        if (layerLoaded[key][seckey][0].length == 0) {

                        } else {
                            var group = [];
                            layerLoaded[key][seckey][0].forEach(el => {
                                if (el.properties.date == dateid || !(Object.keys(el.properties).includes('date'))) {
                                    var color;
                                    var r = Math.floor(Math.random() * 255);
                                    var g = Math.floor(Math.random() * 255);
                                    var b = Math.floor(Math.random() * 255);
                                    color = "rgb(" + r + " ," + g + "," + b + ")";
                                    var string = el.properties.company + el.properties.object;

                                    // console.log(el)
                                    // if (objectType == 'Pit' || objectType == 'PIT') {
                                    //     color = 'red'
                                    // }
                                    // console.log(objectType)
                                    // console.log(color)

                                    if (el.geometry.type == 'MultiPolygon') {
                                        console.log(el)
                                    }
                                    var leafletlayerObject = L.geoJSON(el).
                                    bindPopup(
                                        function() {
                                            var ol = document.createElement('div');

                                            Object.keys(el.properties).forEach(elo => {
                                                var node = document.createElement('p');
                                                node.innerHTML = elo + ' : ' + el.properties[elo];
                                                ol.appendChild(node);
                                            })
                                            return ol;
                                        }
                                    ).
                                    setStyle({
                                        color: color
                                    });

                                    group.push(leafletlayerObject);
                                }
                            });
                            this.stringname.push(key + " " + seckey);
                            leafletObject.push(group)
                        }
                    }
                }
                leafletObject.forEach((el, i) => {
                    // console.log(el)
                    var x = L.layerGroup(el)
                    this.mapobject.overlayMaps[this.stringname[i]] = x
                })
                layerscontrol = L.control.layers(BaseMap, this.mapobject.overlayMaps).addTo(mymap);
                leafletObject.length = 0;
            }

            function positiveCounter() {
                var hasLayer = [];
                layerscontrol._layerControlInputs.forEach(el => {
                    hasLayer.push(el.checked);
                });
                counter > 1 ? counter-- : counter = counter;

                dateid = mapobject.date[mapobject.date.length - counter];
                texttanggal = document.getElementById("texttanggal")
                texttanggal.value = dateid;

                var x = mapobject.overlayMaps;
                for (i in x) {
                    mymap.removeLayer(x[i]);
                }
                layerscontrol.remove();
                loadToMap(gjloaded);
                hasLayer.forEach((el, index) => {
                    layerscontrol._layerControlInputs[index].checked = el
                    Object.keys(mapobject.overlayMaps).forEach((ol, i) => {
                        if (index - 2 == i) {
                            if (el == true) {
                                mapobject.overlayMaps[ol].addTo(mymap);
                            }
                        }
                    })
                })
            }

            function negativeCounter() {
                var hasLayer = [];
                layerscontrol._layerControlInputs.forEach(el => {
                    hasLayer.push(el.checked);
                });
                counter < mapobject.date.length ? counter++ : counter = counter;
                var x = mapobject.overlayMaps;
                for (i in x) {
                    mymap.removeLayer(x[i]);
                }
                dateid = mapobject.date[mapobject.date.length - counter];
                texttanggal = document.getElementById("texttanggal")
                texttanggal.value = dateid;
                layerscontrol.remove();
                loadToMap(gjloaded);
                hasLayer.forEach((el, index) => {
                    layerscontrol._layerControlInputs[index].checked = el
                    Object.keys(mapobject.overlayMaps).forEach((ol, i) => {
                        if (index - 2 == i) {
                            if (el == true) {
                                mapobject.overlayMaps[ol].addTo(mymap);
                            }
                        }
                    })
                })
            }
        </script>
        <script src="static/leaflet/leaflet.js"></script>
        <script src="static/leaflet/Leaflet.Control.Custom.js"></script>
        <script src="static/leaflet/L.control.Sidebar.js"></script>
        <!-- <script src="/static/js/sanleaflet.js"></script> -->
        <script src="/static/js/sancustomcontrol.js"></script>

        <?php
        // $host        = "host = 192.168.34.10";
        // $port        = "port = 5432";
        // $dbname      = "dbname = database_balangan";
        // $credentials = "user = postgres password=postgresdb";

        // $conn = pg_connect( "$host $port $dbname $credentials"  );
        // if(!$conn) {
        //     echo "Error : Unable to open database\n";
        // } else {
        //     echo "Opened database successfully\n";
        // }


        // $result = pg_query($conn, "SELECT objectid, st_Asgeojson(shape) FROM settling_pond_all");
        // if (!$result) {
        //     echo "An error occurred.\n";
        //     exit;
        // }

        // while ($row = pg_fetch_row($result)) {
        //     echo "objectid : $row[0]  E-mail: $row[1]";
        //     echo "<br />\n";
        // }

        ?>
    </section>
</div>