<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");
?>
<style>
    div[textarea]{
        height:200px !important;
    }
</style>

<div class="container">
<h4 class="Titulo<?=$md5?>">Pesquisa Socioeconomico</h4>

    <div class="row" style="margin-bottom:50px;">
            <div class="col">
                <div class="row">
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <div type="text" class="form-control" id="nome" name="nome" placeholder="Nome completo" value="<?=$d->nome?>"></div>
                            <label for="nome">Nome*</label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-floating mb-3">
                            <div type="text" name="cpf" id="cpf" class="form-control" placeholder="CPF" value="<?=$d->cpf?>"></div>
                            <label for="cpf">CPF*</label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-floating mb-3">
                            <div type="text" name="cpf" id="cpf" class="form-control" placeholder="CPF" value="<?=$d->cpf?>"></div>
                            <label for="cpf">RG/Orgão Emissor*</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-floating mb-3">
                            <div type="text" class="form-control" id="nome" name="nome" placeholder="Nome completo" value="<?=$d->nome?>"></div>
                            <label for="nome">Telefone*</label>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="form-floating mb-3">
                            <div type="text" name="cpf" id="cpf" class="form-control" placeholder="CPF" value="<?=$d->cpf?>"></div>
                            <label for="cpf">E-mail*</label>
                        </div>
                    </div>
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
                        'dados' => $d->redes_sociais
                    ])?>
                </div>

                <div class="form-floating mb-3">
                    <div type="text" name="email" id="email" class="form-control" placeholder="E-mail" value="<?=$d->email?>"></div>
                    <label for="email">Município</label>
                </div>



                <div class="form-floating mb-3">
                    <div type="text" name="email" id="email" class="form-control" placeholder="E-mail" value="<?=$d->email?>"></div>
                    <label for="email">Bairro / Comunidade</label>
                </div>

                <div class="form-floating mb-3">
                    <div type="text" name="email" id="email" class="form-control" placeholder="E-mail" value="<?=$d->email?>"></div>
                    <label for="email">Zona</label>
                </div>

                <div class="form-floating mb-3">
                    <div type="text" name="endereco" id="endereco" class="form-control" placeholder="Endereço" value="<?=$d->endereco?>"></div>
                    <label for="endereco">Endereço</label>
                </div>

                <div class="form-floating mb-3">
                    <div type="text" name="cep" id="cep" class="form-control" placeholder="CEP" value="<?=$d->cep?>"></div>
                    <label for="cep">CEP</label>
                </div>

                <div class="form-floating mb-3">
                    <div type="text" name="ponto_referencia" id="ponto_referencia" class="form-control" placeholder="Ponto de Referência" value="<?=$d->ponto_referencia?>"></div>
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
                        'dados' => $d->genero
                    ])?>
                </div>


                <div class="form-floating mb-3">
                    <div type="text" name="data_nascimento" id="data_nascimento" class="form-control" placeholder="Ponto de Referência" value="<?=dataBr($d->data_nascimento)?>"></div>
                    <label for="data_nascimento">Data de Nascimento</label>
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
                        'dados' => $d->estado_civil
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
                        'dados' => $d->meio_transporte
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
                        'dados' => $d->tipo_imovel
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
                        'dados' => $d->tipo_moradia
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
                        'dados' => $d->quantidade_comodos
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
                        'dados' => $d->grau_escolaridade
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
                        'dados' => $d->curos_profissionais
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <div textarea name="curos_profissionais_descricao" id="curos_profissionais_descricao" class="form-control" placeholder="Cursos Técnico/Profissionalizante" ><?=$d->curos_profissionais_descricao?></div>
                    <label for="curos_profissionais_descricao">Descreve os Cursos Técnico/Profissionalizante</label>
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
                        'dados' => $d->renda_mensal
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
                        'dados' => $d->beneficio_social
                    ])?>
                </div>

                <div class="form-floating mb-3">
                    <div textarea name="beneficio_social_descricao" id="beneficio_social_descricao" class="form-control" placeholder="Descrição do Benefício Social" ><?=$d->beneficio_social_descricao?></div>
                    <label for="beneficio_social_descricao">Descrição do Benefício Social</label>
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
                        'dados' => $d->servico_saude
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
                        'dados' => $d->vacina_covid
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
                        'dados' => $d->necessita_documentos
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
                        'dados' => $d->avaliacao_beneficios
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <div textarea name="avaliacao_beneficios_descricao" id="avaliacao_beneficios_descricao" class="form-control" placeholder="Descrição da Avaliação do Benefício" ><?=$d->avaliacao_beneficios_descricao?></div>
                    <label for="avaliacao_beneficios_descricao">Descrição de sua Avaliação do Benefício</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'O beneficio tem atendido suas Necessidades?',
                        'campo' => 'atende_necessidades',
                        'vetor' => [
                           'Sim',
                            'Não',
                        ],
                        'dados' => $d->atende_necessidades
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <div textarea name="atende_necessidades_descricao" id="atende_necessidades_descricao" class="form-control" placeholder="Descrição de Benefício que atende ou não as Necessidades" ><?=$d->atende_necessidades_descricao?></div>
                    <label for="atende_necessidades_descricao">Descrição de Benefício que atende ou não as Necessidades</label>
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
                            'Acesso a Medicamentos',
                            'Marcação de Consultas',
                            'Realização de Exames',
                            'Realização de Procedimentos Médicos e/ou Cirurgia',
                        ],
                        'dados' => $d->opiniao_saude
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <div textarea name="opiniao_saude_descricao" id="opiniao_saude_descricao" class="form-control" placeholder="Outras Opiniões / Detalhes" ><?=$d->opiniao_saude_descricao?></div>
                    <label for="opiniao_saude_descricao">Desreva suas Opiniões Falhas na Saúde</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Na Educação?',
                        'campo' => 'opiniao_educacao',
                        'vetor' => [
                            'Não',
                            'Sim'
                        ],
                        'dados' => $d->opiniao_educacao
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <div textarea name="opiniao_educacao_descricao" id="opiniao_educacao_descricao" class="form-control" placeholder="Outras Opiniões falhas na Educação" ><?=$d->opiniao_educacao_descricao?></div>
                    <label for="opiniao_educacao_descricao">Desreva suas Opiniões falhas na Educação</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Na Cidadania?',
                        'campo' => 'opiniao_cidadania',
                        'vetor' => [
                            'Não',
                            'Sim'
                        ],
                        'dados' => $d->opiniao_cidadania
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <div textarea name="opiniao_cidadania_descricao" id="opiniao_cidadania_descricao" class="form-control" placeholder="Outras Opiniões falhas na Cidadania" ><?=$d->opiniao_cidadania_descricao?></div>
                    <label for="opiniao_cidadania_descricao">Desreva suas Opiniões falhas na Cidadania</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaCheckbox([
                        'rotulo' => 'Na Infraestrutura?',
                        'campo' => 'opiniao_infraestrutura',
                        'vetor' => [
                            'Má Iluminação',
                            'Ausência de Asfalto e/ou Precariedade',
                            'Falta de Saneamento básico e/ou Melhoria',
                            'Abastecimento de Água',
                            'Abastecimento de Energia',
                        ],
                        'dados' => $d->opiniao_infraestrutura
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <div textarea name="opiniao_infraestrutura_descricao" id="opiniao_infraestrutura_descricao" class="form-control" placeholder="Outras Opiniões falhas na Infraestrutura" ><?=$d->opiniao_infraestrutura_descricao?></div>
                    <label for="opiniao_infraestrutura_descricao">Desreva suas Opiniões falhas na Infraestrutura</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaCheckbox([
                        'rotulo' => 'Na Assistência Social?',
                        'campo' => 'opiniao_assistencia_social',
                        'vetor' => [
                            'Alimentação Básica',
                            'Auxílios Governamentais',
                            'Assistência Psicológica',
                        ],
                        'dados' => $d->opiniao_assistencia_social
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <div textarea name="opiniao_assistencia_social_descricao" id="opiniao_assistencia_social_descricao" class="form-control" placeholder="Outras Opiniões falhas na Assistência Social" ><?=$d->opiniao_assistencia_social_descricao?></div>
                    <label for="opiniao_assistencia_social_descricao">Desreva suas Opiniões falhas na Assistência Social</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Nos Direitos Humanos?',
                        'campo' => 'opiniao_direitos_humanos',
                        'vetor' => [
                            'Não',
                            'Sim'
                        ],
                        'dados' => $d->opiniao_direitos_humanos
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <div textarea name="opiniao_direitos_humanos_descricao" id="opiniao_direitos_humanos_descricao" class="form-control" placeholder="Outras Opiniões falhas na Direitos Humanos" ><?=$d->opiniao_direitos_humanos_descricao?></div>
                    <label for="opiniao_direitos_humanos_descricao">Desreva suas Opiniões falhas na Direitos Humanos</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaCheckbox([
                        'rotulo' => 'Na Segurança?',
                        'campo' => 'opiniao_seguranca',
                        'vetor' => [
                            'Atendimento de Chamado para Policiamento',
                        ],
                        'dados' => $d->opiniao_seguranca
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <div textarea name="opiniao_seguranca_descricao" id="opiniao_seguranca_descricao" class="form-control" placeholder="Outras Opiniões falhas na Segurança" ><?=$d->opiniao_seguranca_descricao?></div>
                    <label for="opiniao_seguranca_descricao">Desreva suas Opiniões falhas na Segurança</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaCheckbox([
                        'rotulo' => 'No Esporte e Lazer?',
                        'campo' => 'opiniao_esporte_lazer',
                        'vetor' => [
                            'Areas para pratica de atividades esportivas',
                        ],
                        'dados' => $d->opiniao_esporte_lazer
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <div textarea name="opiniao_esporte_lazer_descricao" id="opiniao_esporte_lazer_descricao" class="form-control" placeholder="Outras Opiniões falhas no Esporte e Lazer" ><?=$d->opiniao_esporte_lazer_descricao?></div>
                    <label for="opiniao_esporte_lazer_descricao">Outras Opiniões falhas no Esporte e Lazer</label>
                </div>

                <div class="form-floating mb-3">
                    <div textarea name="opiniao_outros" id="opiniao_outros" class="form-control" placeholder="Outras Opiniões / Detalhes" ><?=$d->opiniao_outros?></div>
                    <label for="opiniao_outros">Desreva suas Opiniões / Detalhes</label>
                </div>


            </div>
        </div>
</div>


    <script>
        $(function(){

            Carregando('none');



        })
    </script>