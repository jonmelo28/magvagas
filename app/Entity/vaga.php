<?php 

namespace App\Entity;

use App\Db\Database;
use PDO;

class Vaga{
    
    /**
     * 
     * IDENTIFICADOR ÚNICO DA VAGA
     * @var integer
     */
    public $id;

    /**
     * Título DA VAGA
     * @var string
     */
    public $titulo;

    /**
     * DESCRIÇÃO DA VAGA
     * @var string
     */
    public $descricao;

    /**
     * DEFINE SE A VAGA ESTA ATIVO
     * @var string ('s','n')
     */
    public $ativo;

    /**
     * DATA DE PUBLICAÇÃO DA VAGA
     * @var string
     */
    public $data;

    /**
     * Metodo responsavel por cadastrar uma nova vaga no banco
     * return boolean
     */
    public function cadastrar(){
       //definir a data
       $this->data = date('Y-m-d H:i:s');
       
       //INSERE A VAGA NO BANCO
       $obDatabase = new Database('vagas');
       $this->id = $obDatabase->insert([
        'titulo' => $this->titulo,
        'descricao' => $this->descricao,
        'ativo' => $this->ativo,
        'data' => $this->data
       ]);
    
       //echo "<pre>"; print_R($obDatabase ); echo "</pre>"; exit;
       //Retorna sucesso
       return true;
    }

    /**
     * Metodo responsavel por Atualizar uma vaga no banco
     * @return boolean
     */
    public function atualizar(){
        return (new Database('vagas'))->update('id ='.$this->id,[
        'titulo' => $this->titulo,
        'descricao' => $this->descricao,
        'ativo' => $this->ativo,
        'data' => $this->data
        ]);
    }

      /**
     * Metodo responsavel por excluir uma vaga no banco
     * @return boolean
     */
    public function excluir(){
      return (new Database('vagas'))->delete('id ='.$this->id);
  }

    /**
     * Metodo responsavel por obter as vagas no banco de dados
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return array
     */
    public static function getVagas($where = null, $order = null, $limit = null){
       return (new Database('vagas'))->select($where,$order,$limit)->fetchAll(PDO::FETCH_CLASS,self::class);
    }

    /**
     * Metodo responsavel por obter a quantidade total de vagas no banco de dados
     * @param string $where
     * @return integer
     */
    public static function getQuantidadeVagas($where = null){
      return (new Database('vagas'))->select($where,null,null,'COUNT(*) as qtd')->fetchObject()->qtd;
   }

    /**
     * Metodo responsavel por buscar vaga no banco de dados pelo seu id
     * @param integer $id
     * @return Vaga
     */
    public static function getVaga($id){
        return (new Database('vagas'))->select('id = '.$id)->fetchObject(self::class);
     }

}