<html lang="pt-br" manifest="offline.manifest">
    <head>
        <base href="./">
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content=Wilson">
        <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
        <title>Pesquisa</title>
        <!-- Icons-->
        <link href="css/coreui-icons.min.css" rel="stylesheet">
        <link href="css/flag-icon.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
        <!-- Main styles for this application-->
        <link href="css/style.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js" rel="stylesheet">   
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script type="text/Javascript">setInterval("actualizar()", 150000)</script>
    </head>
    <body class="app flex-row align-items-center">
        <div class="container"> 
            <div class="row justify-content-center">              
                <div class="col-md-12">
                    <div class="card mx-4">
                        <form id="formulario" class="form-horizontal" action="processa_formulario.php" method="post" enctype="multipart/form-data">
                            <div class="card-body p-4">
                               
                                <h1>Formulário!!!!</h1> Sincronia automatica:<span id="ajax"></span>
                                <p class="text-muted"><code>* Todos os campos são obrigatórios</code></p>
                                <input type="hidden" id="contPergunta" name="contPergunta" value="<?= count($dados); ?>">
                                <input type="hidden" id="conjunto" name="conjunto" value="<?= $conjunto[0]->conjunto; ?>">
                                <?php
                                for ($i = 0; $i < count($dados); $i++) {
                                    $indicePergunta++;
                                    ?>
                                    <div class="card">
                                        <div class="card-header">
                                            <strong><?= $indicePergunta; ?>-</strong><?= $dados[$i]["pergunta"]; ?>
                                            <input type="hidden" name="pergunta<?= $i ?>" value="<?= $dados[$i]["pergunta"]; ?>">
                                            <input type="hidden" name="perguntaId<?= $i ?>" value="<?= $dados[$i]["id"]; ?>">  
                                            <audio controls preload class="align-middle justify-content-end">
                                                <source src="mp3/<?= $dados[$i]["mp3"]; ?>" type="audio/mpeg">
                                                Seu navegador não suporta áudio em HTML5, atualize-o.
                                            </audio>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group row">
                                                <div class="col-md-9 col-form-label">
                                                    <?php
                                                    for ($j = 0; $j < count($dados[$i]["opcoes"]); $j++) {
                                                        ?>
                                                        <div class="form-check mb-xl-0 <?= $core->alert($dados[$i]["opcoes"][$j]["resposta"]); ?>">                                                         
                                                            <input class="form-check-input" id="resposta<?= $i; ?>_<?= $j; ?>" type="radio" onclick="limpaErro(<?= $i; ?>)" value="<?= $dados[$i]["opcoes"][$j]['id']; ?>" name="resposta<?= $i; ?>" <?= $core->checked($dados[$i]["opcoes"][$j]["resposta"]); ?>>
                                                            <label class="form-check-label" for="resposta<?= $i; ?>_<?= $j; ?>"><?= $dados[$i]["opcoes"][$j]["opcao"] . " " . $core->mensagem($dados[$i]["opcoes"][$j]["resposta"]); ?></label>
                                                        </div>
                                                        <?php
                                                        $checked = "";
                                                    }
                                                    ?>
                                                    <div><code id="pergunta<?= $i; ?>_erro"></code></div>
                                                    <input type="hidden" name="conutOpcoes<?= $i; ?>" value="<?= count($dados[$i]["opcoes"]); ?>">
                                                </div>
                                            </div>                                                                        
                                        </div>                               
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <div class="card-footer p-4">
                                <div class="row">
                                    <?php
                                    if (!$conj) {
                                        ?>
                                        <div class="col-6">
                                            <button class="btn btn-block" type="button" name="axn" value="sinc" onclick='window.location.href = "sincronizar.php"'>
                                                <span>Sincronizar</span>
                                            </button>
                                        </div>
                                        <div class="col-6">                                       
                                            <input type="hidden" name="axn" value="novo">
                                            <button class="btn btn-block btn-success" type="button" onclick="valida()">Salvar</button>                                           
                                        </div>
                                        <?php
                                    } else {
                                        echo ' <div class="col-12"><button class="btn btn-block btn-success" type="button" onclick="window.location = \'index.php\';" >Voltar</button></div>';
                                    }
                                    ?>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- CoreUI and necessary plugins-->
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.4.0/perfect-scrollbar.min.js"></script>      
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jplayer/2.9.2/add-on/jplayer.playlist.min.js"></script>
        <script src="js/coreui.min.js"></script>
        <script src="js/jquery.validate.js"></script>

        <script src="js/validacoes.js"></script>
        <script src="js/conexao.js"></script>
    </body>
</html>

