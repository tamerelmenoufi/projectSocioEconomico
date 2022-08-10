<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    if($_POST['lat'] and $_POST['lng'] and $_POST['codigo']){
        mysqli_query($con, "update municipios set coordenadas = '{$_POST['lat']}, {$_POST['lng']}' where codigo = '{$_POST['codigo']}'");
        exit();
    }

    $query = "select * from municipios where coordenadas = '' limit 10";
    $result = mysqli_query($con, $query);
    while($d = mysqli_fetch_object($result)){
        $codigos[] = $d->codigo;
        $dados[] = $d->municipio;
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="img/icone.png">
    <title>AADESAM - MapCenso</title>
    <?php
    include("lib/header.php");
    ?>
  </head>
  <body>

    <!-- <div class="Carregando">
        <div><i class="fa-solid fa-rotate fa-pulse"></i></div>
    </div>

    <div class="CorpoApp"></div> -->

    <?php
    include("lib/footer.php");
    ?>

    <<script>


function icones(local, codigo){
        address =  `${local}, Amazonas, Brasil`
        geocoder<?=$md5?> = new google.maps.Geocoder();
        geocoder<?=$md5?>.geocode({ 'address':address, 'region': 'BR' }, (results, status) => {
        console.log(address)
        console.log(status)
        console.log(google.maps.GeocoderStatus.OK)

        if (status == google.maps.GeocoderStatus.OK) {
            // if (results[0] && !coordenadas<?=$md5?>) {

                var latitude<?=$md5?> = results[0].geometry.location.lat();
                var longitude<?=$md5?> = results[0].geometry.location.lng();
                // console.log('Coordenadas:', local)
                // console.log('Lat:'+latitude<?=$md5?>)
                // console.log('Lng:'+longitude<?=$md5?>)

                // var location<?=$md5?> = new google.maps.LatLng(latitude<?=$md5?>, longitude<?=$md5?>);
                // marker<?=$md5?>.setPosition(location<?=$md5?>);
                // map<?=$md5?>.setCenter(location<?=$md5?>);
                // map<?=$md5?>.setZoom(18);

                $.ajax({
                    url:"coordenadas.php",
                    type:"POST",
                    data:{
                        lat:latitude<?=$md5?>,
                        lng:longitude<?=$md5?>,
                        codigo
                    },
                    success:function(dados){

                    }
                });

            // }
        }
    });

}

codigos = ['<?=implode("','",$codigos)?>'];
enderecos = ['<?=implode("','",$dados)?>'];

for(i=0;i<enderecos.length;i++){
    console.log(enderecos[i], codigos[i])
    icones(enderecos[i], codigos[i])
}

</script>

  </body>
</html>