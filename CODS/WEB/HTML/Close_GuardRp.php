<?php
require_once 'PHP/Conexao.php';

require_once 'PHP/Login_Cadastro.php';
session_start();
if(!isset($_SESSION['IdUsuario']))
{
    header("location: Close_Log.php");
    exit;
}
 //logo aqui, criada uma forma de armazenar todos os dados do usuario em uma variavel.
$id = $_SESSION['IdUsuario'];




//$result_usuarios = "SELECT * FROM Roupa WHERE fk_Usuario_IdUsuario = '$id'";
		//$resultado_usuarios = mysqli_query($connect, $result_usuarios);
		//while($row_usuario = mysqli_fetch_array($resultado_usuarios)){
      //echo'<img src="Fotos_Roupas/'.$row_usuario["Foto"].'" class="card-img-top" alt="Img [100%x225]" style="height: 225px; width: 100%; display: block; data-holder-rendered="true"">';

		//}
?>




<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Guarda Roupa</title>
    <!--Abaixo: conexão com as folhas de estilo de bootstrap e de css pessoal/nosso-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="CSS\Close_Gal.css" rel="stylesheet">
</head>
    <body id="pg"> 
           
        <header><!--Cabeçalho-->
            <nav class="navbar navbar-default" role="navigation" id="rodp">
                            <!--<h3 id="lgpr" class="nav navbar-nav">CLOSE</h3>-->
    <img src="IMG\Icones\CLOSE.png" class="nav navbar-nav" id="lgpr">
    <ul>
        <li>
            <a href="Close_Estudio.php">Estúdio</a>
            <a href="">Inspirações</a>
            <a href="">Trending</a>
        </li>
       <li >
           <input type="search" placeholder="Pesquisa" class="psq">
          <img role="button" type="submit" src="IMG\Icones\unnamed.png" class="botao" height="30px" width="30px" >
       </li>
       <li >
       <a href="PHP/Sair.php" class="botao">Sair</a>
       </li>
    </ul>
  </nav>
</header>
<body></body>
<div class="row justify-content-between" id="ap">
    <div class="col-4"><!-- Apresentação -->
        <h1>Guarda Roupa</h1>
        <h6>Seus looks são um arraso!</h6>
    </div>
    <div class="col-4">
        <br>
        <label>Filtro:</label>
        <input type="text" placeholder="Ex: Calças, blusas etc">
    </div>
