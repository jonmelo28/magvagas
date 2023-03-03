<?php 

use App\Session\Login;

//Dados do usuário logado
$usuarioLogado = Login::getUsuarioLogado();

//função para verificar o usuario e mostra o nome na tela e botão para logar/deslogar do sistema
$usuario = $usuarioLogado ? $usuarioLogado['nome'].' <a href="logout.php" class="text-light font-weight-bold pl-2"> Sair </a>' : ' Visitante ';
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>MAG VAGAS</title>
  </head>
  <body class="bg-dark text-light">

  <div class="container">
    <div class="jumbotron bg-danger"> 
        <h1 class="p-2">MAG VAGAS</h1>

        
        <hr class="border-light">

        <div class="d-flex justify-content-start p-3">
          <?=$usuario?>
        </div>

    </div>
    
