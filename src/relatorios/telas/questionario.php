<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");


    function questoes($d){
?>

<div class="card">
  <h5 class="card-header"><?=$d['rotulo']?></h5>
  <div class="card-body">
    <ul class="list-group">
<?php
    foreach($d['vetor'] as $ind => $val){
?>
        <li class="list-group-item">
            <div class="row">
                <div class="col"><?=$val[0]?></div>
                <div class="col">
                    <div class="progress">
                        <div class="progress-bar" role="progressbar" aria-valuenow="<?=$val[1]?>" aria-valuemin="0" aria-valuemax="100"><?=$val[1]?></div>
                    </div>
                </div>
                <div class="col">
                    <button class="btn btn-warning btn-sm">
                        <i class="fa fa-edit" campo="<?=$d['rotulo']?>" valor="<?=$val[0]?>"></i>
                    </button>
                </div>
            </div>
        </li>
<?php
    }
?>
    </ul>
  </div>
</div>

<?php
    }


?>
<div class="row" style="margin-bottom:20px;">


    <?php
        questoes([
            'rotulo' => 'Beneficiário encontrado?',
            'campo' => 'beneficiario_encontrado',
            'vetor' => [
                ['Sim', 90],
                ['Não', 10],                
            ],
        ])
    ?>


    <!-- <div class="form-floating mb-3">
        <?=montaRadio([
            'rotulo' => 'Beneficiário encontrado?',
            'campo' => 'beneficiario_encontrado',
            'vetor' => [
                'Sim',
                'Não',
            ],
            'dados' => $d->beneficiario_encontrado,
            'exibir' => [
                'Sim' => true,
                'Não' => false,
            ],
            'campo_destino' => 'beneficiario_encontrado_campos'
        ])?>
    </div>


    <div class="oculto" beneficiario_encontrado_campos >
        <div class="col">
            

            <div class="form-floating mb-3">
                <select disabled name="municipio" id="municipio" class="form-control" >
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
                <select disabled name="bairro_comunidade" id="bairro_comunidade" class="form-control" >
                    <option value="">::Selecione o Bairro/Comunidade</option>
                    <?php
                        $q = "select * from bairros_comunidades where municipio='{$d->municipio}' order by descricao asc";
                        $r = mysqli_query($con, $q);
                        while($s = mysqli_fetch_object($r)){
                    ?>
                    <option value="<?=$s->codigo?>" <?=(($d->bairro_comunidade == $s->codigo)?'selected':false)?>><?=$s->descricao.(($s->zona_urbana)?" ({$s->zona_urbana})":false)?></option>
                    <?php
                        }
                    ?>
                </select>
                <label for="email">Bairro / Comunidade</label>
            </div>

            <div class="form-floating mb-3">
                <select disabled name="local" id="local" class="form-control" >
                    <option value="">::Selecione a Zona</option>
                    <option value="Urbano" <?=(($d->local == 'Urbano')?'selected':false)?>>Urbano</option>
                    <option value="Rural" <?=(($d->local == 'Rural')?'selected':false)?>>Rural</option>
                </select>
                <label for="email">Zona</label>
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
                        'Não Possui',
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
                    'rotulo' => 'Tipo de Moradia:',
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
                        'Não Alfabetizado',
                        'Alfabetizado',
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

            <div class="form-floating mb-3">
                <?=montaRadio([
                    'rotulo' => 'Tem interesse em fazer algum curso?',
                    'campo' => 'intereese_curso',
                    'vetor' => [
                        'Sim',
                        'Não',
                    ],
                    'dados' => $d->intereese_curso,
                    'exibir' => [
                        'Sim'=>true,
                        'Não'=>false,
                    ],
                    'campo_destino' => 'interesse_curso_descricao',
                ])?>
            </div>
            
            <div class="form-floating mb-3">
                <?=montaRadio([
                    'rotulo' => 'Qual sua Renda Mensal?',
                    'campo' => 'renda_mensal',
                    'vetor' => [
                        'Nenhuma',
                        'abaixo de um salário mínimo',
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
                    'rotulo' => 'Renda Familiar Mensal?',
                    'campo' => 'renda_familiar',
                    'vetor' => [
                        'Nenhuma',
                        'abaixo de um salário mínimo',
                        '1 salário mínimo',
                        '2 salários mínimos',
                        '3 salários mínimos',
                        '4 salários mínimos',
                        'Acima de 4 Salários mínimos'
                    ],
                    'dados' => $d->renda_familiar,
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

            <div class="form-floating mb-3">
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
            </div>

            <div class="form-floating mb-3">
                <?=montaRadio([
                    'rotulo' => 'Condições de sua saúde?',
                    'campo' => 'condicoes_saude',
                    'vetor' => [
                        'Doenças Crônicas',
                        'Tratamentos Médicos',
                        'Outros',
                    ],
                    'dados' => $d->condicoes_saude,
                    'exibir' => false,
                    'campo_destino' => false
                ])?>
            </div>


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
                        'Mais de 4 Doses',
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
                        'Outros',
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

            <?php
                //*
            ?>
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
                        'Outros',
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

            <div class="form-floating mb-3">
                <?=montaCheckbox([
                    'rotulo' => 'Na Assistência Social?',
                    'campo' => 'opiniao_assistencia_social',
                    'vetor' => [
                        'Não Necessita',
                        'Alimentação Básica',
                        'Auxílios Governamentais',
                        'Assistência Psicológica',
                        'Outros',
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


            <div class="form-floating mb-3">
                <?=montaCheckbox([
                    'rotulo' => 'Na Segurança?',
                    'campo' => 'opiniao_seguranca',
                    'vetor' => [
                        'Não Necessita',
                        'Policiamento Ostensivo',
                        'Outros',
                    ],
                    'dados' => $d->opiniao_seguranca,
                    'exibir' => [
                        'Não Necessita'=>false,
                        'Policiamento Ostensivo'=>true,
                    ],
                    'campo_destino'=>'opiniao_seguranca_descricao'
                ])?>
            </div>
  
            <div class="form-floating mb-3">
                <?=montaCheckbox([
                    'rotulo' => 'No Esporte e Lazer?',
                    'campo' => 'opiniao_esporte_lazer',
                    'vetor' => [
                        'Não Necessita',
                        'Areas para pratica de atividades esportivas',
                        'Outros',
                    ],
                    'dados' => $d->opiniao_esporte_lazer,
                    'exibir' => [
                        'Não Necessita'=>false,
                        'Areas para pratica de atividades esportivas'=>true,
                    ],
                    'campo_destino'=>'opiniao_esporte_lazer_descricao'

                ])?>
            </div>

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
    </div> -->
</div>