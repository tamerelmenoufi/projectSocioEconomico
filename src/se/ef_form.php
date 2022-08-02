<?php
    include("{$_SERVER['DOCUMENT_ROOT']}/app/projectSocioEconomico/lib/includes.php");


    if($_POST['acao'] == 'salvar'){

        $data = $_POST;
        $attr = [];

        unset($data['codigo']);
        unset($data['acao']);


        foreach ($data as $name => $value) {

            if(is_array($value)) {
                $value = json_encode($value);
            }
            $attr[] = "{$name} = '" . mysqli_real_escape_string($con, $value) . "'";
        }
            $attr[] = "se_codigo = '" . $_SESSION['se_codigo'] . "'";

        $attr = implode(', ', $attr);

        if($_POST['codigo']){
            $query = "update se_estrutura_familiar set {$attr} where codigo = '{$_POST['codigo']}'";
            mysqli_query($con, $query);
            $cod = $_POST['codigo'];
        }else{
            $query = "insert into se_estrutura_familiar set data_cadastro = NOW(), {$attr}";
            mysqli_query($con, $query);
            $cod = mysqli_insert_id($con);
        }

        $retorno = [
            'status' => true,
            'codigo' => $cod,
            'mensagem' => "Cadastro registrado com sucesso!",
            'query' => $query,
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


    $query = "select * from ef where codigo = '{$_POST['cod']}'";
    $result = mysqli_query($con, $query);
    $d = mysqli_fetch_object($result);
?>
<style>
    textarea{
        height:200px !important;
    }
</style>

   <form id="form-<?= $md5 ?>">
        <div class="row" style="margin-bottom:50px;">
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
                            'Mãe',
                            'Pai',
                            'Esposo',
                            'Esposa',
                            'Filho',
                            'Filha',
                            'Entiado',
                            'Entiada',
                            'Neto',
                            'Neta',
                            'Tia',
                            'Tio',
                            'Sobrinho',
                            'Sobrinha',
                            'Primo',
                            'Prima',
                            'Avó',
                            'Avô',
                            'Outros',
                        ]
                    ])?>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="ef_data_nascimento" id="ef_data_nascimento" class="form-control" placeholder="Data de Nascimento" value="<?=$d->ef_data_nascimento?>">
                    <label for="ef_data_nascimento">Data de Nascimento</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="text" name="ef_telefone" id="ef_telefone" class="form-control" placeholder="Telefone" value="<?=$d->ef_telefone?>">
                    <label for="ef_telefone">Telefone*</label>
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


        <div BtnSalvar<?=$md5?> style="position:fixed; bottom:11px; right:40px; height:50px; background-color:#fff; padding:0px;">
            <div style="display:flex; justify-content:end">
                <button type="submit" SalvarFoto class="btn btn-success btn-ms">Salvar</button>
                <input type="hidden" id="codigo" value="<?=$_POST['cod']?>" />
            </div>
        </div>
    </form>

    <script>
        $(function(){

            Carregando('none');

            $("#ef_data_nascimento").mask("99/99/9999");
            $("#ef_telefone").mask("(99) 99999-9999");


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
                    url:"src/se/ef_form.php",
                    type:"POST",
                    dataType:"JSON",
                    mimeType: 'multipart/form-data',
                    data: campos,
                    success:function(dados){
                        $.alert(dados.query);
                        Carregando('none')
                    },
                    error:function(erro){

                        // $.alert('Ocorreu um erro!' + erro.toString());
                        //dados de teste
                    }
                });

            });

        })



        if( navigator.userAgent.match(/Android/i)
            || navigator.userAgent.match(/webOS/i)
            || navigator.userAgent.match(/iPhone/i)
            || navigator.userAgent.match(/iPad/i)
            || navigator.userAgent.match(/iPod/i)
            || navigator.userAgent.match(/BlackBerry/i)
            || navigator.userAgent.match(/Windows Phone/i)
        ){
            $("div[BtnSalvar<?=$md5?>]").css("width","calc(100% - 58px)")
        }
        else {
            $("div[BtnSalvar<?=$md5?>]").css("width","calc(500px - 58px)")
        }

    </script>