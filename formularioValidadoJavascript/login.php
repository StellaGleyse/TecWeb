<?php 
	session_start();

	// RECEBENDO OS DADOS PREENCHIDOS DO FORMUL�RIO !
	$cpf = $_POST ["cpf"]; //atribui��o do campo vindo do formul�rio para variavel
	$senha = $_POST ["senha"];
	$entrar = $_POST ["entrar"];
	$erro = 0;

	
	//Validando os campos do formul�rio
	//valida se os campos obrigat�rios foram preenchidos
	if ((empty($cpf) || empty($senha)) == true){
		echo "<script language='javascript' type='text/javascript'>alert('Usu�rio e senha devem ser preenchidos.');window.location.href='login.xhtml';</script>";
		$erro = 1;
	}

	if ($erro == 0) {
		
		//Par�metros de conex�o
		$conexao = mysql_connect("localhost","root"); //localhost � onde esta o banco de dados.
		if (!$conexao)
		die ("Erro de conex�o com localhost, o seguinte erro ocorreu -> ".mysql_error());

		//conectando com a tabela do banco de dados
		$banco = mysql_select_db("tecweb",$conexao); //nome da base que ser�o inseridos os dados cadastrais
		if (!$banco)
		die ("Erro de conex�o com banco de dados, o seguinte erro ocorreu -> ".mysql_error());


		//Query que realiza a sele��o do usu�rio no banco de dados
		if (isset($entrar)) {
			
			$query = ("select * from usuario where cpf='$cpf' and senha = '$senha'") or die ("Erro ao selecionar");

			$verifica_dados = mysql_query($query,$conexao);

			if (mysql_num_rows($verifica_dados)<=0){
				echo "<script language='javascript' type='text/javascript'>alert('Login e/ou senha incorretos');window.location.href='login.xhtml';</script>";
				die();
			}
			else {

				//Pega o nome do usu�rio a quem o cpf (login) pertence
				$array = mysql_fetch_array($verifica_dados);
				$nome_usuario = $array['nome'];

				//armazeno usu�rio na vari�vel de sess�o
				$_SESSION["usuario_cpf"] = $cpf;
				$_SESSION["nome_usuario"] = $nome_usuario;
				//echo $_SESSION["usuario"];
				//echo $_SESSION["nome_usuario"];
				
				//redireciona para a p�gina inicial
				echo "<script language='javascript' type='text/javascript'>window.location.href='cadastrar_imagem.php';</script>";
			}
	
		}
	}
		
?> 
