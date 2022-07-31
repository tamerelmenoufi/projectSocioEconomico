<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");
?>
<style>
    .Titulo<?=$md5?>{
        position:absolute;
        left:60px;
        top:8px;
        z-index:0;
    }
    .tab-content{
        border-right:1px #ccc solid;
        border-bottom:1px #ccc solid;
        border-left:1px #ccc solid;
        padding:20px;
    }
</style>
<h4 class="Titulo<?=$md5?>">Estrutura Familiar</h4>


<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item" role="presentation">
    <button
            class="nav-link active"
            id="home-tab"
            data-bs-toggle="tab"
            data-bs-target="#listaEstruturaFamiliar"
            type="button"
            role="tab"
            aria-controls="listaEstruturaFamiliar"
            aria-selected="true"
            estruturaFamiliar="src/se/ef_lista.php"
    >Lista dos cadastros</button>
  </li>
  <li class="nav-item" role="presentation">
    <button
            class="nav-link"
            id="profile-tab"
            data-bs-toggle="tab"
            data-bs-target="#formEstruturaFamiliar"
            type="button"
            role="tab"
            aria-controls="formEstruturaFamiliar"
            aria-selected="false"
            estruturaFamiliar="src/se/ef_form.php"
    >Formulário de Cadastro</button>
  </li>
</ul>
<div class="tab-content" id="myTabContent">
  <div
        class="tab-pane fade show active"
        id="listaEstruturaFamiliar"
        role="tabpanel"
        aria-labelledby="lista-tab"
        tabindex="0"
    >Lista dos cadastros</div>
  <div
        class="tab-pane fade"
        id="formEstruturaFamiliar"
        role="tabpanel"
        aria-labelledby="form-tab"
        tabindex="0"
    >Formulários dos cadastros</div>
</div>

    <script>
        $(function(){

            $.ajax({
                url:"src/se/ef_lista.php",
                success:function(dados){
                    $("#listaEstruturaFamiliar").html(dados);
                },
                error:function(erro){
                    Carregando('none');
                    // $.alert('Ocorreu um erro!' + erro.toString());
                    //dados de teste
                }
            });

            $("button[estruturaFamiliar]").click(function(){
                url = $(this).attr("estruturaFamiliar");
                target = $(this).attr("data-bs-target");
                $.ajax({
                    url,
                    success:function(dados){
                        $(target).html(dados);
                    },
                    error:function(erro){
                        Carregando('none');
                        // $.alert('Ocorreu um erro!' + erro.toString());
                        //dados de teste
                    }
                });
            });

        })
    </script>