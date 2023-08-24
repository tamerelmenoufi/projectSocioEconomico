<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");



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
                    <select id="filtro_metas" class="form-select">
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
                    <button class="btn btn-primary">Filtrar</button>
                    <button class="btn btn-danger">Limpar</button>
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
        })
    </script>