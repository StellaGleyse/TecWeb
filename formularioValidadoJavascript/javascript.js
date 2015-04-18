//Função para validar o formulário
function valida(form) {

	//Valida se o nome foi preenchido no formulário
	if (form.nome.value=="") {
		alert("O Nome deve ser preenchido.");
		form.nome.focus();
		return false;
	}


	//Valida se o nascimento foi preenchido no formulário
	if (form.nascimento.value=="dd/mm/aaaa") {
		alert("A Data de Nascimento deve ser preenchida.");
		form.nascimento.focus();
		return false;
	}

	//Valida se o e-mail foi preenchido no formulário
	var filtro_mail = /^.+@.+\..{2,3}$/
		if (!filtro_mail.test(form.email.value) || form.email.value=="") {
		alert("Preencha o e-mail corretamente.");
		form.email.focus();
		return false;
	}

	//Valida se a senha foi preenchida no formulário
	if (form.senha.value=="") {   
		alert("A senha deve ser preenchida corretamente.");
		form.senha.focus();
		return false;
	}

	//Valida se a confirmação da senha foi preenchida no formulário
	if (form.senha_confirmacao.value=="") {  
		alert("A confirmação da senha deve ser preenchida.");
		form.senha_confirmacao.focus();
		return false;
	}

	//Verifica se as senhas são iguais
	if (form.senha.value!=form.senha_confirmacao.value) {
		alert("A confirmação da senha está diferente da senha informada.");
		form.senha_confirmacao.focus();
		return false;
	}
}

//remove algum caractere de uma string (str) qualquer
function remove_caractere(str, caractere) {
	
	i = str.indexOf(caractere);
	r = "";

	if (i == -1) 
			return str;
	else 
		r += str.substring(0,i) + remove_caractere(str.substring(i + caractere.length), caractere);
		//alert (r);
	return r;
}

//valida o cpf 
function valida_cp(cpf){
	
	var filtro = /^\d{3}.\d{3}.\d{3}-\d{2}$/i;
		
	if(!filtro.test(cpf))
	{
		alert("Favor informar um CPF válido.");
		return false;
	}
	
	cpf = remove_caractere(cpf, ".");
	cpf = remove_caractere(cpf, "-");
	
	if(cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" ||
		cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" ||
		cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" ||
		cpf == "88888888888" || cpf == "99999999999")
	{
		alert("Favor informar um CPF válido.");
		return false;
	}
}

//formata o cpf com a máscara
function formata_cpf(event){
	var cpf = document.getElementById('cpf').value;

	//verifica se o caractere informado é um número. Se for uma letra, esta é apagada
	if(isNaN(cpf.charAt(cpf.length -1))){
			cpf = cpf.substring(0, (cpf.length -1));
			document.getElementById('cpf').value = cpf;
	}

	//verifica se os pontos e os traços estão nos lugares corretos
	if(cpf.length == 3 || cpf.length == 7){
		if(event.keyCode != 8)
			document.getElementById('cpf').value = (cpf + '.');
	}
	
	if(cpf.length == 11){
		if(event.keyCode != 8)
			document.getElementById('cpf').value = (cpf + '-');
	}
}

//valida data
function valida_data(data){
	var dia = parseInt(data.substring(0,2));
	var mes = parseInt(data.substring(3,5));
	var ano = parseInt(data.substring(6,10));
	//alert (ano);
	
	if (data.length != 10 || dia > 31 || mes > 12 || 1900 > ano){
		alert ('Favor informar uma data válida.');
		return false;
	}
}

//formata data
function formata_data(event){
	var data = document.getElementById('nascimento').value;

	//verifica se é um número. Se for uma letra, apaga
	if(isNaN(data.charAt(data.length -1)) || data.charAt(data.length -1) == ' '){
		data = data.substring(0, (data.length -1));
		document.getElementById('nascimento').value = data;
	}

	//coloca as barras
	if(data.length == 2 || data.length == 5){
		if( event.keyCode !=8)
			document.getElementById('nascimento').value = (data+'/');
	}
}
