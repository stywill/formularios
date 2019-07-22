<html lang="pt-br" manifest="offline.manifest">
    <head>
        <base href="./">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        <script type="text/Javascript">setInterval("actualizar()", 5000)</script>
    </head>
    <body class="app flex-row align-items-center">
        <div class="container">           
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card mx-4">
                        <form id="formulario" class="form-horizontal" action="processa_formulario.php" method="post" enctype="multipart/form-data">
                            <div class="card-body p-4">
                                <h1>Sincronizar</h1>
                                <div class="card">
                                    <div class="card-header">
                                        <strong>Última atualização:</strong>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <div class="col-md-9 col-form-label">
                                                <span id="ajax">Atualizando...</span>
                                            </div>
                                        </div>                                                                        
                                    </div>                               
                                </div>                                                              
                            </div>
                            <div class="card-footer p-4">
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-block" type="button" onclick='window.location.href="index.php"'>
                                            <span>Voltar</span>
                                        </button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-block btn-success" type="button" onclick='actualizar()'>
                                            <span>Atualizar Agora</span>
                                        </button>
                                    </div>
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
        <script src="js/coreui.min.js"></script>
        <script src="js/jquery.validate.js"></script>

        <script src="js/validacoes.js"></script>
        <script src="js/conexao.js"></script>
    </body>
</html>
