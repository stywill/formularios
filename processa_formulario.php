<?php
// -----------------------------------------------
session_cache_limiter('nocache');
session_start();

include '__core.php';
$core = new core("host_local", "usuario_local", "senha_local", "base_local");
// -----------------------------------------------
$dmsg = 'Dados processados com sucesso'; // mensagem que aparece ao finalizar processamento
$auto_rto = true; // retorna automaticamente para uma url
$tab = 'respostas';
$conjuntoNovo = $conjunto+1;
if ($axn == 'novo') {
    if ($contPergunta) {
        
        for ($i = 0; $i < $contPergunta; $i++) {
            $resposta[$i] = $core->gsim("*", "opcoes", "id=" . ${"resposta" . $i});
            $query = 'INSERT INTO ' . $core->db_prefix . $tab . " VALUES(NULL,'".$core->dispositivo."',$conjuntoNovo,'N'," . ${"perguntaId" . $i} . ","
                    . "'" . ${"pergunta" . $i} . "'," . $resposta[$i][0]->id . ",'" . $resposta[$i][0]->descricao . "',"
                    . "'" . $resposta[$i][0]->correta . "','" . $core->now() . "')";
            $pid = $core->sql("I", $query);
        }
        $rto = "bw_formulario/index.php?conj=".$conjuntoNovo; // URL de retorno após processamento
    } else {
        $dmsg = "Erro ao gravar, tamanho excede o permitido";
        $rto = 'index.php;';
    }

    // -----------------------------------------------
} elseif ($axn == 'novo2') {
    // -----------------------------------------------
    // -----------------------------------------------
} elseif ($axn == 'editar') {

    // -----------------------------------------------
}

// -----------------------------------------------// -----------------------------------------------
// -----------------------------------------------// -----------------------------------------------
// -----------------------------------------------// -----------------------------------------------
// -----------------------------------------------// -----------------------------------------------
// -----------------------------------------------// -----------------------------------------------
// -----------------------------------------------// -----------------------------------------------
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>---</title>
    </head>

    <body>
        <script>
            <!--
            var dmsg = '<?= $dmsg; ?>';
            if (dmsg) {
                alert(dmsg);
            }
<?php if ($auto_rto) {
    ?>
                window.location = '../<?= $rto; ?>';
<?php }
?>
            //-->
        </script>

        <?php if (!$auto_rto) {
            ?>
            <div align=center>
                <br />
                <strong><?php echo $dmsg; ?></strong>
                <input name="btn" id="btn" type="button" value="Prosseguir" onclick="window.location = '<?php echo $rto; ?>';" />
            </div>
        <?php }
        ?>
    </body>
</html>
