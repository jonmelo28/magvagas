<?php 

  $alertaLogin = ($alertaLogin === null || $alertaLogin === '') ? '' : '<div class="alert alert-danger">'.$alertaLogin.'</div>';
  $alertaCadastro = ($alertaCadastro === null || $alertaCadastro === '') ? '' : '<div class="alert alert-success">'.$alertaCadastro.'</div>';
  
  
?>

<div class="jumbotron text-dark bg-light">

 <div class="row p-3">

   <div class="col">

     <form method="post" >
        <h2>Login</h2>
        <?=$alertaLogin?>
        <div class="form-group">
            <label">E-mail</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group pt-2">
            <label>Senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>
        <div class="form-group pt-3">
           <button type="submit" name="acao" value="logar" class="btn btn-primary" >Entrar</button>
        </div>
     </form>

   </div>  

   <div class="col">

   <form method="post" >
        <h2 >Cadastre-se</h2>
        <?=$alertaCadastro?>
        <div>
            <label >Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>
        <div  class="pt-2">
            <label >E-mail</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="form-group pt-2">
            <label >Senha</label>
            <input type="password" name="senha" class="form-control" required>
        </div>
        <div class="form-group pt-3">
           <button type="submit" name="acao" value="cadastrar" class="btn btn-primary" >Cadastrar</button>
        </div>
     </form>

   </div>
 </div>
</div>