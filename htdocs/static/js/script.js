slider = document.getElementById('range')
dateol = document.getElementById('dateol')
target = document.getElementById('target')
target_scm = document.getElementById('target_scm')
checkPit = document.getElementById("checkpit");
textpit = document.getElementById("textpit");
checkDisposal = document.getElementById("checkdisposal");
textdisposal = document.getElementById("textdisposal");
date = document.getElementById('date')
unsoilling_dsplsa = document.getElementById('unsoilling_dsplsa')
fine_coal_field_dsplsa = document.getElementById('fine_coal_field_dsplsa')
area_dsplsa = document.getElementById('area_dsplsa')
unsoilling_dspscm = document.getElementById('unsoilling_dspscm')
fine_coal_field_dspscm = document.getElementById('fine_coal_field_dspscm')
area_dspscm = document.getElementById('area_dspscm')
area_pitlsa = document.getElementById('area_pitlsa')
area_pitscm = document.getElementById('area_pitscm')

mapol = document.getElementById('mapid')
mapol.style.height = window.innerHeight


var numOfFeat = slider.value

var mapobject, mapobject2, lsa, scm, disposal;

var obj_lsa = []
var obj_scm = []
var text = []
var text_scm = []
var features = []
var object = []
var filtered = [];

var pit_scm = []
var pit_lsa = []
var disposal_scm = []
var disposal_lsa = []
var obj_disposal_lsa = []
var obj_disposal_scm = []

window.onload = function all_ready() {

    // ajaxing to Webgis API
    rek_lsa = [];
    rek_scm = [];
    var REKLSA, REKSCM;
    var urlreklamasi = 'http://BCLPRDP030:8000/api/reklamasiAll/?format=json'
    var geojsonRek = new XMLHttpRequest()
    geojsonRek.open('GET', urlreklamasi, true)
    geojsonRek.responseType = 'json'
    console.log('entering geojsonrek')
    geojsonRek.onreadystatechange = function() {
        console.log(this.readyState)
        if (this.readyState == XMLHttpRequest.DONE) {
            console.log(geojsonRek.response)
            rek = geojsonRek.response
            rek = rek.results

            rek.features.forEach(el => {
                if (el.properties.company == 'lsa' && el.properties.jenis == 'reklamasi') {
                    rek_lsa.push(el)
                } else if (el.properties.company == 'scm' && el.properties.jenis == 'reklamasi') {
                    rek_scm.push(el)
                }
            })

            rek_lsa.forEach(el => {
                var x = convert(el.geometry)
                el.geometry = x
            })
            rek_scm.forEach(el => {
                var x = convert(el.geometry)
                el.geometry = x
            })

            /////////////////////////////
            REKLSA = rek_lsa[0]
            REKSCM = rek_scm[0]
                ///////////////////

            // tanggal = REKLSA.properties.date
            // tanggal = new Date(tanggal)
            // tanggal_string = 'Month ' + (tanggal.getMonth() + 1) + ' / Year ' + (tanggal.getYear() + 1900)

            // date.append(tanggal_string)

            // disposal lsa

            // unsoiltext = REKLSA.properties.unsoilling
            // unsoilling_dsplsa.append(unsoiltext)

            // fine_coal_field_dsplsatext = REKLSA.properties.fine_coal_field
            // fine_coal_field_dsplsa.innerHTML = fine_coal_field_dsplsatext

            // area_dsplsatext = DSPLSA.properties.area
            // area_dsplsa.innerHTML = area_dsplsatext

            /// disposal scm

            // unsoiltext_scm = DSPSCM.properties.unsoilling
            // unsoilling_dspscm.append(unsoiltext_scm)

            // fine_coal_field_dspscmtext = DSPSCM.properties.fine_coal_field
            // fine_coal_field_dspscm.innerHTML = fine_coal_field_dspscmtext

            // area_dspscmtext = DSPSCM.properties.area
            // area_dspscm.innerHTML = area_dspscmtext

            // mapREKLSA = L.geoJSON(REKLSA)
            // mapREKLSA.addTo(mymap).setStyle({
            //     color: 'blue'
            // });

            // obj_disposal_lsa.push(mapDSPLSA)

            // DSPSCM = disposal_scm[0]
            mapREKSCM = L.geoJSON(REKSCM)
            mapREKSCM.addTo(mymap).setStyle({
                color: 'green'
            });
            // obj_disposal_scm.push(mapDSPSCM)
            console.log('req sent')
        }
        // move(40)

    }

    geojsonRek.send()
}

var url = 'http://192.168.32.54:8000/api/disposal/?format=json'
var geojson = new XMLHttpRequest()

