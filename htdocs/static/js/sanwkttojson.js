function sanwkttojson(results) {

    this.type = results.type

    this.features = []

    results.features.forEach(feature => {

        var arr = {

            // "id": feature.id,

            "type": feature.type,

            "properties": feature.properties,

            "geometry": convert(feature.geometry),

        }

        this.features.push(arr)

    })



    // this.properties = this.features.properties



    // this.geometry = this.features.geometryt



    this.output = {

        "type": this.type,

        "name": "test_pertama",

        "crs": {

            "type": "name",

            "properties": {

                "name": "urn:ogc:def:crs:OGC:1.3:CRS84"
            }

        },

        "features": this.features,

    }



}


function convert(obj) {

    var srid = obj.split(';')[0]

    var coordinates = obj.split(';')[1]

    var geomobject = {

        type: "",

        coordinates: []

    }

    var type = coordinates.split(' (')[0]

    geomobject.type = type.charAt(0).toUpperCase() + type.substring(1).toLowerCase()



    switch (type) {



        case "POINT" || "Point":



            var dum = (obj.split('(')[1]).replace(')', "").split(', ');

            dum[0].split(' ').forEach(el => {

                geomobject.coordinates.push(parseFloat(el))

            });

            break;



        case "POINT Z":

            var dum = (obj.split('(')[1]).replace(')', "").split(', ');

            for (i = 0; i < 2; i++) {

                var y = dum[0].split(' ');

                geomobject.coordinates.push(parseFloat(y[i]))

            }

            geomobject.type = "Point";

            break;



        case "POINT ZM":



            break;



        case "POINT M":



            break;



        case "LINESTRING":



            var dum = (obj.split('(')[1]).replace(')', "").split(', ')



            dum.forEach(el => {

                geom = []



                el.split(' ').forEach(ol => {

                    geom.push(parseFloat(ol))

                })

                geomobject.coordinates.push(geom)

            })



            break;



        case "POLYGON":

            var dum = obj.split(' ((')[1].replace('))', '').split('), (')

            dum.forEach(dumdum => {

                var arr = [];

                var yea = dumdum.split(', ')

                yea.forEach(ol => {

                    hm = ol.split(' ')

                    hi = hm.map(x => parseFloat(x))

                    arr.push(hi)

                });



                geomobject.coordinates.push(arr)

            })



            break;



        case "MULTIPOINT":



            var geometry = (obj.split('(')[1]).replace(')', "").split(', ')



            for (let j = 0; j < geometry.length; j++) {



                if (geometry[j] != " ") {



                    geomobject.coordinates.push(geometry[j])



                }



            }



            break;



        case "MULTIPOLYGON":

            geomobject.type = "MultiPolygon"

            var olo = obj.split(';')
            var dum = olo[1].split(' ((')
            dum.shift()



            dum.forEach(dumdum => {

                var first_arr = []

                var arr = [];

                var yea = dumdum.split(', ')
                yea.forEach(ol => {

                    hm = ol.split(' ')
                        // '(123 456' '789 101'

                    if (isNaN(parseFloat(hm[0]))) {
                        // '(123' '456'

                        ho = hm[0].split('(')
                            // [['('] ['123']], [456]

                        ho.shift()

                        hd = [...ho, hm[1]]

                        hi = hd.map(x => parseFloat(x))

                        arr.push(hi)


                    } else {
                        //  '789' '101'
                        hi = hm.map(x => parseFloat(x))


                        arr.push(hi)

                    }

                });

                first_arr.push(arr)

                geomobject.coordinates.push(first_arr)

            })

            break;

        case "MULTILINESTRING":



            break;

    }



    return geomobject

}

function onEachFeature(feature, layer) {
    // does this feature have a property named popupContent?
    if (feature.properties && feature.properties.popupContent) {
        layer.bindPopup(feature.properties.popupContent);
    }
}



