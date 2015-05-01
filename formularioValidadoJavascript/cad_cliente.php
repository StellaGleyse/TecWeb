<?php 
	// RECEBENDO OS DADOS PREENCHIDOS DO FORMUL�RIO !
	$nome = $_POST ["nome"];//atribui��o do campo "nome" vindo do formul�rio para variavel
	$cpf = $_POST ["cpf"];
	$email = $_POST ["email"];
	$senha = $_POST ["senha"];
	$senha_confirmacao = $_POST ["senha_confirmacao"];
	$novidades = $_POST ["news"];
	$erro = 0;

	
	//Validando os campos do formul�rio
	//valida se os campos obrigat�rios foram preenchidos
	if ((empty($nome) || empty($cpf) || empty($email) || empty($senha)) == true){
		echo "<script language='javascript' type='text/javascript'>alert('Favor preencher todos os campos obrigat�rios.');window.location.href='formulario.xhtml';</script>";
		$erro = 1;
	}

	//verifica se as senhas s�o iguais.
	if ($senha != $senha_confirmacao){
		echo "<script language='javascript' type='text/javascript'>alert('A senha e sua confirma��o devem ser iguais.');window.location.href='formulario.xhtml';</script>";
		$erro = 1;
	}
	// Verifica se o email est� num formato correto de escrita.
	if (!ereg('^([a-zA-Z0-9.-])*([@])([a-z0-9]).([a-z]{2,3})',$email)){
    	echo "<script language='javascript' type='text/javascript'>alert('Email inv�lido!');window.location.href='formulario.xhtml';</script>";
    	$erro = 1;
    }

	//Valida o CPF 
    // Verifica se nenhuma das sequ�ncias invalidas abaixo foi digitada.
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
        echo "<script language='javascript' type='text/javascript'>alert('CPF inv�lido!');window.location.href='formulario.xhtml';</script>";
    	$erro = 1;
	}

	//se n�o houver erro, faz a grava��o no banco de dados.
	if ($erro == 0) {
		
		//Gravando no banco de dados ! conectando com o localhost - mysql
		$conexao = mysql_connect("localhost","root"); //localhost � onde esta o banco de dados.
		if (!$conexao)
		die ("Erro de conex�o com localhost, o seguinte erro ocorreu -> ".mysql_error());

		//conectando com a tabela do banco de dados
		$banco = mysql_select_db("tecweb",$conexao); //nome da base que ser�o inseridos os dados cadastrais
		if (!$banco)
		die ("Erro de conex�o com banco de dados, o seguinte erro ocorreu -> ".mysql_error());

		//verifica se o cpf n�o foi cadastrado anteriormente
		$query_procura_cpf_cadastrado = "select cpf from usuario where cpf = '$cpf'";
		$result_cpf_cadastrado = mysql_query($query_procura_cpf_cadastrado, $conexao);
		$array = mysql_fetch_array($result_cpf_cadastrado);
		$logarray = $array['cpf'];

		if($logarray == $cpf){
			echo "<script language='javascript' type='text/javascript'>alert('O CPF informado j� est� cadastrado! Favor informar um novo.');window.location.href='formulario.xhtml';</script>";
		}

		//Se cpf n�o estiver cadastrado, sistema grava novo cadastro
		else{

			//Query que realiza a inser��o dos dados no banco de dados na tabela indicada acima
			$query_insert = "INSERT INTO usuario 
			VALUES ('$nome', '$cpf', '$email', '$senha', '$novidades')";
			mysql_query($query_insert,$conexao);

			//mensagem que � escrita quando os dados s�o inseridos normalmente.
			echo "<script language='javascript' type='text/javascript'>alert('Seu cadastro foi realizado com sucesso!!');window.location.href='login.xhtml';</script>";
		}

		mysql_close($conexao);
	}
		
?> 