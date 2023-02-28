<?php 

require __DIR__."/vendor/autoload.php";

//echo "<pre>"; print_R($_POST); echo "</pre>"; exit;

//Constante com o nome da fução que a tela tem
define('TITLE','Editar Vaga');

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

//VALIDAÇÃO DO POST 
if(isset($_POST['titulo'],$_POST['descricao'],$_POST['ativo'])){

  $obVaga->titulo = $_POST['titulo'];
  $obVaga->descricao = $_POST['descricao'];
  $obVaga->ativo = $_POST['ativo'];
  $obVaga->atualizar();
  header('location: index.php?status=success');
  exit;
}

include __DIR__."/includes/header.php";
include __DIR__."/includes/formulario.php"; 
include __DIR__."/includes/footer.php";