function convert2(obj) {

    testobj = obj;

    // var srid = obj.split(';')[0]

    var coordinates = obj.slice(7)

    var geomobject = {

        type: "",

        coordinates: []

    }

    var geojsonObject = {

        "type": "Feature",

        "properties": {},

        "geometry": geomobject
    }



    var type = obj.split('(')[0]

    switch (type) {



        case "POINT" || "Point":



            var dum = (obj.split('(')[1]).replace(')', "").split(', ');

            dum[0].split(' ').forEach(el => {

                geomobject.coordinates.push(parseFloat(el))

            });

            break;



        case "POINT Z":

            var dum = (obj.split('(')[1]).replace(')', "").split(', ');

            for (i = 0; i < 2; i++) {

                var y = dum[0].split(' ');

                geomobject.coordinates.push(parseFloat(y[i]))

            }

            geomobject.type = "Point";

            break;



        case "POINT ZM":



            break;



        case "POINT M":



            break;



        case "LINESTRING":



            var dum = (obj.split('(')[1]).replace(')', "").split(', ')



            dum.forEach(el => {

                geom = []



                el.split(' ').forEach(ol => {

                    geom.push(parseFloat(ol))

                })

                geomobject.coordinates.push(geom)

            })



            break;



        case "POLYGON":

            geomobject.type = 'Polygon'

            dum = coordinates.split('((')[1].replace('))', '').split(',')

            var arr = [];

            dum.forEach(dumdum => {

                var yea = dumdum.split(' ')

                arr.push(yea)

            })

            geomobject.coordinates.push(arr)

            break;



        case "MULTIPOINT":



            var geometry = (obj.split('(')[1]).replace(')', "").split(', ')



            for (let j = 0; j < geometry.length; j++) {



                if (geometry[j] != " ") {



                    geomobject.coordinates.push(geometry[j])



                }



            }



            break;



        case "MULTIPOLYGON":

            geomobject.type = 'MultiPolygon';

            multiPolyArr = [];

            var dum = obj.split('(');
            dum.shift();
            dum = dum.filter(checkNull);

            cleanArr = [];
            dum.forEach(dumdum => {
                cleanArr.push(dumdum.split(')')[0]);
            })
            cleanArr = cleanArr.filter(checkNull);

            cleanArr.map(x => x.split(','));

            cleanArr.forEach(el => {

                var polyArr = [];

                hm = el.split(',');

                hm.forEach(ol => {
                    var ho = ol.split(' ');

                    polyArr.push(ho);
                })

                multiPolyArr.push(polyArr);
            })

            geomobject.coordinates.push(multiPolyArr)

            break;

        case "MULTIPOLYGONZ":

            console.log('masuk')

            break;

        case "MULTILINESTRING":



            break;

    }



    return geojsonObject;

}

function checkNull(el) {
    return el != '';
}

function convertPhp(obj) {
    testobj = obj;


    var geomobject = {

        type: "",

        coordinates: []

    }

    var geojsonObject = {

        "type": "Feature",

        "properties": {},

        "geometry": geomobject
    }



    var type = obj.split('(')[0]

    console.log(type)

    switch (type) {



        case "POINT" || "Point":



            var dum = (obj.split('(')[1]).replace(')', "").split(', ');

            dum[0].split(' ').forEach(el => {

                geomobject.coordinates.push(parseFloat(el))

            });

            break;



        case "POINT Z":

            var dum = (obj.split('(')[1]).replace(')', "").split(', ');

            for (i = 0; i < 2; i++) {

                var y = dum[0].split(' ');

                geomobject.coordinates.push(parseFloat(y[i]))

            }

            geomobject.type = "Point";

            break;



        case "POINT ZM":



            break;



        case "POINT M":



            break;



        case "LINESTRING":



            var dum = (obj.split('(')[1]).replace(')', "").split(', ')



            dum.forEach(el => {

                geom = []



                el.split(' ').forEach(ol => {

                    geom.push(parseFloat(ol))

                })

                geomobject.coordinates.push(geom)

            })



            break;



        case "POLYGON":

            geomobject.type = 'Polygon'

            var dum = obj.split('(');

            dum.shift();

            dum = dum.filter(checkNull);

            dom = dum[dum.length - 1].split(')');

            dom = dom.filter(checkNull);

            dum = dom[0].split(', ')

            var arr = [];

            // console.log(dum)

            dum.forEach(dumdum => {

                yea = dumdum.split(' ');

                yea[0] = parseFloat(yea[0]);

                yea[1] = parseFloat(yea[1]);

                // yea.map(x => parseFloat(x));

                arr.push(yea);

            })

            geomobject.coordinates.push(arr);

            break;

        case "MULTIPOINT":

            var geometry = (obj.split('(')[1]).replace(')', "").split(', ')

            for (let j = 0; j < geometry.length; j++) {

                if (geometry[j] != " ") {

                    geomobject.coordinates.push(geometry[j])

                }

            }

            break;

        case "MULTIPOLYGON":

            geomobject.type = 'MultiPolygon';

            multiPolyArr = [];

            var dum = obj.split('(');

            dum.shift();

            dum = dum.filter(checkNull);

            cleanArr = [];

            dum.forEach(dumdum => {

                cleanArr.push(dumdum.split(')')[0]);

            })

            cleanArr = cleanArr.filter(checkNull);

            cleanArr.map(x => x.split(','));

            cleanArr.forEach(el => {

                var polyArr = [];

                hm = el.split(',');

                console.log(hm)

                hm.forEach((ol, index) => {

                    var ho = ol.split(' ');



                    if (index > 0) {
                        ho.shift()
                    }

                    console.log(ho);
                    // index > 1 ? ho.shift() : " ";
                    // ho.shift()

                    polyArr.push(ho);
                })

                multiPolyArr.push(polyArr);
            })

            // console.log(multiPolyArr);

            geomobject.coordinates.push(multiPolyArr)

            // console.log(cleanArr)


            // dum.forEach(dumdum => {

            //     var first_arr = []

            //     var arr = [];

            //     var yea = dumdum.split(', ')
            //     yea.forEach(ol => {

            //         hm = ol.split(' ')
            //             // '(123 456' '789 101'

            //         if (isNaN(parseFloat(hm[0]))) {
            //             // '(123' '456'

            //             ho = hm[0].split('(')
            //                 // [['('] ['123']], [456]

            //             ho.shift()

            //             hd = [...ho, hm[1]]

            //             hi = hd.map(x => parseFloat(x))

            //             arr.push(hi)


            //         } else {
            //             //  '789' '101'
            //             hi = hm.map(x => parseFloat(x))


            //             arr.push(hi)

            //         }

            //     });

            //     first_arr.push(arr)

            //     geomobject.coordinates.push(first_arr)

            // })

            break;

        case "MULTIPOLYGONZ":

            console.log('masukdong')

            geomobject.type = 'MultiPolygon';

            multiPolyArr = [];

            var dum = obj.split('(');

            dum.shift();

            dum = dum.filter(checkNull);

            // 115.60505645282 -2.3453767005192 0

            cleanArr = [];


            dum.forEach(dumdum => {
                cleanArr.push(dumdum.split(')')[0]);
            })

            cleanArr = cleanArr.filter(checkNull);

            cleanArr.map(x => x.split(','));

            cleanArr.forEach(el => {

                var polyArr = [];

                hm = el.split(',');

                hm.forEach(ol => {

                    var om = []

                    var ho = ol.split(' ');

                    hi = ho.filter(checkNull);

                    hi.pop();

                    hi[0] = parseFloat(hi[0])
                    hi[1] = parseFloat(hi[1])

                    polyArr.push(hi);
                })

                multiPolyArr.push(polyArr);
            })

            console.log(multiPolyArr);

            geomobject.coordinates.push(multiPolyArr)

            break;

        case "MULTILINESTRING":



            break;

    }


    testgeojson = geojsonObject;
    return geojsonObject;
}


