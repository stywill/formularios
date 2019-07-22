<?php
// -----------------------------------------------
session_cache_limiter('nocache');
session_start();

include '__core.php';
$core = new core("host_local", "usuario_local", "senha_local", "base_local");

$perguntas = $core->gsim("*","perguntas","status='A'");
foreach ($perguntas as $keyP => $per) {
    $opcoes= $core->gsim("*","opcoes","status='A' AND id_pergunta=".$per->id);
    foreach ($opcoes as $keyO => $ops){
        $respostas = $core->gsim("correta","respostas","conjunto=".$conj." AND id_pergunta=".$per->id." AND id_opcao=".$ops->id,"unitario");
        $opcao[$per->id][] = array("id"=>$ops->id,"opcao"=>$ops->descricao,"resposta"=>$respostas);
    }                                                      
    $dados[]= array("id"=>$per->id,"pergunta"=>$per->pergunta,"mp3"=>$per->mp3,"opcoes"=>$opcao[$per->id]);
}
$conjunto = $core->gsim("conjunto","respostas","id<>0 ORDER BY conjunto DESC");
include 'formulario.php';
?>