geojson.responseType = 'json'
geojson.onreadystatechange = function() {
    console.log(this.readyState)
    if (this.readyState == XMLHttpRequest.DONE) {

        disposal = geojson.response
        disposal = disposal.results

        disposal.features.forEach(el => {
            if (el.properties.disposal == 'LSA') {
                disposal_lsa.push(el)
            } else {
                disposal_scm.push(el)
            }
        })

        disposal_lsa.forEach(el => {
            var x = convert(el.geometry)
            el.geometry = x
        })
        disposal_scm.forEach(el => {
            var x = convert(el.geometry)
            el.geometry = x
        })

        ///////////////////////////////
        DSPLSA = disposal_lsa[0]
        DSPSCM = disposal_scm[0]
            ///////////////////

        tanggal = DSPLSA.properties.date
        tanggal = new Date(tanggal)
        tanggal_string = 'Month ' + (tanggal.getMonth() + 1) + ' / Year ' + (tanggal.getYear() + 1900)

        date.append(tanggal_string)

        // disposal lsa

        unsoiltext = DSPLSA.properties.unsoilling
        unsoilling_dsplsa.append(unsoiltext)

        fine_coal_field_dsplsatext = DSPLSA.properties.fine_coal_field
        fine_coal_field_dsplsa.innerHTML = fine_coal_field_dsplsatext

        area_dsplsatext = DSPLSA.properties.area
        area_dsplsa.innerHTML = area_dsplsatext

        /// disposal scm

        unsoiltext_scm = DSPSCM.properties.unsoilling
        unsoilling_dspscm.append(unsoiltext_scm)

        fine_coal_field_dspscmtext = DSPSCM.properties.fine_coal_field
        fine_coal_field_dspscm.innerHTML = fine_coal_field_dspscmtext

        area_dspscmtext = DSPSCM.properties.area
        area_dspscm.innerHTML = area_dspscmtext

        mapDSPLSA = L.geoJSON(DSPLSA)
        mapDSPLSA.addTo(mymap).setStyle({
            color: 'blue'
        });

        obj_disposal_lsa.push(mapDSPLSA)

        DSPSCM = disposal_scm[0]
        mapDSPSCM = L.geoJSON(DSPSCM)
        mapDSPSCM.addTo(mymap).setStyle({
            color: 'green'
        });
        obj_disposal_scm.push(mapDSPSCM)
    }
    move(40)
}

var url2 = "http://192.168.32.54:8000/api/pit/?format=json"
var pitajax = new XMLHttpRequest();
pitajax.responseType = 'json'

pitajax.onreadystatechange = function() {
    console.log(this.readyState)

    if (this.readyState == 4) {

        var obj = pitajax.response

        obj = obj.results

        obj.features.forEach(element => {
            // console.log(element)

            if (element.properties.pit == 'SCM') {
                pit_scm.push(element)
            } else {
                pit_lsa.push(element)
            }
        });

        pit_lsa.forEach(el => {
            var x = convert(el.geometry)
            el.geometry = x
        })
        pit_scm.forEach(el => {
            var x = convert(el.geometry)
            el.geometry = x
        })


        lsa = pit_lsa[0]
        scm = pit_scm[0]

        // pit lsa

        area_pitlsatext = lsa.properties.area
        area_pitlsa.innerHTML = area_pitlsatext

        // pit scm

        area_pitscmtext = scm.properties.area
        area_pitscm.innerHTML = area_pitscmtext

        /////

        mapobject_lsa = L.geoJSON(lsa)
        mapobject_lsa.addTo(mymap).setStyle({
            color: 'red'
        });

        mapobject_lsa.bindPopup(
            "<b>PIT : </b>" + lsa.properties.pit.toString() +
            "</br><b>Luas : </b>" + Math.round(lsa.properties.area) + "Ha" +
            "</br>"
        );
        obj_lsa.push(mapobject_lsa)


        mapobject_scm = L.geoJSON(scm)
        mapobject_scm.addTo(mymap)

        mapobject_scm.bindPopup(
            "<b>PIT : </b>" + scm.properties.pit.toString() +
            "</br><b>Luas : </b>" + Math.round(scm.properties.area) + "Ha" +
            "</br>"
        );

        obj_scm.push(mapobject_scm)


        slider.max = pit_lsa.length - 1

        console.log('pit ready')
        move(100)
    }
};



