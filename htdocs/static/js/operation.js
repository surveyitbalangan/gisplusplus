///////////////////////////////////////////////////////
// header plan //

headerPlanBC = [
    ['Month',
        'Inpit',
        '-',
        'Outpit',
        'Coal PTR',
        '-',
        'Coal RTK',
        'Coal Barging',
        'SR'
    ],
    ['Vol (BCM)',
        'Dist (m)',
        'Vol (BCM)',
        'Dist (m)',
        'Vol (BCM)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
        'Tonnage ( Ton )',
        'Tonnage ( Ton )'
    ]
];

headerPlanLSA = [
    ['Month',
        'Inpit South LSA',
        'Inpit North LSA',
        'Outpit',
        'Coal PTR South LSA',
        'Coal PTR North LSA',
        'Coal RTK',
        'Coal Barging',
        'SR'
    ],
    ['Vol (BCM)',
        'Dist (m)',
        'Vol (BCM)',
        'Dist (m)',
        'Vol (BCM)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
        'Tonnage ( Ton )',
        'Tonnage ( Ton )'
    ]
];

headerPlanSCM = [
    ['Month',
        'Inpit OB 1',
        'Inpit OB 2',
        'Outpit',
        'Coal PTR',
        '-',
        'Coal RTK',
        'Coal Barging',
        'SR'
    ],
    ['Vol (BCM)',
        'Dist (m)',
        'Vol (BCM)',
        'Dist (m)',
        'Vol (BCM)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
        'Tonnage ( Ton )',
        'Tonnage ( Ton )'
    ]
];

headerPlanPCS = [
    ['Month',
        'Inpit',
        '-',
        'Outpit',
        'Coal PTR',
        '-',
        'Coal RTK',
        'Coal Barging',
        'SR'
    ],
    ['Vol (BCM)',
        'Dist (m)',
        'Vol (BCM)',
        'Dist (m)',
        'Vol (BCM)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
        'Tonnage ( Ton )',
        'Tonnage ( Ton )'
    ]
];

///////////////////////////////////
//// header actual ////

headerActualSCM = [
    ['Month',
        'Inpit OB 1',
        'Inpit OB 2',
        'Outpit',
        'Coal PTR',
        'PIT-CPP',
        'PIT-72',
        'CPP-72',
        'Coal RTK',
        'Coal Barging',
        'SR'
    ],
    ['Vol (BCM)',
        'Dist (m)',
        'Vol (BCM)',
        'Dist (m)',
        'Vol (BCM)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
        'Tonnage ( Ton )',
        'Tonnage ( Ton )'
    ]
];

headerActualLSA = [
    ['Month',
        'Inpit South LSA',
        'Inpit North LSA',
        'Outpit',
        'Coal PTR',
        'PIT-CPP',
        'PIT-72',
        'CPP-72',
        'Coal RTK',
        'Coal Barging',
        'SR'
    ],
    ['Vol (BCM)',
        'Dist (m)',
        'Vol (BCM)',
        'Dist (m)',
        'Vol (BCM)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
        'Tonnage ( Ton )',
        'Tonnage ( Ton )'
    ]
];

headerActualBC = [
    ['Month',
        'Inpit',
        '',
        'Outpit',
        'Coal PTR',
        'PIT-CPP',
        'PIT-72',
        'CPP-72',
        'Coal RTK',
        'Coal Barging',
        'SR'
    ],
    ['Vol (BCM)',
        'Dist (m)',
        'Vol (BCM)',
        'Dist (m)',
        'Vol (BCM)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
        'Tonnage ( Ton )',
        'Tonnage ( Ton )'
    ]
];

/// Plan Agreed 

headerPlanAgreed = [
    ['Month',
        'Inpit',
        'Outpit',
        'Coal PTR',
        'SR'
    ],
    ['Vol (BCM)',
        'Dist (m)',
        'Vol (BCM)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
    ]
];
/// Plan Monthly SIS
headerPlanMonthlySis = [
    ['Month',
        'Inpit',
        'Outpit',
        'Coal PTR',
        'SR'
    ],
    ['Vol (BCM)',
        'Dist (m)',
        'Vol (BCM)',
        'Dist (m)',
        'Tonnage (Ton)',
        'Dist (m)',
    ]
];

