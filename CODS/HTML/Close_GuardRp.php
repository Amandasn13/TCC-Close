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
$sql = "SELECT * FROM Usuario WHERE IdUsuario = '$id'";
$resultado1 = mysqli_query($connect, $sql);
$dados1 = mysqli_fetch_array($resultado1);
$u = new Usuario; 


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
    <link rel="icon" type="imagem/png" href="IMG\Vetores\Close_Logo.png">
</head>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script language="javascript">    
        $('#meuModal').on('shown.bs.modal', function () {
          $('#meuInput').trigger('focus')
        })
    </script>
    <body id="pg"> 
           
        <header><!--Cabeçalho-->
            <nav class="navbar navbar-default" role="navigation" id="rodp">
                            <!--<h3 id="lgpr" class="nav navbar-nav">CLOSE</h3>-->
    <img src="IMG\Vetores\Close_EscLog.png" class="nav navbar-nav" id="lgpr" width="80px" height="30px">
    <ul>
        <li>
            <a href="">Estúdio</a>
            <a href="">Inspirações</a>
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
    <div class="row" id="ct"><table><br>  
        <div class="col-md-4" id="cdt"><!-- img 01-->

        <?php

      if(!isset($_SESSION['IdUsuario']))
      {
          header("location: Close_Log.php");
          exit;
      }else{
        $sql = "SELECT * FROM Roupa";
                  $resultado = mysqli_query($connect, $sql);
                  while($dados = mysqli_fetch_array($resultado)){
                    $album[] = $dados; 
                  };
      }
    ?>
    <?php
    ini_set('display_errors', 0 );
    error_reporting(0);
  
    
      if($album != ""){
    
    
    ?>
        <tr>
            <?php
              $cont = 0; 
              foreach($album as $foto){
                
              $cont++;
            
            ?>
            
            <td id="cdt" class="col-md-4">
            <div class="card mb-4 shadow-sm">
        
        <img class="card-img-top"  alt="Img [100%x225]" height= "225px" width= "100%" style="  display: block;" src=" <?php echo"Fotos_Roupas/".$foto["Foto"].''; ?>" data-holder-rendered="true">
        <div class="card-body">
        <p class="card-text"><?php Echo $foto['Titulo']?></p>
        <small class="text-muted">Vezes utilizadas:</small> <small class="text-muted">0</small><br>
        <small class="text-muted">Última vez usada:</small> <small class="text-muted">DD/MM/AAAA</small><br><br>
        <div class="d-flex justify-content-between align-items-center">
          <form action="#" method="get">
          <div class="btn-group"><input type="hidden" value="<?php Echo $foto["Titulo"]; ?>" name="tit_roupa">
          <input type="hidden" value="<?php Echo $foto["IdRoupa"]; ?>" name="id_roupa">
            <button  class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalVer" type="submit">Ver</button>
              </form>
             <?php
             ini_set('display_errors', true);
             error_reporting(E_ALL|E_STRICT); 
             if(!empty($_GET) && $_SERVER['REQUEST_METHOD'] == 'GET'){
              $idroupa = $_GET['id_roupa'];
              $sql = "SELECT * FROM Roupa WHERE IdRoupa = '$idroupa'";
              $resultado3 = mysqli_query($connect, $sql);
              $dados3 = mysqli_fetch_array($resultado3);
          }   
          ?>
             
            <!--Modal Ver-->
              <div class="modal fade bd-example-modal-lg" id="ModalVer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <header>
                      <div class="container">
                        <div class="row">
                          <h5 name="unm" class="col" style="color: azure;">@<?php echo $dados1['Nome_de_Usuario'];?></h5>
                          <h5 style="color: azure; font-style: bold;;">>></h5>
                          <h5 name="rnm" class="col-6" style="color: azure;"><?php echo $dados3['Titulo'];?></h5>
                          <a class="btn btn-outline-light popover-test col dropdown-toggle" data-toggle="dropdown" href="#" title="Descrição da peça" role="button" aria-haspopup="true" aria-expanded="false" style="font-style: bold; width: 70px;">↡</a>
<div class="dropdown-menu" style="width: 500px;">
<a class="dropdown-item" href="#"><h4>Descrição</h4></a>
<div class="dropdown-divider"></div>
<div class="blog-post" style="width: inherit;">
<p class="mb-0" href="#" style="margin: 10px;">
<?php   echo $dados3['Descricao'];?>
</p>
</div>                        </div>
                      </div>
                    </header>
                    
                    <img src="<?php echo"Fotos_Roupas/".$dados3["Foto"].'';?>" alt="Imagem ilustrativa da peça de roupa" width="800px" height="600px" id="uimg">                           
                   <!--<span>
                      <ul class="pager btn-group">
                        <li class="previous btn btn-sm btn-outline-secondary" style="list-style-type: none;"><a href="#" class="previous round" href="bootstrap_list_groups.asp">&#8249;</a></li>
                        <li class="next btn btn-sm btn-outline-secondary" style="list-style-type: none;"><a href="#" class="next round" href="bootstrap_list_groups.asp">&#8250;</a></li>
                      </ul>
                    </span>-->
                  </div>
                </div>
              </div>
            <!--/Modal Ver-->
           
            <form action="#">
                        <input type="hidden" value="<?php Echo $foto["IdRoupa"]; ?>" name="id_roupa">
            <button type="submit" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalEdit">Editar</button>
        </form>
        <?php
             ini_set('display_errors', true);
             error_reporting(E_ALL|E_STRICT); 
             if(!empty($_GET) && $_SERVER['REQUEST_METHOD'] == 'GET'){
              $idroupa1 = $_GET['id_roupa'];
              $sql = "SELECT * FROM Roupa WHERE IdRoupa = '$idroupa1'";
              $resultado4 = mysqli_query($connect, $sql);
              $dados4 = mysqli_fetch_array($resultado4);
          }   
          ?>
            <!--Modal Editar-->
            <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModalEdit">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <!--Links para cada aba da modal-->
                  <ul class="nav nav-tabs ulna">
                    <li class="nav-item"><a href="#NmPc" class="nav-link" data-toggle="tab">Nome da peça</a></li>
                    <li class="nav-item"><a href="#Imgm" class="nav-link" data-toggle="tab">Imagem</a></li>
                    <li class="nav-item"><a href="#Desc" class="nav-link" data-toggle="tab">Descrição</a></li>
                   
                 </ul>
                 <!-- Conteudo das abas-->
                 <div class="tab-content">
                    <!--ABA DE ALT NOME PEÇAS-->
                    
                    <div class="tab-pane active ab-a" id="Nmpc">
                    <form method="post" name="editartitulo">
                      <br><center><h2>Deseja alterar o nome da peça?</h2><br>
                      <input type="hidden" value="<?php Echo $dados4["IdRoupa"]; ?>" name="id_roupa">
                      <label for="nmpc">É só digitar o novo nome abaixo:</label><br><br>
                      <input type="text" id="nmpc" name="nomepeca" placeholder="Digite aqui"><br><br>
                      <input type="submit" value="Confirmar"></center><br><br>
                      <?php
                if(isset($_POST['nomepeca']))
                {
                $id = addslashes($_POST['id_roupa']);
                $titulo = addslashes($_POST['nomepeca']);
               

                    $u->conexao("Tiffanny", "localhost","root","");
                    if($u->msgErro == "")
                    {
                        if($u->editartitulo($titulo, $id))
                        {
                          echo "<script language=javascript type= 'text/javascript'>
                          window.alert('Titulo alterado com sucesso!')
                          </script>";
                          echo "<script language=java script type= 'text/javascript'>
			window.location.href = 'Close_GuardRp.php'
		</script>";
                        }else{
                            echo "Não foi possivel editar!";

                        }
                    }else
                    {
                        echo "Erro: ".$u->msgErro;
                    }
                    }
            ?>   
                    </div>
                   
                    </form>
                    <!-- ABA ALT IMG-->
                    <div class="tab-pane ab-b" id="Imgm">
                        <br><center><h2>Deseja alterar a imagem da peça?</h2><br>
                        <form method="post" name="editarfoto" enctype="multipart/form-data" action="PHP/atualizarfotoroupa.php"> 
                        <input type="hidden" value="<?php Echo $dados4["IdRoupa"]; ?>" name="id_roupa">
                        <label for="imgpc">É só selecionar o novo arquivo abaixo:</label><br><br>
                        <input type="file" id="imgpc" name="arquivo"><br><br>
                        <input type="submit" value="Confirmar"></center><br><br>
                        
                  </form>
                  
                    </div>
                    <!-- ABA ALT DESCRIÇÃO-->
                    
                    <div class="tab-pane ab-c" id="Desc">
                        <br><center><h2>Deseja alterar a descrição da peça?</h2><br>
                        <form method="post" name="editardescricao">
                        <input type="hidden" value="<?php Echo $dados4["IdRoupa"]; ?>" name="id_roupa">
                        <label for="descpc">É só digitar a nova descrição abaixo:</label><br><br>
                        <input type="textarea" maxlenght="250" id="descpc" name="descrpeca" placeholder="Digite aqui"><br><br>
                        <input type="submit" value="Confirmar"></center><br><br>
                    </div>
                    <?php
                if(isset($_POST['descrpeca']))
                {
                $id = addslashes($_POST['id_roupa']);
                $titulo = addslashes($_POST['descrpeca']);
               

                    $u->conexao("Tiffanny", "localhost","root","");
                    if($u->msgErro == "")
                    {
                        if($u->editardescricao($titulo, $id))
                        {
                          echo "<script language=javascript type= 'text/javascript'>
                          window.alert('Descrição alterada com sucesso!')
                          </script>";
                          echo "<script language=java script type= 'text/javascript'>
			window.location.href = 'Close_GuardRp.php'
		</script>";
                        }else{
                            echo "Não foi possivel editar!";

                        }
                    }else
                    {
                        echo "Erro: ".$u->msgErro;
                    }
                    }
            ?> 
                    </form>
                    <!-- ABA ALT DAS TAGS-->
                   
                 </div>
                </div>
              </div>
            </div>
          <!--/Modal Editar-->
          <form action="#" method="get">
          <input type="hidden" value="<?php Echo $foto["IdRoupa"]; ?>" name="id_roupa">
            <button type="submit" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalApg">Apagar</button>
            </form>
            <?php
             ini_set('display_errors', true);
             error_reporting(E_ALL|E_STRICT); 
             if(!empty($_GET) && $_SERVER['REQUEST_METHOD'] == 'GET'){
              $idroupa = $_GET['id_roupa'];
              $sql = "SELECT * FROM Roupa WHERE IdRoupa = '$idroupa'";
              $resultado5 = mysqli_query($connect, $sql);
              $dados5 = mysqli_fetch_array($resultado5);
          }   
          ?>
          <!--Modal Apagar-->
          <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModalApg">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <header><h2 style="color: azure;"> Apagar peça</h2></header>
                  <div class="ab-e">
                    <br><center><h4>Deseja mesmo apagar a peça e todas suas informações? Essa ação não podera ser desfeita no futuro</h4></center><br>
                    <form method="post" name="apagarfoto">
                    <div class="row justify-content-around">
                   
                    <input type="hidden" value="<?php Echo $dados5["Titulo"]; ?>" name="tit_roupa">
                    <input type="hidden" value="<?php Echo $dados5["IdRoupa"]; ?>" name="id_roupa">
                        <input type="submit" value="Sim, desejo apagar" class="col-4">
                        <?php
                if(isset($_POST['tit_roupa']))
                {
                $id = addslashes($_POST['id_roupa']);
                
               

                    $u->conexao("Tiffanny", "localhost","root","");
                    if($u->msgErro == "")
                    {
                        if($u->apagarfoto($id))
                        {
                          echo "<script language=javascript type= 'text/javascript'>
                          window.alert('Roupa apagada com sucesso!')
                          </script>";
                          echo "<script language=java script type= 'text/javascript'>
			window.location.href = 'Close_GuardRp.php'
		</script>";
                        }else{
                            echo "Não foi possivel apagar!";

                        }
                    }else
                    {
                        echo "Erro: ".$u->msgErro;
                    }
                    }
            ?> 
                    </form>
                    
                        <input type="submit" value="Não, cancelar" class="col-4">
                       
                    </div>
                </div>
                <br><br>
              </div>
            </div>
        <!--/Modal Apagar-->
          </div>
        </div>
      </div>
    </div>
  </div>
                  
            </td>
           <?php
            if($cont == 3){
                echo"</tr>";
                echo"<tr>";
                $cont = 0;
            } 
              }
           ?>
        </tr>
            </div>
            </div>
            </div>
            </div>
    </table>
<?php 

            }else{
              echo'<div class="card mb-4 shadow-sm">
              <img class="card-img-top"  alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" src="IMG/Samples/IMG00.png" data-holder-rendered="true">
              <div class="card-body">
              <p class="card-text">Nenhuma roupa cadastrada, cadastre logo abaixo!</p>
              <small class="text-muted">Último acesso:</small> <small class="text-muted">DD/MM/AAAA</small><br>
              <small class="text-muted">Última vez usada:</small> <small class="text-muted">DD/MM/AAAA</small><br><br>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalVer">Ver</button>
                  <!--Modal Ver-->
                    <div class="modal fade bd-example-modal-lg" id="ModalVer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <header>
                            <div class="container">
                              <div class="row">
                                <h5 name="unm" class="col" style="color: azure;">@nome_usuario</h5>
                                <h5 style="color: azure; font-style: bold;;">>></h5>
                                <h5 name="rnm" class="col-6" style="color: azure;">@nome_roupa</h5>
                                <a href="#" role="button" class="btn btn-outline-light popover-test col" title="Descrição da peça" data-content="O conteúdo do popover é definido aqui. (no caso a descrição da roupa)" style="font-style: bold; width: 70px;">↡</a>
                              </div>
                            </div>
                          </header> 
                          <img src="" alt="Imagem ilustrativa da peça de roupa" width="800px" height="600px" id="uimg">                           
                         <!--<span>
                            <ul class="pager btn-group">
                              <li class="previous btn btn-sm btn-outline-secondary" style="list-style-type: none;"><a href="#" class="previous round" href="bootstrap_list_groups.asp">&#8249;</a></li>
                              <li class="next btn btn-sm btn-outline-secondary" style="list-style-type: none;"><a href="#" class="next round" href="bootstrap_list_groups.asp">&#8250;</a></li>
                            </ul>
                          </span>-->
                        </div>
                      </div>
                    </div>
                  <!--/Modal Ver-->
                  <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalEdit">Editar</button>
                  <!--Modal Editar-->
                  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModalEdit">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <!--Links para cada aba da modal-->
                        <ul class="nav nav-tabs ulna">
                          <li class="nav-item"><a href="#NmPc" class="nav-link" data-toggle="tab">Nome da peça</a></li>
                          <li class="nav-item"><a href="#Imgm" class="nav-link" data-toggle="tab">Imagem</a></li>
                          <li class="nav-item"><a href="#Desc" class="nav-link" data-toggle="tab">Descrição</a></li>
                          <li class="nav-item"><a href="#Tags" class="nav-link" data-toggle="tab">Tags</a></li>
                       </ul>
                       <!-- Conteudo das abas-->
                       <div class="tab-content">
                          <!--ABA DE ALT NOME PEÇAS-->
                          <div class="tab-pane active ab-a" id="Nmpc">
                            <br><center><h2>Deseja alterar o nome da peça?</h2><br>
                            <label for="nmpc">É só digitar o novo nome abaixo:</label><br><br>
                            <input type="text" id="nmpc" name="nomepeca" placeholder="Digite aqui"><br><br>
                            <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                          <!-- ABA ALT IMG-->
                          <div class="tab-pane ab-b" id="Imgm">
                              <br><center><h2>Deseja alterar a imagem da peça?</h2><br>
                              <label for="imgpc">É só selecionar o novo arquivo abaixo:</label><br><br>
                              <input type="file" id="imgpc" name="imgpeca"><br><br>
                              <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                          <!-- ABA ALT DESCRIÇÃO-->
                          <div class="tab-pane ab-c" id="Desc">
                              <br><center><h2>Deseja alterar a descrição da peça?</h2><br>
                              <label for="descpc">É só digitar a nova descrição abaixo:</label><br><br>
                              <input type="textarea" maxlenght="250" id="descpc" name="descrpeca" placeholder="Digite aqui"><br><br>
                              <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                          <!-- ABA ALT DAS TAGS-->
                          <div class="tab-pane ab-d" id="Tags">
                              <br><center><h2>Deseja alterar as tags da peça?</h2><br>
                              <label for="tagpc">É só digitar as novas tags abaixo:</label><br><br>
                              <input type="textarea" id="tagpc" name="tagspeca" placeholder="Digite aqui"><br><br>
                              <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                       </div>
                      </div>
                    </div>
                  </div>
                <!--/Modal Editar-->
                  <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalApg">Apagar</button>
                <!--Modal Apagar-->
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModalApg">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <header><h2 style="color: azure;"> Apagar peça</h2></header>
                        <div class="ab-e">
                          <br><center><h4>Deseja mesmo apagar a peça e todas suas informações? Essa ação não podera ser desfeita no futuro</h4></center><br>
                          <div class="row justify-content-around">
                              <input type="submit" value="Sim, desejo apagar" class="col-4">
                              <input type="submit" value="Não, cancelar" class="col-4">
                          </div>
                      </div>
                      <br><br>
                    </div>
                  </div>
                </div>
              <!--/Modal Apagar-->
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4"><!-- img02 -->
          <div class="card mb-4 shadow-sm">
              <img class="card-img-top"  alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" src=" IMG/Samples/IMG00.png" data-holder-rendered="true">
              <div class="card-body">
              <p class="card-text">Nenhuma roupa cadastrada, cadastre logo abaixo!</p>
              <small class="text-muted">Último acesso:</small> <small class="text-muted">DD/MM/AAAA</small><br>
              <small class="text-muted">Última vez usada:</small> <small class="text-muted">DD/MM/AAAA</small><br><br>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalVer">Ver</button>
                  <!--Modal Ver-->
                    <div class="modal fade bd-example-modal-lg" id="ModalVer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <header>
                            <div class="container">
                              <div class="row">
                                <h5 name="unm" class="col" style="color: azure;">@nome_usuario</h5>
                                <h5 style="color: azure; font-style: bold;;">>></h5>
                                <h5 name="rnm" class="col-6" style="color: azure;">@nome_roupa</h5>
                                <a href="#" role="button" class="btn btn-outline-light popover-test col" title="Descrição da peça" data-content="O conteúdo do popover é definido aqui. (no caso a descrição da roupa)" style="font-style: bold; width: 70px;">↡</a>
                              </div>
                            </div>
                          </header> 
                          <img src="" alt="Imagem ilustrativa da peça de roupa" width="800px" height="600px" id="uimg">                           
                         <!--<span>
                            <ul class="pager btn-group">
                              <li class="previous btn btn-sm btn-outline-secondary" style="list-style-type: none;"><a href="#" class="previous round" href="bootstrap_list_groups.asp">&#8249;</a></li>
                              <li class="next btn btn-sm btn-outline-secondary" style="list-style-type: none;"><a href="#" class="next round" href="bootstrap_list_groups.asp">&#8250;</a></li>
                            </ul>
                          </span>-->
                        </div>
                      </div>
                    </div>
                  <!--/Modal Ver-->
                  <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalEdit">Editar</button>
                  <!--Modal Editar-->
                  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModalEdit">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <!--Links para cada aba da modal-->
                        <ul class="nav nav-tabs ulna">
                          <li class="nav-item"><a href="#NmPc" class="nav-link" data-toggle="tab">Nome da peça</a></li>
                          <li class="nav-item"><a href="#Imgm" class="nav-link" data-toggle="tab">Imagem</a></li>
                          <li class="nav-item"><a href="#Desc" class="nav-link" data-toggle="tab">Descrição</a></li>
                          <li class="nav-item"><a href="#Tags" class="nav-link" data-toggle="tab">Tags</a></li>
                       </ul>
                       <!-- Conteudo das abas-->
                       <div class="tab-content">
                          <!--ABA DE ALT NOME PEÇAS-->
                          <div class="tab-pane active ab-a" id="Nmpc">
                            <br><center><h2>Deseja alterar o nome da peça?</h2><br>
                            <label for="nmpc">É só digitar o novo nome abaixo:</label><br><br>
                            <input type="text" id="nmpc" name="nomepeca" placeholder="Digite aqui"><br><br>
                            <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                          <!-- ABA ALT IMG-->
                          <div class="tab-pane ab-b" id="Imgm">
                              <br><center><h2>Deseja alterar a imagem da peça?</h2><br>
                              <label for="imgpc">É só selecionar o novo arquivo abaixo:</label><br><br>
                              <input type="file" id="imgpc" name="imgpeca"><br><br>
                              <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                          <!-- ABA ALT DESCRIÇÃO-->
                          <div class="tab-pane ab-c" id="Desc">
                              <br><center><h2>Deseja alterar a descrição da peça?</h2><br>
                              <label for="descpc">É só digitar a nova descrição abaixo:</label><br><br>
                              <input type="textarea" maxlenght="250" id="descpc" name="descrpeca" placeholder="Digite aqui"><br><br>
                              <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                          <!-- ABA ALT DAS TAGS-->
                          <div class="tab-pane ab-d" id="Tags">
                              <br><center><h2>Deseja alterar as tags da peça?</h2><br>
                              <label for="tagpc">É só digitar as novas tags abaixo:</label><br><br>
                              <input type="textarea" id="tagpc" name="tagspeca" placeholder="Digite aqui"><br><br>
                              <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                       </div>
                      </div>
                    </div>
                  </div>
                <!--/Modal Editar-->
                  <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalApg">Apagar</button>
                <!--Modal Apagar-->
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModalApg">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <header><h2 style="color: azure;"> Apagar peça</h2></header>
                        <div class="ab-e">
                          <br><center><h4>Deseja mesmo apagar a peça e todas suas informações? Essa ação não podera ser desfeita no futuro</h4></center><br>
                          <div class="row justify-content-around">
                              <input type="submit" value="Sim, desejo apagar" class="col-4">
                              <input type="submit" value="Não, cancelar" class="col-4">
                          </div>
                      </div>
                      <br><br>
                    </div>
                  </div>
                </div>
              <!--/Modal Apagar-->
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4"><!-- img03 -->
          <div class="card mb-4 shadow-sm">
              <img class="card-img-top"  alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" src=" IMG/Samples/IMG00.png" data-holder-rendered="true">
              <div class="card-body">
              <p class="card-text">Nenhuma roupa cadastrada, cadastre logo abaixo!</p>
              <small class="text-muted">Último acesso:</small> <small class="text-muted">DD/MM/AAAA</small><br>
              <small class="text-muted">Última vez usada:</small> <small class="text-muted">DD/MM/AAAA</small><br><br>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalVer">Ver</button>
                  <!--Modal Ver-->
                    <div class="modal fade bd-example-modal-lg" id="ModalVer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <header>
                            <div class="container">
                              <div class="row">
                                <h5 name="unm" class="col" style="color: azure;">@nome_usuario</h5>
                                <h5 style="color: azure; font-style: bold;;">>></h5>
                                <h5 name="rnm" class="col-6" style="color: azure;">@nome_roupa</h5>
                                <a href="#" role="button" class="btn btn-outline-light popover-test col" title="Descrição da peça" data-content="O conteúdo do popover é definido aqui. (no caso a descrição da roupa)" style="font-style: bold; width: 70px;">↡</a>
                              </div>
                            </div>
                          </header> 
                          <img src="" alt="Imagem ilustrativa da peça de roupa" width="800px" height="600px" id="uimg">                           
                         <!--<span>
                            <ul class="pager btn-group">
                              <li class="previous btn btn-sm btn-outline-secondary" style="list-style-type: none;"><a href="#" class="previous round" href="bootstrap_list_groups.asp">&#8249;</a></li>
                              <li class="next btn btn-sm btn-outline-secondary" style="list-style-type: none;"><a href="#" class="next round" href="bootstrap_list_groups.asp">&#8250;</a></li>
                            </ul>
                          </span>-->
                        </div>
                      </div>
                    </div>
                  <!--/Modal Ver-->
                  <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalEdit">Editar</button>
                  <!--Modal Editar-->
                  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModalEdit">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <!--Links para cada aba da modal-->
                        <ul class="nav nav-tabs ulna">
                          <li class="nav-item"><a href="#NmPc" class="nav-link" data-toggle="tab">Nome da peça</a></li>
                          <li class="nav-item"><a href="#Imgm" class="nav-link" data-toggle="tab">Imagem</a></li>
                          <li class="nav-item"><a href="#Desc" class="nav-link" data-toggle="tab">Descrição</a></li>
                          <li class="nav-item"><a href="#Tags" class="nav-link" data-toggle="tab">Tags</a></li>
                       </ul>
                       <!-- Conteudo das abas-->
                       <div class="tab-content">
                          <!--ABA DE ALT NOME PEÇAS-->
                          <div class="tab-pane active ab-a" id="Nmpc">
                            <br><center><h2>Deseja alterar o nome da peça?</h2><br>
                            <label for="nmpc">É só digitar o novo nome abaixo:</label><br><br>
                            <input type="text" id="nmpc" name="nomepeca" placeholder="Digite aqui"><br><br>
                            <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                          <!-- ABA ALT IMG-->
                          <div class="tab-pane ab-b" id="Imgm">
                              <br><center><h2>Deseja alterar a imagem da peça?</h2><br>
                              <label for="imgpc">É só selecionar o novo arquivo abaixo:</label><br><br>
                              <input type="image" id="imgpc" name="imgpeca"><br><br>
                              <input type="file" value="Confirmar"></center><br><br>
                          </div>
                          <!-- ABA ALT DESCRIÇÃO-->
                          <div class="tab-pane ab-c" id="Desc">
                              <br><center><h2>Deseja alterar a descrição da peça?</h2><br>
                              <label for="descpc">É só digitar a nova descrição abaixo:</label><br><br>
                              <input type="textarea" maxlenght="250" id="descpc" name="descrpeca" placeholder="Digite aqui"><br><br>
                              <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                          <!-- ABA ALT DAS TAGS-->
                          <div class="tab-pane ab-d" id="Tags">
                              <br><center><h2>Deseja alterar as tags da peça?</h2><br>
                              <label for="tagpc">É só digitar as novas tags abaixo:</label><br><br>
                              <input type="textarea" id="tagpc" name="tagspeca" placeholder="Digite aqui"><br><br>
                              <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                       </div>
                      </div>
                    </div>
                  </div>
                <!--/Modal Editar-->
                  <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalApg">Apagar</button>
                <!--Modal Apagar-->
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModalApg">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <header><h2 style="color: azure;"> Apagar peça</h2></header>
                        <div class="ab-e">
                          <br><center><h4>Deseja mesmo apagar a peça e todas suas informações? Essa ação não podera ser desfeita no futuro</h4></center><br>
                          <div class="row justify-content-around">
                              <input type="submit" value="Sim, desejo apagar" class="col-4">
                              <input type="submit" value="Não, cancelar" class="col-4">
                          </div>
                      </div>
                      <br><br>
                    </div>
                  </div>
                </div>
              <!--/Modal Apagar-->
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4"><!-- img 04-->
          <div class="card mb-4 shadow-sm">
             <img class="card-img-top"  alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" src=" IMG/Samples/IMG00.png" data-holder-rendered="true">
              <div class="card-body">
              <p class="card-text">Nenhuma roupa cadastrada, cadastre logo abaixo!</p>
              <small class="text-muted">Último acesso:</small> <small class="text-muted">DD/MM/AAAA</small><br>
              <small class="text-muted">Última vez usada:</small> <small class="text-muted">DD/MM/AAAA</small><br><br>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalVer">Ver</button>
                  <!--Modal Ver-->
                    <div class="modal fade bd-example-modal-lg" id="ModalVer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <header>
                            <div class="container">
                              <div class="row">
                                <h5 name="unm" class="col" style="color: azure;">@nome_usuario</h5>
                                <h5 style="color: azure; font-style: bold;;">>></h5>
                                <h5 name="rnm" class="col-6" style="color: azure;">@nome_roupa</h5>
                                <a href="#" role="button" class="btn btn-outline-light popover-test col" title="Descrição da peça" data-content="O conteúdo do popover é definido aqui. (no caso a descrição da roupa)" style="font-style: bold; width: 70px;">↡</a>
                              </div>
                            </div>
                          </header> 
                          <img src="" alt="Imagem ilustrativa da peça de roupa" width="800px" height="600px" id="uimg">                           
                         <!--<span>
                            <ul class="pager btn-group">
                              <li class="previous btn btn-sm btn-outline-secondary" style="list-style-type: none;"><a href="#" class="previous round" href="bootstrap_list_groups.asp">&#8249;</a></li>
                              <li class="next btn btn-sm btn-outline-secondary" style="list-style-type: none;"><a href="#" class="next round" href="bootstrap_list_groups.asp">&#8250;</a></li>
                            </ul>
                          </span>-->
                        </div>
                      </div>
                    </div>
                  <!--/Modal Ver-->
                  <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalEdit">Editar</button>
                  <!--Modal Editar-->
                  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModalEdit">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <!--Links para cada aba da modal-->
                        <ul class="nav nav-tabs ulna">
                          <li class="nav-item"><a href="#NmPc" class="nav-link" data-toggle="tab">Nome da peça</a></li>
                          <li class="nav-item"><a href="#Imgm" class="nav-link" data-toggle="tab">Imagem</a></li>
                          <li class="nav-item"><a href="#Desc" class="nav-link" data-toggle="tab">Descrição</a></li>
                          <li class="nav-item"><a href="#Tags" class="nav-link" data-toggle="tab">Tags</a></li>
                       </ul>
                       <!-- Conteudo das abas-->
                       <div class="tab-content">
                          <!--ABA DE ALT NOME PEÇAS-->
                          <div class="tab-pane active ab-a" id="Nmpc">
                            <br><center><h2>Deseja alterar o nome da peça?</h2><br>
                            <label for="nmpc">É só digitar o novo nome abaixo:</label><br><br>
                            <input type="text" id="nmpc" name="nomepeca" placeholder="Digite aqui"><br><br>
                            <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                          <!-- ABA ALT IMG-->
                          <div class="tab-pane ab-b" id="Imgm">
                              <br><center><h2>Deseja alterar a imagem da peça?</h2><br>
                              <label for="imgpc">É só selecionar o novo arquivo abaixo:</label><br><br>
                              <input type="file" id="imgpc" name="imgpeca"><br><br>
                              <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                          <!-- ABA ALT DESCRIÇÃO-->
                          <div class="tab-pane ab-c" id="Desc">
                              <br><center><h2>Deseja alterar a descrição da peça?</h2><br>
                              <label for="descpc">É só digitar a nova descrição abaixo:</label><br><br>
                              <input type="textarea" maxlenght="250" id="descpc" name="descrpeca" placeholder="Digite aqui"><br><br>
                              <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                          <!-- ABA ALT DAS TAGS-->
                          <div class="tab-pane ab-d" id="Tags">
                              <br><center><h2>Deseja alterar as tags da peça?</h2><br>
                              <label for="tagpc">É só digitar as novas tags abaixo:</label><br><br>
                              <input type="textarea" id="tagpc" name="tagspeca" placeholder="Digite aqui"><br><br>
                              <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                       </div>
                      </div>
                    </div>
                  </div>
                <!--/Modal Editar-->
                  <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalApg">Apagar</button>
                <!--Modal Apagar-->
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModalApg">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <header><h2 style="color: azure;"> Apagar peça</h2></header>
                        <div class="ab-e">
                          <br><center><h4>Deseja mesmo apagar a peça e todas suas informações? Essa ação não podera ser desfeita no futuro</h4></center><br>
                          <div class="row justify-content-around">
                              <input type="submit" value="Sim, desejo apagar" class="col-4">
                              <input type="submit" value="Não, cancelar" class="col-4">
                          </div>
                      </div>
                      <br><br>
                    </div>
                  </div>
                </div>
              <!--/Modal Apagar-->
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4"><!--img 05-->
          <div class="card mb-4 shadow-sm">
           <img class="card-img-top"  alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" src="IMG/Samples/IMG00.png " data-holder-rendered="true">  
            <div class="card-body">
              <p class="card-text">Nenhuma roupa cadastrada, cadastre logo abaixo!</p>
              <small class="text-muted">Último acesso:</small> <small class="text-muted">DD/MM/AAAA</small><br>
              <small class="text-muted">Última vez usada:</small> <small class="text-muted">DD/MM/AAAA</small><br><br>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalVer">Ver</button>
                  <!--Modal Ver-->
                    <div class="modal fade bd-example-modal-lg" id="ModalVer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <header>
                            <div class="container">
                              <div class="row">
                                <h5 name="unm" class="col" style="color: azure;">@nome_usuario</h5>
                                <h5 style="color: azure; font-style: bold;;">>></h5>
                                <h5 name="rnm" class="col-6" style="color: azure;">@nome_roupa</h5>
                                <a href="#" role="button" class="btn btn-outline-light popover-test col" title="Descrição da peça" data-content="O conteúdo do popover é definido aqui. (no caso a descrição da roupa)" style="font-style: bold; width: 70px;">↡</a>
                              </div>
                            </div>
                          </header> 
                          <img src="" alt="Imagem ilustrativa da peça de roupa" width="800px" height="600px" id="uimg">                           
                         <!--<span>
                            <ul class="pager btn-group">
                              <li class="previous btn btn-sm btn-outline-secondary" style="list-style-type: none;"><a href="#" class="previous round" href="bootstrap_list_groups.asp">&#8249;</a></li>
                              <li class="next btn btn-sm btn-outline-secondary" style="list-style-type: none;"><a href="#" class="next round" href="bootstrap_list_groups.asp">&#8250;</a></li>
                            </ul>
                          </span>-->
                        </div>
                      </div>
                    </div>
                  <!--/Modal Ver-->
                  <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalEdit">Editar</button>
                  <!--Modal Editar-->
                  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModalEdit">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <!--Links para cada aba da modal-->
                        <ul class="nav nav-tabs ulna">
                          <li class="nav-item"><a href="#NmPc" class="nav-link" data-toggle="tab">Nome da peça</a></li>
                          <li class="nav-item"><a href="#Imgm" class="nav-link" data-toggle="tab">Imagem</a></li>
                          <li class="nav-item"><a href="#Desc" class="nav-link" data-toggle="tab">Descrição</a></li>
                          <li class="nav-item"><a href="#Tags" class="nav-link" data-toggle="tab">Tags</a></li>
                       </ul>
                       <!-- Conteudo das abas-->
                       <div class="tab-content">
                          <!--ABA DE ALT NOME PEÇAS-->
                          <div class="tab-pane active ab-a" id="Nmpc">
                            <br><center><h2>Deseja alterar o nome da peça?</h2><br>
                            <label for="nmpc">É só digitar o novo nome abaixo:</label><br><br>
                            <input type="text" id="nmpc" name="nomepeca" placeholder="Digite aqui"><br><br>
                            <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                          <!-- ABA ALT IMG-->
                          <div class="tab-pane ab-b" id="Imgm">
                              <br><center><h2>Deseja alterar a imagem da peça?</h2><br>
                              <label for="imgpc">É só selecionar o novo arquivo abaixo:</label><br><br>
                              <input type="file" id="imgpc" name="imgpeca"><br><br>
                              <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                          <!-- ABA ALT DESCRIÇÃO-->
                          <div class="tab-pane ab-c" id="Desc">
                              <br><center><h2>Deseja alterar a descrição da peça?</h2><br>
                              <label for="descpc">É só digitar a nova descrição abaixo:</label><br><br>
                              <input type="textarea" maxlenght="250" id="descpc" name="descrpeca" placeholder="Digite aqui"><br><br>
                              <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                          <!-- ABA ALT DAS TAGS-->
                          <div class="tab-pane ab-d" id="Tags">
                              <br><center><h2>Deseja alterar as tags da peça?</h2><br>
                              <label for="tagpc">É só digitar as novas tags abaixo:</label><br><br>
                              <input type="textarea" id="tagpc" name="tagspeca" placeholder="Digite aqui"><br><br>
                              <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                       </div>
                      </div>
                    </div>
                  </div>
                <!--/Modal Editar-->
                  <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalApg">Apagar</button>
                <!--Modal Apagar-->
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModalApg">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <header><h2 style="color: azure;"> Apagar peça</h2></header>
                        <div class="ab-e">
                          <br><center><h4>Deseja mesmo apagar a peça e todas suas informações? Essa ação não podera ser desfeita no futuro</h4></center><br>
                          <div class="row justify-content-around">
                              <input type="submit" value="Sim, desejo apagar" class="col-4">
                              <input type="submit" value="Não, cancelar" class="col-4">
                          </div>
                      </div>
                      <br><br>
                    </div>
                  </div>
                </div>
              <!--/Modal Apagar-->
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4"><!--img06-->
          <div class="card mb-4 shadow-sm">
            <img class="card-img-top"  alt="Img [100%x225]" style="height: 225px; width: 100%; display: block;" src=" IMG/Samples/IMG00.png" data-holder-rendered="true">
            <div class="card-body">
              <p class="card-text">Nenhuma roupa cadastrada, cadastre logo abaixo!</p>
              <small class="text-muted">Último acesso:</small> <small class="text-muted">DD/MM/AAAA</small><br>
              <small class="text-muted">Última vez usada:</small> <small class="text-muted">DD/MM/AAAA</small><br><br>
              <div class="d-flex justify-content-between align-items-center">
                <div class="btn-group">
                  <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalVer">Ver</button>
                  <!--Modal Ver-->
                    <div class="modal fade bd-example-modal-lg" id="ModalVer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <header>
                            <div class="container">
                              <div class="row">
                                <h5 name="unm" class="col" style="color: azure;">@nome_usuario</h5>
                                <h5 style="color: azure; font-style: bold;;">>></h5>
                                <h5 name="rnm" class="col-6" style="color: azure;">@nome_roupa</h5>
                                <a href="#" role="button" class="btn btn-outline-light popover-test col" title="Descrição da peça" data-content="O conteúdo do popover é definido aqui. (no caso a descrição da roupa)" style="font-style: bold; width: 70px;">↡</a>
                              </div>
                            </div>
                          </header> 
                          <img src="" alt="Imagem ilustrativa da peça de roupa" width="800px" height="600px" id="uimg">                           
                         <!--<span>
                            <ul class="pager btn-group">
                              <li class="previous btn btn-sm btn-outline-secondary" style="list-style-type: none;"><a href="#" class="previous round" href="bootstrap_list_groups.asp">&#8249;</a></li>
                              <li class="next btn btn-sm btn-outline-secondary" style="list-style-type: none;"><a href="#" class="next round" href="bootstrap_list_groups.asp">&#8250;</a></li>
                            </ul>
                          </span>-->
                        </div>
                      </div>
                    </div>
                  <!--/Modal Ver-->
                  <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalEdit">Editar</button>
                  <!--Modal Editar-->
                  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModalEdit">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <!--Links para cada aba da modal-->
                        <ul class="nav nav-tabs ulna">
                          <li class="nav-item"><a href="#NmPc" class="nav-link" data-toggle="tab">Nome da peça</a></li>
                          <li class="nav-item"><a href="#Imgm" class="nav-link" data-toggle="tab">Imagem</a></li>
                          <li class="nav-item"><a href="#Desc" class="nav-link" data-toggle="tab">Descrição</a></li>
                          <li class="nav-item"><a href="#Tags" class="nav-link" data-toggle="tab">Tags</a></li>
                       </ul>
                       <!-- Conteudo das abas-->
                       <div class="tab-content">
                          <!--ABA DE ALT NOME PEÇAS-->
                          <div class="tab-pane active ab-a" id="Nmpc">
                            <br><center><h2>Deseja alterar o nome da peça?</h2><br>
                            <label for="nmpc">É só digitar o novo nome abaixo:</label><br><br>
                            <input type="text" id="nmpc" name="nomepeca" placeholder="Digite aqui"><br><br>
                            <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                          <!-- ABA ALT IMG-->
                          <div class="tab-pane ab-b" id="Imgm">
                              <br><center><h2>Deseja alterar a imagem da peça?</h2><br>
                              <label for="imgpc">É só selecionar o novo arquivo abaixo:</label><br><br>
                              <input type="file" id="imgpc" name="imgpeca"><br><br>
                              <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                          <!-- ABA ALT DESCRIÇÃO-->
                          <div class="tab-pane ab-c" id="Desc">
                              <br><center><h2>Deseja alterar a descrição da peça?</h2><br>
                              <label for="descpc">É só digitar a nova descrição abaixo:</label><br><br>
                              <input type="textarea" maxlenght="250" id="descpc" name="descrpeca" placeholder="Digite aqui"><br><br>
                              <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                          <!-- ABA ALT DAS TAGS-->
                          <div class="tab-pane ab-d" id="Tags">
                              <br><center><h2>Deseja alterar as tags da peça?</h2><br>
                              <label for="tagpc">É só digitar as novas tags abaixo:</label><br><br>
                              <input type="textarea" id="tagpc" name="tagspeca" placeholder="Digite aqui"><br><br>
                              <input type="submit" value="Confirmar"></center><br><br>
                          </div>
                       </div>
                      </div>
                    </div>
                  </div>
                <!--/Modal Editar-->
                  <button type="button" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalApg">Apagar</button>
                <!--Modal Apagar-->
                <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModalApg">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <header><h2 style="color: azure;"> Apagar peça</h2></header>
                        <div class="ab-e">
                          <br><center><h4>Deseja mesmo apagar a peça e todas suas informações? Essa ação não podera ser desfeita no futuro</h4></center><br>
                          <div class="row justify-content-around">
                              <input type="submit" value="Sim, desejo apagar" class="col-4">
                              <input type="submit" value="Não, cancelar" class="col-4">
                          </div>
                      </div>
                      <br><br>
                    </div>
                  </div>
                </div>
              <!--/Modal Apagar-->
                </div>
              </div>
            </div>
          </div>
        </div>
  
      </div></table>';
            }

