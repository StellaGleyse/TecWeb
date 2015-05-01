<?php 

	session_start();

	// RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO !
	$descricao = $_POST ["descricao"];//atribuição do campo "nome" vindo do formulário para variavel
	$imagem = $_FILES["imagem"]["tmp_name"];
	$erro = 0;

	//verifica se o usuário está logado.
	if (!isset($_SESSION["usuario_cpf"])){
		echo "<script language='javascript' type='text/javascript'>alert('O usuário deve estar logado.');window.location.href='login.xhtml';</script>";
		$erro = 1;
	}	
	else {
		//Validando os campos do formulário
		//valida se os campos obrigatórios foram preenchidos
		if ((empty($descricao)) || (empty($_FILES['imagem']))) {
			echo "<script language='javascript' type='text/javascript'>alert('Favor preencher todos os campos obrigatórios.');window.location.href='cadastrar_imagem.xhtml';</script>";
			$erro = 1;
		}
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

		$imagem = base64_encode(file_get_contents($imagem));

		//Query que realiza a inserção dos dados no banco de dados na tabela indicada acima
		$query_insert = "INSERT INTO imagem (cliente_cpf, imagem, descricao) 
		VALUES ('$_SESSION[usuario_cpf]', '".$imagem."', '$descricao')";
		mysql_query($query_insert,$conexao) or die(mysql_error());

		//mensagem que é escrita quando os dados são inseridos normalmente.
		echo "<script language='javascript' type='text/javascript'>alert('Imagem cadastrada com sucesso!!');window.location.href='cadastrar_imagem.php';</script>";
	
		mysql_close($conexao);
	}
		
?> 