<?= $this->extend('layout') ?>

<?= $this->section('head') ?>
    <script src="<?= base_url('leaflet/leaflet.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('leaflet/leaflet.css') ?>" />
    <style>
        #maps {
            height: 500px;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h1>Peta Indonesia</h1>
<div id="maps"></div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    var map = L.map('maps').setView({ lat : 0.7893, lon : 113.9213 }, 5);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
    }).addTo(map);

    L.marker({lat : 0.7893, lon : 113.9213}).bindPopup('Hello Indonesia').addTo(map);

</script>
<?= $this->endSection() ?>