<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");
?>

    <div class="row mb-3 mt-3">
        <div class="col-md-1"></div>
        <div class="col-md-10"><h3 style="color:#a1a1a1">Relatório Geral</h3></div>
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


    <script>
        $(function(){
            Carregando('none')
        })
    </script>