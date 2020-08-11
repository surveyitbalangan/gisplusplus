<div class="content-wrapper">
    <section class="content-header">
        <h1>
            <?= $app_name ?>
            <!-- <small>Version 2.0</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Underconstruction</li>
        </ol>
    </section>
    <section class="content">
        <div>

            <?php

            $map = directory_map('./folderlist/topo update');


            ?>

            <script>
                map = <?= json_encode($map) ?>;
                baseUrl = '<?php echo base_url() ?>';
            </script>


            <div id="jstree_demo_div"></div>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class='row ' style="border: red solid 0.5px">
                            <div class='col-6'>
                                <h4  style="border: black solid 0.5px">Topo Update</h4>
                            </div>

                        <!-- Trigger the modal with a button -->
                            <div>

                            </div>
                        <button id='addbutton' style="margin-bottom: 20px" type="button" class="btn btn-lg col-6" data-toggle="modal" data-target="#myModal">Upload New Data</button>
                        </div>

                        <!-- Modal -->
                        <div id="myModal" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title">Sorry</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>This feature is not yeat alvailable</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div id='foldercontainer' class='table table-bordered'>
                            <!-- <legend>Nama Folder</legend> -->

                        </div>

                        <div id='target' class="row">

                        </div>

                        <script>
                            folderContainer = document.getElementById('foldercontainer');

                            Object.keys(map).forEach(type => {

                                var topoFileLoc = baseUrl + 'folderlist/topo%20update/' + type.replace('\\', '/');

                                var div = document.createElement('div');

                                var typeString = type.replace('\\', '');

                                var tr = document.createElement('div');
                                var td = document.createElement('p');

                                td.innerHTML = typeString;

                                tr.appendChild(td);

                                td.id = typeString;

                                td.className = 'button btn-info'

                                // td >>>>>> <td></td>

                                td.onclick = function() {
                                    collapse(map[type], topoFileLoc)
                                }

                                // Object.keys(map[type]).forEach(el => {
                                //     var node = document.createElement('p')
                                //     if (typeof el == 'array') {
                                //         console.log('array : ');
                                //         console.log(el);
                                //     } else {
                                //         node.innerHTML = el;
                                //         console.log('not array but ' + typeof el);
                                //         console.log(map[type][el]);

                                //     }
                                // })

                                folderContainer.appendChild(tr);
                            })

                            var div = document.getElementById('target');

                            function collapse(ent, topoFileLoc) {

                                var node = document.createElement('p');
                                if (!Array.isArray(ent)) {

                                    Object.keys(ent).forEach(el => {

                                        if (typeof ent[el] == 'object') {

                                            console.log(ent[el])

                                            collapse(ent[el])


                                        } else {
                                            div.removeChild(div.firstChild)

                                            Object.keys(ent).forEach(el => {


                                                div.appendChild(createFileCard(ent[el], topoFileLoc))

                                                var node3 = document.createElement('p')
                                                var node2 = document.createElement('a')
                                                node2.href = topoFileLoc + ent[el]
                                                node2.innerHTML = ent[el];

                                                if (typeof ent[el] == 'object') {
                                                    node2.innerHTML = 'iniobject' + ent[el]
                                                }


                                                node3.appendChild(node2);
                                                node.appendChild(node3);

                                            })


                                            div.appendChild(node);
                                        }
                                    })

                                } else {

                                    div.innerHTML = ''

                                    Object.keys(ent).forEach(el => {

                                        div.appendChild(createFileCard(ent[el], topoFileLoc))
                                        // var node3 = document.createElement('p')
                                        // var node2 = document.createElement('a')
                                        // node2.href = topoFileLoc + ent[el]
                                        // node2.innerHTML = ent[el];
                                        // node3.appendChild(node2)
                                        // node.appendChild(node3);
                                    })

                                    div.appendChild(node)
                                }
                            }
                        </script>
                    </div>

                </div>
            </div>

        </div>
    </section>
    <!-- <div>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                <a href="#" class="card-link">Card link</a>
                <a href="#" class="card-link">Another link</a>
            </div>
        </div>
    </div> -->
    <script>
        /// card 
        function createFolderCard(el) {
            var card = document.createElement('div');
            card.className = 'card';
            card.style.width = '18rem';

            var cardBody = document.createElement('div');
            cardBody.className = 'card-body';


        }

        function createFileCard(el, fileLoc) {
            var card = document.createElement('div');
            card.className = 'card col-3';
            // card.style.width = '18rem';

            var cardBody = document.createElement('div');
            cardBody.className = 'card-body';

            var cardTitle = document.createElement('a');
            cardTitle.innerHTML = el;
            cardTitle.className = 'card-title';

            var cardSubTitle = document.createElement('a');
            cardSubTitle.className = 'card-subtitle mb-2 text-muted';
            // cardSubTitle.innerHTML = 'testst';
            cardTitle.href = fileLoc + el;
            cardTitle.style.color = 'black';

            cardBody.appendChild(cardTitle);
            cardBody.appendChild(cardSubTitle);
            card.appendChild(cardBody);

            return card;
        }
    </script>
</div>