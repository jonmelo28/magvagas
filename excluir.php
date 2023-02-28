<?php 

require __DIR__."/vendor/autoload.php";

//echo "<pre>"; print_R($_POST); echo "</pre>"; exit;


use \App\Entity\Vaga;
use App\Session\Login;

//Obriga o usuário a está logado
Login::requireLogin();

//validação do ID 
if(!isset($_GET['id']) or !is_numeric($_GET['id'])){
    header('location: index.php?status=error');
    exit;
}

//Instancia de vaga
$obVaga = Vaga::getVaga($_GET['id']);

//Validação se o id da vaga existe
if(!$obVaga instanceof Vaga){
  header('location: index.php?status=error');
  exit;
}
//echo "<pre>"; print_R($obVaga); echo "</pre>"; exit;

//VALIDAÇÃO DO POST 
if(isset($_POST['excluir'])){

  $obVaga->excluir();
  header('location: index.php?status=success');
  exit;
}

include __DIR__."/includes/header.php";
include __DIR__."/includes/confirmar_exclusao.php"; 
include __DIR__."/includes/footer.php";