<!DOCTYPE html    PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">   
	<head> 
		<title> Formulário para o site </title>  
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

		<link rel="stylesheet" href="style.css" type="text/css" />
		
		<script type="text/javascript" src="javascript.js"></script>

	</head>  

	<body>

		<div id="fundo_pagina">
		
		<div id="formulario">
			
			<p id="subtitulo"> Cadastro de Imagem </p>

			<p id="logout"> <a href="logout.php"> Sair </a> </p>

			<form id="cadastro_imagem" name="cadastro_imagem" method="post" action="cad_imagem.php" onsubmit="return valida_form_imagem(this); return false;" enctype="multipart/form-data"> 

				<div id="divisao_form"> <span class="negrito"> Upload de Imagem </span>  

					<p> <label> Descrição:<span class="obrigatorio">* </span>
					<input type="text" name="descricao" size="35" maxlength="30" tabindex="1" />
					</label> 
					</p>
					
					
					<p>
					<label> Buscar 	Imagem: <span class="obrigatorio">* </span>
					<input type="file" name="imagem" id="imagem" size="35" tabindex="2" />
					</label>
					</p>

					<p id="campos_obrigatorios"> <span class="obrigatorio">* </span> Campos obrigatórios </p>
			
					<input id="botao_enviar" type="submit" value="Enviar" tabindex="3" /> 
					
				</div>	
				
			</form> 

			<div id="divisao_form">
				<p> <span class="negrito"> Galeria de imagens </span> </p>

				<?php include 'recupera_imagem.php'; ?>

			</div>

		</div>

	</div>
		
	</body>
	
	
</html>