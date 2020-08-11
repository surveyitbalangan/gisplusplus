var mapobject = {
    geojsonloaded: {},
    date: [],
    overlayMaps: {},
    basemap: {},
    basemapOverlayered: {}
}

function loaddata(url, objectType) {

    var lsaArr = [];
    var scmArr = [];
    var pcsArr = [];
    var bothArr = [];
    var ajax = new XMLHttpRequest();
    ajax.responseType = 'json';
    ajax.onreadystatechange = function() {
        if (this.readyState == XMLHttpRequest.DONE) {
            // geojson object >>>>> gjobj
            gjobj = ajax.response
            gjobj = gjobj.results
            gjobj.features.forEach(el => {
                if (Object.keys(el.properties).includes("company")) {
                    var geom = convert(el.geometry);
                    el.geometry = geom;
                    el.properties["object"] = objectType;
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
        }
    };
    ajax.open('GET', url, true);
    ajax.send();

    // pushing geojson to globalobject
    mapobject.geojsonloaded[objectType] = {
        lsa: [],
        scm: [],
        pcs: [],
        both: []
    }

    mapobject.geojsonloaded[objectType].lsa.push(lsaArr);
    mapobject.geojsonloaded[objectType].scm.push(scmArr);
    mapobject.geojsonloaded[objectType].pcs.push(pcsArr);
    mapobject.geojsonloaded[objectType].both.push(bothArr);

    // // emptying array
    lsaArr.length = 0;
    scmArr.length = 0;
    pcsArr.length = 0;
    bothArr.length = 0;
}

// piturl = "http://BCLPRDP030:8000/api/pit/?format=json";
// loaddata(piturl, "Pit");

// disposalurl = "http://BCLPRDP030:8000/api/disposal/?format=json";
// loaddata(disposalurl, "Disposal");

// reklamasiUrl = "http://BCLPRDP030:8000/api/reklamasiAll/?format=json";
// loaddata(reklamasiUrl, "Reklamasi");

// dsp_soil = "http://BCLPRDP030:8000/api/disposalsoil/?format=json";
// loaddata(dsp_soil, "Disposal Soil");

// settlingpond_url = "http://BCLPRDP030:8000/api/settlingpond/?format=json";
// loaddata(settlingpond_url, "Settling Pond");

// bukaanlahanurl = "http://BCLPRDP030:8000/api/bukaanLahan/?format=json";
// loaddata(bukaanlahanurl, "Bukaan Lahan");

// fasilitasPenunjangUrl = "http://BCLPRDP030:8000/api/fasilitapenunjang/?format=json";
// loaddata(fasilitasPenunjangUrl, "Fasilitas Penunjang");

// catchment = "http://BCLPRDP030:8000/api/catchment/?format=json";
// loadBaseMap(catchment, "Catchment");

pemukimanUrl = "http://BCLPRDP030:8000/api/pemukiman/?format=json";
loadBaseMap(pemukimanUrl, "Pemukiman");

toponimiUrl = "http://BCLPRDP030:8000/api/toponimi/?format=json";
loadBaseMap(toponimiUrl, "Toponimi");

function loadBaseMap(baseurl, objectType) {
    baseMapArr = [];
    var baseAjax = new XMLHttpRequest();
    baseAjax.responseType = 'json';
    baseAjax.onreadystatechange = function() {
        if (this.readyState == XMLHttpRequest.DONE) {
            gjobj = baseAjax.response;
            gjobj = gjobj.results;
            var objectGroup = []
            gjobj.features.forEach(el => {
                var color;
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                color = "rgb(" + r + " ," + g + "," + b + ")";

                var geom = convert(el.geometry);
                el.geometry = geom;
                el.properties['object'] = objectType;

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
                setStyle({ color: color });
                objectGroup.push(leafletlayerObject);
            })
            baseMapArr.push(objectGroup);
            // console.log(baseMapArr)
            mapobject.basemapOverlayered[objectType] = L.layerGroup(objectGroup);
        }
    }
    baseAjax.open('GET', baseurl, true);
    baseAjax.send();

    // console.log(baseMapArr)
    // this.mapobject.basemapOverlayered[objectType] = L.layerGroup(baseMapArr);
}

function baseMapToMap() {
    console.log(mapobject.basemapOverlayered)
    layerscontrol2 = L.control.layers(null, this.mapobject.basemapOverlayered).addTo(mymap);
}

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
    layerscontrol2 = L.control.layers(null, this.mapobject.basemapOverlayered).addTo(mymap);
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
                        setStyle({ color: color });

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