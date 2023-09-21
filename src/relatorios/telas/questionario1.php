<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");


    function questoes($d){

        global $_SESSION;
        global $con;

        
?>

    <li class="list-group-item d-flex justify-content-between align-items-center">
        <div><i class="fa-solid fa-angle-right"></i> <?=$d['rotulo']?></div>
        <span class="badge bg-primary rounded-pill"><i class="fa-solid fa-chart-line"></i> Visualizar</span>
    </li>

<?php
    }

?>
<style>
    .popUpBeneficiados{
        position:fixed;
        left:0;
        top:0;
        bottom:0;
        display:none;
        background-color:#fff;
        z-index:10;
        border-right:2px solid #ccc;
    }

    .popUpBeneficiados h3.popTitle{
        position:absolute;
        left:20px;
        top:10px;
    }
    .popUpBeneficiados span.popClose{
        position:absolute;
        right:20px;
        top:15px;
        cursor:pointer;
    }
    .popUpBeneficiados div.popBody{
        position:absolute;
        left:0;
        right:0;
        bottom:0;
        top:50px;
        overflow-y:auto;
    }
    
</style>

<div class="popUpBeneficiados">
    <h3 class="popTitle">Título da Janela</h3>
    <span class="popClose">X</span>
    <div class="popBody"></div>
</div>


<div class="row" style="margin-bottom:20px;">

    <div class="row mb-3 mt-3">
        <div class="col-md-12"><h3 style="color:#a1a1a1">Relatório Estatístico das Metas</h3></div>
    </div>
    <ul class="list-group">
    <?php
        questoes([
            'rotulo' => 'Situação da Pesquisa',
            'campo' => 'situacao',
            'legenda' => [
                'i' => 'Iniciada',
                'c' => 'Concluida',
                'n' => 'Não encontrado',
                'p' => 'Pendente',
                '' => 'Não Informada',
            ]
        ]);

        questoes([
            'rotulo' => 'Municípios',
            'campo' => 'municipio',
            'join' => "left join municipios b on a.municipio = b.codigo ",
            'item' => "b.municipio"
        ]);

        questoes([
            'rotulo' => 'Bairros / Comunidades',
            'campo' => 'bairro_comunidade',
            'join' => "left join bairros_comunidades b on a.bairro_comunidade = b.codigo ",
            'item' => "b.descricao"
        ]);

        questoes([
            'rotulo' => 'Zonas',
            'campo' => 'local',
        ]);

        questoes([
            'rotulo' => 'Genéro',
            'campo' => 'genero',
        ]);

        questoes([
            'rotulo' => 'Estado Civil',
            'campo' => 'estado_civil',
        ]);

        questoes([
            'rotulo' => 'Redes Sociais',
            'campo' => 'redes_sociais',
            'tipo' => 'json' 
        ]);

        questoes([
            'rotulo' => 'Meio de Trasporte',
            'campo' => 'meio_transporte',
            'tipo' => 'json' 
        ]);

        questoes([
            'rotulo' => 'Tipo de Imóvel',
            'campo' => 'tipo_imovel',
        ]);

        questoes([
            'rotulo' => 'Tipo de Moradia',
            'campo' => 'tipo_moradia',
            'tipo' => 'json'
        ]);

        questoes([
            'rotulo' => 'Quantidade de Cômodos na Moradia',
            'campo' => 'quantidade_comodos',
        ]);

        questoes([
            'rotulo' => 'Grau de escolaridade',
            'campo' => 'grau_escolaridade',
        ]);

        questoes([
            'rotulo' => 'Cursos Profissionalizantes',
            'campo' => 'curos_profissionais',
        ]);

        questoes([
            'rotulo' => 'Interesse por novos Cursos',
            'campo' => 'intereese_curso',
        ]);

        questoes([
            'rotulo' => 'Renda Mensal',
            'campo' => 'renda_mensal',
        ]);


        questoes([
            'rotulo' => 'Renda Familiar',
            'campo' => 'renda_familiar',
        ]);

        questoes([
            'rotulo' => 'Beneficio Social',
            'campo' => 'beneficio_social',
        ]);

        questoes([
            'rotulo' => 'Serviço de Saúde',
            'campo' => 'servico_saude',
        ]);

        questoes([
            'rotulo' => 'Condições de Saúde',
            'campo' => 'condicoes_saude',
        ]);


        questoes([
            'rotulo' => 'Vacina contra o Covid-19',
            'campo' => 'vacina_covid',
        ]);

        questoes([
            'rotulo' => 'Necessita de Documentos',
            'campo' => 'necessita_documentos',
            'tipo' => 'json',
        ]);
        questoes([
            'rotulo' => 'Como você avalia o Beneficio',
            'campo' => 'avaliacao_beneficios',
        ]);
        questoes([
            'rotulo' => 'O beneficio atendido as Necessidades',
            'campo' => 'atende_necessidades',
        ]);
        questoes([
            'rotulo' => 'Opinião na Saúde',
            'campo' => 'opiniao_saude',
            'tipo' => 'json',
        ]);
        questoes([
            'rotulo' => 'Opinião na Educação',
            'campo' => 'opiniao_educacao',
        ]);

        questoes([
            'rotulo' => 'Opinião na Cidadania',
            'campo' => 'opiniao_cidadania',
        ]);

        questoes([
            'rotulo' => 'Opinião na Infraestrutura',
            'campo' => 'opiniao_infraestrutura',
            'tipo' => 'json',
        ]);

        questoes([
            'rotulo' => 'Opinião na Assistência Social',
            'campo' => 'opiniao_assistencia_social',
            'tipo' => 'json',
        ]);

        questoes([
            'rotulo' => 'Opinião nos Direitos Humanos',
            'campo' => 'opiniao_direitos_humanos',
        ]);

        questoes([
            'rotulo' => 'Opinião na Segurança',
            'campo' => 'opiniao_seguranca',
            'tipo' => 'json',
        ]);

        questoes([
            'rotulo' => 'Opinião no Esporte e Lazer',
            'campo' => 'opiniao_esporte_lazer',
            'tipo' => 'json',
        ]);

        questoes([
            'rotulo' => 'Recepção pelo Beneficiado',
            'campo' => 'recepcao_entrevistado',
        ]);

                
    ?>
    </ul>
