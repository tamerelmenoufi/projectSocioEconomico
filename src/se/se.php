<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");


    if($_POST['acao'] == 'salvar'){


        $data = $_POST;
        $attr = [];

        unset($data['codigo']);
        unset($data['acao']);
        unset($data['data_nascimento']);

        $tot = count($data);
        $qt = 0;
        foreach ($data as $name => $value) {

            if(is_array($value)) {
                $value = json_encode($value);
            }
            $qt = (($value)?($qt+1):$qt);
            $attr[] = "{$name} = '" . mysqli_real_escape_string($con, $value) . "'";
        }
            $pct = (100*$qt/$tot);
            $attr[] = "percentual = '" . $pct . "'";
            $attr[] = "data_nascimento = '" . dataMysql($_POST['data_nascimento']) . "'";
            $attr[] = "data = NOW()";
            $attr[] = "monitor_social = '{$_SESSION['ProjectSeLogin']->codigo}'";
            $attr[] = "coordenador = '{$_SESSION['ProjectSeLogin']->coordenador}'";

            if($pct == 100){
                $attr[] = "pesquisa_realizada = 'Sim'";
            }elseif($pct > 0){
                $attr[] = "pesquisa_realizada = 'Pendente'";
            }else{
                $attr[] = "pesquisa_realizada = ''";
            }


        $attr = implode(', ', $attr);

        if($_POST['codigo']){
            $query = "update se set {$attr} where codigo = '{$_POST['codigo']}'";
            mysqli_query($con, $query);
            $cod = $_POST['codigo'];
        }else{
            $query = "insert into se set data_cadastro = NOW(), {$attr}";
            mysqli_query($con, $query);
            $cod = mysqli_insert_id($con);
        }

        $retorno = [
            'status' => true,
            'codigo' => $cod,
            'mensagem' => "Pesquisa registrada com sucesso!",
            'query' => $query,
        ];

        echo json_encode($retorno);

        exit();
    }


    $query = "select * from se where codigo = '{$_POST['cod']}'";
    $result = mysqli_query($con, $query);
    $d = mysqli_fetch_object($result);
?>
<style>
    .Titulo<?=$md5?>{
        position:absolute;
        left:60px;
        top:8px;
        z-index:0;
    }
    textarea{
        height:200px !important;
    }
    .oculto{
        display:none;
    }
