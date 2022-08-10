<script>

    address =  `<?=$_POST['local']?>, Amazonas, Brasil`

    geocoder<?=$_POST['md5']?>.geocode({ 'address':address, 'region': 'BR' }, (results, status) => {
        console.log(address)
        console.log(status)
        console.log(google.maps.GeocoderStatus.OK)

        if (status == google.maps.GeocoderStatus.OK) {
            // if (results[0] && !coordenadas<?=$_POST['md5']?>) {

                var latitude<?=$_POST['md5']?> = results[0].geometry.location.lat();
                var longitude<?=$_POST['md5']?> = results[0].geometry.location.lng();
                // console.log('Coordenadas:', local)
                // console.log('Lat:'+latitude<?=$_POST['md5']?>)
                // console.log('Lng:'+longitude<?=$_POST['md5']?>)

                // var location<?=$_POST['md5']?> = new google.maps.LatLng(latitude<?=$_POST['md5']?>, longitude<?=$_POST['md5']?>);
                // marker<?=$_POST['md5']?>.setPosition(location<?=$_POST['md5']?>);
                // map<?=$_POST['md5']?>.setCenter(location<?=$_POST['md5']?>);
                // map<?=$_POST['md5']?>.setZoom(18);

                marker<?=$_POST['md5']?> = new google.maps.Marker({
                    position: { lat: latitude<?=$_POST['md5']?>, lng: longitude<?=$_POST['md5']?> },
                    map:map<?=$_POST['md5']?>,
                    title: "<?=$_POST['qt']?> Beneficiários em <?=$_POST['local']?>",
                    draggable:false,
                });



            // }
        }else{
            // console.log('Não encontrado:', local)
            // console.log('Quantidade:', qt)
        }
    });

</script>