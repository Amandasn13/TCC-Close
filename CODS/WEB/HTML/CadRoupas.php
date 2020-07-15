<?php
//aqui eu chamei os documentos necessários e iniciei a sessão  
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
$resultado = mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($resultado);
$u = new Usuario; 
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Cadastro de roupas</title>
    <!--Abaixo: conexão com as folhas de estilo de bootstrap e de css pessoal/nosso-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="CSS\Close_CadRp.css" rel="stylesheet">
    <style>
      @import url('CSS/Close_CadRp.css');
    </style>
</head>
<body id="pg"> 
<header><!--Cabeçalho-->
  <nav class="navbar navbar-default" role="navigation" id="rodp">
    <!--<h3 id="lgpr" class="nav navbar-nav">CLOSE</h3>-->
    <img src="IMG\Icones\CLOSE.png" class="nav navbar-nav" id="lgpr">
    <ul>
        <li>
            <a href="Close_GuardRp.php">Guarda-Roupa</a>
            <a href="">Inspirações</a>
            <a href="">Trending</a>
        </li>
        <li >
          <input type="search" placeholder="Pesquisa" id="psq">
          <img role="button" type="submit" src="IMG\Icones\unnamed.png" class="botao" height="30px" width="30px" >
       </li>
       <li >
            <a href="PHP/Sair.php" class="botao">Sair</a>
       </li>
    </ul>
  </nav>
</header>
<!--COMENTÁRIO PRÉ-PREPARATORIO DE DESIGN _ coisas a serem feitas aqui:
*colocar labels nos inputs
*guardar label+input em divs como na do segundo nav de config.
*colocar pormularios numa div e  input de imagem + visualizador em outra
*Usar os alinhamentos da pag de Login para organizar as caixas do form
*estilizar form geral
-->

<br>
<center><h1>Cadastro de roupas</h1></center>
    <form method="post" class="px-4 py-3" action="PHP/cadastrarfotoroupas.php" id="est-f" enctype="multipart/form-data">
      <div class="row justify-content-around"  >  
        <div class="col-4" id="log">
            <div class="row">    
                <div class="col-md-6 mb-3">
                <label id="leflab" class="lb-st"> Categoria</label><br>
                <input type="text" class="inp" name="categoria" id="cat_roupa" placeholder="Categoria da roupa."  maxlength="100" required>
                </div>
                <div class="col-md-6 mb-3">
                <label id="rigid" class="lb-st"> Tipo</label><br>
                <input type="text" class="inp" name="tipo" id="tip_roupa" placeholder="Tipo de roupa (ex: calça)" maxlength="100" required>
                </div><br><br>
                <div class="col-md-6 mb-3">
                <label id="leflab" class="lb-st"> Descrição</label><br>
                <input type="text" class="inp" name="descricao" id="des_roupa" placeholder="Diga mais sobre..." maxlength="400">
                </div>
                <div class="col-md-6 mb-3">
                <label id="rigid" class="lb-st">Cor</label><br>
                <input type="text" class="inp" name="cor" id="cor_roupa" placeholder="Cor da roupa!" maxlength="100">
                </div><br><br>
                <div class="col-md-6 mb-3">
                <label id="leflab" class="lb-st">Tamanho</label><br>
                <input type="text" class="inp" name="tamanho" id="tam_roupa" placeholder="Tamanho da roupa!" maxlength="20">
                </div>
                <div class="col-md-6 mb-3">
                <label id="rigid" class="lb-st">Marca</label><br>
                <input type="text" class="inp" name="marca" id="marc_roupa" placeholder="Marca da roupa!" maxlength="200">
                </div><br><br>
                <div class="col-md-6 mb-3">
                <label id="leflab" class="lb-st">Material</label><br>
                <input type="text" class="inp" name="material" id="mat_roupa" placeholder="Material da roupa!" maxlength="200">
                </div>
                <div class="col-md-6 mb-3">
                <label id="rigid" class="lb-st">Título</label><br>
                <input type="text" class="inp" name="titulo" id="titulo_roupa" placeholder="Título/nome pra roupa."  maxlength="100">
                </div><br><br>
            </div>
        </div>  
        <div class="col-4" id="cad">
            <div class="col-md-6 mb-3">
                <input type="hidden" name="id_user" value="<?php Echo $dados['IdUsuario']; ?>"class="form-control" required>    
                <input type="file" placeholder="Coloque aqui" id="btg" name="arquivo" id="arquivo"  onchange="previewImagem()"><br><br> <!--AQUI É AONDE VAI FICAR A VIZUALIZAÇÃO DA IMAGEM QUANDO A PESSOA ABRIR O ARQUIVO:!-->
                <center><img style="width: 200%; height: 200%;" id="img" name="img" ></center>
            </div>
        </div>
      </div><br><br>
    <center><input type="submit" class="align-bottom" id="btg" value="Cadastrar roupa"></center>
    
    </form>
    
<!--</form!-->    

<script>
     function previewImagem() {
         var imagem = document.querySelector ('input[name=arquivo]').files[0]; 
         var preview = document.querySelector ('img[name=img]');

         var reader = new FileReader ();

         reader.onloadend = function () {
             preview.src = reader.result;
         }

         if (imagem){
             reader.readAsDataURL(imagem);
         }else{
             preview.src = "";
         }
     }
 </script>


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