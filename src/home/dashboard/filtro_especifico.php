<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");

?>

<style>

</style>


    <form id="form-<?= $md5 ?>">
        <div class="row" style="margin-bottom:50px;">
            <div class="col">

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

                <div class="form-floating mb-3">
                    <?=montaCheckbox([
                        'rotulo' => 'Na Segurança?',
                        'campo' => 'opiniao_seguranca',
                        'vetor' => [
                            'Não Necessita',
                            'Policiamento Ostensivo',
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



    })
</script>