<?php 

namespace App\Session;

use App\Entity\Usuario;

class Login{

    /**
     * Método responsável por inicia a sessão
     */
    private static function init(){
       //Verifica se a sessão está ativa
       if(session_status() !== PHP_SESSION_ACTIVE){
        //Inicia a sessão
        session_start(); 
       }
    }

    /**
     * Método responsável por retornar os dados do usuário
     * @return array
     */
    public static function getUsuarioLogado(){
          //Inicia a sessão
          self::init();


          //Retorna 
          return self::isLogged() ? $_SESSION['usuario'] : null;
    }

    /**
     * Método responsável por logar o usuário
     * @param Usuario $obUsuario
     */
    public static function login($obUsuario){
        //Inicia a sessão
        self::init();

        //Sessão do usuário
        $_SESSION['usuario'] =  [
            'id' => $obUsuario->id,
            'nome' => $obUsuario->nome,
            'email' => $obUsuario->email
        ];

        //Redireciona para o index.php
        header('location: index.php');
        exit;

    }

    /**
     * Método responsável por deslogar o usuário
     */
    public static function logout(){
        //Inicia a sessão
        self::init();

        //Encerra a sessão do usuário
        unset($_SESSION['usuario']);

        //Redireciona para o index.php
        header('location: login.php');
        exit;
         
    }

    /**
     * Método responsável por verificar se o usuario está logado
     * @return boolean
     */
    public static function isLogged(){
        //Inicia a sessão
        self::init();

        //Validação do usuário
        return isset($_SESSION['usuario']['id']);
    }

    /**
     * Método responsável por obrigar o usuário a estar logado para acessar
     */
    public static function requireLogin(){
        if(!self::isLogged()){
            header('location: login.php');
            exit;
        }  
    }

    /**
     * Método responsável por obrigar o usuário a estar logado para acessar
     */
    public static function requireLogout(){
        if(self::isLogged()){
            header('location: index.php');
            exit;
        }
    }

}