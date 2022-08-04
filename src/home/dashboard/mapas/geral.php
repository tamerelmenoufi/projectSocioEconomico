<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    $endereco = 'centro';
?>

<style>

#map<?=$md5?> {
    position:relative;
    height: 100%;
    width:100%;
    opacity:0.6;
    z-index:0;
}

</style>

<div id="map<?=$md5?>"></div>

<script>

    coordenadas<?=$md5?> = '<?="{$coordenadas}"?>';
    endereco<?=$md5?> = "<?=$endereco?>";
    geocoder<?=$md5?> = new google.maps.Geocoder();
    map<?=$md5?> = new google.maps.Map(document.getElementById("map<?=$md5?>"), {
        zoomControl: true,
        mapTypeControl: false,
        draggable: true,
        scaleControl: true,
        scrollwheel: true,
        navigationControl: false,
        streetViewControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        fullscreenControl: true,
        <?php
        // if($coordenadas){
            // -3.986913, -63.931869
        ?>
        center: { lat: -3.986913, lng: -63.931869 },
        zoom: 5,

        <?php
        // }
        ?>
    }
    /*{
        center: { lat: -34.397, lng: 150.644 },
        zoom: 8,
    }*/
    );

    // marker<?=$md5?> = new google.maps.Marker({
    //     position: { lat: -3.986913, lng: -63.931869 },
    //     map:map<?=$md5?>,
    //     title: "Hello World!",
    //     draggable:false,
    // });

    // google.maps.event.addListener(marker<?=$md5?>, 'dragend', function(marker) {
    //     var latLng = marker.latLng;
    //     alert(`Lat ${latLng.lat()} & Lng ${latLng.lng()}`)
    // });

function icones(local, qt){
    geocoder<?=$md5?>.geocode({ 'address': local + ', Amazonas, Brasil', 'region': 'BR' }, (results, status) => {

        if (status == google.maps.GeocoderStatus.OK) {
            if (results[0] && !coordenadas<?=$md5?>) {

                var latitude<?=$md5?> = results[0].geometry.location.lat();
                var longitude<?=$md5?> = results[0].geometry.location.lng();
                console.log('Coordenadas:')
                console.log('Lat:'+latitude<?=$md5?>)
                console.log('Lng:'+longitude<?=$md5?>)

                // var location<?=$md5?> = new google.maps.LatLng(latitude<?=$md5?>, longitude<?=$md5?>);
                // marker<?=$md5?>.setPosition(location<?=$md5?>);
                // map<?=$md5?>.setCenter(location<?=$md5?>);
                // map<?=$md5?>.setZoom(18);

                marker<?=$md5?> = new google.maps.Marker({
                    position: { lat: latitude<?=$md5?>, lng: longitude<?=$md5?> },
                    map:map<?=$md5?>,
                    title: qt + " Beneficiários",
                    draggable:false,
                });



            }
        }
    });

}

<?php

    $query = "select
                    a.*/*,
                    (select count(*) from se where municipio = a.codigo) as qt*/
                from municipios a
            ";
    $result = mysqli_query($con, $query);
    $mun = [];
    $qt = [];
    while($d = mysqli_fetch_object($result)){
        $mun[] = $d->municipio;
        $qt[] = $d->qt;
    }

?>


var enderecos = ['<?=implode("','",$mun)?>'];
var qt = ['<?=implode("','",$qt)?>'];

for(i=0;i<enderecos.length;i++){
    console.log(enderecos[i])
    icones(enderecos[i], qt[i])
}

</script>