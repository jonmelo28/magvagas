<?php 

require __DIR__."/vendor/autoload.php";

use App\Entity\Usuario;
use App\Session\Login;

//Obriga o usuário a não está logado
Login::requireLogout();

//variaveis de alerta dos formularios
$alertaLogin   = '';
$alertaCadastro = '';

if(isset($_POST['acao'])){
    switch($_POST['acao']){
        case 'logar':
            //Consulta o usuário com o parametro de email
            $obUsuario = Usuario::getUsuario($_POST['email']);
            //echo "<pre>"; print_r($obDatabase); echo "<pre>";
              //Validação da instancia e a senha do usuário
              if(!$obUsuario instanceof Usuario || !password_verify($_POST['senha'],$obUsuario->senha)){
                $alertaLogin = 'E-mail Ou Senha Inválidos';
                break;
              }

              //Loga o usuário
              Login::login($obUsuario);
            break;
        case 'cadastrar':
            if(isset($_POST['nome'],$_POST['email'],$_POST['senha'])){

            //Consulta o usuário com o parametro de email
            $obUsuario = Usuario::getUsuario($_POST['email']);

            if($obUsuario instanceof Usuario){
                $alertaCadastro = 'O e-mail digitado já esta em uso';
                break;
            }

             $obUsuario = new Usuario;
             $obUsuario->nome   = $_POST['nome'];
             $obUsuario->email = $_POST['email'];
             $obUsuario->senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
             $obUsuario->cadastar();

            //Loga o usuário
            Login::login($obUsuario);
            break;
        }
    }
}


include __DIR__."/includes/header.php";
include __DIR__."/includes/formulario_login.php"; 
include __DIR__."/includes/footer.php";