<?php

include('../../config/config.php');
include('../../config/functions.php');

// RECEBENDO OS PARAMETROS VIA POST
$id_pessoa = (int)descriptografa(trim($_POST['id_pessoa']));

// VALIDANDO O PARAMETRO
if ( $id_pessoa <= 0 ) {
  retorno_usuario('erro', "Não foi possível deletar o registro!");
}


// INICIA O DELETE NO BD


// FAZ O PREPARE
$stmt = $connect->prepare("DELETE FROM tab_pessoass WHERE id_pessoa = :id_pessoa");

// VERIFICA SE O PREPARE DEU ALGUM ERRO
if ( !$stmt ) {
  retorno_usuario('error', "ERRO: " . $connect->errorInfo()[2]);
}

// BIND NOS PARAMATROS
$stmt->bindParam(':id_pessoa', $id_pessoa, PDO::PARAM_INT);

if ( !$stmt->execute() ) {
  retorno_usuario('error', 'ERRO: ' . $connect->errorInfo());
}


// Se chegou aqui, sucesso!
retorno_usuario('success', "Pessoa DELETADA com Sucesso!");