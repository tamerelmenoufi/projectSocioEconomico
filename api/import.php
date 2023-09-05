<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

    function preparaJson($d){

        $D = explode(",",$d);
        return '["'.implode('","', $D).'"]';

    }


    if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST))
    $_POST = json_decode(file_get_contents('php://input'), true);
 
    if(!is_dir('logs')) mkdir('logs');

    echo 'success';

    file_put_contents('logs/'.date("YmdHis").".txt", print_r($_POST, true));


    foreach($_POST['dados'] as $ind => $val){

        $data = $val;
        unset($data['municipio']);
        unset($data['bairro_comunidade']);
        unset($data['local']);
        unset($data['zona_urbana']);
        unset($data['coordenadas']);
        unset($data['codigo']);
        $data['data_nascimento'] = dataMysql($data['data_nascimento']);


        $data['redes_sociais'] = preparaJson($data['redes_sociais']);
        $data['meio_transporte'] = preparaJson($data['meio_transporte']);
        $data['tipo_moradia'] = preparaJson($data['tipo_moradia']);
        $data['necessita_documentos'] = preparaJson($data['necessita_documentos']);
        $data['opiniao_saude'] = preparaJson($data['opiniao_saude']);
        $data['opiniao_infraestrutura'] = preparaJson($data['opiniao_infraestrutura']);
        $data['opiniao_assistencia_social'] = preparaJson($data['opiniao_assistencia_social']);
        $data['opiniao_seguranca'] = preparaJson($data['opiniao_seguranca']);
        $data['opiniao_esporte_lazer'] = preparaJson($data['opiniao_esporte_lazer']);

        $data['data'] = date("Y-m-d H:i:s");
        $codigo = $val['codigo'];

        $campos = [];
        foreach($data as $i => $v){
            if($i == 'beneficiario_encontrado'){
                if($data['situacao'] == 'n'){
                    $data['beneficiario_encontrado'] = 'Não';
                }else{
                    $campos[] = "{$i} = '{$v}'";
                }
            }else{
                $campos[] = "{$i} = '{$v}'";
            }
            
        }

        $comando = "UPDATE se set ".implode(", ", $campos)." where codigo = '{$codigo}'";

        mysqli_query($con, $comando);

        file_put_contents('logs/comando-'.date("YmdHis").".txt", $comando);


    }