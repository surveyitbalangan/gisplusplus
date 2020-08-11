
    <div id='status'>
        NOT READY
    </div>
    <script>
        // Initiating Global Array

        var features = []
        var object = []
        var filtered = [];
        statusol = document.getElementById('status')
        var feature_scm = []
        var feature_lsa = []
            // ajaxing to Webgis API

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            console.log(this.readyState)

            if (this.readyState == 4 && this.status == 200) {

                var slider = document.getElementById('range')
                    // json-ing response
                var obj = JSON.parse(xhttp.response)
                    // save the results at res
                res = obj.results
                    // pushing the feature results to global features array
                features.push(res)

                // takes the features geometry properties to global object array
                input = features[0].features
                    // console.log(geometry)

                input.forEach(element => {
                    // console.log(element)

                    if (element.properties.disposal == 'SCM') {
                        feature_scm.push(element)
                    } else {
                        feature_lsa.push(element)
                    }
                });
                feature_lsa.forEach(el => {
                    var x = convert(el.geometry)
                    el.geometry = x
                })
                feature_scm.forEach(el => {
                    var x = convert(el.geometry)
                    el.geometry = x
                })

                slider.max = feature_lsa.length - 1
                statusol.innerHTML = 'READY'
            }
        };

        xhttp.open("GET", "http://192.168.32.54:8000/api/disposal/?page=1", true);
        xhttp.send();
    </script>
    <div class='container'>
        <div id="mapid"></div>
        <script>
            // init map
            var mymap = L.map('mapid').setView([-2.330108415230943, 115.6010420499895], 13);

            var basemap = L.tileLayer('https://{s}.tiles.mapbox.com/v3/{key}/{z}/{x}/{y}.png', {
                key: 'lrqdo.me2bng9n',
                maxZoom: 18,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            }).addTo(mymap);


            // working with Well Known Text Data
        </script>

    </div>
    <div id='slidecontainer'>
        <input type="range" value='0' min='0' id='range' step='1' class='slider'>
        <!-- <input type="range" value='0' min='1' id='range2' step='1'> -->
    </div>

    <div id='target'>

    </div>
    <div id='target_scm'>

    </div>

    <script>
        slider = document.getElementById('range')

        target = document.getElementById('target')
        target_scm = document.getElementById('target_scm')

        var numOfFeat = slider.value

        var mapobject, mapobject2;

        var obj_lsa = []
        var obj_scm = []
        var text = []
        var text_scm = []


        slider.oninput = function() {
            numOfFeat = this.value
            mapobject_lsa = L.geoJSON(feature_lsa[parseInt(numOfFeat)])
            mapobject_lsa.addTo(mymap).setStyle({
                color: 'red'
            });
            obj_lsa.push(mapobject_lsa)

            mapobject_scm = L.geoJSON(feature_scm[parseInt(numOfFeat)])
            mapobject_scm.addTo(mymap)

            obj_scm.push(mapobject_scm)

            if (obj_lsa.length > 1) {
                mymap.removeLayer(obj_lsa[0])
                mymap.removeLayer(obj_scm[0])
                obj_lsa.shift()
                obj_scm.shift()
            }

            var properties = feature_lsa[parseInt(numOfFeat)].properties
            var properties_scm = feature_scm[parseInt(numOfFeat)].properties

            if (text.length > 0) {
                text.shift()
                text.push(properties)

                text_scm.shift()
                text_scm.push(properties_scm)

                var children = target.children
                var children_scm = target_scm.children

                target.removeChild(children[0])
                target_scm.removeChild(children_scm[0])

                var par = document.createElement('p')
                par.append('date: ' + text[0].date + '</br>')
                par.append('disposal ' + text[0].disposal + '</br>')
                par.append('area ' + text[0].area + '</br>')

                target.appendChild(par)

                var par_scm = document.createElement('p')
                par_scm.append('date: ' + text_scm[0].date + '</br>')
                par_scm.append('disposal ' + text_scm[0].disposal + '</br>')
                par_scm.append('area ' + text_scm[0].area + '</br>')

                target_scm.appendChild(par_scm)


            } else if (text.length == 0) {
                text.push(properties)
                text_scm.push(properties_scm)

                var par = document.createElement('p')
                par.append('date: ' + text[0].date + '</br>')
                par.append('disposal ' + text[0].disposal + '</br>')
                par.append('area ' + text[0].area + '</br>')
                target.appendChild(par)

                var par_scm = document.createElement('p')
                par_scm.append('date: ' + text_scm[0].date + '</br>')
                par_scm.append('disposal ' + text_scm[0].disposal + '</br>')
                par_scm.append('area ' + text_scm[0].area + '</br>')

                target_scm.appendChild(par_scm)
            }
        }


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