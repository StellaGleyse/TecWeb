<?php 
	session_start();
	//var_dump($_SESSION); exit();
		
	//Parâmetros de conexão
	$conexao = mysql_connect("localhost","root"); //localhost é onde esta o banco de dados.
	if (!$conexao)
	die ("Erro de conexão com localhost, o seguinte erro ocorreu -> ".mysql_error());

	//conectando com a tabela do banco de dados
	$banco = mysql_select_db("tecweb",$conexao); //nome da base que serão inseridos os dados cadastrais
	if (!$banco)
	die ("Erro de conexão com banco de dados, o seguinte erro ocorreu -> ".mysql_error());

	if (isset($_SESSION["usuario_cpf"])){
		
		$cpf = $_SESSION["usuario_cpf"];
		//var_dump($cpf); exit();

		//Query que realiza a seleção do usuário no banco de dados
		$query = "select descricao, imagem from imagem where cliente_cpf='$cpf'";

		$busca_imagens = mysql_query($query,$conexao);

		if (mysql_num_rows($busca_imagens)<=0){
			echo "Nenhuma imagem cadastrada.";
		}

		else {
			
			while ($row = mysql_fetch_assoc($busca_imagens)){

				echo "<div class='exibe_imagem_galeria'>".'<img src="data:image/jpeg;base64, '.$row['imagem'].'" width="300px">'."</div>";

				echo $row['descricao']." <br /> <br />";

			}
		}
	}
		
?> 
