<?php 


namespace App\Entity;

use App\Db\Database;
use PDO;

class Usuario{

    /**
     * Indentificador do Usuário
     * @var integer
     */
    public $id;

    /**
     * Nome do usuário
     * @var string
     */
    public $nome;

    /**
     * Email do usuário
     * @var string
     */
    public $email;

    /**
     * Hash da senha do usuário
     * @var string
     */
    public $senha;

    /**
     * Metodo responsavel por cadastrar um usuário
     * @return boolean
     */
    public function cadastar(){
           //Database
           $obDatabase = new Database('usuario');

           //Insere um novo usuário
           $this->id = $obDatabase->insert([
               'nome' => $this->nome,
               'email' => $this->email,
               'senha' => $this->senha
           ]);

           //Sucesso
           return true;
    }

    /**
     * Metodo para retornar uma instancia de usuário buscando por email
     * @param string email
     * @return Usuario
     */
    public static function getUsuario($email){
         return (new Database('usuario'))->select('email= "'.$email.'"')->fetchObject(self::class);
        
    }
}