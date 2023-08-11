<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    if($_POST['usuario']) $_SESSION['usuario'] = $_POST['usuario'];

    if($_POST['delete']){
      $query = "delete from metas where codigo = '{$_POST['delete']}'";
      mysqli_query($con, $query);
      mysqli_query($con, "update se set meta = '0' where meta = '{$_POST['delete']}'");
    }

    if($_POST['situacao']){
      $query = "update metas set situacao = '{$_POST['opc']}' where codigo = '{$_POST['situacao']}'";
      mysqli_query($con, $query);
      exit();
    }

    $q = "select * from usuarios where codigo = '{$_SESSION['usuario']}'";
    $u = mysqli_fetch_object(mysqli_query($con, $q));
?>

<div class="col">
  <div class="m-3">

    <div class="row">
      <div class="col">
        <div class="card">
          <h5 class="card-header">Lista de Metas (<?=$u->nome?>)</h5>
          <div class="card-body">
            <div style="display:flex; justify-content:end">
                <button
                    novoCadastro
                    class="btn btn-success"
                    data-bs-toggle="offcanvas"
                    href="#offcanvasDireita"
                    role="button"
                    aria-controls="offcanvasDireita"
                >Novo</button>
            </div>


            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">Código</th>
                  <th scope="col">Município</th>
                  <th scope="col">Bairro/Comunidade</th>
                  <th scope="col">Zona</th>
                  <th scope="col">Situação</th>
                  <th scope="col">Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $query = "select a.*, 
                                   b.municipio as municipio_nome, 
                                   c.descricao as bairro_comunidade_nome 
                              from metas a 
                                   left join municipios b on a.municipio = b.codigo 
                                   left join bairros_comunidades c on a.bairro_comunidade = c.codigo 
                              where usuario = '{$_SESSION['usuario']}'
                              order by a.codigo desc";
                  $result = mysqli_query($con, $query);
                  while($d = mysqli_fetch_object($result)){
                ?>
                <tr>
                  <td><?=str_pad($d->codigo, 6, "0", STR_PAD_LEFT)?></td>
                  <td><?=$d->municipio_nome?></td>
                  <td><?=$d->bairro_comunidade_nome?></td>
                  <td><?=$d->zona?></td>
                  <td>

                  <div class="form-check form-switch">
                    <input class="form-check-input situacao" type="checkbox" <?=(($d->situacao)?'checked':false)?> usuario="<?=$d->codigo?>">
                  </div>

                  </td>
                    <td>

                      <button
                        class="btn btn-primary"
                        beneficiados="<?=$d->codigo?>"
                        data-bs-toggle="offcanvas"
                        href="#offcanvasDireita"
                        role="button"
                        aria-controls="offcanvasDireita"
                      >
                        Beneficiados
                      </button>

                      <button
                        class="btn btn-primary"
                        edit="<?=$d->codigo?>"
                        data-bs-toggle="offcanvas"
                        href="#offcanvasDireita"
                        role="button"
                        aria-controls="offcanvasDireita"
                        <?=(($d->quantidade)?'disabled':false)?>
                      >
                        Editar
                      </button>

                      <button 
                        class="btn btn-danger" 
                        delete="<?=$d->codigo?>" 
                        <?=(($d->quantidade)?'disabled':false)?> 
                      >
                        Excluir
                      </button>

                  </td>
                </tr>
                <?php
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


<script>
    $(function(){
        Carregando('none');
        $("button[novoCadastro]").click(function(){
            $.ajax({
                url:"src/metas/form.php",
                success:function(dados){
                    $(".LateralDireita").html(dados);
                }
            })
        })

        $("button[edit]").click(function(){
            meta = $(this).attr("edit");
            $.ajax({
                url:"src/metas/form.php",
                type:"POST",
                data:{
                  meta
                },
                success:function(dados){
                    $(".LateralDireita").html(dados);
                }
            })
        })

        $("button[beneficiados]").click(function(){
            meta = $(this).attr("beneficiados");
            $.ajax({
                url:"src/metas/beneficiados.php",
                type:"POST",
                data:{
                  meta
                },
                success:function(dados){
                    $(".LateralDireita").html(dados);
                }
            })
        })

        $("button[metas]").click(function(){
            meta = $(this).attr("metas");
            $.ajax({
                url:"src/metas/index.php",
                type:"POST",
                data:{
                  meta
                },
                success:function(dados){
                    $(".paginaHome").html(dados);
                }
            })
        })


        $(".situacao").change(function(){

            situacao = $(this).attr("usuario");
            opc = false;

            if($(this).prop("checked") == true){
              opc = '1';
            }else{
              opc = '0';
            }


            $.ajax({
                url:"src/metas/index.php",
                type:"POST",
                data:{
                    situacao,
                    opc
                },
                success:function(dados){
                    // $("#paginaHome").html(dados);
                }
            })

        });


        $("button[delete]").click(function(){
            deletar = $(this).attr("delete");
            $.confirm({
                content:"Deseja realmente excluir o cadastro ?",
                title:false,
                buttons:{
                    'SIM':function(){
                        $.ajax({
                            url:"src/metas/index.php",
                            type:"POST",
                            data:{
                                delete:deletar
                            },
                            success:function(dados){
                                $("#paginaHome").html(dados);
                            }
                        })
                    },
                    'NÃO':function(){

                    }
                }
            });

        })

    })
</script>