?>

  </div>
          </div>
          </div>          
        </div><br>   
    <div> 
        <center>
        <input type="button" value="Ver Mais" class="btn btn-sm btn-outline-secondary" id="btn-pg">
        <input type="button" value="Gerador" class="btn btn-sm btn-outline-secondary" id="btn-pg">
        <input type="button" value="Cadastrar" class="btn btn-sm btn-outline-secondary" id="btn-pg" data-toggle="modal" data-target="#ModalCad">
        <!--Modal Cad de Roupas-->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModalCad">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <header><h2 style="color: azure;"> Cadastro de roupas</h2></header>

                <div class="ab-e">
                <form method="post" class="px-4 py-3" action="PHP/cadastrarfotoroupas.php" id="est-f" enctype="multipart/form-data">
                  <br><center><h4>Por favor, preencha as lacunas abaixo com os dados necessários para o cadastro da peça de roupa</h4></center><br>
                  <div class="row justify-content-center">
                    <label for="cat_roupa" class="col-4">Categoria:</label>
                      <input type="text" class="col-4" id="cat_roupa" name="categoria" placeholder="Ex: Acessório" maxlength="100" required>
                  </div><br>
                  <div class="row justify-content-center">
                    <label for="cat_roupa" class="col-4">Tipo:</label>
                      <input type="text" list="tipo" class="col-4" id="tip_roupa" name="tipo"   placeholder="Tipo de roupa (ex: calça)" maxlength="100" required>
                      <datalist id="tipo">
            <!--Acessórios: -->
            <option value="Anel"></option>
            <option value="Alargador"></option>
            <option value="Arco"></option>
            <option value="Bandana"></option>
            <option value="Bijuteria"></option>
            <option value="Bodies"></option>
            <option value="Bolsa"></option>
            <option value="Boné"></option>
            <option value="Bracelete"></option>
            <option value="Brinco"></option>
            <option value="Botton"></option>
            <option value="Carteira"></option>
            <option value="Cachecol"></option>
            <option value="Calça"></option>
            <option value="Cinto"></option>
            <option value="Chapéu"></option>
            <option value="Chupeta"></option>
            <option value="Colar"></option>
            <option value="Corrente"></option>
            <option value="Coroa"></option>
            <option value="Dedal"></option>
            <option value="Elmo"></option>
            <option value="Flanela"></option>
            <option value="Gargantilha"></option>
            <option value="Gravata"></option>
            <option value="Leque"></option>
            <option value="Luvas"></option>
            <option value="Máscara"></option>
            <option value="Mala"></option>
            <option value="Meia-Calça"></option>
            <option value="Mochila"></option>
            <option value="Miçanga"></option>
            <option value="Óculos"></option>
            <option value="Ombreira"></option>
            <option value="Piercing"></option>
            <option value="Pulseira"></option>
            <option value="Pochete"></option>
            <option value="Presilha"></option>
            <option value="Suspensório"></option>
            <option value="Relógio"></option>
            <option value="Tiara"></option>
            <option value="Tornozeleira"></option>
            <option value="Touca"></option>
            <option value="Turbante"></option>
            <!--Calçado: -->
            <option value="Bota"></option>
            <option value="Chinelo"></option>
            <option value="Crocs"></option>
            <option value="Mocassim"></option>
            <option value="Rasteira"></option>
            <option value="Sandália"></option>
            <option value="Salto"></option>
            <option value="Sapatenis"></option>
            <option value="Sapato"></option>
            <option value="Sapatilha"></option>
            <option value="Sider"></option>
            <option value="Tênis"></option>
            <!--Roupa: -->
            <option value="Bermuda"></option>
            <option value="Biquini"></option>
            <option value="Blazer"></option>
            <option value="Blusa"></option>
            <option value="Calcinha"></option>
            <option value="Calça"></option>
            <option value="Camisa"></option>
            <option value="Camiseta"></option>
            <option value="Camisola"></option>
            <option value="Capa de Chuva"></option>
            <option value="Colete"></option>
            <option value="Conjunto"></option>
            <option value="Cueca"></option>
            <option value="Esportiva"></option>
            <option value="Fantasia"></option>
            <option value="Jaqueta"></option>
            <option value="Legging"></option>
            <option value="Macacão"></option>
            <option value="Maio"></option>
        </datalist>
                  </div><br>
                  <div class="row justify-content-center">
                    <label for="cor_roupa" class="col-4">Cor:</label>
                      <input type="text" class="col-4" id="cor_roupa" name="cor" placeholder="Digite a cor da roupa" required>
                  </div><br>
                  <div class="row justify-content-center">
                    <label for="tamanho_roupa" class="col-4">Tamanho:</label>
                      <input type="text" class="col-4" id="tamanho_roupa" name="tamanho" placeholder="Tamanho da roupa">
                  </div><br>
                  <div class="row justify-content-center">
                    <label for="marc_roupa" class="col-4">Marca:</label>
                      <input type="text" class="col-4" id="marc_roupa" name="marca" placeholder="Marca">
                  </div><br>
                  <div class="row justify-content-center">
                    <label for="mat_roupa" class="col-4">Material:</label>
                      <input type="text" class="col-4" id="mat_roupa" name="material" placeholder="Material da roupa">
                  </div><br>
                  <div class="row justify-content-center">
                    <label for="tit_roupa" class="col-4">Título:</label>
                      <input type="text" class="col-4" id="tit_roupa" name="titulo" placeholder="Dê um título pra essa roupa">
                  </div><br>
                  <div class="row justify-content-center">
                    <label for="arquivo" class="col-4">Selecione a imagem:</label>
                    <input type="hidden" name="id_user" value="<?php Echo $dados1['IdUsuario']; ?>"class="form-control" required>
                    <input type="file" placeholder="Coloque aqui" name="arquivo" id="arquivo"> 
                  </div><br>
                  <div class="row justify-content-center">
                    <label for="descpc2" class="col-4">Descrição da peça (se quiser adicione ):</label>
                      <input type="textarea" class="col-4" maxlenght="250" id="descpc2" name="descricao" placeholder="Digite uma descrição aqui">
                  </div><br>
                  <input type="submit" value="Confirmar"><br><br></center>
                  <br>
              </div>
              <br><br>
            </div>
          </div>
        </div>
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