///

months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

var features
var apiPlanRKAB = new XMLHttpRequest();
var url = 'http://BCLPRDP030:8000/api/planbudget/?format=json';
var url2 = 'http://BCLPRDP030:8000/api/actualProd/?format=json';
// var url = 'https://raw.githubusercontent.com/fabhiansan/json/master/baru.json';
// var url = 'static/js/djangodata.json';
apiPlanRKAB.open('GET', url, true);


apiPlanRKAB.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var obj = JSON.parse(apiPlanRKAB.response)
        features = obj.results

        var tablename = []
        features.forEach(el => {
            var dates = new Date(el.date).getMonth()
            month = months[dates]
            el['month'] = month.toString()

            if (tablename.includes(el.table)) {

            } else {
                tablename.push(el.table)
            }

        })

        planBudgetarr = []
        planRkabarr = []

        for (x in features) {

            if (features[x]['table'] == 'planRkab') {
                planRkabarr.push(features[x])
            } else if (features[x]['table'] == 'planBudget') {
                planBudgetarr.push(features[x])
            }

        }
        createTable(['lsa'], 'PlanRkab', planRkabarr, headerPlanLSA)
        createTable(['scm'], 'PlanRkab', planRkabarr, headerPlanSCM)
        createTable(['pcs'], 'PlanRkab', planRkabarr, headerPlanPCS)
        createTable(['lsa'], 'PlanBudget', planBudgetarr, headerPlanLSA)
        createTable(['scm'], 'PlanBudget', planBudgetarr, headerPlanSCM)

        createTable(['bc'], 'PlanBudget', createBCData(planBudgetarr, 'PlanBudget'), headerPlanBC)
        createTable(['bc'], 'PlanRkab', createBCData(planRkabarr, 'PlanRkab'), headerPlanBC)

    }


}

apiPlanRKAB.send()

var ajreq = new XMLHttpRequest();
ajreq.open('GET', url2, true);
ajreq.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        var obj = JSON.parse(ajreq.response)
        features = obj.results

        features.forEach(el => {
            var dates = new Date(el.date).getMonth()
            month = months[dates]
            el['month'] = month.toString()

        })

        createTableActual(['lsa'], 'Actual', features, headerActualLSA)
        createTableActual(['scm'], 'Actual', features, headerActualSCM)
        createTableActual(['bc'], 'Actual', createBCData(features, 'Actual'), headerActualBC)
    }
}

ajreq.send()

const capitalize = (s) => {
    if (typeof s !== 'string') return ''
    return s.charAt(0).toUpperCase() + s.slice(1)
}


bcobj = {}

companies = ['bc', 'lsa', 'scm']
companyRKAB = ['lsa', 'scm', 'pcs']

