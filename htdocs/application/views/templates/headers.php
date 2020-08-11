<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script type='text/javascript' src="static/js/jquery-3.4.1.js"></script>
    <link rel="stylesheet" type="text/css" href="static/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="static/css/landingpage.css">

    <!-- <script type='text/javascript' src="static/js/popper.min.js"></script> -->

    <script type='text/javascript' src="static/js/bootstrap.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="static/css/login.css"> -->
    <!-- <link rel="stylesheet" href="static/css/bootstrap.css">
    <script src="static/js/bootstrap.js"></script> -->
    <link rel="stylesheet" href="static/leaflet/leaflet.css">
    <script src="static/leaflet/leaflet.js"></script>
    <script src="static/js/sanwkttojson.js"></script>


    <style>
        #icon {
            height: 30px;
            width: auto;
        }
        
        #mapid {
            height: 80vh;
            width: 60vw;
            margin-top: 100px;
            z-index: 0;
        }
        
        .row,
        .wrapper,
        .fadeInDown {
            margin: 0;
            padding: 0;
        }
        
        a {
            color: white;
        }
        
        ul li a {
            text-decoration: none;
        }
        
        #header {
            top: 0;
            overflow: hidden;
            position: fixed;
            z-index: 3;
        }
        
        legend {
            margin: 100px;
        }
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

            var table = document.getElementsByTagName('table')
            var tablearr = [...table]
            tablearr.forEach(el => {
                el.className = 'table table-sm table-bordered table-dark'
            })

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