</div>
<div class="container"><!--Div pra  exibição-->
    <div class="row" id="ct"><br>
        <div class="col-md-4" id="cdt"><!-- img 01-->
            <div class="card mb-4 shadow-sm">
            <!--< ? //$resultado_usuarios = mysqli_query($connect, $result_usuarios);
		//while($row_usuario = mysqli_fetch_array($resultado_usuarios)){
      //echo'<img src="Fotos_Roupas/'.$row_usuario["Foto"].'" class="card-img-top" alt="Img [100%x225]" style="height: 225px; width: 100%; display: block; data-holder-rendered="true"">';

    //} 
    ? >!-->     <?php $sql = "SELECT * FROM Roupa WHERE fk_Usuario_IdUsuario = '$id' AND IdRoupa = 1";
                  $resultado = mysqli_query($connect, $sql);
                  $dados = mysqli_fetch_array($resultado);
                  if($dados==""){
                    echo '<img src="Fotos_Roupas/sem.png" id="uimg">';
                  }else{
                    echo'<img src="Fotos_Roupas/'.$dados["Foto"].'" class="card-img-top" alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" >';
                    
                  }
                ?>         
                 <!--<img class="card-img-top"  alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" src=" " data-holder-rendered="true">!-->
                <div class="card-body">
                <p class="card-text"><?php 
                if($dados==""){
                    echo "Nenhuma roupa cadastrada, cadastre.";
                  }else{
                    echo $dados["Descricao"];
                    
                  } ?></p>
                               <div class="d-flex justify-content-between align-items-center">

                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg">Ver</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg">Editar</button>
                  </div>
                  <small class="text-muted">9 mins</small>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4"><!-- img02 -->
            <div class="card mb-4 shadow-sm">
                <!--<img class="card-img-top"  alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" src=" " data-holder-rendered="true">!-->
                <?php $sql = "SELECT * FROM Roupa WHERE fk_Usuario_IdUsuario = '$id' AND IdRoupa = 2";
                  $resultado = mysqli_query($connect, $sql);
                  $dados = mysqli_fetch_array($resultado);
                  if($dados==""){
                    echo '<img src="Fotos_Roupas/sem.png" class="card-img-top" alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" >';
                  }else{
                    echo'<img src="Fotos_Roupas/'.$dados["Foto"].'" class="card-img-top" alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" >';
                    
                  }
                ?>      
                <div class="card-body">
                <p class="card-text"><?php 
                if($dados==""){
                    echo "Nenhuma roupa cadastrada, cadastre.";
                  }else{
                    echo $dados["Descricao"];
                    
                  } ?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg">Ver</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg">Editar</button>
                  </div>
                  <small class="text-muted">9 mins</small>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4"><!-- img03 -->
            <div class="card mb-4 shadow-sm">
                <!--<img class="card-img-top"  alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" src=" " data-holder-rendered="true">!-->
                <?php $sql = "SELECT * FROM Roupa WHERE fk_Usuario_IdUsuario = '$id' AND IdRoupa = 3";
                  $resultado = mysqli_query($connect, $sql);
                  $dados = mysqli_fetch_array($resultado);
                  if($dados==""){
                    echo '<img src="Fotos_Roupas/sem.png" class="card-img-top" alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" >';
                  }else{
                    echo'<img src="Fotos_Roupas/'.$dados["Foto"].'" class="card-img-top" alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" >';
                    
                  }

                ?>      
                <div class="card-body">
                <p class="card-text"><?php 
                if($dados==""){
                    echo "Nenhuma roupa cadastrada, cadastre.";
                  }else{
                    echo $dados["Descricao"];
                    
                  } ?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg">Ver</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg">Editar</button>
                  </div>
                  <small class="text-muted">9 mins</small>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4"><!-- img 04-->
            <div class="card mb-4 shadow-sm">
               <!--<img class="card-img-top"  alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" src=" " data-holder-rendered="true">!-->
               <?php $sql = "SELECT * FROM Roupa WHERE fk_Usuario_IdUsuario = '$id' AND IdRoupa = 4";
                  $resultado = mysqli_query($connect, $sql);
                  $dados = mysqli_fetch_array($resultado);
                  if($dados==""){
                    echo '<img src="Fotos_Roupas/sem.png" class="card-img-top" alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" >';
                  }else{
                    echo'<img src="Fotos_Roupas/'.$dados["Foto"].'" class="card-img-top" alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" >';
                    
                  }
              
                ?>      
                <div class="card-body">
                <p class="card-text"><?php 
                if($dados==""){
                    echo "Nenhuma roupa cadastrada, cadastre.";
                  }else{
                    echo $dados["Descricao"];
                    
                  } ?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg">Ver</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg">Editar</button>
                  </div>
                  <small class="text-muted">9 mins</small>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4"><!--img 05-->
            <div class="card mb-4 shadow-sm">
             <!--<img class="card-img-top"  alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" src=" " data-holder-rendered="true">!-->
             <?php $sql = "SELECT * FROM Roupa WHERE fk_Usuario_IdUsuario = '$id' AND IdRoupa = 5";
                  $resultado = mysqli_query($connect, $sql);
                  $dados = mysqli_fetch_array($resultado);
                  if($dados==""){
                    echo '<img src="Fotos_Roupas/sem.png" class="card-img-top" alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" >';
                  }else{
                    echo'<img src="Fotos_Roupas/'.$dados["Foto"].'" class="card-img-top" alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" >';
                    
                  }
                ?>        
              <div class="card-body">
                <p class="card-text"><?php 
                if($dados==""){
                    echo "Nenhuma roupa cadastrada, cadastre.";
                  }else{
                    echo $dados["Descricao"];
                    
                  } ?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg">Ver</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg">Editar</button>
                  </div>
                  <small class="text-muted">9 mins</small>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4"><!--img06-->
            <div class="card mb-4 shadow-sm">
              <!--<img class="card-img-top"  alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" src=" " data-holder-rendered="true">!-->
              <?php $sql = "SELECT * FROM Roupa WHERE fk_Usuario_IdUsuario = '$id' AND IdRoupa = 6";
                  $resultado = mysqli_query($connect, $sql);
                  $dados = mysqli_fetch_array($resultado);
                  if($dados==""){
                    echo '<img src="Fotos_Roupas/sem.png" class="card-img-top" alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" >';
                  }else{
                    echo'<img src="Fotos_Roupas/'.$dados["Foto"].'" class="card-img-top" alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" >';
                    
                  }
                ?>      
              <div class="card-body">
                <p class="card-text"><?php 
                if($dados==""){
                    echo "Nenhuma roupa cadastrada, cadastre.";
                  }else{
                    echo $dados["Descricao"];
                    
                  } ?></p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg">Ver</button>
                    <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg">Editar</button>
                  </div>
                  <small class="text-muted">9 mins</small>
                </div>
              </div>
            </div>
          </div>
    
        </div><br>   
    <div> 
        <center>
        
        <input type="button" value="Ver Mais" class="btn btn-sm btn-outline-secondary" id="btn-pg">
        <input type="button" value="Gerador" class="btn btn-sm btn-outline-secondary" id="btn-pg">
        <a href="CadRoupas.php">
        <input type="button" value="Cadastrar" class="btn btn-sm btn-outline-secondary" id="btn-pg">
        </a>
    </div>
</div>
<footer>
    <nav class="navbar navbar-default" role="navigation" id="rodp">
    <center>
      <ul>
        <li>
            <a href="">SOBRE</a>
        </li>
        <li>
            <a href="">AJUDA</a>
        </li>
        <li>
            <a href="">NÓS</a>
        </li>
        <li>
            <a href="">CONTATO</a>
        </li>
    </ul>
  </center>
</nav>
</footer>
</body>
</html>