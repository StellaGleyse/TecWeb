<?php
ob_start();
//INICIALIZA A SESS�O 
session_start(); 

//DESTR�I AS SESSOES
unset($_SESSION[usuario]); 
unset($_SESSION[validacao]);
unset($_SESSION[senha]);
session_destroy(); 

//REDIRECIONA PARA A TELA DE LOGIN 
Header("Location: login.xhtml"); 

exit();
?>