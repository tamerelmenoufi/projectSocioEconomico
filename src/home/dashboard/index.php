<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");
?>

<style>
  div[tabela]{
    overflow:auto;
  }
</style>
<div class="col">
  <div class="m-3">

    <h4>Relatórios e estatísticas</h4>

  <!-- Pesquisa de satisfação Gráficos -->
    <div class="row" style="margin-top:20px; margin-bottom:20px;">
      <div class="col-md-12">
        <div class="card">
          <h5 class="card-header">Resumo Geral</h5>
          <div class="card-body">
            <div tabela="resumo" style="width:100%;"></div>
          </div>
        </div>
      </div>
    </div>


    <!-- Pesquisa de satisfação Gráficos -->
    <div class="row" style="margin-top:20px; margin-bottom:20px;">
      <div class="col-md-6">
        <div class="card">
          <h5 class="card-header">Usuários por município</h5>
          <div class="card-body">
            <div grafico="municipio"></div>
          </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <h5 class="card-header">Tabela Bom - por Unidade</h5>
          <div class="card-body">
            <div tabela="votos_bom_unidade"></div>
          </div>
        </div>
      </div>

    </div>


  </div>
</div>







<script>
  $(function(){
    Carregando('none');

    const Graficos = (r) => {
        $.ajax({
          url:`src/home/dashboard/graficos/${r.local}.php`,
          type:"POST",
          data:{
            rotulo:r.rotulo,
            local:r.local,
          },
          success:function(dados){
            $(`div[grafico="${r.local}"]`).html(dados);
          },
          error:function(){
            console.log('Erro');
          }
        });
    }

    $("div[grafico]").each(function(){
      local = $(this).attr("grafico");
      rotulo = $(this).parent('div').parent('div').children('h5').text();
      Graficos({local, rotulo});
    })



    const Tabelas = (r) => {
        $.ajax({
          url:`src/home/dashboard/tabelas/${r.local}.php`,
          type:"POST",
          data:{
            rotulo:r.rotulo,
            local:r.local,
          },
          success:function(dados){
            $(`div[tabela="${r.local}"]`).html(dados);
          },
          error:function(){
            console.log('Erro');
          }
        });
    }

    $("div[tabela]").each(function(){
      local = $(this).attr("tabela");
      rotulo = $(this).parent('div').parent('div').children('h5').text();
      Tabelas({local, rotulo});
    })



  })
</script>