function createTable(companyarr, identifier, data, headerFormat) {

    objidentifier = {}

    months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    format_table = []


    Object.keys(data[0]).forEach(key => {

        if (key == 'company' || key == 'date' || key == 'objectid' || key == 'table' || key == 'month') {} else {
            format_table.push(key)
        }

    })

    format_table.push('sr')

    if (identifier == 'planAgreed' || identifier == 'planMonthlySis') {

        var ele = companyarr[0]

        var DOMid = ele + identifier

        createHeader(ele, DOMid, headerFormat)

        var table = document.getElementById(ele + DOMid)

        table.className = 'table table-sm table-bordered table-dark'

        dataarr = []

        data.forEach(month => {

            var bulan = new Date(month.date).getMonth()

            obj = {}
            obj['month'] = months[bulan]

            if (month.company == ele) {

                var node = document.createElement('tr')

                var childNode1 = document.createElement('td')

                childNode1.innerHTML = month.month.toString()

                node.appendChild(childNode1)

                format_table.forEach(el => {

                    if (el != 'sr') {

                        var childNode2 = document.createElement('td')

                        childNode2.innerHTML = month[el]

                        obj[el] = month[el]

                        node.appendChild(childNode2)

                    } else {

                        var childNode2 = document.createElement('td')

                        childNode2.className = 'sr'

                        childNode2.innerHTML = ((month.inpit_volume) / (month.coalptr_all_tonage)).toFixed(2)

                        node.appendChild(childNode2)

                        obj[el] = month[el]

                    }

                })

                dataarr.push(obj)
                table.appendChild(node)
            } else {
                // console.error('checking else');
            }

            objidentifier[ele] = dataarr
            bcobj[identifier + ele] = objidentifier

        })

        ////////////////////// total


        var node = document.createElement('tr')

        var childNode = document.createElement('td')

        childNode.innerHTML = 'Total'

        childNode.id = 'Total'

        node.appendChild(childNode)

        sum = {}

        sum['identifier'] = identifier

        data.forEach(datum => {

            if (datum.company == ele) {

                sum['company'] = ele
                format_table.forEach(format => {

                    if (typeof datum[format] == 'number' && format != 'sr') {

                        if (format in sum) {
                            sum[format] += parseInt(datum[format])
                        } else {
                            sum[format] = parseInt(datum[format])
                        }

                    } else if (format == 'sr') {

                        sum[format] = parseFloat(((sum['inpit_volume']) / (sum['coalptr_all_tonage'])).toFixed(2))

                    } else {
                        sum[format] = 0
                    }

                })

            }

        })

        Object.keys(sum).forEach(function(item) {

            if (typeof sum[item] == 'number' || typeof sum[item] == 'float') {
                var childNode2 = document.createElement('td')

                childNode2.innerHTML = sum[item]

                if (item == 'coalrtk_tonage' || item == 'coalbarging_tonage') {
                    childNode2.colSpan = '2'
                }

                node.appendChild(childNode2)
            } else if (sum[item] == '') {
                var childNode2 = document.createElement('td')

                childNode2.innerHTML = sum[item]

                if (item == 'coalrtk_tonage' || item == 'coalbarging_tonage' || item == '-') {
                    childNode2.colSpan = '2'
                }

                node.appendChild(childNode2)
            }

        });

        table.appendChild(node)

    } else {
        companyarr.forEach(ele => {

            var DOMid = ele + identifier

            createHeader(ele, DOMid, headerFormat)

            var table = document.getElementById(ele + DOMid)

            table.className = 'table table-sm table-bordered table-dark'

            dataarr = []

            data.forEach(month => {


                var bulan = new Date(month.date).getMonth()

                obj = {}
                obj['month'] = months[bulan]

                if (month.company == ele) {

                    var node = document.createElement('tr')

                    var childNode1 = document.createElement('td')

                    childNode1.innerHTML = month.month.toString()

                    node.appendChild(childNode1)

                    format_table.forEach(el => {

                        if (el == 'coalrtk_tonage' || el == 'coalbarging_tonage') {

                            var childNode2 = document.createElement('td')

                            childNode2.colSpan = '2'

                            childNode2.innerHTML = month[el]

                            obj[el] = month[el]

                            node.appendChild(childNode2)

                        } else if (el == 'sr' && (identifier == 'PlanBudget' || identifier == 'PlanRkab')) {

                            var childNode2 = document.createElement('td')

                            childNode2.className = 'sr'

                            childNode2.innerHTML = ((month.inpit_volumea + month.inpit_volume_b) / (month.coalptr_tonage_a + month.coalptr_tonage_b)).toFixed(2)

                            node.appendChild(childNode2)

                            obj[el] = month[el]

                        } else if (el != 'coalrtk_tonage' && el != 'sr') {

                            var childNode2 = document.createElement('td')

                            childNode2.innerHTML = month[el]

                            node.appendChild(childNode2)

                            obj[el] = month[el]

                        }

                    })

                    dataarr.push(obj)
                    table.appendChild(node)
                } else {
                    // console.error('checking else');
                }

                objidentifier[ele] = dataarr
                bcobj[identifier + ele] = objidentifier

            })


            ////////////////////// total


            var node = document.createElement('tr')

            var childNode = document.createElement('td')

            childNode.innerHTML = 'Total'

            childNode.id = 'Total'

            node.appendChild(childNode)

            sum = {}

            sum['identifier'] = identifier

            data.forEach(datum => {

                if (datum.company == ele) {

                    sum['company'] = ele

                    format_table.forEach(format => {

                        if (typeof datum[format] == 'number' && format != 'sr') {

                            if (format in sum) {
                                sum[format] += parseInt(datum[format])
                            } else {
                                sum[format] = parseInt(datum[format])
                            }

                        } else if (format == 'sr') {

                            if (typeof datum['coalptr_tonage_b'] == 'object') {
                                datum['coalptr_tonage_b'] = 0
                            } else if (typeof datum['inpit_volume_b'] != 'number') {
                                datum['inpit_volume_b'] = 0
                            }
                            if (typeof datum['coalptr_tonage_b'] != 'number') {
                                datum['coalptr_tonage_b'] = 0
                            }

                            sum[format] = parseFloat(((sum['inpit_volumea'] + sum['inpit_volume_b']) / (sum['coalptr_tonage_a'] + sum['coalptr_tonage_b'])).toFixed(2))

                        } else {
                            sum[format] = 0
                        }

                    })

                }

            })

            Object.keys(sum).forEach(function(item) {

                if (typeof sum[item] == 'number' || typeof sum[item] == 'float') {
                    var childNode2 = document.createElement('td')

                    childNode2.innerHTML = sum[item]

                    if (item == 'coalrtk_tonage' || item == 'coalbarging_tonage') {
                        childNode2.colSpan = '2'
                    }

                    node.appendChild(childNode2)
                } else if (sum[item] == '') {
                    var childNode2 = document.createElement('td')

                    childNode2.innerHTML = sum[item]

                    if (item == 'coalrtk_tonage' || item == 'coalbarging_tonage' || item == '-') {
                        childNode2.colSpan = '2'
                    }

                    node.appendChild(childNode2)
                }

            });

            table.appendChild(node)

        })
    }



}

