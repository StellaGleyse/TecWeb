<?php 
	// RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO !
	$nome = $_POST ["nome"];//atribuição do campo "nome" vindo do formulário para variavel
	$cpf = $_POST ["cpf"];
	$email = $_POST ["email"];
	$senha = $_POST ["senha"];
	$senha_confirmacao = $_POST ["senha_confirmacao"];
	$novidades = $_POST ["news"];
	$erro = 0;

	
	//Validando os campos do formulário
	//valida se os campos obrigatórios foram preenchidos
	if ((empty($nome) || empty($cpf) || empty($email) || empty($senha)) == true){
		echo "<script language='javascript' type='text/javascript'>alert('Favor preencher todos os campos obrigatórios.');window.location.href='formulario.xhtml';</script>";
		$erro = 1;
	}

	//verifica se as senhas são iguais.
	if ($senha != $senha_confirmacao){
		echo "<script language='javascript' type='text/javascript'>alert('A senha e sua confirmação devem ser iguais.');window.location.href='formulario.xhtml';</script>";
		$erro = 1;
	}
	// Verifica se o email está num formato correto de escrita.
	if (!ereg('^([a-zA-Z0-9.-])*([@])([a-z0-9]).([a-z]{2,3})',$email)){
    	echo "<script language='javascript' type='text/javascript'>alert('Email inválido!');window.location.href='formulario.xhtml';</script>";
    	$erro = 1;
    }

	//Valida o CPF 
    // Verifica se nenhuma das sequências invalidas abaixo foi digitada.
    if ($cpf == '00000000000' || 
        $cpf == '11111111111' || 
        $cpf == '22222222222' || 
        $cpf == '33333333333' || 
        $cpf == '44444444444' || 
        $cpf == '55555555555' || 
        $cpf == '66666666666' || 
        $cpf == '77777777777' || 
        $cpf == '88888888888' || 
        $cpf == '99999999999') {
        echo "<script language='javascript' type='text/javascript'>alert('CPF inválido!');window.location.href='formulario.xhtml';</script>";
    	$erro = 1;
	}

	//se não houver erro, faz a gravação no banco de dados.
	if ($erro == 0) {
		
		//Gravando no banco de dados ! conectando com o localhost - mysql
		$conexao = mysql_connect("localhost","root"); //localhost é onde esta o banco de dados.
		if (!$conexao)
		die ("Erro de conexão com localhost, o seguinte erro ocorreu -> ".mysql_error());

		//conectando com a tabela do banco de dados
		$banco = mysql_select_db("tecweb",$conexao); //nome da base que serão inseridos os dados cadastrais
		if (!$banco)
		die ("Erro de conexão com banco de dados, o seguinte erro ocorreu -> ".mysql_error());

		//verifica se o cpf não foi cadastrado anteriormente
		$query_procura_cpf_cadastrado = "select cpf from usuario where cpf = '$cpf'";
		$result_cpf_cadastrado = mysql_query($query_procura_cpf_cadastrado, $conexao);
		$array = mysql_fetch_array($result_cpf_cadastrado);
		$logarray = $array['cpf'];

		if($logarray == $cpf){
			echo "<script language='javascript' type='text/javascript'>alert('O CPF informado já está cadastrado! Favor informar um novo.');window.location.href='formulario.xhtml';</script>";
		}

		//Se cpf não estiver cadastrado, sistema grava novo cadastro
		else{

			//Query que realiza a inserção dos dados no banco de dados na tabela indicada acima
			$query_insert = "INSERT INTO usuario 
			VALUES ('$nome', '$cpf', '$email', '$senha', '$novidades')";
			mysql_query($query_insert,$conexao);

			//mensagem que é escrita quando os dados são inseridos normalmente.
			echo "<script language='javascript' type='text/javascript'>alert('Seu cadastro foi realizado com sucesso!!');window.location.href='login.xhtml';</script>";
		}

		mysql_close($conexao);
	}
		
?> 