L.control.custom({
        position: 'bottomright',
        content: `<div id="test" class='row' style="border: white solid 1px; height: 40px; width: 350px;border-radius:5px">
                    <div id="left" class="col-md-2" style="color: teal; border-top-left-radius:5px; border-top-left-radius:5px; border-bottom-left-radius:5px; background-color:#173f5f;">
                        <div class="mt-2" style="color: white"><<<</div>    
                    </div>
                    <input class='col-md-8 pt-2 pl-5' style="background-color: #20639b" id="texttanggal"></input>
                <div class="col-md-2" style="color: teal; border-top-left-radius:5px; border-top-right-radius:5px; border-bottom-right-radius:5px; background-color:#173f5f">
                    <div id="right" class="mt-2" style="color: white">
                    >>>
                    </div>    
                </div>
            </div>`,
        classes: 'btn-group-horizontal btn-group-md',
        style: {
            // margin: '10px',
            padding: '0px 0 0 0',
            cursor: 'pointer',
        },
        datas: {
            'foo': 'bar',
        },
        events: {
            // click: function(data) {
            //     console.log('wrapper div element clicked');
            //     console.log(data);
            // },
            // dblclick: function(data) {
            //     console.log('wrapper div element dblclicked');
            //     console.log(data);
            // },
            // contextmenu: function(data) {
            //     console.log('wrapper div element contextmenu');
            //     console.log(data);
            // },
        }
    })
    .addTo(mymap);

var left = document.getElementById('left')
left.addEventListener('click', negativeCounter)

var right = document.getElementById('right')
right.addEventListener('click', positiveCounter)


// Leaflet Sidebar





/////////////////////

L.Control.Watermark = L.Control.extend({
    onAdd: function(mymap) {
        var img = L.DomUtil.create('img');

        img.src = '../static/img/logo.png';
        img.style.width = '100px';

        return img;
    },

    onRemove: function(mymap) {
        // Nothing to do here
    }
});

L.control.watermark = function(opts) {
    return new L.Control.Watermark(opts);
}


L.control.watermark({ position: 'bottomleft' }).addTo(mymap);