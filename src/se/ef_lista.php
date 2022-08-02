<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");
?>
<style>

</style>

<h3>Aqui é a lista completa</h3>
<?php

$query = "select * from se_estrutura_familiar where se_codigo = '{$_SESSION['se_codigo']}'";
$result = mysqli_query($con, $query);
while($d = mysqli_fetch_object($result)){
?>

<div class="row">
            <div class="col">
                <div class="card mt-3">
                    <h5 class="card-header"><?=$d->ef_nome?> - <?=$d->ef_grau_parentesco?></h5>
                    <div class="card-body">

                        <h5 class="card-title"><?=$d->ef_telefone?></h5>
                        <p class="card-text">
                            Outras Informações
                        </p>

                        <button
                            class="btn btn-primary"
                            editarEf="<?=$d->codigo?>"
                        >
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>

                        <button
                            class="btn btn-danger"
                            deleteEf="<?=$d->codigo?>"
                        >
                            <i class="fa-solid fa-trash"></i>
                        </button>


                    </div>
                </div>
            </div>
        </div>

<?php
}
?>
<script>
    $(function(){

        Carregando('none');
        $("button[editarEf]").click(function(){
            cod = $(this).attr("editarEf");
            $("#form-tab").addClass("active")
            $("#form-tab").attr("aria-selected","true")

            $("#lista-tab").removeClass("active")
            $("#lista-tab").attr("aria-selected","false")

            $.ajax({
                url:"src/se/ef_form.php",
                type:"POST",
                data:{
                    cod
                },
                success:function(dados){
                    $("#EstruturaFamiliar").html(dados);
                },
                error:function(erro){
                    Carregando('none');
                }
            });
        });

        $("button[deleteEf]").click(function(){

            $.confirm({
                content:"Deseja realmente excluir o registro?",
                title:false,
                buttons:{
                    'SIM':function(){
                        Carregando();
                       $.ajax({
                            url:"src/se/ef_lista.php",
                            success:function(dados){
                                $("#EstruturaFamiliar").html(dados);

                                $("#lista-tab").addClass("active")
                                $("#lista-tab").attr("aria-selected","true")
                                $("#form-tab").removeClass("active")
                                $("#form-tab").attr("aria-selected","false")

                            },
                            error:function(erro){
                                Carregando('none');

                            }
                        });
                    },
                    'Não':function(){

                    }
                }
            })



        })


    })
</script>