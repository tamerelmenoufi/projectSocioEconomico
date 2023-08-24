<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    if($_POST['acao'] == 'filtro'){
        $_SESSION['relatorio']['usuario'] = $_POST['usuario'];
        $_SESSION['relatorio']['meta'] = $_POST['meta'];
        $_SESSION['relatorio']['data_inicial'] = $_POST['data_inicial'];
        $_SESSION['relatorio']['data_final'] = $_POST['data_final'];
    }



?>
<style>
    .AreaDashboard{
        position:absolute;
        left:20px;
        right:20px;
    }
</style>



    <div class="row g-0 p-3">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <select id="filtro_usuario" class="form-select">
                        <option value="">::Todos os usuários::</option>
                        <?php
                        $q = "select b.*, count(*) as qt from se a left join usuarios b on a.monitor_social = b.codigo where a.monitor_social > 0 and b.situacao = '1' and b.deletado != '1' group by b.codigo order by b.nome";
                        $r = mysqli_query($con, $q);
                        while($d = mysqli_fetch_object($r)){
                        ?>
                        <option value="<?=$d->codigo?>" <?=(($_SESSION['relatorio']['usuario'] == $d->codigo)?'selected':false)?>><?=$d->nome?> (<?=$d->qt?>)</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="filtro_meta" class="form-select">
                        <option value="">::Todos as metas::</option>
                        <?php
                        $q = "select a.*, b.municipio as municipio_nome, c.descricao as bairro_nome from metas a left join municipios b on a.municipio = b.codigo left join bairros_comunidades c on a.bairro_comunidade = c.codigo where a.usuario = '{$_SESSION['relatorio']['usuario']}' order by municipio_nome, bairro_nome";
                        $r = mysqli_query($con, $q);
                        while($d = mysqli_fetch_object($r)){
                        ?>
                        <option value="<?=$d->codigo?>" <?=(($_SESSION['relatorio']['meta'] == $d->codigo)?'selected':false)?>><?="{$d->municipio_nome} - {$d->bairro_nome}"?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control" id="data_inicial" max="<?=date("Y-m-d")?>" value="<?=$_SESSION['relatorio']['data_inicial']?>" />
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control" id="data_final" max="<?=date("Y-m-d")?>" value="<?=$_SESSION['relatorio']['data_final']?>" />
                </div>
                <div class="col-md-2">
                    <button id="filtrar" class="btn btn-primary">Filtrar</button>
                    <button id="limpar" class="btn btn-danger">Limpar</button>
                </div>
            </div>
        </div>
    </div>


<div class="AreaDashboard">
    <div geral></div>
</div>

    <script>
        $(function(){
            Carregando('none')
            $.ajax({
                url:"src/relatorios/telas/geral.php",
                success:function(dados){
                    $("div[geral]").html(dados);
                }
            })

            $("#filtro_usuario").change(function(){
                usuario = $(this).val();
                $.ajax({
                    url:"src/relatorios/componentes/select_metas.php",
                    type:"POST",
                    data:{
                        usuario
                    },
                    success:function(dados){
                        $("#filtro_meta").html(dados);
                    }
                })
            })

            $("#data_inicial").change(function(){
                obj = $("#data_final");
                obj.val($(this).val());
                obj.attr('min', $(this).val());
            })

            $("#filtrar").click(function(){
                usuario = $("#filtro_usuario").val();
                meta = $("#filtro_meta").val();
                data_inicial = $("#data_inicial").val();
                data_final = $("#data_final").val();

                $.ajax({
                    url:"src/relatorios/index.php",
                    type:"POST",
                    data:{
                        usuario,
                        meta,
                        data_inicial,
                        data_final,
                        acao:'filtro'
                    },
                    success:function(dados){
                        $("#paginaHome").html(dados);
                    }
                });
            })
        })
    </script>