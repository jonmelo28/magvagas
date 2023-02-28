<?php 

namespace App\Db;

class Pagination{

    /**
     * Número máximo de registros por pagina
     * @var integer 
     */
    private $limit;

    /**
     * Quantidade total de resultados do banco
     * @var integer
     */
    private $result;

    /**
     * quantidades de páginas
     * @var integer
     */
    private $pages;

    /**
     * Página atual
     * @var integer
     */
    private $currentpage;

    /**
     * Construtor da classe
     * @param integer $result 
     * @param integer $currentpage
     * @param integer $limit 
     */
    public function __construct($result,$currentpage = 1, $limit = 10){
        $this->result = $result;
        $this->limit  = $limit;
        $this->currentpage = (is_numeric($currentpage) and $currentpage >0 ) ? $currentpage : 1;
        $this->calculate(); 
        
    }

    /**
     * Função para calcular a quantidade de paginas 
     */
    private function calculate(){
        //Calculo de total de páginas
       $this->pages = $this->result > 0 ? ceil($this->result / $this->limit) : 1;

       //Verifica se a página atual não esta maior que a quantidade total de páginas
       $this->currentpage = $this->currentpage <= $this->pages ? $this->currentpage : $this->pages;
    }

     /**
     * Função para buscar o limite de paginas 
     * @return string
     */
    public function getLimit(){
        //Calculo de total de páginas
        $offset = ($this->limit * ($this->currentpage - 1));
        return $offset.','.$this->limit;
    }

    /**
     * Metodo para retornar as opções de paginas 
     * @return array
     */
    public function getPages(){
        //Não retorna páginas
        if($this->pages == 1) return [];

        //Retorna as Paginas
        $paginas = [];
        for($i = 1; $i <= $this->pages; $i++){
            $paginas[] = [
                'pagina' => $i,
                'atual' => $i == $this->currentpage
            ];
        }

        return $paginas;
    }

}