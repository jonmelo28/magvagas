<?php 

namespace App\Db;

use PDO;
use PDOException;
use PDOStatement;

class Database{

    /**
     * Host de conexão com o banco de dados
     * @var string
     */
    const HOST = 'localhost';

    /**
     * Nome do banco de dados 
     * @var string
     */
    const NAME = 'mag_vagas';

    /**
     * Usuário do banco de dados
     * @var string
     */
    const USER = 'root';

    /**
     * Senha do banco de dados
     * @var string
     */
    const PASS = '';

    /**
     * Nome da tabela a ser utilizada
     * @var string
     */
    private $table;

    /**
     * Cria uma instancia do banco de dados
     */
    private $connection;
 
    /**
     * Define a tabela e a instancia de conexão
     * @param string $table
     */
    public function __construct($table = null){
        $this->table = $table;
        $this->setConnection();
    }

    /**
     * Metodo responsavel por criar a conexão com o banco de dados
     * 
     */
    private function setConnection(){
       try{
         $this->connection = new PDO('mysql:host='.self::HOST.';dbname='.self::NAME,self::USER,self::PASS);
         $this->connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
       }catch(PDOException $e){
        die('ERROR: '.$e->getMessage());
       }  
    }

    /**
     * Metodo responsavel por executar query dentro do banco de dados
     * @param string
     * @param array
     * @return PDOStatement 
     */
    public function execute($query,$params = []){
       try{
         $statement = $this->connection->prepare($query);
         $statement->execute($params);
         return $statement;
       }catch(PDOException $e){
        die('ERROR: '.$e->getMessage());
       }  
    }


    /**
     * Metodo responsavel por inserir dados no banco
     * @param array $values [fields => value]
     * @return integer ID inserido
     */
    public function insert($values){
      //Dados da query
      $fields = array_keys($values);
      $biends = array_pad([],count($fields), '?');
      //query de inserção no banco
       $query = 'INSERT INTO '.$this->table.' ('.implode(',',$fields).') VALUES ('.implode(',',$biends).')';
       $this->execute($query,array_values($values));

       //Retorna o id iniserido
       return $this->connection->lastInsertId();
       //echo "<pre>"; print_R($query); echo "</pre>"; exit;
    }

    /**
     * Metodo responsavel por executar uma consulta no banco
     * @param string $where
     * @param string $order
     * @param string $limit
     * @return PDOStatement 
     */
    public function select($where = null, $order = null, $limit = null, $fields = '*'){
      //Dados da query
       $where = ($where  === null || $where === '') ? '' : 'WHERE '.$where ;
       $order = ($order  === null || $order === '') ? '' : 'ORDER BY '.$order ;
       $limit = ($limit  === null || $limit === '') ? '' : 'LIMIT '.$limit  ;
       
       //Monta a query
       $query = 'SELECT '.$fields .' FROM '.$this->table.' '.$where.' '.$order.' '.$limit;
      
       //Executa a query
       return  $this->execute($query);
       
    }

      /**
     * Metodo responsavel por atualizar os dados no banco
     * @param string $where
     * @param array $values [fields => value]
     * @return boolean
     */
    public function update($where,$values){
        //Dados da query
        $fields = array_keys($values);

       //Monta a query
       $query = 'UPDATE '. $this->table.' SET '.implode("=?, ",$fields).'=? WHERE '.$where;
       
       //Executa query
       $this->execute($query,array_values($values));

       //Retorna verdadeiro
       return true;
    }

     /**
     * Metodo responsavel por atualizar os dados no banco
     * @param string $where
     * @return boolean
     */
    public function delete($where){
     
     //Monta a query
     $query = 'DELETE FROM '. $this->table.' WHERE '.$where;
     
     //Executa query
     $this->execute($query);

     //Retorna verdadeiro
     return true;
  }


}