<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    if($_POST['acao'] == 'filtro'){
        $_SESSION['relatorio']['usuario'] = $_POST['usuario'];
        $_SESSION['relatorio']['meta'] = $_POST['meta'];
        $_SESSION['relatorio']['data_inicial'] = $_POST['data_inicial'];
        $_SESSION['relatorio']['data_final'] = $_POST['data_final'];
    }

    $filtro = $f_usuario = $f_meta = $f_data = false;
    if($_SESSION['relatorio']['usuario']){
        $f_usuario = " and monitor_social in( {$_SESSION['relatorio']['usuario']} ) ";
    }
    if($_SESSION['relatorio']['meta']){
        $f_meta = " and meta in( {$_SESSION['relatorio']['meta']} ) ";
    }
    if($_SESSION['relatorio']['data_inicial']){
        $f_data = " and (data between '{$_SESSION['relatorio']['data_inicial']} 00:00:00' and '".(($_SESSION['relatorio']['data_final'])?:$_SESSION['relatorio']['data_inicial'])." 23:59:59')";
    }

    $filtro = $f_usuario . $f_meta . $f_data;


    echo $query = "select count(*) from se where monitor_social > 0 and meta > 0 {$filtro} group by situacao";


?>
<style>
       .AreaDashboard{
        position:absolute;
        left:20px;
        right:20px;
    }
    .cartao{
        position:relative;
        width:99%;
        min-height:120px;
        background-color:#459adb;
        border-radius:10px;
        color:#fff;
    }
    .cartao span{
        font-size:10px;
        margin-left:10px;
    }
    .cartao p{
        font-size:25px;
        font-weight:bold;
        text-align:center;
        padding-top:0px;
        padding-bottom:15px;
    }
    .cartao div{
        position:absolute;
        right:10px;
        bottom:5px;
        width:auto;
        opacity:0;
    }
    .cartao div i{
        cursor: pointer;
        margin-left:10px;
    }
</style>



    <div class="row mb-3 mt-3">
        <div class="col-md-1"></div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-3">
                    <select id="filtro_usuario" class="form-select">
                        <option value="">::Todos os usuários::</option>
                        <?php
                        $q = "select * from usuarios where situacao = '1' and deletado != '1' order by nome";
                        $r = mysqli_query($con, $q);
                        while($d = mysqli_fetch_object($r)){
                        ?>
                        <option value="<?=$d->codigo?>"><?=$d->nome?></option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="filtro_meta" class="form-select">
                        <option value="">::Todos as metas::</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control" id="data_inicial" />
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control" id="data_final" />
                </div>
                <div class="col-md-2">
                    <button id="filtrar" class="btn btn-primary">Filtrar</button>
                    <button id="limpar" class="btn btn-danger">Limpar</button>
                </div>
            </div>
        </div>
        <div class="col-md-1"></div>
    </div>


<div class="AreaDashboard">
    <div class="row mb-3 mt-3">
        <div class="col-md-1"></div>
        <div class="col-md-10"><h3 style="color:#a1a1a1">Relatório Quantitativo</h3></div>
        <div class="col-md-1"></div>
    </div>
    <div class="row">
        <div class="col-md-1"></div>


        <div class="col-md-2 mb-3">
            <div class="cartao">
                <span>Toatl Geral</span>
                <p><?=$total?></p>
                <div>
                    <i acao='editar' filtro='' class="fa-solid fa-up-right-from-square"></i>
                    <i acao='download' filtro='' class="fa-solid fa-file-arrow-down"></i>
                </div>
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <div class="cartao">
                <span>Pesquisas Iniciadas</span>
                <p><?=$i?></p>
                <div>
                    <i acao='editar' filtro='i' class="fa-solid fa-up-right-from-square"></i>
                    <i acao='download' filtro='i' class="fa-solid fa-file-arrow-down"></i>
                </div>
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <div class="cartao">
                <span>Pesquisas Pendentes</span>
                <p><?=$p?></p>
                <div>
                    <i acao='editar' filtro='p' class="fa-solid fa-up-right-from-square"></i>
                    <i acao='download' filtro='p' class="fa-solid fa-file-arrow-down"></i>
                </div>
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <div class="cartao">
                <span>Pesquisas Concluídas</span>
                <p><?=$c?></p>
                <div>
                    <i acao='editar' filtro='c' class="fa-solid fa-up-right-from-square"></i>
                    <i acao='download' filtro='c' class="fa-solid fa-file-arrow-down"></i>
                </div>
            </div>
        </div>

        <div class="col-md-2 mb-3">
            <div class="cartao">
                <span>Beneficiários não encontrados</span>
                <p><?=$n?></p>
                <div>
                    <i acao='editar' filtro='n' class="fa-solid fa-up-right-from-square"></i>
                    <i acao='download' filtro='n' class="fa-solid fa-file-arrow-down"></i>
                </div>
            </div>
        </div>

        <div class="col-md-1"></div>
    </div>
</div>

    <script>
        $(function(){
            Carregando('none')

            $(".cartao").mouseover(function(){
                $(this).children(".cartao div").css('opacity',1)
            }).mouseout(function(){
                $(this).children(".cartao div").css('opacity',0)
            })


            $("#filtro_usuario").change(function(){
                usuario = $(this).val();
                $.ajax({
                    url:"src/relatorios/componentes/select_metas.php",
                    type:"POST",
                    data:{
                        usuario,
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