function convert3(obj) {

    console.log(obj)

    console.log(typeof obj)
    var coordinates = obj.split(';')[1]

    var geomobject = {

        type: "",

        coordinates: []

    }

    var type = coordinates.split(' (')[0]

    geomobject.type = type.charAt(0).toUpperCase() + type.substring(1).toLowerCase()



    switch (type) {



        case "POINT" || "Point":



            var dum = (obj.split('(')[1]).replace(')', "").split(', ');

            dum[0].split(' ').forEach(el => {

                geomobject.coordinates.push(parseFloat(el))

            });

            break;



        case "POINT Z":

            var dum = (obj.split('(')[1]).replace(')', "").split(', ');

            for (i = 0; i < 2; i++) {

                var y = dum[0].split(' ');

                geomobject.coordinates.push(parseFloat(y[i]))

            }

            geomobject.type = "Point";

            break;



        case "POINT ZM":



            break;



        case "POINT M":



            break;



        case "LINESTRING":



            var dum = (obj.split('(')[1]).replace(')', "").split(', ')



            dum.forEach(el => {

                geom = []



                el.split(' ').forEach(ol => {

                    geom.push(parseFloat(ol))

                })

                geomobject.coordinates.push(geom)

            })



            break;



        case "POLYGON":

            var dum = obj.split(' ((')[1].replace('))', '').split('), (')

            dum.forEach(dumdum => {

                var arr = [];

                var yea = dumdum.split(', ')

                yea.forEach(ol => {

                    hm = ol.split(' ')

                    hi = hm.map(x => parseFloat(x))

                    arr.push(hi)

                });



                geomobject.coordinates.push(arr)

            })



            break;



        case "MULTIPOINT":



            var geometry = (obj.split('(')[1]).replace(')', "").split(', ')



            for (let j = 0; j < geometry.length; j++) {



                if (geometry[j] != " ") {



                    geomobject.coordinates.push(geometry[j])



                }



            }



            break;



        case "MULTIPOLYGON":

            geomobject.type = "MultiPolygon"

            var olo = obj.split(';')
            var dum = olo[1].split(' ((')
            dum.shift()



            dum.forEach(dumdum => {

                var first_arr = []

                var arr = [];

                var yea = dumdum.split(', ')
                yea.forEach(ol => {

                    hm = ol.split(' ')
                        // '(123 456' '789 101'

                    if (isNaN(parseFloat(hm[0]))) {
                        // '(123' '456'

                        ho = hm[0].split('(')
                            // [['('] ['123']], [456]

                        ho.shift()

                        hd = [...ho, hm[1]]

                        hi = hd.map(x => parseFloat(x))

                        arr.push(hi)


                    } else {
                        //  '789' '101'
                        hi = hm.map(x => parseFloat(x))


                        arr.push(hi)

                    }

                });

                first_arr.push(arr)

                geomobject.coordinates.push(first_arr)

            })

            break;

        case "MULTILINESTRING":



            break;

    }



    return geomobject

}