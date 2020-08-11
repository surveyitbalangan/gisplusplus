<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script type='text/javascript' src="static/js/jquery-3.4.1.js"></script>
    <link rel="stylesheet" type="text/css" href="static/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="static/css/landingpage.css">
    <script type='text/javascript' src="static/js/bootstrap.js"></script>
    <script type='text/javascript' src="static/js/operation.js"></script>
    <link rel="stylesheet" href="static/leaflet/leaflet.css">
    <script src="static/leaflet/leaflet.js"></script>
    <script src="static/js/sanwkttojson.js"></script>


    <style>

    </style>
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
            <div id='wrapper' class='row'>
                <nav id="sidebar" class='col-2 bg-dark text-light' style="background-color: #344; ">
                    <ul class="list-unstyled components">
                        <li class="row">
                            <div class="col-2">
                                <a href="javascript:void(0)" class="closebtn ml-auto" onclick="closeNav()" id='closerbutton'>&times;</a>
                            </div>
                            <div class="col-2 ml-auto">
                                <div id="main">
                                    <a class="openbtn" href="javascript:void(0)" onclick="openNav()">&#9776;</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <div class='my-auto' id='myauto'>
                        <ul class="list-unstyled components">
                            <li class="active">
                                <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle btn btn-dark w-100">Engineering</a>
                                <ul class="collapse list-unstyled mr-auto" id="homeSubmenu">
                                    <li class='btn btn-dark w-100'>
                                        <a class="pagelinks" onclick="changePage(event, 'webgis')" href="/pit">Webgis</a>
                                    </li>
                                    <li class='btn btn-dark w-100'>
                                        <a id='defaultOpen' class="pagelinks" onclick="changePage(event, 'monthlyReport')" href="#">Monthly Report</a>
                                    </li>
                                    <li class='btn btn-dark w-100'>
                                        <a href="#">-</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="btn btn-dark w-100">
                                <a href="#">QHSE</a>
                            </li>
                            <li>
                                <a href="#pageSubmenu" data-toggle="collapse" class="dropdown-toggle btn btn-dark w-100" aria-expanded="false">GGD</a>
                                <ul class="collapse list-unstyled" id="pageSubmenu">
                                    <li class='btn btn-dark w-100'>
                                        <a href="/crosssection">Cross Section</a>
                                    </li>
                                    <li class='btn btn-dark w-100'>
                                        <a href="#">Page 2</a>
                                    </li>
                                    <li class='btn btn-dark w-100'>
                                        <a href="#">Page 3</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="btn btn-dark w-100">
                                <a href="#">HD</a>
                            </li>
                            <li class="btn btn-dark w-100">
                                <a href="#">Contact</a>
                            </li>
                        </ul>
                    </div>


                </nav>
                <!-- Page Content -->
                <div id="content" class='col-10'>
                    <div>
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <div>
                                <div class='container p-0 w-100' style="margin-left: 15%;">
                                    <div class="fadeInDown">
                                        <div class="pagecontent mt-5 w-100" id='monthlyReport'>
                                            <div class="tab">
                                                <button id='defaultOpen2' class="tablinks" onclick="changeTab(event, 'Actual')">Actual</button>
                                                <button class="tablinks" onclick="changeTab(event, 'planBudget')">Plan
                                                    Budget</button>
                                                <button class="tablinks" onclick="changeTab(event, 'planRKAB')">Plan
                                                    RKAB</button>
                                                <button class="tablinks" onclick="changeTab(event, 'planAgreed')">Plan
                                                    Agreed</button>
                                                <button class="tablinks" onclick="changeTab(event, 'planMonthlySis')">Plan
                                                    Monthly SIS</button>
                                            </div>

                                            <div id="planBudget" class="tabcontent">

                                                <legend>Plan Budget</legend>
                                                <div id='bcPlanBudget' class='scrollmenu'>

                                                </div>
                                                <div id='lsaPlanBudget' class='scrollmenu'>
                                                </div>
                                                <div id='scmPlanBudget' class='scrollmenu'>
                                                </div>
                                            </div>

                                            <div id="planRKAB" class="tabcontent">
                                                <legend>Plan RKAB</legend>
                                                <div id='bcPlanRkab' class='scrollmenu'>
                                                </div>
                                                <div class='scrollmenu' id='lsaPlanRkab'>
                                                </div>
                                                <div class='scrollmenu' id='scmPlanRkab'>
                                                </div>
                                                <div class='scrollmenu' id='pcsPlanRkab'>
                                                </div>
                                            </div>

                                            <div id="Actual" class="tabcontent">

                                                <legend>Actual</legend>
                                                <div id='bcActual' class='scrollmenu'>
                                                </div>
                                                <div class='scrollmenu' id='lsaActual'>
                                                </div>
                                                <div class='scrollmenu' id='scmActual'>
                                                </div>
                                            </div>

                                            <div id="planAgreed" class="tabcontent">
                                                <legend>Plan Agreed</legend>
                                                <div id='bcplanAgreed' class='scrollmenu'>
                                                </div>
                                                <div class='scrollmenu' id='lsaplanAgreed'>
                                                </div>
                                                <div class='scrollmenu' id='scmplanAgreed'>
                                                </div>
                                            </div>
                                            <div id="planMonthlySis" class="tabcontent">
                                                <legend>Plan Monthly SIS</legend>
                                                <div id='bcplanMonthlySis' class='scrollmenu'>
                                                </div>
                                                <div class='scrollmenu' id='lsaplanMonthlySis'>
                                                </div>
                                                <div class='scrollmenu' id='scmplanMonthlySis'>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                    <div id="webgis" class="row pagecontent mt-5">
                                        <!-- <h1></h1>
                                        <div id="mapid" class='m-0' style='border: solid 1px white'>

                                        </div>

                                        <script src="static/js/sanleaflet.js"></script>
                                        <script>
                                            // init map
                                        </script> -->
                                    </div>
                                </div>
                            </div>
                    </div>
                    </nav>
                </div>

            </div>
        </div>
    </div>

    </div>



    <script>
        function openNav() {
            document.getElementById("sidebar").style.width = "250px";
            document.getElementById("content").style.marginLeft = "250px";
            document.getElementById('myauto').style.display = 'block';
            document.getElementById('closerbutton').style.display = 'block'
        }

        /* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
        function closeNav() {
            document.getElementById("sidebar").style.width = "50px";
            document.getElementById("content").style.marginLeft = "0";
            // document.getElementById("sidebar").style.marginLeft = "0";
            document.getElementById('myauto').style.display = 'none';
            document.getElementById('closerbutton').style.display = 'none'
        }


        window.onload = () => {
            var loading = document.getElementById('loading')
            var body = document.getElementById('body')
            setTimeout(() => {
                loading.style.display = 'none';
                body.style.display = 'block';
                console.log('a')
            }, 3000)

            $(document).ready(function() {

                openNav()

            });

            document.getElementById("defaultOpen").click();
            document.getElementById("defaultOpen2").click();
            // createHeader('bc', 'bcPlanBudget', headerPlanBC)
            // createHeader('bc', 'bcPlanRKAB', headerPlanBC)
            // createHeader('bc', 'bcActual', headerPlanBC)

            //removing the blueish effect from a on hover
            document.querySelectorAll('a').forEach(el => {
                el.addEventListener('mouseover', (event) => {
                    event.target.style.color = 'white';
                })
            })
        }
    </script>
</body>

</html>