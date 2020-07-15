<?php
require_once 'PHP/Conexao.php';

require_once 'PHP/Login_Cadastro.php';
session_start();
if(!isset($_SESSION['IdUsuario']))
{
    header("location: ../Close_Log.php");
    exit;
}
 //logo aqui, criada uma forma de armazenar todos os dados do usuario em uma variavel.
$id = $_SESSION['IdUsuario'];
$sql = "SELECT * FROM Usuario WHERE IdUsuario = '$id'";
$resultado = mysqli_query($connect, $sql);
$dados = mysqli_fetch_array($resultado);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Estúdio</title>
    <!--Abaixo: conexão com as folhas de estilo de bootstrap e de css pessoal/nosso-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="CSS\Close_Est.css" media="all" rel="stylesheet" type="text/css">

    <style>
      @import url('CSS/Close_Est.css');
    </style>
</head>
<body id="pg"> 
<header><!--Cabeçalho-->
  <nav class="navbar navbar-default" role="navigation" id="rodp">
    <!--<h3 id="lgpr" class="nav navbar-nav">CLOSE</h3>-->
    <img src="IMG\Icones\CLOSE.png" class="nav navbar-nav" id="lgpr">
    <ul>
        <li>
            <a href="">Estúdio</a>
            <a href="">Inspirações</a>
            <a href="">Trending</a>
        </li>
       <li >
           <input type="search" placeholder="Pesquisa" id="psq">
          <img role="button" type="submit" src="IMG\Icones\unnamed.png" class="botao" height="30px" width="30px" >
       </li>
       <li >
       <a href="PHP/config.php" class="botao">Editar</a>     
       <a href="PHP/Sair.php" class="botao">Sair</a>
       </li>
    </ul>
  </nav>
</header>
<br><br>
<div class="row justify-content-around"><!-- Div de apresentação/dados do usuário-->
  <div class="col-4"> 
  <?php
    if($dados['Foto_Perfil']==""){
      echo '<img src="../IMG\Icones\8-512.png" id="uimg">';
    }else{
      echo'<img src="Fotos_Perfis/'.$dados["Foto_Perfil"].'" id="uimg">';
    }
    
    
    
    ?>
  </div>
  <div class="col-4" id="infus">
    <h1 name="socnm"><?php Echo $dados['Nome']; ?></h1>
    <h3 name="unm">@<?php Echo $dados['Nome_Usuário']; ?></h3>
    <h3 name="unm"><?php Echo $dados['Data_de_Nascimento']; ?></h3>
    <p name="ubio"><?php echo $dados['Biografia']; ?></p>  
</div>
    <!--<br><br>-->
    <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel" style="width: 100%; margin: 1% 0% 1% 0%;"><!-- div de criação do carousel com os links-->
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="4"></li>
        </ol>
        <div class="carousel-inner"><!--Organização de slides-->
          <div class="carousel-item active"><!--slide 1 e ativador de slide-->
            <img src="IMG\Samples\png1.png" class="d-block w-100" id="sl1">
            <div class="carousel-caption d-none d-md-block" id="sl1">
              <a href="Close_GuardRp.php"><h5>Guarda-Roupa</h5></a>
              <p>Estamos guardando sua roupa com o maior carinho. Quer ver o que você ja tem guardado até agora?</p>
            </div>
          </div>
          <div class="carousel-item"><!--slide 2-->
            <img src="IMG\Samples\png1.png" class="d-block w-100" id="sl2">
            <div class="carousel-caption d-none d-md-block" id="sl2">
              <h5>Trending</h5>
              <p>Que tal ver as ultimas atualizações do mundo da moda?</p>
            </div>
          </div>
          <div class="carousel-item" style="height: 60%;"><!--slide 3-->
            <img src="IMG\Samples\png1.png" class="d-block w-100" id="sl3">
              <div class="carousel-caption d-none d-md-block" id="sl3">
              <h5>Inspirações</h5>
              <p>Precisa de ideias pro seu look do dia? Vem conferir por aqui</p>
            </div>
          </div>
          <div class="carousel-item" style="height: 60%;"><!--slide 4-->
            <img src="IMG\Samples\png1.png" class="d-block w-100" id="sl4">
            <div class="carousel-caption d-none d-md-block" id="sl4">
            <h5>Cadastro de Roupas</h5>
            <p>Ta com uma peça nova e deseja guarda-la? É so vir pro Cadastro de Roupas</p>
          </div>
        </div>
        <div class="carousel-item" style="height: 60%;"><!--slide 5-->
          <img src="IMG\Samples\png1.png" class="d-block w-100" id="sl5">
          <div class="carousel-caption d-none d-md-block" id="sl5">
          <h5>Gerador</h5>
          <p>Precisa de um look e não tem ideia do que vestir? Podemos te ajudar nessa</p>
        </div>
      </div>
      </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
    </div>
          <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <br><br><br>
    <center><div class="al-fm">
    <center><h2>Querendo deixar seu estúdio um pouco mais do seu jeitinho?</h2></center><br>
    <div class="row justify-content-center" id="persz"><!--Div de personalização-->
      <div class="col-4"> 
        <h5>Opções de Fundo:</h5>   
        <div class="col-4">
         <div class="custom-control custom-switch"><!--toggles-->
          <input type="checkbox" class="custom-control-input" id="tg1">
              <!--<script type="text/javascript">
                // Função que muda a cor do fundo quando o toogle é ativado
                function Md_Cor(){
                document.getElementById("pg").style.backgroundColor = '#FFFFE6';
                }
              </script>-->
            <label class="custom-control-label" for="tg1"> Dia</label>
          </div><br><br>
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input"v id="tg2">
            <label class="custom-control-label" for="tg2"> Meio-termo</label>
          </div><br><br>
          <div class="custom-control custom-switch">
            <input type="checkbox" class="custom-control-input" id="tg3">
            <label class="custom-control-label" for="tg3">Noite</label>
          </div><br>
        </div>
    </div>
          <form class="col-4"><!--inputs radio de cores-->
          <h5>Opções de Cores:</h5>
            <input type="radio">
            <label>Opc 01</label><br><br>
            <input type="radio">
            <label>Opc 02</label><br><br>
            <input type="radio">
            <label>Opc 03</label><br><br>
            <input type="radio">
            <label>Opc 04</label><br>
          </form>
    </div>
</div></center>
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