<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");


    if($_POST['acao'] == 'salvar'){



        $retorno = [
            'status' => true,
            'codigo' => $cod
        ];

        echo json_encode($retorno);

        exit();
    }


    function montaCheckbox($v){
        $campo = $v['campo'];
        $vetor = $v['vetor'];
        $rotulo = $v['rotulo'];

        $lista[] = '<div class="mb-3"><label for="'.$campo.'"><b>'.$rotulo.'</b></label></div>';
        for($i=0;$i<count($vetor);$i++){
            $lista[] = '  <div class="mb-3 form-check">
            <input type="checkbox" name="'.$campo.'[]" value="'.$vetor[$i].'" class="form-check-input" id="'.$campo.$i.'">
            <label class="form-check-label" for="'.$campo.$i.'">'.$vetor[$i].'</label>
            </div>';
        }
        if($lista){
            return implode(" ",$lista);
        }
    }

    function montaRadio($v){
        $campo = $v['campo'];
        $vetor = $v['vetor'];
        $rotulo = $v['rotulo'];

        $lista[] = '<div class="mb-3"><label for="'.$campo.'"><b>'.$rotulo.'</b></label></div>';
        for($i=0;$i<count($vetor);$i++){
            $lista[] = '  <div class="mb-3 form-check">
            <input type="radio" name="'.$campo.'" value="'.$vetor[$i].'" class="form-check-input" id="'.$campo.$i.'">
            <label class="form-check-label" for="'.$campo.$i.'">'.$vetor[$i].'</label>
            </div>';
        }
        if($lista){
            return implode(" ",$lista);
        }
    }


    $query = "select * from se where codigo = '{$_POST['cod']}'";
    $result = mysqli_query($con, $query);
    $d = mysqli_fetch_object($result);
?>
<style>

</style>

   <form id="form-<?= $md5 ?>">
        <div class="row">
            <div class="col">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="ef_nome" name="ef_nome" placeholder="Nome completo" value="<?=$d->ef_nome?>">
                    <label for="ef_nome">Nome</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Grau de Parentesco',
                        'campo' => 'ef_grau_parentesco',
                        'vetor' => [
                            'Não',
                        ]
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="ef_data_nascimento" id="ef_data_nascimento" class="form-control" placeholder="Data de Nascimento" value="<?=$d->ef_data_nascimento?>">
                    <label for="ef_data_nascimento">Data de Nascimento</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="telefone" id="telefone" class="form-control" placeholder="telefone" value="<?=$d->telefone?>">
                    <label for="telefone">Telefone*</label>
                </div>
                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Renda Mensal',
                        'campo' => 'ef_renda_mensal',
                        'vetor' => [
                            'Nenhuma',
                            '1 salário mínimo',
                            '2 salários mínimos',
                            '3 salários mínimos',
                            '4 salários mínimos',
                            'Acima de 4 Salários mínimos'
                        ]
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Tratamento de Saúde',
                        'campo' => 'ef_tratamento_saude',
                        'vetor' => [
                            'Não',
                            'Sim',
                        ]
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="ef_tratamento_saude_descricao" id="ef_tratamento_saude_descricao" class="form-control" placeholder="Descreva o Tratamento de Saúde" value="<?=$d->ef_tratamento_saude_descricao?>">
                    <label for="ef_tratamento_saude_descricao">Descreva o Tratamento de Saúde</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Doenças Crônicas',
                        'campo' => 'ef_doencas_cronicas	',
                        'vetor' => [
                            'Não',
                            'Sim',
                        ]
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="ef_doencas_cronicas_descricao" id="ef_doencas_cronicas_descricao" class="form-control" placeholder="Descreva o Tratamento de Saúde" value="<?=$d->ef_doencas_cronicas_descricao?>">
                    <label for="ef_doencas_cronicas_descricao">Descreva a(s) Doença(s) Crônica(s)</label>
                </div>

                <div class="form-floating mb-3">
                    <?=montaRadio([
                        'rotulo' => 'Portador de Deficiência',
                        'campo' => 'ef_portador_deficiencia',
                        'vetor' => [
                            'Não',
                            'Sim',
                        ]
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="ef_portador_deficiencia_descricao" id="ef_portador_deficiencia_descricao" class="form-control" placeholder="Descreva a Definiência" value="<?=$d->ef_portador_deficiencia_descricao?>">
                    <label for="ef_portador_deficiencia_descricao">Descreva a Definiência</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="ef_gastos_saude" id="rg_orgao" class="form-control" placeholder="Gastos com Saúde" value="<?=$d->ef_gastos_saude?>">
                    <label for="ef_gastos_saude">Gastos com Saúde</label>
                </div>
                <div class="form-floating mb-3">
                    <?=montaCheckbox([
                        'rotulo' => 'Necessita de Documentos',
                        'campo' => 'ef_necessita_documentos',
                        'vetor' => [
                            'Não',
                            'RCN', // - Registro Civil de Nascimento
                            'RCC', // -
                            'RG', // - Registro Geral
                            'CPF', //- Cadastro de Pessoa Física
                            'CTPS', // - Carteira de Trabalho e Previdencia Social
                            'TE', //- Título Eleitoral
                        ]
                    ])?>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col">
                <div style="display:flex; justify-content:end">
                    <button type="submit" SalvarFoto class="btn btn-success btn-ms">Salvar</button>
                    <input type="hidden" id="codigo" value="<?=$_POST['cod']?>" />
                </div>
            </div>
        </div>
    </form>

    <script>
        $(function(){

            Carregando('none');

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
                    typeData:"JSON",
                    mimeType: 'multipart/form-data',
                    data: campos,
                    success:function(dados){

                    },
                    error:function(erro){

                        // $.alert('Ocorreu um erro!' + erro.toString());
                        //dados de teste
                    }
                });

            });

        })
    </script>