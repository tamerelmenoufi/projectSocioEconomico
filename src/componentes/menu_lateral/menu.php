<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");
?>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <img src="img/logo_h.png" style="height:60px;" alt="">
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <h5>Project Map Censo - AADESAM</h5>

    <div class="row mb-1">
      <div class="col">
        <a url="src/dashboard/index.php" class="text-decoration-none" data-bs-dismiss="offcanvas" aria-label="Close">
          <i class="fa-solid fa-clipboard-list"></i> Dashboard
        </a>
      </div>
    </div>

    <div class="row mb-1">
      <div class="col">
        <a url="src/usuarios/index.php" class="text-decoration-none" data-bs-dismiss="offcanvas" aria-label="Close">
          <i class="fa-solid fa-clipboard-list"></i> Usuários do Sistema
        </a>
      </div>
    </div>

    <div class="row mb-1">
      <div class="col">
        <a url="src/se/index.php" class="text-decoration-none" data-bs-dismiss="offcanvas" aria-label="Close">
          <i class="fa-solid fa-clipboard-list"></i> Beneficiários
        </a>
      </div>
    </div>


    <div class="row mb-1">
      <div class="col">
        <a href="./docs/form-se.pdf" target="formSocioEconimico" class="text-decoration-none">
          <i class="fa-solid fa-list-ol"></i> Formulário Socioeconômico
        </a>
      </div>
    </div>

    <div class="row mb-1">
      <div class="col">
        <a href="./docs/form-ef.pdf" target="formEstruturaFamiliar" class="text-decoration-none">
          <i class="fa-solid fa-list-ol"></i> Formulário Estrutura Familiar
        </a>
      </div>
    </div>

    <div class="row mb-1" style="opacity:0">
      <div class="col">
        <a url="src/dashboard/index.php" class="text-decoration-none" data-bs-dismiss="offcanvas" aria-label="Close">
          <i class="fa-solid fa-clipboard-list"></i> Novo Dashboard
        </a>
      </div>
    </div>

    <!-- <div class="row mb-1">
      <div class="col">
        <a href="./print.php?u=<?=base64_encode("src/se/se_print.php")?>" target="formSocioEconimico" class="text-decoration-none">
          <i class="fa-solid fa-list-ol"></i> Formulário Socioeconômico
        </a>
      </div>
    </div>

    <div class="row mb-1">
      <div class="col">
        <a href="./print.php?u=<?=base64_encode("src/se/ef_print.php")?>" target="formEstruturaFamiliar" class="text-decoration-none">
          <i class="fa-solid fa-list-ol"></i> Formulário Estrutura Familiar
        </a>
      </div>
    </div> -->

  </div>
</div>

<script>
  $(function(){
    $("a[url]").click(function(){
      Carregando();
      url = $(this).attr("url");
      $.ajax({
        url,
        success:function(dados){
          $("#paginaHome").html(dados);
        }
      });
    });
  })
</script>