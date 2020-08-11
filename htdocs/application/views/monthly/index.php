<!DOCTYPE html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Monthly Report</title>
    <script type='text/javascript' src="static/js/jquery-3.4.1.js"></script>
    <link rel="stylesheet" type="text/css" href="static/css/bootstrap.css">
    <!-- <script type='text/javascript' src="static/js/popper.min.js"></script> -->

    <script type='text/javascript' src="static/js/bootstrap.js"></script>
    <script src="static/js/operation.js" type="text/javascript"></script>
    <script>
    </script>
</head>

<style>
    html,
    body {
        margin: 0;
        padding: 0;
        background-color: rgb(209, 207, 207);
        scroll-behavior: smooth;
    }
    
    table {
        text-align: center;
        /* border-radius: 1px; */
    }
    
    div.scrollmenu {
        background-color: #333;
        overflow: auto;
        white-space: nowrap;
        margin: 100px;
        padding: 20px;
        border-radius: 5px;
    }
    
    div.scrollmenu a {
        display: inline-block;
        color: white;
        text-align: center;
        padding: 14px;
        text-decoration: none;
    }
    
    div.scrollmenu a:hover {
        background-color: #777;
    }
    /* Style the tab */
    
    .tab {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }
    /* Style the buttons that are used to open the tab content */
    
    .tab button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
    }
    /* Change background color of buttons on hover */
    
    .tab button:hover {
        background-color: #ddd;
    }
    /* Create an active/current tablink class */
    
    .tab button.active {
        background-color: #ccc;
    }
    /* Style the tab content */
    
    .tabcontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }
    
    .tabcontent {
        animation: fadeEffect 1s;
        /* Fading effect takes 1 second */
    }
    /* Go from zero to full opacity */
    
    .page {
        overflow: hidden;
        border: 1px solid #ccc;
        background-color: #f1f1f1;
    }
    /* Style the buttons that are used to open the tab content */
    
    .page button {
        background-color: inherit;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: 0.3s;
    }
    /* Change background color of buttons on hover */
    
    .page button:hover {
        background-color: #ddd;
    }
    /* Create an active/current tablink class */
    
    .page button.active {
        background-color: #ccc;
    }
    /* Style the tab content */
    
    .pagecontent {
        display: none;
        padding: 6px 12px;
        border: 1px solid #ccc;
        border-top: none;
    }
    
    .pagecontent {
        animation: fadeEffect 1s;
        /* Fading effect takes 1 second */
    }
    
    @keyframes fadeEffect {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    
    h3 {
        color: white;
    }
</style>



<body>
    <div class="page">
        <button id='defaultOpen' class="pagelinks" onclick="changePage(event, 'monthlyReport')">Monthly Report</button>
        <button class="pagelinks" onclick="changePage(event, 'planRKAB')">Yearly</button>
    </div>

    <div class="pagecontent" id='monthlyReport'>
        <div class="tab">
            <button id='defaultOpen2' class="tablinks" onclick="changeTab(event, 'Actual')">Actual</button>
            <button class="tablinks" onclick="changeTab(event, 'planBudget')">Plan Budget</button>
            <button class="tablinks" onclick="changeTab(event, 'planRKAB')">Plan RKAB</button>
            <button class="tablinks" onclick="changeTab(event, 'planAgreed')">Plan Agreed</button>
            <button class="tablinks" onclick="changeTab(event, 'planMonthlySis')">Plan Monthly SIS</button>
        </div>




    </div>
    <!-- Tab content -->
    <div id="planBudget" class="tabcontent">
        <h2>Plan Budget</h2>
        <div id='bcPlanBudget' class='scrollmenu'>
        </div>
        <div id='lsaPlanBudget' class='scrollmenu'>
        </div>
        <div id='scmPlanBudget' class='scrollmenu'>
        </div>
    </div>

    <div id="planRKAB" class="tabcontent">
        <h2>Plan RKAB</h2>
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
        <h2>Actual</h2>
        <div id='bcActual' class='scrollmenu'>
        </div>
        <div class='scrollmenu' id='lsaActual'>
        </div>
        <div class='scrollmenu' id='scmActual'>
        </div>
    </div>

    <div id="planAgreed" class="tabcontent">
        <h2>Plan Agreed</h2>
        <div id='bcplanAgreed' class='scrollmenu'>
        </div>
        <div class='scrollmenu' id='lsaplanAgreed'>
        </div>
        <div class='scrollmenu' id='scmplanAgreed'>
        </div>
    </div>
    <div id="planMonthlySis" class="tabcontent">
        <h2>Plan Monthly SIS</h2>
        <div id='bcplanMonthlySis' class='scrollmenu'>
        </div>
        <div class='scrollmenu' id='lsaplanMonthlySis'>
        </div>
        <div class='scrollmenu' id='scmplanMonthlySis'>
        </div>
    </div>
    </div>




</body>

<script>
    document.getElementById("defaultOpen").click();
    document.getElementById("defaultOpen2").click();
    // createHeader('bc', 'bcPlanBudget', headerPlanBC)
    // createHeader('bc', 'bcPlanRKAB', headerPlanBC)
    // createHeader('bc', 'bcActual', headerPlanBC)

    var table = document.getElementsByTagName('table')
    var tablearr = [...table]
    tablearr.forEach(el => {
        el.className = 'table table-sm table-bordered table-dark'
    })
</script>