<?php 

	session_start();

	// RECEBENDO OS DADOS PREENCHIDOS DO FORMUL�RIO !
	$descricao = $_POST ["descricao"];//atribui��o do campo "nome" vindo do formul�rio para variavel
	$imagem = $_FILES["imagem"]["tmp_name"];
	$erro = 0;

	//verifica se o usu�rio est� logado.
	if (!isset($_SESSION["usuario_cpf"])){
		echo "<script language='javascript' type='text/javascript'>alert('O usu�rio deve estar logado.');window.location.href='login.xhtml';</script>";
		$erro = 1;
	}	
	else {
		//Validando os campos do formul�rio
		//valida se os campos obrigat�rios foram preenchidos
		if ((empty($descricao)) || (empty($_FILES['imagem']))) {
			echo "<script language='javascript' type='text/javascript'>alert('Favor preencher todos os campos obrigat�rios.');window.location.href='cadastrar_imagem.xhtml';</script>";
			$erro = 1;
		}
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

		$imagem = base64_encode(file_get_contents($imagem));

		//Query que realiza a inser��o dos dados no banco de dados na tabela indicada acima
		$query_insert = "INSERT INTO imagem (cliente_cpf, imagem, descricao) 
		VALUES ('$_SESSION[usuario_cpf]', '".$imagem."', '$descricao')";
		mysql_query($query_insert,$conexao) or die(mysql_error());

		//mensagem que � escrita quando os dados s�o inseridos normalmente.
		echo "<script language='javascript' type='text/javascript'>alert('Imagem cadastrada com sucesso!!');window.location.href='cadastrar_imagem.php';</script>";
	
		mysql_close($conexao);
	}
		
?> 