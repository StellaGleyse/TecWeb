<?php 
	session_start();

	// RECEBENDO OS DADOS PREENCHIDOS DO FORMULÁRIO !
	$cpf = $_POST ["cpf"]; //atribuição do campo vindo do formulário para variavel
	$senha = $_POST ["senha"];
	$entrar = $_POST ["entrar"];
	$erro = 0;

	
	//Validando os campos do formulário
	//valida se os campos obrigatórios foram preenchidos
	if ((empty($cpf) || empty($senha)) == true){
		echo "<script language='javascript' type='text/javascript'>alert('Usuário e senha devem ser preenchidos.');window.location.href='login.xhtml';</script>";
		$erro = 1;
	}

	if ($erro == 0) {
		
		//Parâmetros de conexão
		$conexao = mysql_connect("localhost","root"); //localhost é onde esta o banco de dados.
		if (!$conexao)
		die ("Erro de conexão com localhost, o seguinte erro ocorreu -> ".mysql_error());

		//conectando com a tabela do banco de dados
		$banco = mysql_select_db("tecweb",$conexao); //nome da base que serão inseridos os dados cadastrais
		if (!$banco)
		die ("Erro de conexão com banco de dados, o seguinte erro ocorreu -> ".mysql_error());


		//Query que realiza a seleção do usuário no banco de dados
		if (isset($entrar)) {
			
			$query = ("select * from usuario where cpf='$cpf' and senha = '$senha'") or die ("Erro ao selecionar");

			$verifica_dados = mysql_query($query,$conexao);

			if (mysql_num_rows($verifica_dados)<=0){
				echo "<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='login.xhtml';</script>";
				die();
			}
			else {

				//Pega o nome do usuário a quem o cpf (login) pertence
				$array = mysql_fetch_array($verifica_dados);
				$nome_usuario = $array['nome'];

				//armazeno usuário na variável de sessão
				$_SESSION["usuario_cpf"] = $cpf;
				$_SESSION["nome_usuario"] = $nome_usuario;
				//echo $_SESSION["usuario"];
				//echo $_SESSION["nome_usuario"];
				
				//redireciona para a página inicial
				echo "<script language='javascript' type='text/javascript'>window.location.href='cadastrar_imagem.php';</script>";
			}
	
		}
	}
		
?> 
