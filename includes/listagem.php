<?php 

  $mensagem = '';   
  if(isset($_GET['status'])){
     switch($_GET['status']){
        case 'success':
            $mensagem = '<div class="alert alert-success">Ação Executada com sucesso </div>';  
            break;
        case 'error':
            $mensagem = '<div class="alert alert-danger">Ação com error na Execução </div>';  
            break;
       
     }
  }
  
  $resultado =  '';

  foreach($vagas as $vaga){
     $resultado .= '<tr>
                       <td>'.$vaga->id.'</td>
                       <td>'.$vaga->titulo.'</td>
                       <td>'.$vaga->descricao.'</td>
                       <td>'.($vaga->ativo == 's' ? 'Ativo' : 'Inativo').'</td>
                       <td>'.date('d/m/Y á\s H:i:s',strtotime($vaga->data)).'</td>
                       <td>
                       <a href="editar.php?id='.$vaga->id.'" ><button type="button" class="btn btn-primary">Editar</button> 
                       </a>
                       <a href="excluir.php?id='.$vaga->id.'" ><button type="button" class="btn btn-danger">Excluir</button> 
                       </a>
                       </td>
                    </tr>
     ';
  }

  $resultado = ($resultado === null || $resultado === '') ? '<tr>
  <td colspan="6" class="text-center">Nenhuma Vaga encontrada</td>
  </tr>' : $resultado;

  //GET's
  unset($_GET['status']);
  unset($_GET['pagina']);
  $gets = http_build_query($_GET);

  //Paginação
  $paginacao = '';
  $paginas = $obPagination->getPages();
  foreach($paginas as $key=>$pagina){
          $class = $pagina['atual'] ? 'btn-primary': 'btn-light';
          $paginacao .= '<a href="?pagina='.$pagina['pagina'].'&'.$gets.' "><button type="button" class="btn '.$class.'">'.$pagina['pagina'].'</button></a>';
  }
  //echo "<pre>"; print_r($paginas); echo "</pre>"; exit;
?>

<main>
    
   <?=$mensagem?>

    <section>
        <a href="cadastrar.php">
            <button class="btn btn-success">
                Nova Vaga
            </button>
        </a>

    </section>

    <section>
        <form method="get">
            <div class="row my-3">
                <div class="col">
                    <label >Buscar por Título</label>
                    <input type="text" name="busca" class="form-control" value="<?=$busca?>"> 
                </div>

                <div class="col">
                    <label>Status</label>
                    <select name="filtrostatus" class="form-control">
                        <option value="">Ativo/Inativo</option>
                        <option value="s" <?=$filtrostatus == 's' ? 'selected' : ''?>>Ativo</option>
                        <option value="n" <?=$filtrostatus == 'n' ? 'selected' : ''?>>Inativo</option>
                    </select>
                </div>

                <div class="col d-flex align-items-end"> 
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>

            </div>
        </form>
    </section>

    <section>
        <table class="table bg-light mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?= $resultado ?>
            </tbody>
        </table>
    </section>

    <section>
        <?=$paginacao?>
    </section>
</main>