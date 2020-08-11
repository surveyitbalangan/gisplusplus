<?

function curling($url){

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
<html>
test
<script src="<?php echo base_url() ?>static/js/sanwkttojson.js"></script>
<script>
    var pit = <?= curling($url1); ?>;

    var mapobject = {
        geojsonloaded: {},
        date: [],
        overlayMaps: {},
        basemap: {},
        basemapOverlayered: {}
    }

    loadData2(pit, "Pit");

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

        console.log(scmArr)

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

    console.log(pit);

    // function loadCurlData(object) {

    //     var features = object.results.features;

    //     features.forEach(el => {
    //         var geom = convert3(el.geometry);
    //         el.geometry = geom;
    //     })

    //     return object;
    // }

    // loadCurlData(pit);
</script>

</html>