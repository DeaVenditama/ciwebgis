<?= $this->extend('layout') ?>

<?= $this->section('head') ?>
    <script src="<?= base_url('leaflet/leaflet.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('leaflet/leaflet.css') ?>" />
    <style>
        #maps {
            height: 500px;
        }
        .info {
            padding: 6px 8px;
            font: 14px/16px Arial, Helvetica, sans-serif;
            background: white;
            background: rgba(255,255,255,0.8);
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            border-radius: 5px;
        }
        .info h4 {
            margin: 0 0 5px;
            color: #777;
        }
        .legend {
            line-height: 18px;
            color: #555;
        }
        .legend i {
            width: 18px;
            height: 18px;
            float: left;
            margin-right: 8px;
            opacity: 0.7;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h1>Peta Indonesia</h1>
<div id="maps"></div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    var data = <?= json_encode($data) ?>;
    var nilaiMax = <?= $nilaiMax ?>;

    var map = L.map('maps').setView({ lat : 0.7893, lon : 113.9213 }, 5);
    
    function getColor(d) {
		return d > (nilaiMax/8)*7 ? '#800026' :
           d > (nilaiMax/8)*6  ? '#BD0026' :
           d > (nilaiMax/8)*5  ? '#E31A1C' :
           d > (nilaiMax/8)*4  ? '#FC4E2A' :
           d > (nilaiMax/8)*3   ? '#FD8D3C' :
           d > (nilaiMax/8)*2   ? '#FEB24C' :
           d > (nilaiMax/8)*1   ? '#FED976' :
                      '#FFEDA0';
    }
    
    function style(feature){
        return{
            weight : 2,
            opacity : 1,
            color : 'white',
            dashArray : '3',
            fillOpacity : 0.7,
            fillColor : getColor(parseInt(feature.properties.nilai))
        };
    }

    function onEachFeature(feature, layer)
    {
        layer.bindPopup("<h4>Jumlah Proyeksi Penduduk</h4><br>"+feature.properties.Propinsi+" : "+feature.properties.nilai +"(000) ribu jiwa");
        layer.on({
            mouseover: highlightFeature,
            mouseout: resetHighlight,
        });
    }


    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
    }).addTo(map);

    var geojson = L.geoJson(data, {
        style : style,
        onEachFeature : onEachFeature
    }).addTo(map);

    function highlightFeature(e) {
        var layer = e.target;

        layer.setStyle({
            weight: 1,
            color: '#ff0000',
            dashArray: '',
            fillOpacity: 0.7
        });

        if (!L.Browser.ie && !L.Browser.opera && !L.Browser.edge) {
            layer.bringToFront();
        }

        info.update(layer.feature.properties);
    }

    function resetHighlight(e) {
        geojson.resetStyle(e.target);
        info.update();
    }

    var info = L.control();

    info.onAdd = function (map) {
        this._div = L.DomUtil.create('div', 'info'); // create a div with a class "info"
        this.update();
        return this._div;
    };

    // method that we will use to update the control based on feature properties passed
    info.update = function (props) {
        this._div.innerHTML = '<h4><?= $masterData->nama ?></h4>' +  (props ?
            '<b>' + props.Propinsi + '</b><br />' + props.nilai + ' (000) ribu jiwa'
            : 'Hover di atas wilayah');
    };

    info.addTo(map);

    var legend = L.control({position: 'bottomright'});

    legend.onAdd = function (map) {

        var div = L.DomUtil.create('div', 'info legend'),
            grades = [0, (nilaiMax/8)*1, (nilaiMax/8)*2, (nilaiMax/8)*3, (nilaiMax/8)*4, (nilaiMax/8)*5, (nilaiMax/8)*6, (nilaiMax/8)*7],
            labels = [];

        // loop through our density intervals and generate a label with a colored square for each interval
        for (var i = 0; i < grades.length; i++) {
            div.innerHTML +=
                '<i style="background:' + getColor(grades[i] + 1) + '"></i> ' +
                grades[i] + (grades[i + 1] ? '&ndash;' + grades[i + 1] + '<br>' : '+');
        }

        return div;
    };

    legend.addTo(map);


</script>
<?= $this->endSection() ?>