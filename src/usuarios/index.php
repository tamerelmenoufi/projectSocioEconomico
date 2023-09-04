<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");


    function Pefil($p){
      $Perfil = [
        'adm' => 'Administrador',
        'crd' => 'Coordenador',
        'usr' => 'Usuário',
      ];
      return $Perfil[$p];
    }

    if($_POST['delete']){
      // $query = "delete from usuarios where codigo = '{$_POST['delete']}'";
      $query = "update usuarios set deletado = '1' where codigo = '{$_POST['delete']}'";
      mysqli_query($con, $query);
    }

    if($_POST['situacao']){
      $query = "update usuarios set situacao = '{$_POST['opc']}' where codigo = '{$_POST['situacao']}'";
      mysqli_query($con, $query);
      exit();
    }

    if($_POST['acao'] == 'filtro'){
      $_SESSION['usuarioBuscaCampo'] = $_POST['campo'];
      $_SESSION['usuarioBusca'] = $_POST['busca'];
    }
    if($_POST['acao'] == 'limpar'){
      $_SESSION['usuarioBuscaCampo'] = false;
      $_SESSION['usuarioBusca'] = false;      
    }

    $where = false;
    if($_SESSION['usuarioBuscaCampo'] and $_SESSION['usuarioBusca']){
      $where = " and a.{$_SESSION['usuarioBuscaCampo']} like '%{$_SESSION['usuarioBusca']}%'";
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
                  <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" rotulo_busca aria-expanded="false"><?=((!$_SESSION['usuarioBuscaCampo'] or $_SESSION['usuarioBuscaCampo'] == 'nome')?'Nome':(($_SESSION['usuarioBuscaCampo'] == 'perfil')?'Perfil':'CPF'))?></button>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" opcao_busca="Nome">Nome</a></li>
                    <li><a class="dropdown-item" href="#" opcao_busca="CPF">CPF</a></li>
                    <li><a class="dropdown-item" href="#" opcao_busca="Perfil">Perfil</a></li>
                  </ul>
                  <input type="text" texto_busca style="display:<?=(($_SESSION['usuarioBuscaCampo'] == 'perfil')?'none':'block')?>" class="form-control" value="<?=$_SESSION['usuarioBusca']?>" aria-label="Digite a informação para a busca">
                  <select busca_perfil class="form-control" style="display:<?=(($_SESSION['usuarioBuscaCampo'] != 'perfil')?'none':'block')?>">
                    <option value="adm" <?=(($_SESSION['usuarioBusca'] == 'adm')?'selected':false)?>>Administrador</option>
                    <option value="crd" <?=(($_SESSION['usuarioBusca'] == 'crd')?'selected':false)?>>Coordenador</option>
                    <option value="usr" <?=(($_SESSION['usuarioBusca'] == 'usr')?'selected':false)?>>Usuário</option>
                  </select>
                  <button filtrar class="btn btn-outline-secondary" type="button">Buscar</button>
                  <button limpar class="btn btn-outline-danger" type="button">limpar</button>
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
                  <th scope="col">Perfil</th>
                  <th scope="col">Situação</th>
                  <th scope="col">Ações</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $query = "select a.*, (select count(*) from metas where usuario = a.codigo) as metas from usuarios a where a.deletado != '1' ".(($_SESSION['ProjectSeLogin']->perfil == 'crd')?" and a.coordenador = '{$_SESSION['ProjectSeLogin']->codigo}' ":false)." {$where} order by a.nome asc";
                  $result = mysqli_query($con, $query);
                  while($d = mysqli_fetch_object($result)){
                ?>
                <tr>
                  <td><?=$d->nome?></td>
                  <td><?=$d->cpf?></td>
                  <td><?=$d->telefone?></td>
                  <td><?=$d->email?></td>
                  <td><?=Pefil($d->perfil)?></td>
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
          $("select[busca_perfil]").val('')
          if(opc == 'Nome'){
            $("input[texto_busca]").unmask();
            $("input[texto_busca]").css('display','block')
            $("select[busca_perfil]").css('display','none')
          }else if(opc == 'CPF'){
            $("input[texto_busca]").mask("999.999.999-99");
            $("input[texto_busca]").css('display','block')
            $("select[busca_perfil]").css('display','none')
          }else if(opc == 'Perfil'){
            $("input[texto_busca]").css('display','none')
            $("select[busca_perfil]").css('display','block')
          }
        });

        $("button[limpar]").click(function(){
          Carregando()
          $.ajax({
              url:"src/usuarios/index.php",
              type:"POST",
              data:{
                acao:"limpar"
              },
              success:function(dados){
                $("#paginaHome").html(dados);
              }
            });
        })

        $("button[filtrar]").click(function(){
          opc = $("button[rotulo_busca]").text();
          busca = $("input[texto_busca]").val();
          campo = false;
          if(opc == 'Nome'){
            campo = 'nome';
          }else if(opc == 'CPF'){
            campo = 'cpf';
          }else if(opc == 'Perfil'){
            campo = 'perfil';
            busca = $("select[busca_perfil]").val();
          }
          if(campo && busca){
            // console.log(`campo:${campo} && Busca: ${busca}`);
            Carregando()
            $.ajax({
              url:"src/usuarios/index.php",
              type:"POST",
              data:{
                campo,
                busca,
                acao:"filtro"
              },
              success:function(dados){
                $("#paginaHome").html(dados);
              }
            });
          }else{
            $.alert('Favor preencher o campo da busca!')
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