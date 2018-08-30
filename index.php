<?php
  include('./config/config.php');
  include('./config/functions.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- IMPEDINDO INDEXAÇÃO BUSCADORES -->
    <meta name="robots" content="noindex">
    <meta name="googlebot" content="noindex">

    <title>Cadastro de Pessoas</title>

    <!-- FAVICON -->
    <link rel="shortcut icon" href="./assets/img/favicon.png" type="image/png">

    <!-- CSS -->
    <link rel="stylesheet" href="./assets/css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/iziToast.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">
  </head>

  <body>

    <header>
      <h1>CADASTRO DE PESSOAS</h1>
    </header>

    <div class="container">
      <div class="row">
        <div class="col-sm-12">

          <h3 class="text-center">Relação de Pessoas cadastradas</h3>
          
          <a href="#modal_cadastro" data-toggle="modal" class="btn btn-primary pull-right mb-md">
            <i class="fa fa-plus mr-sm"></i> NOVA PESSOA
          </a>
        </div>
      </div>

        <div id="div_table_pessoas"></div>

    </div>




    <footer>
       <?php echo 'Copyright ©' . date('Y') . " - Cadastro de Pessoas"; ?>
    </footer>


    <?php include('./inc/modal.php'); ?>

    <!-- JS's -->
    <script src="./assets/js/jquery.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/iziToast.min.js"></script>

    <script src="./assets/js/custom.js"></script>

  </body>
</html>