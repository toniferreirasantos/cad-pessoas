<?php


/*----------------------------------------------------------
	MENSAGEM DE RETORNO NOS FORMULARIOS PARA OS USUARIOS
-----------------------------------------------------------*/
function retorno_usuario($result, $message, $data = "") {
	$retorno = array(
		"result" 	=> $result,  // success, error, warning, info
		"message" => $message, // Mensagem para o usuario
		"data" 		=> $data
	);

	$resposta = json_encode($retorno);	
	echo $resposta;
	exit;	
}



function get_estados() {
	$resultado = file_get_contents('http://www.geonames.org/childrenJSON?geonameId=3469034');
	$res = json_decode($resultado);
	$estados = $res->geonames;
	
	echo "<option value=''>Selecione...</option>";

	for ($i=0; $i < count($estados); $i++) { 
		$nome_estado = mb_strtoupper($estados[$i]->toponymName, 'UTF-8');		
		$sigla_uf = $estados[$i]->adminCodes1->ISO3166_2;

		echo "\n<option value='$sigla_uf - $nome_estado'>$sigla_uf - $nome_estado </option>";
	}
}









/*--------------------------
	VALIDA CPF E CNPJ
---------------------------- */
function validaCpfCnpj($cpf_cnpj) {

	if (strlen($cpf_cnpj) == 11)  //Se for CPF
	{
		// Verifica se um n?mero foi informado
		if(empty($cpf_cnpj)) {
			return false;
		}

		// Elimina possivel mascara
		$cpf_cnpj = ereg_replace('[^0-9]', '', $cpf_cnpj);
		$cpf_cnpj = str_pad($cpf_cnpj, 11, '0', STR_PAD_LEFT);

		// Verifica se o numero de digitos informados ? igual a 11
		if (strlen($cpf_cnpj) != 11) {
			return false;
		}
		// Verifica se nenhuma das sequ?ncias invalidas abaixo
		// foi digitada. Caso afirmativo, retorna falso
		else if ($cpf_cnpj == '00000000000' ||
			$cpf_cnpj == '11111111111' ||
			$cpf_cnpj == '22222222222' ||
			$cpf_cnpj == '33333333333' ||
			$cpf_cnpj == '44444444444' ||
			$cpf_cnpj == '55555555555' ||
			$cpf_cnpj == '66666666666' ||
			$cpf_cnpj == '77777777777' ||
			$cpf_cnpj == '88888888888' ||
			$cpf_cnpj == '99999999999') {
			return false;
			// Calcula os digitos verificadores para verificar se o
			// CPF ? v?lido
			} else {

			for ($t = 9; $t < 11; $t++) {

				for ($d = 0, $c = 0; $c < $t; $c++) {
					$d += $cpf_cnpj{$c} * (($t + 1) - $c);
				}
				$d = ((10 * $d) % 11) % 10;
				if ($cpf_cnpj{$c} != $d) {
					return false;
				}
			}

			return true;
		}

	}else if (strlen($cpf_cnpj) == 14) //Se for CNPJ
	{

		//Zera a Soma
		$soma = 0;

		$soma += ($cpf_cnpj[0] * 5);
		$soma += ($cpf_cnpj[1] * 4);
		$soma += ($cpf_cnpj[2] * 3);
		$soma += ($cpf_cnpj[3] * 2);
		$soma += ($cpf_cnpj[4] * 9);
		$soma += ($cpf_cnpj[5] * 8);
		$soma += ($cpf_cnpj[6] * 7);
		$soma += ($cpf_cnpj[7] * 6);
		$soma += ($cpf_cnpj[8] * 5);
		$soma += ($cpf_cnpj[9] * 4);
		$soma += ($cpf_cnpj[10] * 3);
		$soma += ($cpf_cnpj[11] * 2);

		$d1 = $soma % 11;
		$d1 = $d1 < 2 ? 0 : 11 - $d1;

		$soma = 0;
		$soma += ($cpf_cnpj[0] * 6);
		$soma += ($cpf_cnpj[1] * 5);
		$soma += ($cpf_cnpj[2] * 4);
		$soma += ($cpf_cnpj[3] * 3);
		$soma += ($cpf_cnpj[4] * 2);
		$soma += ($cpf_cnpj[5] * 9);
		$soma += ($cpf_cnpj[6] * 8);
		$soma += ($cpf_cnpj[7] * 7);
		$soma += ($cpf_cnpj[8] * 6);
		$soma += ($cpf_cnpj[9] * 5);
		$soma += ($cpf_cnpj[10] * 4);
		$soma += ($cpf_cnpj[11] * 3);
		$soma += ($cpf_cnpj[12] * 2);


		$d2 = $soma % 11;
		$d2 = $d2 < 2 ? 0 : 11 - $d2;

		if ($cpf_cnpj[12] == $d1 && $cpf_cnpj[13] == $d2)
		{
			return true;
		}
		else{
			return false;
		}
		}else
	{
	return false;
	}
}





function criptografa($criptografar) {
	for($i = 1; $i < 8; $i++) {
		$criptografar = base64_encode($criptografar);
	}
	return $criptografar;
}
function descriptografa($descriptografar) {
	for($i = 1; $i < 8; $i++) {
		$descriptografar = base64_decode($descriptografar);
	}
	return $descriptografar;
}