function createHeader(companyName, domId, arr) {

    var div = document.getElementById(domId)

    var company = document.createElement('h3')

    company.innerHTML = companyName.toUpperCase()

    div.appendChild(company)

    var table = document.createElement('table')

    table.id = companyName + domId

    var thead = document.createElement('thead')

    arr.forEach((elarr, index) => {

        var tr = document.createElement('tr')

        elarr.forEach(el => {

            var td = document.createElement('td')

            td.innerHTML = el

            if (el == 'Month' || el == 'SR') {
                td.className = 'align-middle'
                td.rowSpan = '2'
            } else if (el == 'Tonnage ( Ton )') {
                td.colSpan = '2';
            } else {
                if (index == 0) {
                    td.colSpan = '2';
                } else {
                    td.colSpan = '1'
                }
            }

            tr.appendChild(td)
            thead.appendChild(tr)

        })

        table.appendChild(thead)

    })


    div.appendChild(table)

}

function changeTab(evt, tabname) {
    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(tabname).style.display = "block";
    evt.currentTarget.className += " active";
}

function changePage(evt, pageName) {

    // Declare all variables
    var i, pagecontent, pagelinks;

    // Get all elements with class="tabcontent" and hide them
    pagecontent = document.getElementsByClassName("pagecontent");
    for (i = 0; i < pagecontent.length; i++) {
        pagecontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    pagelinks = document.getElementsByClassName("pagelinks");
    for (i = 0; i < pagelinks.length; i++) {
        pagelinks[i].className = pagelinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(pageName).style.display = "block";
    evt.currentTarget.className += " active";
}

var createBCTable = (obj) => {
    // creating result obj
    var resultobj = {}

    //desired output
    resultobj = {
        planbudgetlsa: {

        }
    }

    //loop trough bcobj
    Object.keys(obj).forEach(item => {
        // resultobj[item] = item

        //loop trough everytable
        Object.keys(obj[item]).forEach(el => {

            resultobj[item] = item



            // loop trough every month
            for (let i = 0; i < obj[item][el].length; i++) {

                var data = obj[item][el][i]

            }


        })

    })
}

function createTableActual(companyarr, identifier, data, headerFormat) {

    objidentifier = {}

    months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    format_table = [
        'inpit_volumea',
        'inpit_distance_a',
        'inpit_volume_b',
        'inpit_distance_b',
        'outpit_volume',
        'outpit_distance',
        'coalptr_all_tonage',
        'coalptr_all_distance',
        'coalptr_tonage_a',
        'coalptr_distance_a',
        'coalptr_tonage_b',
        'coalptr_distance_b',
        'coalptr_tonage_c',
        'coalptr_distance_c',
        'coalrtk_tonage',
        'coalbarging_tonage',
        'sr'
    ];


    companyarr.forEach(ele => {

        var DOMid = ele + identifier

        createHeader(ele, DOMid, headerFormat)

        var table = document.getElementById(ele + DOMid)

        table.className = 'table table-sm table-bordered table-dark'

        dataarr = []

        data.forEach(month => {


            var bulan = new Date(month.date).getMonth()

            obj = {}
            obj['month'] = months[bulan]

            if (month.company == ele) {

                var node = document.createElement('tr')

                var childNode1 = document.createElement('td')

                childNode1.innerHTML = month.month.toString()

                node.appendChild(childNode1)

                format_table.forEach(el => {

                    if (el == 'coalrtk_tonage' || el == 'coalbarging_tonage') {

                        var childNode2 = document.createElement('td')

                        childNode2.colSpan = '2'

                        childNode2.innerHTML = month[el]

                        obj[el] = month[el]

                        node.appendChild(childNode2)

                    } else if (el == 'sr') {

                        var childNode2 = document.createElement('td')

                        childNode2.className = 'sr'

                        var sr = ((month.inpit_volumea + month.inpit_volume_b) / (month.coalptr_tonage_a + month.coalptr_tonage_b + month.coalptr_tonage_c)).toFixed(2)


                        childNode2.innerHTML = sr

                        node.appendChild(childNode2)

                        obj[el] = sr

                    } else if (el == 'coalptr_all_tonage' || el == 'coalptr_all_distance') {

                        if (el == 'coalptr_all_tonage') {

                            var childNode2 = document.createElement('td')

                            childNode2.className = 'coalptr_all_tonage'

                            var coalptr_ton = (month.coalptr_tonage_a + month.coalptr_tonage_b + month.coalptr_tonage_c).toFixed(2)

                            childNode2.innerHTML = coalptr_ton

                            node.appendChild(childNode2)

                            obj[el] = parseFloat(coalptr_ton)

                        } else {

                            var childNode2 = document.createElement('td')

                            childNode2.className = 'coalptr_all_distance'

                            var coalptr_dist = (month.coalptr_distance_a + month.coalptr_distance_b + month.coalptr_distance_c).toFixed(2)

                            childNode2.innerHTML = coalptr_dist

                            node.appendChild(childNode2)

                            obj[el] = parseFloat(coalptr_dist)

                        }



                    } else {

                        var childNode2 = document.createElement('td')

                        childNode2.innerHTML = month[el]

                        node.appendChild(childNode2)

                        obj[el] = month[el]

                    }

                })

                dataarr.push(obj)
                table.appendChild(node)
            } else {
                // console.error('checking else');

            }

            objidentifier[ele] = dataarr
            bcobj[identifier + ele] = objidentifier

        })


        ////////////////////// total


        var node = document.createElement('tr')

        var childNode = document.createElement('td')

        childNode.innerHTML = 'Total'

        childNode.id = 'Total'

        node.appendChild(childNode)

        sum = {}

        sum['identifier'] = identifier

        data.forEach(datum => {

            if (datum.company == ele) {

                sum['company'] = ele

                format_table.forEach(format => {

                    if (typeof datum[format] == 'number' && (format != 'sr' && format != 'coalptr_all_tonage' && format != 'coalptr_all_distance')) {

                        if (format in sum) {

                            sum[format] += parseInt(datum[format])

                        } else {

                            sum[format] = parseInt(datum[format])

                        }

                    } else if (format == 'coalptr_all_tonage' || format == 'coalptr_all_distance') {

                        if (format == 'coalptr_all_tonage') {

                            if (format in sum) {

                                sum[format] += parseInt(datum['coalptr_tonage_a'] + datum['coalptr_tonage_b'] + datum['coalptr_tonage_c'])

                            } else {

                                sum[format] = datum['coalptr_tonage_a'] + datum['coalptr_tonage_b'] + datum['coalptr_tonage_c']

                            }
                        } else {

                            if (format in sum) {

                                sum[format] += parseInt(datum['coalptr_distance_a'] + datum['coalptr_distance_b'] + datum['coalptr_distance_c'])

                            } else {

                                sum[format] = datum['coalptr_distance_a'] + datum['coalptr_distance_b'] + datum['coalptr_distance_c']

                            }
                        }

                    } else if (format == 'sr') {

                        if (typeof datum['coalptr_tonage_b'] == 'object') {

                            datum['coalptr_tonage_b'] = 0

                        } else if (typeof datum['inpit_volume_b'] != 'number') {

                            datum['inpit_volume_b'] = 0

                        }

                        if (typeof datum['coalptr_tonage_b'] != 'number') {

                            datum['coalptr_tonage_b'] = 0

                        }

                        sum[format] = parseFloat((((sum['inpit_volumea'] + sum['inpit_volume_b']) / (sum['coalptr_all_tonage']))).toFixed(2))

                    } else {
                        sum[format] = ''
                    }

                })

            }

        })
        Object.keys(sum).forEach(function(item) {

            if (typeof sum[item] == 'number' || typeof sum[item] == 'float') {
                var childNode2 = document.createElement('td')

                childNode2.innerHTML = sum[item]

                if (item == 'coalrtk_tonage' || item == 'coalbarging_tonage') {
                    childNode2.colSpan = '2'
                }

                node.appendChild(childNode2)

            } else if (sum[item] == '') {
                var childNode2 = document.createElement('td')

                childNode2.innerHTML = sum[item]

                if (item == 'coalrtk_tonage' || item == 'coalbarging_tonage' || item == '-') {
                    childNode2.colSpan = '2'
                }

                node.appendChild(childNode2)
            }

        });

        table.appendChild(node)

    })

}


const createBCData = (arr, tablename) => {

    months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    if (tablename == 'Actual') {

        bcarr = []

        months.forEach(month => {

            arr.forEach(el => {

                bcobj = {}

                if (el['month'] == month) {

                    if (bcarr.length == 0) {
                        bcobj = el

                        bcobj['company'] = 'bc'

                        bcarr.push(bcobj)

                    } else {
                        bcarr.forEach(ol => {

                            if (ol['month'] == el['month']) {

                                Object.keys(ol).forEach(key => {

                                    ol[key] += el[key]

                                    if (key == 'inpit_volume_b') {
                                        ol['inpit_volume_a'] += el[key]
                                    }

                                    ol['company'] = 'bc'
                                    ol['month'] = month
                                    ol['date'] = ''
                                })

                            } else {

                                bcobj = el
                                bcobj['company'] = 'bc'

                                bcarr.push(bcobj)

                            }
                        })
                    }
                }

            })

        })

        bcarr.forEach(el => {
            el['inpit_volumea'] = el['inpit_volumea'] + el['inpit_volume_b']
            el['inpit_volume_b'] = ''
            el['inpit_distance_a'] = el['inpit_distance_a'] + el['inpit_distance_b']
            el['inpit_distance_b'] = ''
        })
        return bcarr

    } else if (tablename == 'PlanBudget' || tablename == 'PlanRkab') {

        bcarr = []

        months.forEach(month => {

            arr.forEach(el => {

                bcobj = {}

                if (el['month'] == month) {

                    bcobj = el
                    bcobj['company'] = 'bc'
                    bcarr.push(bcobj)

                }
            })
        })

        bcarr2 = []
        bcarr.forEach(el => {
            el['inpit_volumea'] = el['inpit_volumea'] + el['inpit_volume_b']
            el['inpit_volume_b'] = ''
            el['inpit_distance_a'] = el['inpit_distance_a'] + el['inpit_distance_b']
            el['inpit_distance_b'] = ''
        })

        monthpopulation = []

        for (datum in bcarr) {
            if (monthpopulation.length == 0) {
                monthpopulation.push(bcarr[datum]['month'])
            } else {
                if (monthpopulation.includes(bcarr[datum]['month'])) {

                } else {
                    monthpopulation.push(bcarr[datum]['month'])
                }
            }
        }

        monthpopulation.forEach(month => {

            bcarr.forEach(bcdata => {

                if (bcdata['month'] == month) {

                    if (!bcarr2.some(datum => datum.month == month)) {
                        bcarr2.push(bcdata)
                    } else {

                        // get posisition of spesific month
                        var pos = bcarr2.map(e => { return e.month }).indexOf(month)

                        Object.keys(bcarr2[pos]).forEach(key => {
                            bcarr2[pos][key] += bcdata[key]
                            bcarr2[pos]['company'] = 'bc'
                            bcarr2[pos]['month'] = bcdata['month']

                        })
                    }

                }

            })

        })
        return bcarr2
    } else if (tablename == 'planAgreed' || tablename == 'planMonthlySis') {
        bcarr = []

        months.forEach(month => {

            arr.forEach(el => {

                bcobj = {}

                if (el['month'] == month) {

                    bcobj = el
                    bcobj['company'] = 'bc'
                    bcobj['month'] = month
                    bcarr.push(bcobj)

                }
            })
        })

        bcarr2 = []

        monthpopulation = []

        for (datum in bcarr) {
            if (monthpopulation.length == 0) {
                monthpopulation.push(bcarr[datum]['month'])
            } else {
                if (monthpopulation.includes(bcarr[datum]['month'])) {

                } else {
                    monthpopulation.push(bcarr[datum]['month'])
                }
            }
        }

        monthpopulation.forEach(month => {

            bcarr.forEach(bcdata => {

                if (bcdata['month'] == month) {

                    if (!bcarr2.some(datum => datum.month == month)) {
                        bcarr2.push(bcdata)
                    } else {

                        // get posisition of spesific month
                        var pos = bcarr2.map(e => { return e.month }).indexOf(month)

                        Object.keys(bcarr2[pos]).forEach(key => {
                            bcarr2[pos][key] += bcdata[key]
                            bcarr2[pos]['company'] = 'bc'
                            bcarr2[pos]['month'] = bcdata['month']

                        })
                    }

                }

            })

        })
        return bcarr2
    } else {
        console.log('no data')
    }

    return bcarr
}

url3 = 'http://BCLPRDP030:8000/api/planAgreed/?format=json'

var planAgreedReq = new XMLHttpRequest();
planAgreedReq.open('GET', url3, true);
planAgreedReq.onreadystatechange = function() {

    if (this.readyState == 4 && this.status == 200) {
        var obj = JSON.parse(planAgreedReq.response)
        var featureAgreed = obj.results

        featureAgreed.forEach(el => {
            var dates = new Date(el.date).getMonth()
            month = months[dates]
            el['month'] = month.toString()

        })

        createTable(['lsa'], 'planAgreed', featureAgreed, headerPlanAgreed)
        createTable(['scm'], 'planAgreed', featureAgreed, headerPlanAgreed)
        createTable(['bc'], 'planAgreed', createBCData(featureAgreed, 'planAgreed'), headerPlanAgreed)


    }
}

planAgreedReq.send()

url4 = 'http://BCLPRDP030:8000/api/planMonthlySis/?format=json'

var planMonthlySisreq = new XMLHttpRequest();
planMonthlySisreq.open('GET', url4, true);
planMonthlySisreq.onreadystatechange = function() {

    if (this.readyState == 4 && this.status == 200) {
        var obj = JSON.parse(planMonthlySisreq.response)
        var featureAgreed = obj.results

        featureAgreed.forEach(el => {
            var dates = new Date(el.date).getMonth()
            month = months[dates]
            el['month'] = month.toString()

        })

        createTable(['lsa'], 'planMonthlySis', featureAgreed, headerPlanAgreed)
        createTable(['scm'], 'planMonthlySis', featureAgreed, headerPlanAgreed)
        createTable(['bc'], 'planMonthlySis', createBCData(featureAgreed, 'planMonthlySis'), headerPlanAgreed)


    }
}

planMonthlySisreq.send()