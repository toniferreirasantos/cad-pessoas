<?php

include('../../config/config.php');
include('../../config/functions.php');


$stmt = $connect->query("SELECT * FROM tab_pessoass ORDER BY id_pessoa");
if ( !$stmt->execute() ) {
  echo 'ERRO: ' . $connect->errorInfo();
  exit;
}

// SE TROUXER AO MENOS UM REGISTRO...
if ( $stmt->rowCount() > 0 ) { ?>

  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover">
      
      <thead>
        <tr>
          <th class="text-center"><i class="fa fa-sort-numeric-asc"></i></th>
          <th class="text-center">Nome</th>
          <th class="text-center">CPF / CNPJ</th>
          <th class="text-center">Nascimento</th>
          <th class="text-center">Peso (Kg)</th>
          <th class="text-center">UF</th>
          <th class="text-center">Cadastro</th>
          <th class="text-center">Apagar</th>
        </tr>
      </thead>

      <tbody>

        <?php
          while ( $pessoa = $stmt->fetch(PDO::FETCH_OBJ) ) { ?>
          
            <tr>
              <td class="text-center"><?php echo ++$contador ?></td>
              <td class="text-center text-primary"><?php echo mb_strtoupper($pessoa->nome_pessoa, 'UTF-8') ?></td>
              <td class="text-center text-danger"><?php echo $pessoa->cpf_cnpj_pessoa; ?></td>

              <td class="text-center"><?php echo trim($pessoa->data_nasc_pessoa) != '0000-00-00' ? date('d/m/Y', strtotime($pessoa->data_nasc_pessoa)) : 'Não Informada'; ?></td>
              <td class="text-center"><?php echo (int)$pessoa->peso_pessoa > 0 ? str_replace('.', ',', $pessoa->peso_pessoa) : 'Não informado'; ?></td>
              <td class="text-center"><?php echo !empty(trim($pessoa->uf_pessoa)) ? $pessoa->uf_pessoa : 'Não Informado'; ?></td>

              <td class="text-center">
                <?php
                  $data_cadastro = date('d/m/Y', strtotime($pessoa->DATE_CADASTRO));
                  $hora_cadastro = date('H:i:s', strtotime($pessoa->DATE_CADASTRO));
                  echo "$data_cadastro às $hora_cadastro";
                ?>
              </td>

              <td class="text-center">
                <button class="btn btn-danger btn-xs" onclick="confirma_delete_pessoa('<?php echo $pessoa->nome_pessoa ?>', '<?php echo criptografa($pessoa->id_pessoa) ?>')">
                  <i class="fa fa-times"></i>
                </button>
              </td>
            </tr>

            <?php  
          } // WHILE
        ?>
        
      </tbody>
    </table>
  </div>

  <?php
} // IF
else { ?>


  <div class='col-sm-12 mb-lg npl npr'>
    <div class='alert alert-info text-center'>
      <h3>Nenhuma pessoa cadastrada!</h3>
      
      <a href="#modal_cadastro" data-toggle="modal">
        Clique aqui e cadastre uma agora mesmo!
      </a>
      
      
    </div>
  </div>

  <?php
} // IF