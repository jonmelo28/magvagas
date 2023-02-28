<?php 

require __DIR__."/vendor/autoload.php";

//echo "<pre>"; print_R($_POST); echo "</pre>"; exit;

//Constante com o nome da fução que a tela tem
define('TITLE','Cadastrar Vaga');

use \App\Entity\Vaga;
use App\Session\Login;

//Obriga o usuário a está logado
Login::requireLogin();

//Instancia de vaga
$obVaga = new Vaga();

//VALIDAÇÃO DO POST 
if(isset($_POST['titulo'],$_POST['descricao'],$_POST['ativo'])){
  
  $obVaga->titulo = $_POST['titulo'];
  $obVaga->descricao = $_POST['descricao'];
  $obVaga->ativo = $_POST['ativo'];
  $obVaga->cadastrar();

  header('location: index.php?status=success');
  exit;
}

include __DIR__."/includes/header.php";
include __DIR__."/includes/formulario.php"; 
include __DIR__."/includes/footer.php";