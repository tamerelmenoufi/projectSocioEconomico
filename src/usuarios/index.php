<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    if($_POST['delete']){
      $query = "delete from usuarios where codigo = '{$_POST['delete']}'";
      mysqli_query($con, $query);
    }

    if($_POST['situacao']){
      $query = "update usuarios set situacao = '{$_POST['opc']}' where codigo = '{$_POST['situacao']}'";
      mysqli_query($con, $query);
      exit();
    }
?>

<div class="col">
  <div class="m-3">

    <div class="row">
      <div class="col">
        <div class="card">
          <h5 class="card-header">Lista de Usuários</h5>
          <div class="card-body">
            <div class="d-flex justify-content-between">
                <div class="input-group mb-3">
                  <label class="input-group-text" for="inputGroupFile01">Buscar por </label>
                  <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" rotulo_busca aria-expanded="false">Nome</button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" opcao_busca="Nome">Nome</a></li>
                    <li><a class="dropdown-item" href="#" opcao_busca="CPF">CPF</a></li>
                  </ul>
                  <input type="text" texto_busca class="form-control" aria-label="Digite a informação para a busca">
                  <button filtrar class="btn btn-outline-secondary" type="button">Buscar</button>
                </div>


                <button
                    novoCadastro
                    class="btn btn-success"
                    data-bs-toggle="offcanvas"
                    href="#offcanvasDireita"
                    role="button"
                    aria-controls="offcanvasDireita"
                    style="margin-left:20px;"
                >Novo</button>
            </div>


            <table class="table table-striped table-hover">
              <thead>
                <tr>
                  <th scope="col">Nome</th>
                  <th scope="col">CPF</th>
                  <th scope="col">Telefone</th>
                  <th scope="col">E-mail</th>
                  <th scope="col">Situação</th>
                  <th scope="col">Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $query = "select a.*, (select count(*) from metas where usuario = a.codigo) as metas from usuarios a order by a.nome asc";
                  $result = mysqli_query($con, $query);
                  while($d = mysqli_fetch_object($result)){
                ?>
                <tr>
                  <td><?=$d->nome?></td>
                  <td><?=$d->cpf?></td>
                  <td><?=$d->telefone?></td>
                  <td><?=$d->email?></td>
                  <td>

                  <div class="form-check form-switch">
                    <input class="form-check-input situacao" type="checkbox" <?=(($d->codigo == 1)?'disabled':false)?> <?=(($d->situacao)?'checked':false)?> usuario="<?=$d->codigo?>">
                  </div>

                  </td>
                  <td>
                    <button
                      class="btn btn-primary"
                      metas="<?=$d->codigo?>"
                    >
                      <?=$d->metas?> Meta(s)
                    </button>
                    <button
                      class="btn btn-primary"
                      edit="<?=$d->codigo?>"
                      data-bs-toggle="offcanvas"
                      href="#offcanvasDireita"
                      role="button"
                      aria-controls="offcanvasDireita"
                    >
                      Editar
                    </button>
                    <?php
                    if($d->codigo != 1){
                    ?>
                    <button class="btn btn-danger" delete="<?=$d->codigo?>">
                      Excluir
                    </button>
                    <?php
                    }
                    ?>
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
                url:"src/usuarios/form.php",
                success:function(dados){
                    $(".LateralDireita").html(dados);
                }
            })
        })

        // opcao, rotulo, texto
        $("a[opcao_busca]").click(function(){
          opc = $(this).attr("opcao_busca");
          $("button[rotulo_busca]").text(opc);
          $("input[texto_busca]").val('')
          if(opc == 'Nome'){
            $("input[texto_busca]").unmask();
          }else if(opc == 'CPF'){
            $("input[texto_busca]").mask("999.999.999-99");
          }
        });

        $("button[filtrar]").click(function(){
          opc = $("button[rotulo_busca]").text();
          busca = $("input[texto_busca]").val();
          campo = false;
          if(opc == 'Nome'){
            campo = 'nome';
          }else if(opc == 'CPF'){
            campo = 'cpf';
          }
          if(campo && busca){
            console.log(`campo:${campo} && Busca: ${busca}`);
          }

        });

        $("button[edit]").click(function(){
            cod = $(this).attr("edit");
            $.ajax({
                url:"src/usuarios/form.php",
                type:"POST",
                data:{
                  cod
                },
                success:function(dados){
                    $(".LateralDireita").html(dados);
                }
            })
        })

        $("button[metas]").click(function(){
            usuario = $(this).attr("metas");
            $.ajax({
                url:"src/metas/index.php",
                type:"POST",
                data:{
                  usuario
                },
                success:function(dados){
                    $("#paginaHome").html(dados);
                }
            })
        })

        $("button[delete]").click(function(){
            deletar = $(this).attr("delete");
            $.confirm({
                content:"Deseja realmente excluir o cadastro ?",
                title:false,
                buttons:{
                    'SIM':function(){
                        $.ajax({
                            url:"src/usuarios/index.php",
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


        $(".situacao").change(function(){

            situacao = $(this).attr("usuario");
            opc = false;

            if($(this).prop("checked") == true){
              opc = '1';
            }else{
              opc = '0';
            }


            $.ajax({
                url:"src/usuarios/index.php",
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

    })
</script>