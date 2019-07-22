<?php
session_cache_limiter('nocache');
session_start();

include '__core.php';
$tab = 'respostas';
if (!$sock = @fsockopen('host_online', 3306, $num, $error, 5)){
    echo 'OFF LINE';
}else{
    $online = new core("host_online", "usuario_online", "senha_online", "base_online");
    $core = new core("host_local", "usuario_local", "senha_local", "base_local");

    $dados = $core->gsim("*","respostas","sincronizado='N'");
    foreach ($dados as $key => $value) {
        $query = 'INSERT INTO ' . $online->db_prefix . $tab . " VALUES(NULL,'".$value->dispositivo."',".$value->conjunto.","
                . "'S','".$value->id_pergunta."','".$value->pergunta."','".$value->id_opcao."',"
                . "'".$value->opcao."','".$value->correta."','".$value->data_cadastro."','" . $online->now() . "')";
        $pid = $online->sql("I", $query);
        
        if($pid){
            $update = "UPDATE ". $core->db_prefix . $tab." SET sincronizado='S' WHERE id=".$value->id;
            $uid = $core->sql("U", $update);
        }
    }
    echo htmlentities(date("d/m/Y H:i:s"));
}

?>