</style>
<h4 class="Titulo<?=$md5?>">Pesquisa Socioeconomico</h4>
    <form id="form-<?= $md5 ?>">
        <div class="row" style="margin-bottom:50px;">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome completo" value="<?=$d->nome?>">
                    <label for="nome">Nome*</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="cpf" id="cpf" class="form-control" placeholder="CPF" value="<?=$d->cpf?>">
                    <label for="cpf">CPF*</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="rg" id="rg" class="form-control" placeholder="RG" value="<?=$d->rg?>">
                    <label for="rg">RG*</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="rg_orgao" id="rg_orgao" class="form-control" placeholder="RG - Orgão Emissor" value="<?=$d->rg_orgao?>">
                    <label for="rg_orgao">RG (Orgão Emissor)*</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="data_nascimento" id="data_nascimento" class="form-control" placeholder="Ponto de Referência" value="<?=dataBr($d->data_nascimento)?>">
                    <label for="data_nascimento">Data de Nascimento</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="telefone" id="telefone" class="form-control" placeholder="telefone" value="<?=$d->telefone?>">
                    <label for="telefone">Telefone*</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="email" id="email" class="form-control" placeholder="E-mail" value="<?=$d->email?>">
                    <label for="email">E-mail*</label>
                </div>

                <div class="form-floating mb-3">
                    <select name="municipio" id="municipio" class="form-control" >
                        <option value="">::Selecione o Município</option>
                        <?php
                            $q = "select * from municipios order by municipio asc";
                            $r = mysqli_query($con, $q);
                            while($s = mysqli_fetch_object($r)){
                        ?>
                        <option value="<?=$s->codigo?>" <?=(($d->municipio == $s->codigo)?'selected':false)?>><?=$s->municipio?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <label for="email">Município</label>
                </div>



                <div class="form-floating mb-3">
                    <select name="bairro_comunidade" id="bairro_comunidade" class="form-control" >
                        <option value="">::Selecione o Bairro/Comunidade</option>
                        <?php
                            $q = "select * from bairros_comunidades where municipio='{$d->municipio}' order by descricao asc";
                            $r = mysqli_query($con, $q);
                            while($s = mysqli_fetch_object($r)){
                        ?>
                        <option value="<?=$s->codigo?>" <?=(($d->bairro_comunidade == $s->codigo)?'selected':false)?>><?=$s->descricao?></option>
                        <?php
                            }
                        ?>
                    </select>
                    <label for="email">Bairro / Comunidade</label>
                </div>

                <div class="form-floating mb-3">
                    <select name="local" id="local" class="form-control" >
                        <option value="">::Selecione a Zona</option>
                        <option value="Urbano" <?=(($d->local == 'Urbano')?'selected':false)?>>Urbano</option>
                        <option value="Rural" <?=(($d->local == 'Rural')?'selected':false)?>>Rural</option>
                    </select>
                    <label for="email">Zona</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="endereco" id="endereco" class="form-control" placeholder="Endereço" value="<?=$d->endereco?>">
                    <label for="endereco">Endereço</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="cep" id="cep" class="form-control" placeholder="CEP" value="<?=$d->cep?>">
                    <label for="cep">CEP</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="ponto_referencia" id="ponto_referencia" class="form-control" placeholder="Ponto de Referência" value="<?=$d->ponto_referencia?>">
                    <label for="ponto_referencia">Ponto de Referência</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Genero?',
                        'campo' => 'genero',
                        'vetor' => [
                            'Masculino',
                            'Feminino',
                        ],
                        'dados' => $d->genero,
                        'exibir' => false,
                        'campo_destino' => false
                    ])?>
                </div>

                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Qual o seu Estado Civil?',
                        'campo' => 'estado_civil',
                        'vetor' => [
                            'Solteiro',
                            'Casado',
                            'Divorciado',
                            'Viúvo',
                            'Outros',
                        ],
                        'dados' => $d->estado_civil,
                        'exibir' => false,
                        'campo_destino' => false
                    ])?>
                </div>


                <div class="form-floating mb-3">
                    <?=montaCheckbox([
                        'rotulo' => 'Quais Redes Sociais você possui?',
                        'campo' => 'redes_sociais',
                        'vetor' => [
                            'FaceBook',
                            'Twitter',
                            'Instagram',
                            'Youtube',
                            'Linkedin'
                        ],
                        'dados' => $d->redes_sociais,
                        'exibir' => false,
                        'campo_destino' => false
                    ])?>
                </div>

                <div class="form-floating mb-3">
                    <?=montaCheckbox([
                        'rotulo' => 'Qual é o principal meio de transporte utilizado?',
                        'campo' => 'meio_transporte',
                        'vetor' => [
                            'A Pé',
                            'Bicicleta',
                            'Moto',
                            'Ônibus',
                            'Carro próprio',
                            'Fluvial',
                            'Outros'
                        ],
                        'dados' => $d->meio_transporte,
                        'exibir' => false,
                        'campo_destino' => false
                    ])?>
                </div>


                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Você reside em Imóvel:',
                        'campo' => 'tipo_imovel',
                        'vetor' => [
                            'Própria',
                            'Emprestado/Cedido',
                            'Financiado',
                            'Invasão',
                            'Alugado',
                            'Outros',
                        ],
                        'dados' => $d->tipo_imovel,
                        'exibir' => false,
                        'campo_destino' => false
                    ])?>
                </div>

                <div class="form-floating mb-3">
                    <?=montaCheckbox([
                        'rotulo' => 'Tipos de Moradia:',
                        'campo' => 'tipo_moradia',
                        'vetor' => [
                            'Madeira',
                            'Alvenaria',
                            'Palafita',
                            'Flutuante',
                            'Apartamento',
                            'Outros',
                        ],
                        'dados' => $d->tipo_moradia,
                        'exibir' => false,
                        'campo_destino' => false
                    ])?>
                </div>

                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Quantos Cômodos possui sua residência?',
                        'campo' => 'quantidade_comodos',
                        'vetor' => [
                            '1 Cômodo',
                            '2 Cômodos',
                            '3 Cômodos',
                            '4 Cômodos',
                            'Mais de 4 Cômodos',
                        ],
                        'dados' => $d->quantidade_comodos,
                        'exibir' => false,
                        'campo_destino' => false
                    ])?>
                </div>

                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Qual o seu Grau de escolaridade?',
                        'campo' => 'grau_escolaridade',
                        'vetor' => [
                            'Ensino Fundamental I Completo',
                            'Ensino Fundamental II Completo',
                            'Ensino Médio Completo',
                            'Ensino Técnico/Profissionalizante',
                            'Ensino Superior Completo',
                        ],
                        'dados' => $d->grau_escolaridade,
                        'exibir' => false,
                        'campo_destino' => false
                    ])?>
                </div>

                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Você possui algum Curso Técnico/Profissionalizante?',
                        'campo' => 'curos_profissionais',
                        'vetor' => [
                            'Sim',
                            'Não',
                        ],
                        'dados' => $d->curos_profissionais,
                        'exibir' => [
                            'Sim'=>true,
                            'Não'=>false,
                        ],
                        'campo_destino' => 'curos_profissionais_descricao',
                    ])?>
                </div>
                <div class="oculto" curos_profissionais_descricao>
                    <div class="form-floating mb-3">
                        <textarea name="curos_profissionais_descricao" id="curos_profissionais_descricao" class="form-control" placeholder="Cursos Técnico/Profissionalizante" ><?=$d->curos_profissionais_descricao?></textarea>
                        <label for="curos_profissionais_descricao">Descreve os Cursos Técnico/Profissionalizante</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Qual sua Renda Mensal?',
                        'campo' => 'renda_mensal',
                        'vetor' => [
                            'Nenhuma',
                            '1 salário mínimo',
                            '2 salários mínimos',
                            '3 salários mínimos',
                            '4 salários mínimos',
                            'Acima de 4 Salários mínimos'
                        ],
                        'dados' => $d->renda_mensal,
                        'exibir' => false,
                        'campo_destino' => false
                    ])?>
                </div>

                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Você possui algum Benefício Social?',
                        'campo' => 'beneficio_social',
                        'vetor' => [
                            'Sim',
                            'Não',
                        ],
                        'dados' => $d->beneficio_social,
                        'exibir'=>[
                            'Sim'=>true,
                            'Não'=>false,
                        ],
                        'campo_destino'=>'beneficio_social_descricao',
                    ])?>
                </div>
                <div class="oculto" beneficio_social_descricao>
                    <div class="form-floating mb-3">
                        <textarea name="beneficio_social_descricao" id="beneficio_social_descricao" class="form-control" placeholder="Descrição do Benefício Social" ><?=$d->beneficio_social_descricao?></textarea>
                        <label for="beneficio_social_descricao">Descrição do Benefício Social</label>
                    </div>
                </div>


                <!-- <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Qual Serviço de Saúde você utiliza?',
                        'campo' => 'servico_saude',
                        'vetor' => [
                            'SUS',
                            'Associações/PlanodeSaúde',
                            'Outros',
                        ],
                        'dados' => $d->servico_saude,
                        'exibir' => false,
                        'campo_destino' => false
                    ])?>
                </div> -->


                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Já tomou a vacina contra o Covid-19? Quantas doses já tomou?',
                        'campo' => 'vacina_covid',
                        'vetor' => [
                            'Não',
                            '1a Dose',
                            '2a Dose',
                            '3a Dose',
                            '4a Dose',
                        ],
                        'dados' => $d->vacina_covid,
                        'exibir' => false,
                        'campo_destino' => false
                    ])?>
                </div>



                <div class="form-floating mb-3">
                    <?=montaCheckbox([
                        'rotulo' => 'Necessita de Documentos',
                        'campo' => 'necessita_documentos',
                        'vetor' => [
                            'Não',
                            'RCN', // - Registro Civil de Nascimento
                            'RCC', // -
                            'RG', // - Registro Geral
                            'CPF', //- Cadastro de Pessoa Física
                            'CTPS', // - Carteira de Trabalho e Previdencia Social
                            'TE', //- Título Eleitoral
                        ],
                        'dados' => $d->necessita_documentos,
                        'exibir' => false,
                        'campo_destino' => false
                    ])?>
                </div>




                    <!-- XXXXXXXXXXXXXXXXXXXXXXXX -->



                    <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Como você avalia o Beneficio?',
                        'campo' => 'avaliacao_beneficios',
                        'vetor' => [
                           'Ruim',
                            'Bom',
                            'Ótimo',
                        ],
                        'dados' => $d->avaliacao_beneficios,
                        'exibir' => [
                            'Ruim'=>true,
                            'Bom'=>true,
                            'Ótimo'=>true,
                        ],
                        'campo_destino'=>'avaliacao_beneficios_descricao'
                    ])?>
                </div>
                <div class='oculto' avaliacao_beneficios_descricao>
                    <div class="form-floating mb-3">
                        <textarea name="avaliacao_beneficios_descricao" id="avaliacao_beneficios_descricao" class="form-control" placeholder="Descrição da Avaliação do Benefício" ><?=$d->avaliacao_beneficios_descricao?></textarea>
                        <label for="avaliacao_beneficios_descricao">Descrição de sua Avaliação do Benefício</label>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'O beneficio tem atendido suas Necessidades?',
                        'campo' => 'atende_necessidades',
                        'vetor' => [
                           'Sim',
                            'Não',
                        ],
                        'dados' => $d->atende_necessidades,
                        'exibir' => [
                           'Sim'=>true,
                            'Não'=>true,
                        ],
                        'campo_destino'=>'atende_necessidades_descricao'
                    ])?>

                </div>
                <div class="oculto" atende_necessidades_descricao>
                    <div class="form-floating mb-3">
                        <textarea name="atende_necessidades_descricao" id="atende_necessidades_descricao" class="form-control" placeholder="Descrição de Benefício que atende ou não as Necessidades" ><?=$d->atende_necessidades_descricao?></textarea>
                        <label for="atende_necessidades_descricao">Descrição de Benefício que atende ou não as Necessidades</label>
                    </div>
                </div>
                <!-- XXXXXXXXXXXXXXXXXXXXXXXX -->


                <div class="form-floating mb-3">
                    <p><b>Na sua opinião dentro da estrutura do governo, em qual área abaixo descrita, necessita de melhorias para desenvolvimento na qualidade de vida da sua família e/ou da sua comunidade:</b></p>
                </div>
                <div class="form-floating mb-3">
                    <?=montaCheckbox([
                        'rotulo' => 'Na Saúde?',
                        'campo' => 'opiniao_saude',
                        'vetor' => [
                            'Não Necessita',
                            'Acesso a Medicamentos',
                            'Marcação de Consultas',
                            'Realização de Exames',
                            'Realização de Procedimentos Médicos e/ou Cirurgia',
                        ],
                        'dados' => $d->opiniao_saude,
                        'exibir' => [
                            'Não Necessita'=>false,
                            'Acesso a Medicamentos'=>true,
                            'Marcação de Consultas'=>true,
                            'Realização de Exames'=>true,
                            'Realização de Procedimentos Médicos e/ou Cirurgia'=>true,
                         ],
                         'campo_destino'=>'opiniao_saude_descricao'
                    ])?>
                </div>
                <div class="oculto" opiniao_saude_descricao>
                    <div class="form-floating mb-3">
                        <textarea name="opiniao_saude_descricao" id="opiniao_saude_descricao" class="form-control" placeholder="Outras Opiniões / Detalhes" ><?=$d->opiniao_saude_descricao?></textarea>
                        <label for="opiniao_saude_descricao">Desreva suas Opiniões Falhas na Saúde</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Na Educação?',
                        'campo' => 'opiniao_educacao',
                        'vetor' => [
                            'Não Necessita',
                            'Sim Necessita'
                        ],
                        'dados' => $d->opiniao_educacao,
                        'exibir' => [
                            'Não Necessita'=>false,
                            'Sim Necessita'=>true
                         ],
                         'campo_destino'=>'opiniao_educacao_descricao'
                    ])?>
                </div>
                <div class="oculto" opiniao_educacao_descricao>
                    <div class="form-floating mb-3">
                        <textarea name="opiniao_educacao_descricao" id="opiniao_educacao_descricao" class="form-control" placeholder="Outras Opiniões falhas na Educação" ><?=$d->opiniao_educacao_descricao?></textarea>
                        <label for="opiniao_educacao_descricao">Desreva suas Opiniões falhas na Educação</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Na Cidadania?',
                        'campo' => 'opiniao_cidadania',
                        'vetor' => [
                            'Não Nacessita',
                            'Sim Necessita'
                        ],
                        'dados' => $d->opiniao_cidadania,
                        'exibir' => [
                            'Não Nacessita'=>false,
                            'Sim Necessita'=>true
                         ],
                         'campo_destino'=>'opiniao_cidadania_descricao'
                    ])?>
                </div>
                <div class="oculto" opiniao_cidadania_descricao>
                    <div class="form-floating mb-3">
                        <textarea name="opiniao_cidadania_descricao" id="opiniao_cidadania_descricao" class="form-control" placeholder="Outras Opiniões falhas na Cidadania" ><?=$d->opiniao_cidadania_descricao?></textarea>
                        <label for="opiniao_cidadania_descricao">Desreva suas Opiniões falhas na Cidadania</label>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <?=montaCheckbox([
                        'rotulo' => 'Na Infraestrutura?',
                        'campo' => 'opiniao_infraestrutura',
                        'vetor' => [
                            'Não Necessita',
                            'Má Iluminação',
                            'Ausência de Asfalto e/ou Precariedade',
                            'Falta de Saneamento básico e/ou Melhoria',
                            'Abastecimento de Água',
                            'Abastecimento de Energia',
                        ],
                        'dados' => $d->opiniao_infraestrutura,
                        'exibir' => [
                            'Não Necessita'=>false,
                            'Má Iluminação'=>true,
                            'Ausência de Asfalto e/ou Precariedade'=>true,
                            'Falta de Saneamento básico e/ou Melhoria'=>true,
                            'Abastecimento de Água'=>true,
                            'Abastecimento de Energia'=>true,
                         ],
                         'campo_destino'=>'opiniao_infraestrutura_descricao'
                    ])?>
                </div>
                <div class="oculto" opiniao_infraestrutura_descricao>
                    <div class="form-floating mb-3">
                        <textarea name="opiniao_infraestrutura_descricao" id="opiniao_infraestrutura_descricao" class="form-control" placeholder="Outras Opiniões falhas na Infraestrutura" ><?=$d->opiniao_infraestrutura_descricao?></textarea>
                        <label for="opiniao_infraestrutura_descricao">Desreva suas Opiniões falhas na Infraestrutura</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <?=montaCheckbox([
                        'rotulo' => 'Na Assistência Social?',
                        'campo' => 'opiniao_assistencia_social',
                        'vetor' => [
                            'Não Necessita',
                            'Alimentação Básica',
                            'Auxílios Governamentais',
                            'Assistência Psicológica',
                        ],
                        'dados' => $d->opiniao_assistencia_social,
                        'exibir' => [
                            'Não Necessita'=>false,
                            'Alimentação Básica'=>true,
                            'Auxílios Governamentais'=>true,
                            'Assistência Psicológica'=>true,
                         ],
                         'campo_destino'=>'opiniao_assistencia_social_descricao'
                    ])?>
                </div>
                <div class="oculto" opiniao_assistencia_social_descricao>
                    <div class="form-floating mb-3">
                        <textarea name="opiniao_assistencia_social_descricao" id="opiniao_assistencia_social_descricao" class="form-control" placeholder="Outras Opiniões falhas na Assistência Social" ><?=$d->opiniao_assistencia_social_descricao?></textarea>
                        <label for="opiniao_assistencia_social_descricao">Desreva suas Opiniões falhas na Assistência Social</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Nos Direitos Humanos?',
                        'campo' => 'opiniao_direitos_humanos',
                        'vetor' => [
                            'Não Necessita',
                            'Sim Necessita'
                        ],
                        'dados' => $d->opiniao_direitos_humanos,
                        'exibir' => [
                            'Não Necessita'=>false,
                            'Sim Necessita'=>true
                         ],
                         'campo_destino'=>'opiniao_direitos_humanos_descricao'
                    ])?>
                </div>
                <div class="oculto" opiniao_direitos_humanos_descricao>
                    <div class="form-floating mb-3">
                        <textarea name="opiniao_direitos_humanos_descricao" id="opiniao_direitos_humanos_descricao" class="form-control" placeholder="Outras Opiniões falhas na Direitos Humanos" ><?=$d->opiniao_direitos_humanos_descricao?></textarea>
                        <label for="opiniao_direitos_humanos_descricao">Desreva suas Opiniões falhas na Direitos Humanos</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <?=montaCheckbox([
                        'rotulo' => 'Na Segurança?',
                        'campo' => 'opiniao_seguranca',
                        'vetor' => [
                            'Não Necessita',
                            'Atendimento de Chamado para Policiamento',
                        ],
                        'dados' => $d->opiniao_seguranca,
                        'exibir' => [
                            'Não Necessita'=>false,
                            'Atendimento de Chamado para Policiamento'=>true,
                         ],
                         'campo_destino'=>'opiniao_seguranca_descricao'
                    ])?>
                </div>
                <div class="oculto" opiniao_seguranca_descricao>
                    <div class="form-floating mb-3">
                        <textarea name="opiniao_seguranca_descricao" id="opiniao_seguranca_descricao" class="form-control" placeholder="Outras Opiniões falhas na Segurança" ><?=$d->opiniao_seguranca_descricao?></textarea>
                        <label for="opiniao_seguranca_descricao">Desreva suas Opiniões falhas na Segurança</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <?=montaCheckbox([
                        'rotulo' => 'No Esporte e Lazer?',
                        'campo' => 'opiniao_esporte_lazer',
                        'vetor' => [
                            'Não Necessita',
                            'Areas para pratica de atividades esportivas',
                        ],
                        'dados' => $d->opiniao_esporte_lazer,
                        'exibir' => [
                            'Não Necessita'=>false,
                            'Areas para pratica de atividades esportivas'=>true,
                         ],
                         'campo_destino'=>'opiniao_esporte_lazer_descricao'

                    ])?>
                </div>
                <div class="oculto" opiniao_esporte_lazer_descricao>
                    <div class="form-floating mb-3">
                        <textarea name="opiniao_esporte_lazer_descricao" id="opiniao_esporte_lazer_descricao" class="form-control" placeholder="Outras Opiniões falhas no Esporte e Lazer" ><?=$d->opiniao_esporte_lazer_descricao?></textarea>
                        <label for="opiniao_esporte_lazer_descricao">Outras Opiniões falhas no Esporte e Lazer</label>
                    </div>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="opiniao_outros" id="opiniao_outros" class="form-control" placeholder="Outras Opiniões / Detalhes" ><?=$d->opiniao_outros?></textarea>
                    <label for="opiniao_outros">Desreva suas Opiniões / Detalhes</label>
                </div>

                <div class="card border-warning">
                    <h5 class="card-header">Avaliação do Técnico</h5>
                    <div class="card-body">
                        <div class="form-floating mb-3">
                            <?=montaRadio([
                                'rotulo' => 'Como fui Recebido?',
                                'campo' => 'recepcao_entrevistado',
                                'vetor' => [
                                    'Ruim',
                                    'Bom',
                                    'Ótimo',
                                ],
                                'dados' => $d->recepcao_entrevistado,
                                'exibir' => false,
                                'campo_destino' => false
                            ])?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div style="position:absolute; bottom:0;left:0; right:20px; height:50px; padding-right:10px; background-color:#fff;">
            <div style="display:flex; justify-content:end">
                <button
                    type="submit"
                    SalvarFoto
                    class="btn btn-success btn-ms"
                    data-bs-toggle="offcanvas"
                    href="#offcanvasDireita"
                    role="button"
                    aria-controls="offcanvasDireita"
                >Salvar</button>
                <input type="hidden" id="codigo" value="<?=$_POST['cod']?>" />
            </div>
        </div>

    </form>

    <script>
        $(function(){

            Carregando('none');

            $("#cpf").mask('999.999.999-99');
            $("#telefone").mask('(99) 99999-9999');
            $("#cep").mask('99999-999');
            $("#data_nascimento").mask('99/99/9999');

            $('#form-<?=$md5?>').submit(function (e) {

                e.preventDefault();

                $(".oculto").remove();


                var codigo = $('#codigo').val();
                var campos = $(this).serializeArray();

                if (codigo) {
                    campos.push({name: 'codigo', value: codigo})
                }

                campos.push({name: 'acao', value: 'salvar'})
                console.log(campos)
                Carregando();

                $.ajax({
                    url:"src/se/se.php",
                    type:"POST",
                    dataType:"JSON",
                    data: campos,
                    success:function(dados){
                        $.alert('Dados atualizados com sucesso!');
                        Carregando('none');
                    },
                    error:function(erro){

                        // $.alert('Ocorreu um erro!' + erro.toString());
                        //dados de teste
                    }
                });

            });


            $("input[exibir]").parent("div").parent("div").children("div").children("input[exibir]").each(function(){
                if($(this).prop("checked") == true){
                    $(`div[${$(this).attr('exibir')}]`).removeClass("oculto");
                }
            })

            $("input[exibir]").click(function(){

                if($(this).attr("type") == 'checkbox' && $(this).prop("checked") == true){

                    $(this).parent("div").parent("div").children("div").children("input[ocultar]").each(function(){
                        $(this).prop("checked",false);
                    })
                }

                if($(this).attr('exibir')){
                    if($(this).prop("checked") == true){
                        // $(`div[${$(this).attr('exibir')}]`).css("display","block");
                        $(`div[${$(this).attr('exibir')}]`).removeClass("oculto");
                    }
                }

                obj = $(`div[${$(this).attr('exibir')}]`);
                // obj.css("display","none");
                obj.addClass("oculto");

                $(this).parent("div").parent("div").children("div").children("input[exibir]").each(function(){
                    if($(this).prop("checked") == true){
                        // obj.css("display","block");
                        obj.removeClass("oculto");
                    }
                })

            })

            $("input[ocultar]").click(function(){

                if($(this).attr("type") == 'checkbox' && $(this).prop("checked") == true){
                    $(this).parent("div").parent("div").children("div").children("input[exibir]").each(function(){
                        $(this).prop("checked",false);
                    })
                }

                if($(this).prop("checked") == true){
                    // $(`div[${$(this).attr('ocultar')}]`).css("display","none");
                    if($(this).attr('ocultar')){
                        $(`div[${$(this).attr('ocultar')}]`).addClass("oculto");
                    }
                }

            })

        })
    </script>