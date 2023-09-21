<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");


    function questoes($d){

        global $_SESSION;
        global $con;

        $filtro = $f_usuario = $f_meta = $f_data = false;
        if($_SESSION['relatorio']['usuario']){
            $f_usuario = " and a.monitor_social in( {$_SESSION['relatorio']['usuario']} ) ";
        }
        if($_SESSION['relatorio']['meta']){
            $f_meta = " and a.meta in( {$_SESSION['relatorio']['meta']} ) ";
        }else if($_SESSION['ProjectSeLogin']->perfil == 'crd'){
            $f_meta = " and a.meta in( select codigo from metas where usuario in(select codigo from usuarios where coordenador = '{$_SESSION['ProjectSeLogin']->codigo}') ) ";
        }

        if($_SESSION['relatorio']['data_inicial']){
            $f_data = " and (a.data between '{$_SESSION['relatorio']['data_inicial']} 00:00:00' and '".(($_SESSION['relatorio']['data_final'])?:$_SESSION['relatorio']['data_inicial'])." 23:59:59')";
        }

        $filtro = $f_usuario . $f_meta . $f_data;

        if($d->join){
            $join = $d->join;
        }
        if($d->item){
            $item = ", {$d->item} as item";
        }
    
        $query = "select a.{$d->campo} as campo {$item} from se a {$join} where a.monitor_social > 0 and a.meta > 0 {$filtro} ";
        $result = mysqli_query($con, $query);
        $t = 0;
        if(mysqli_num_rows($result)){
        while($s = mysqli_fetch_object($result)){

            $cmp = $s->campo;

            if($d->tipo == 'json'){
                $J = json_decode($s->campo);
                if($J){
                    foreach($J as $i => $v){
                        
                        $L[$v] = ((trim($v))?:'Não Informado');

                        $D[$v] = ($D[$v] + 1);
                        $t = ($t + 1);
                    }
                }
            }else{

                

                if($item) {$L[$s->campo] = $s->item;}
                else if(!$d->legenda->$cmp) { $L[$s->campo] = ((trim($s->campo))?:'Não Informado'); }

                $D[$s->campo] = ($D[$s->campo] + 1);
                $t = ($t + 1);
            }
            
        }
?>
<div class="card mb-3">
  <h5 class="card-header"><?=$d->rotulo?></h5>
  <div class="card-body">
    <ul class="list-group">
<?php
    arsort($D);
    foreach($D as $ind => $val){
        $p = number_format($val*100/$t, 0,false,false);
?>
        <li class="list-group-item">
            <div class="row">
                <div class="col-5"><?=($L[$ind])?></div>
                <div class="col-5">
                    <div class="progress">
                        <div class="progress-bar" style="width:<?=$p?>%" role="progressbar" aria-valuenow="<?=$p?>" aria-valuemin="0" aria-valuemax="100"><?=$p?>%</div>
                    </div>
                </div>
                <?php
                //*
                ?>
                <div class="col-2">
                        <button 
                            class="btn btn-info btn-sm w-100 d-flex justify-content-between"
                            campo="<?=$d->campo?>"
                            valor="<?=$ind?>" 
                            json="<?=$d->tipo?>"
                            rotulo_titulo="<?=$d->rotulo?>"
                            rotulo_campo="<?=$d->legenda->$ind?>"
                            data-bs-toggleX="offcanvas"
                            hrefX="#offcanvasDireita"
                            roleX="button"
                            aria-controlsX="offcanvasDireita"                          
                        >
                            <i class="fa-solid fa-arrow-up-1-9"></i><span><?=$val?> <i class="fa-solid fa-up-right-from-square"></i></span>
                        </button>                    
                </div>
                <?php
                    //*/
                ?>
            </div>
        </li>
<?php
    }
?>
    </ul>
  </div>
</div>
<?php
        }
    }

    $d = json_decode(base64_decode($_POST['json']));    
    questoes($d);

?>