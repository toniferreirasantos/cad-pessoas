<?php

include('../../config/config.php');
include('../../config/functions.php');

// RECEBENDO OS PARAMETROS VIA POST
$nome_pessoa = trim($_POST['nome_pessoa']);
$cpf_pessoa  = trim($_POST['cpf_pessoa']);
$nasc_pessoa = trim($_POST['nasc_pessoa']);
$peso_pessoa = (float)$_POST['peso_pessoa'];
$uf_pessoa   = trim($_POST['uf_pessoa']);


// REVALIDANDO OS PARAMETROS
if (
  empty($nome_pessoa) || empty($cpf_pessoa)
  // empty($nasc_pessoa) ||
  // empty($peso_pessoa) ||
  // empty($uf_pessoa)
 ) {

  retorno_usuario('warning', "Preencha todos os campos obrigatórios!");
}





// VALIDANDO O CPF/CNPJ
$cpf_validate = $cpf_pessoa;
$cpf_validate = ereg_replace('[^0-9]', '', $cpf_validate);
$cpf_validate = str_pad($cpf_validate, 11, '0', STR_PAD_LEFT);

if ( !validaCpfCnpj($cpf_validate) ) {
	retorno_usuario("error", "<strong>CPF / CNPJ</strong> INVÁLIDO!<br>Verifique e tente novamente.");
}




// VERIFICA SE O CPF/CNPJ INFORMADO JÁ ESTÁ CADASTRADO
$stmt = $connect->query("SELECT * FROM tab_pessoass WHERE cpf_cnpj_pessoa = '$cpf_pessoa'");
if ( !$stmt->execute() ) {
  retorno_usuario("warning", "ERRO: " . $connect->errorInfo());
}
// SE TROUXER ALGUM UM REGISTRO...
if ( $stmt->rowCount() > 0 ) {
  retorno_usuario("warning", "O documento <strong>$cpf_pessoa</strong> já encontra-se cadastrado! Tente outro número.");
}






// INICIA O INSERT NO BD
$query_insert_pessoa =
"	INSERT INTO tab_pessoass (
    nome_pessoa,
    cpf_cnpj_pessoa,
    data_nasc_pessoa,
    peso_pessoa,
    uf_pessoa,
    DATE_CADASTRO
  )
  VALUES (
    :nome_pessoa,
    :cpf_pessoa,
    :nasc_pessoa,
    :peso_pessoa,
    :uf_pessoa,
    NOW()
  )
";

// FAZ O PREPARE
$stmt = $connect->prepare($query_insert_pessoa);

// VERIFICA SE O PREPARE DEU ALGUM ERRO
if ( !$stmt ) {
  retorno_usuario('error', "ERRO: " . $connect->errorInfo()[2]);
}

// BIND NOS PARAMATROS
$stmt->bindParam(':nome_pessoa', $nome_pessoa, PDO::PARAM_STR);
$stmt->bindParam(':cpf_pessoa', $cpf_pessoa, PDO::PARAM_STR);
$stmt->bindParam(':nasc_pessoa', $nasc_pessoa, PDO::PARAM_STR);
$stmt->bindParam(':peso_pessoa', $peso_pessoa, PDO::PARAM_STR);
$stmt->bindParam(':uf_pessoa', $uf_pessoa, PDO::PARAM_STR);

if ( !$stmt->execute() ) {
  retorno_usuario('error', 'ERRO: ' . $connect->errorInfo());
}


// Se chegou aqui, sucesso!
retorno_usuario('success', "Pessoa cadastrada com Sucesso!");