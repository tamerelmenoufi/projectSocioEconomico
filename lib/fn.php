<?php

    function dataBr($dt){
        list($d, $h) = explode(" ",$dt);
        list($y,$m,$d) = explode("-",$d);
        $data = false;
        if($y && $m && $d){
            $data = "{$d}/{$m}/$y".(($h)?" {$h}":false);
        }
        return $data;
    }

    function dataMysql($dt){
        list($d, $h) = explode(" ",$dt);
        list($d,$m,$y) = explode("/",$d);
        $data = false;
        if($y && $m && $d){
            $data = "{$y}-{$m}-$d".(($h)?" {$h}":false);
        }
        return $data;
    }

    function montaCheckbox($v){
        $campo = $v['campo'];
        $vetor = $v['vetor'];
        $rotulo = $v['rotulo'];
        $dados = json_decode($v['dados']);
        // $lista[] = print_r($dados, true);
        $lista[] = '<div class="mb-3"><label for="'.$campo.'"><b>'.$rotulo.'</b></label></div>';
        for($i=0;$i<count($vetor);$i++){
            $lista[] = '  <div class="mb-3 form-check">
            <input
                    type="checkbox"
                    name="'.$campo.'[]"
                    value="'.$vetor[$i].'"
                    class="form-check-input"
                    id="'.$campo.$i.'"
                    '.((@in_array($vetor[$i],$dados))?'checked':false).'
            >
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
        $dados = $v['dados'];

        $lista[] = '<div class="mb-3"><label for="'.$campo.'"><b>'.$rotulo.'</b></label></div>';
        for($i=0;$i<count($vetor);$i++){
            $lista[] = '  <div class="mb-3 form-check">
            <input
                    type="radio"
                    name="'.$campo.'"
                    value="'.$vetor[$i].'"
                    class="form-check-input"
                    id="'.$campo.$i.'"
                    '.(($vetor[$i] == $dados)?'checked':false).'
            >
            <label class="form-check-label" for="'.$campo.$i.'">'.$vetor[$i].'</label>
            </div>';
        }
        if($lista){
            return implode(" ",$lista);
        }
    }



    function montaOpcPrint($v){
        $campo = $v['campo'];
        $vetor = $v['vetor'];
        $rotulo = $v['rotulo'];
        $dados = json_decode($v['dados']);
        // $lista[] = print_r($dados, true);
        $lista[] = '<div class="mt-3" style="width:100%; float:none;"><label for="'.$campo.'"><b>'.$rotulo.'</b></label></div><div style="width:100%; float:none;">';
        for($i=0;$i<count($vetor);$i++){
            $lista[] = '  <div style="width:auto; margin-left:15px; margin-bottom:20px; float:left">
            <i class="fa-solid fa-square" style="color:#ccc"></i> '.$vetor[$i].'</div>';
        }
        $lista[] = '</div>';
        if($lista){
            return implode(" ",$lista);
        }
    }