slider.oninput = function() {
    checkPit.checked = true
    checkDisposal.checked = true
    numOfFeat = this.value
    mymap.removeLayer(obj_lsa[0])
    mymap.removeLayer(obj_scm[0])
    mymap.removeLayer(obj_disposal_lsa[0])
    mymap.removeLayer(obj_disposal_scm[0])
    obj_lsa.shift()
    obj_scm.shift()
    obj_disposal_lsa.shift()
    obj_disposal_scm.shift()


    //working with map and layer
    // LSA
    // PIT
    lsa = pit_lsa[parseInt(numOfFeat)]

    mapobject_lsa = L.geoJSON(lsa)
    mapobject_lsa.addTo(mymap).setStyle({
        color: 'red'
    });

    mapobject_lsa.bindPopup(
        "<b>PIT : </b>" + lsa.properties.pit.toString() +
        "</br><b>Luas : </b>" + Math.round(lsa.properties.area) + "Ha" +
        "</br>"
    );
    obj_lsa.push(mapobject_lsa)


    // DISPOSAL

    DSPLSA = disposal_lsa[parseInt(numOfFeat)]
    mapDSPLSA = L.geoJSON(DSPLSA)
    mapDSPLSA.addTo(mymap).setStyle({
        color: 'blue'
    });

    obj_disposal_lsa.push(mapDSPLSA)


    // SCM
    // PIT

    scm = pit_scm[parseInt(numOfFeat)]
    mapobject_scm = L.geoJSON(scm)
    mapobject_scm.addTo(mymap)

    mapobject_scm.bindPopup(
        "<b>PIT : </b>" + scm.properties.pit.toString() +
        "</br><b>Luas : </b>" + Math.round(scm.properties.area) + "Ha" +
        "</br>"
    );

    obj_scm.push(mapobject_scm)

    // DISPOSAL

    DSPSCM = disposal_scm[parseInt(numOfFeat)]
    mapDSPSCM = L.geoJSON(DSPSCM)
    mapDSPSCM.addTo(mymap).setStyle({
        color: 'green'
    });

    obj_disposal_scm.push(mapDSPSCM)


    //working with text and properties

    // var properties = pit_lsa[parseInt(numOfFeat)].properties
    // var properties_scm = pit_scm[parseInt(numOfFeat)].properties

    date.innerHTML = ''
    tanggal = DSPLSA.properties.date
    tanggal = new Date(tanggal)
    tanggal_string = 'Month ' + (tanggal.getMonth() + 1) + ' / Year ' + (tanggal.getYear() + 1900)
    date.innerHTML = tanggal_string

    unsoiltext.innerHTML = ''
    unsoiltext = DSPLSA.properties.unsoilling
    unsoilling_dsplsa.innerHTML = unsoiltext

    fine_coal_field_dsplsa.innerHTML = ''
    fine_coal_field_dsplsatext = DSPLSA.properties.fine_coal_field
    fine_coal_field_dsplsa.innerHTML = fine_coal_field_dsplsatext

    area_dsplsa.innerHTML = ''
    area_dsplsatext = DSPLSA.properties.area
    area_dsplsa.innerHTML = area_dsplsatext

    // pit lsa

    area_pitlsa.innerHTML = ''
    area_pitlsatext = lsa.properties.area
    area_pitlsa.innerHTML = area_pitlsatext

    // pit scm

    area_pitscm.innerHTML = ''
    area_pitscmtext = scm.properties.area
    area_pitscm.innerHTML = area_pitscmtext

    /////

    var properties = DSPLSA.properties
    var properties_scm = DSPSCM.properties

}

function show(ol) {
    if (ol == 'pit') {
        if (checkPit.checked == true) {
            pitajax.open("GET", url2, true);
            pitajax.send();
            mapobject_lsa.addTo(mymap)
            mapobject_scm.addTo(mymap)

        } else {

            mymap.removeLayer(mapobject_lsa)
            mymap.removeLayer(mapobject_scm)
        }
    } else if (ol == 'disposal') {
        if (checkDisposal.checked == true) {
            geojson.open('GET', url, true)
            geojson.send()
            mapDSPLSA.addTo(mymap)
            mapDSPSCM.addTo(mymap)
        } else {

            mymap.removeLayer(mapDSPLSA)
            mymap.removeLayer(mapDSPSCM)
        }
    }
}

var lebar = 0;

var bar = document.getElementById("myBar");

function move(value) {

    setInterval(function() {
        if (value != 100) {

            if (lebar <= value) {

                bar.style.width = lebar + '%'

                lebar = (lebar + (value / 100))

                bar.innerHTML = 'Loading Data . . .'

            } else {
                clearInterval()
            }
        } else if (value == 100) {

            if (lebar <= value) {

                bar.style.width = lebar + '%'

                lebar = lebar + 1

                bar.innerHTML = 'Loading Data . . .'

            } else {
                bar.style.width = '100%'
                bar.innerHTML = 'Data Ready!'
                clearInterval()
                    // $(bar).fadeOut(3000);
            }
        }
    }, 10)

}

// var basemap = L.tileLayer('https://{s}.tiles.mapbox.com/v3/{key}/{z}/{x}/{y}.png', {
//     key: 'lrqdo.me2bng9n',
//     maxZoom: 18,
//     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
// }).addTo(mymap);


var testurl = 'http://192.168.32.54:8080/geoserver/sdb_balangan/wms?service=WMS&version=1.1.0&request=GetMap&layers=sdb_balangan%3Aapril22&bbox=115.46764131191296%2C-2.432005519655563%2C115.65329099299228%2C-2.2893922077052444&width=768&height=589&srs=EPSG%3A4326&format=application/openlayers'