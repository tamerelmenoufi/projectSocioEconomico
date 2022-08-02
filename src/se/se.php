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
                    <input type="text" name="telefone" id="telefone" class="form-control" placeholder="telefone" value="<?=$d->telefone?>">
                    <label for="telefone">Telefone*</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="email" id="email" class="form-control" placeholder="E-mail" value="<?=$d->email?>">
                    <label for="email">E-mail*</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaCheckbox([
                        'rotulo' => 'Redes Sociais',
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
                        'rotulo' => 'Genero',
                        'campo' => 'genero',
                        'vetor' => [
                            'Masculino',
                            'Feminino',
                        ],
                        'dados' => $d->genero
                    ])?>
                </div>


                <div class="form-floating mb-3">
                    <input type="text" name="data_nascimento" id="data_nascimento" class="form-control" placeholder="Ponto de Referência" value="<?=dataBr($d->data_nascimento)?>">
                    <label for="data_nascimento">Data de Nascimento</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Estado Civil',
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
                        'rotulo' => 'Meio(s) de Trasporte(s)',
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
                        'rotulo' => 'Tipo de Imóvel ',
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
                        'rotulo' => 'Tipo de Moradia',
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
                        'rotulo' => 'Quantidade de Cômodos',
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
                        'rotulo' => 'Grau de Escolaridade',
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
                        'rotulo' => 'Cursos Técnico/Profissionalizante',
                        'campo' => 'curos_profissionais',
                        'vetor' => [
                            'Sim',
                            'Não',
                        ],
                        'dados' => $d->curos_profissionais
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="curos_profissionais_descricao" id="curos_profissionais_descricao" class="form-control" placeholder="Cursos Técnico/Profissionalizante" ><?=$d->curos_profissionais_descricao?></textarea>
                    <label for="curos_profissionais_descricao">Descreve os Cursos Técnico/Profissionalizante</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Renda Mensal',
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
                        'rotulo' => 'Benefício Social',
                        'campo' => 'beneficio_social',
                        'vetor' => [
                            'Sim',
                            'Não',
                        ],
                        'dados' => $d->beneficio_social
                    ])?>
                </div>

                <div class="form-floating mb-3">
                    <textarea name="beneficio_social_descricao" id="beneficio_social_descricao" class="form-control" placeholder="Descrição do Benefício Social" ><?=$d->beneficio_social_descricao?></textarea>
                    <label for="beneficio_social_descricao">Descrição do Benefício Social</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Serviço de Saúde',
                        'campo' => 'servico_saude',
                        'vetor' => [
                           'SUS',
                            'Associações/PlanodeSaúde',
                            'Outros',
                        ],
                        'dados' => $d->servico_saude
                    ])?>
                </div>


                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Vacina COVID19',
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
                        'rotulo' => 'Opinião falhas na Saúde',
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
                    <textarea name="opiniao_saude_descricao" id="opiniao_saude_descricao" class="form-control" placeholder="Outras Opiniões / Detalhes" ><?=$d->opiniao_saude_descricao?></textarea>
                    <label for="opiniao_saude_descricao">Outras Opiniões Falhas na Saúde</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Opinião falhas na Educação',
                        'campo' => 'opiniao_educacao',
                        'vetor' => [
                            'Não',
                            'Sim'
                        ],
                        'dados' => $d->opiniao_educacao
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="opiniao_educacao_descricao" id="opiniao_educacao_descricao" class="form-control" placeholder="Outras Opiniões falhas na Educação" ><?=$d->opiniao_educacao_descricao?></textarea>
                    <label for="opiniao_educacao_descricao">Outras Opiniões falhas na Educação</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Opinião falhas na Cidadania',
                        'campo' => 'opiniao_cidadania',
                        'vetor' => [
                            'Não',
                            'Sim'
                        ],
                        'dados' => $d->opiniao_cidadania
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="opiniao_cidadania_descricao" id="opiniao_cidadania_descricao" class="form-control" placeholder="Outras Opiniões falhas na Cidadania" ><?=$d->opiniao_cidadania_descricao?></textarea>
                    <label for="opiniao_cidadania_descricao">Outras Opiniões falhas na Cidadania</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaCheckbox([
                        'rotulo' => 'Opinião falhas na Infraestrutura',
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
                    <textarea name="opiniao_infraestrutura_descricao" id="opiniao_infraestrutura_descricao" class="form-control" placeholder="Outras Opiniões falhas na Infraestrutura" ><?=$d->opiniao_infraestrutura_descricao?></textarea>
                    <label for="opiniao_infraestrutura_descricao">Outras Opiniões falhas na Infraestrutura</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaCheckbox([
                        'rotulo' => 'Opinião falhas na Assistência Social',
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
                    <textarea name="opiniao_assistencia_social_descricao" id="opiniao_assistencia_social_descricao" class="form-control" placeholder="Outras Opiniões falhas na Assistência Social" ><?=$d->opiniao_assistencia_social_descricao?></textarea>
                    <label for="opiniao_assistencia_social_descricao">Outras Opiniões falhas na Assistência Social</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Opinião falhas nos Direitos Humanos',
                        'campo' => 'opiniao_direitos_humanos',
                        'vetor' => [
                            'Não',
                            'Sim'
                        ],
                        'dados' => $d->opiniao_direitos_humanos
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="opiniao_direitos_humanos_descricao" id="opiniao_direitos_humanos_descricao" class="form-control" placeholder="Outras Opiniões falhas na Direitos Humanos" ><?=$d->opiniao_direitos_humanos_descricao?></textarea>
                    <label for="opiniao_direitos_humanos_descricao">Outras Opiniões falhas na Direitos Humanos</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaCheckbox([
                        'rotulo' => 'Opinião falhas na Segurança',
                        'campo' => 'opiniao_seguranca',
                        'vetor' => [
                            'Atendimento de Chamado para Policiamento',
                        ],
                        'dados' => $d->opiniao_seguranca
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="opiniao_seguranca_descricao" id="opiniao_seguranca_descricao" class="form-control" placeholder="Outras Opiniões falhas na Segurança" ><?=$d->opiniao_seguranca_descricao?></textarea>
                    <label for="opiniao_seguranca_descricao">Outras Opiniões falhas na Segurança</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaCheckbox([
                        'rotulo' => 'Opinião falhas no Esporte e Lazer',
                        'campo' => 'opiniao_esporte_lazer',
                        'vetor' => [
                            'Areas para pratica de atividades esportivas',
                        ],
                        'dados' => $d->opiniao_esporte_lazer
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <textarea name="opiniao_esporte_lazer_descricao" id="opiniao_esporte_lazer_descricao" class="form-control" placeholder="Outras Opiniões falhas no Esporte e Lazer" ><?=$d->opiniao_esporte_lazer_descricao?></textarea>
                    <label for="opiniao_esporte_lazer_descricao">Outras Opiniões falhas no Esporte e Lazer</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea name="opiniao_outros" id="opiniao_outros" class="form-control" placeholder="Outras Opiniões / Detalhes" ><?=$d->opiniao_outros?></textarea>
                    <label for="opiniao_outros">Outras Opiniões / Detalhes</label>
                </div>


            </div>
        </div>

        <div style="position:absolute; bottom:0;left:0; right:20px; height:50px; padding-right:10px; background-color:#fff;">
            <div style="display:flex; justify-content:end">
                <button type="submit" SalvarFoto class="btn btn-success btn-ms">Salvar</button>
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

                var codigo = $('#codigo').val();
                var campos = $(this).serializeArray();

                if (codigo) {
                    campos.push({name: 'codigo', value: codigo})
                }

                campos.push({name: 'acao', value: 'salvar'})

                Carregando();

                $.ajax({
                    url:"src/se/se.php",
                    type:"POST",
                    dataType:"JSON",
                    data: campos,
                    success:function(dados){
                        $.alert(dados.query);
                        Carregando('none');
                    },
                    error:function(erro){

                        // $.alert('Ocorreu um erro!' + erro.toString());
                        //dados de teste
                    }
                });

            });

        })
    </script>