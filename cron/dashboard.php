<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");


    $dashboard = [];
    //dados do quadro geral 
    $query = "select count(*) as qt, situacao from se where monitor_social > 0 and meta > 0 {$filtro} group by situacao";
    $result = mysqli_query($con, $query);
    while($d = mysqli_fetch_object($result)){
        $dashboard['geral']['g'] = $dashboard['geral']['g'] + $d->qt;
        $dashboard['geral'][$d->situacao] = $d->qt;
    }


    //Questionários

    $k = 0;

    function questoes($d){

        global $_SESSION;
        global $con;
        global $dashboard;
        global $VetorTeste;
        global $k;

        $filtro = $f_usuario = $f_meta = $f_data = false;
        if($_SESSION['relatorio']['usuario']){
            $f_usuario = " and a.monitor_social in( {$_SESSION['relatorio']['usuario']} ) ";
        }
        if($_SESSION['relatorio']['meta']){
            $f_meta = " and a.meta in( {$_SESSION['relatorio']['meta']} ) ";
        }else if($_SESSION['ProjectSeLogin']->perfil == 'crd'){
            $f_meta = " and a.meta in( select codigo from metas where usuario in(select codigo from usuarios where coordenador = '{$_SESSION['ProjectSeLogin']->codigo}') ) ";
        }

        if($_SESSION['relatorio']['data_inicial']){
            $f_data = " and (a.data between '{$_SESSION['relatorio']['data_inicial']} 00:00:00' and '".(($_SESSION['relatorio']['data_final'])?:$_SESSION['relatorio']['data_inicial'])." 23:59:59')";
        }

        $filtro = $f_usuario . $f_meta . $f_data;

        if($d['join']){
            $join = $d['join'];
        }
        if($d['item']){
            $item = ", {$d['item']} as item";
        }
    
        $query = "select a.{$d['campo']} as campo {$item}, a.data, a.monitor_social, a.meta from se a {$join} where a.monitor_social > 0 and a.meta > 0 {$filtro} ";
        $result = mysqli_query($con, $query);
        $t = 0;
        if(mysqli_num_rows($result)){
            while($s = mysqli_fetch_object($result)){

                if($d['tipo'] == 'json'){
                    $J = json_decode($s->campo);
                    if($J){
                        foreach($J as $i => $v){

                            $VetorTeste[] = [
                                'campo' => $d['campo'],
                                'legenda' => ((trim($v))?:'Não Informado'),
                                'data' => $d['data'],
                                'monitor_social' => $d['monitor_social'],
                                'meta' => $d['meta']
                            ];
                            
                            $d['legenda'][trim($v)] = ((trim($v))?:'Não Informado');

                            $D[$v] = ($D[$v] + 1);
                            $t = ($t + 1);
                        }
                    }
                }else{

                    if($item) {$d['legenda'][trim($s->campo)] = $s->item;}
                    else if(!$d['legenda'][$s->campo]) { $d['legenda'][trim($s->campo)] = ((trim($s->campo))?:'Não Informado'); }


                    $VetorTeste[] = [
                        'campo' => $d['campo'],
                        'legenda' => $d['legenda'][trim($s->campo)],
                        'data' => $d['data'],
                        'monitor_social' => $d['monitor_social'],
                        'meta' => $d['meta']
                    ];

                    $D[$s->campo] = ($D[$s->campo] + 1);
                    $t = ($t + 1);
                }
                
            }

            arsort($D);
            $dashboard['questionario'][$k]['rotulo'] = $d['rotulo'];
            // echo "<h5>{$d['rotulo']}</h5>";
            $w = 0;
            foreach($D as $ind => $val){
                $p = number_format($val*100/$t, 0,false,false);
                // echo "<p>{$d['legenda'][$ind]} | {$p} | {$val}</p>";
                $dashboard['questionario'][$k]['dados'][$w]['legenda'] = $d['legenda'][$ind];
                $dashboard['questionario'][$k]['dados'][$w]['percentual'] = $p;
                $dashboard['questionario'][$k]['dados'][$w]['quantidade'] = $val;
                $w++;
            }
            $k++;
        }
    }


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

    echo "<pre>";
    print_r($VetorTeste);
    echo "</pre>";

?>