</div>

<script>


    if( navigator.userAgent.match(/Android/i)
    || navigator.userAgent.match(/webOS/i)
    || navigator.userAgent.match(/iPhone/i)
    || navigator.userAgent.match(/iPad/i)
    || navigator.userAgent.match(/iPod/i)
    || navigator.userAgent.match(/BlackBerry/i)
    || navigator.userAgent.match(/Windows Phone/i)
    ){
        $(".popUpBeneficiados").css("width","100%")
    }
    else {
        $(".popUpBeneficiados").css("width","600px")
    }

    $(".popClose").click(function(){
        $(".popUpBeneficiados div").html('');
        $(".popUpBeneficiados h3").html('');
        $(".popUpBeneficiados").css("display","none");
    })

    $(function(){
        Carregando('none');
        $("button[campo]").click(function(){
            campo = $(this).attr("campo")
            valor = $(this).attr("valor")
            json = $(this).attr("json")
            rotulo_titulo = $(this).attr("rotulo_titulo")
            rotulo_campo = $(this).attr("rotulo_campo")
            $(".LateralDireita").html('');
            
            Carregando();
            $.ajax({
                url:"src/relatorios/telas/lista_beneficiados.php",
                type:"POST",
                data:{
                    campo,
                    valor,
                    json,
                    titulo:`${rotulo_titulo} - ${rotulo_campo}`
                },
                success:function(dados){

                    $(".popUpBeneficiados div").html(dados);
                    $(".popUpBeneficiados h3").html(`${rotulo_titulo} - ${rotulo_campo}`);
                    $(".popUpBeneficiados").css("display","block");
                    
                    // $(".LateralDireita").html(dados);
                    
                    // $.dialog({
                    //     title:`${rotulo_titulo} - ${rotulo_campo}`,
                    //     content:dados,
                    //     columnClass:'col-md-12'
                    // });
                }
            })
        });
    })
</script>