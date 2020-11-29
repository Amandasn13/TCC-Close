<?php
require_once 'PHP/Conexao.php';
require_once 'PHP/funcoes_usuario.php';
if(!isset($_SESSION['IdUsuario']))
{
    header("location: Close_Log02.php");
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
    <title>Desapegos</title>
    <!--Abaixo: conexão com as folhas de estilo de bootstrap e de css pessoal/nosso-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="CSS\Close_Desp.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <link rel="icon" type="imagem/png" href="IMG\Vetores\Close_Logo.png">
    <script>
        hey = function(){
            switch (localStorage.getItem("tg")){
                case "#fcfcff":
                var h = "#fcfcff";
                break ;
    
                case "#131324":
                var h = "#131324";
                break ;
    
                case "#000000":
                var h = "black";
                break ;
            }
            document.getElementById("pg").style.background= h;
            if(h == 'black','#131324'){
                document.getElementById("tt").style.color= "azure";
                document.getElementById("t1").style.color= "azure";
                document.getElementById("t2").style.color= "azure";
                document.getElementById("t3").style.color= "azure";
                document.getElementById("t4").style.color= "azure";
                document.getElementById("t5").style.color= "azure";
                document.getElementById("b1").style.color= "azure";
                document.getElementById("b2").style.color= "azure";
                document.getElementById("b3").style.color= "azure";
                document.getElementById("b4").style.color= "azure";
                document.getElementById("b5").style.color= "azure";
            }
            if(h == '#fcfcff'){
                document.getElementById("tt").style.color= "#070B19";
                document.getElementById("t1").style.color= "#070B19";
                document.getElementById("t2").style.color= "#070B19";
                document.getElementById("t3").style.color= "#070B19";
                document.getElementById("t4").style.color= "#070B19";
                document.getElementById("t5").style.color= "#070B19";
                document.getElementById("b1").style.color= "#151515";
                document.getElementById("b2").style.color= "#151515";
                document.getElementById("b3").style.color= "#151515";
                document.getElementById("b4").style.color= "#151515";
                document.getElementById("b5").style.color= "#151515";
            }
        }
    </script>
    </head>
    <body id="pg" onload='hey()'> 
<header><!--Cabeçalho-->
  <nav class="navbar navbar-default" role="navigation" id="rodp">
    <!--<h3 id="lgpr" class="nav navbar-nav">CLOSE</h3>-->
    <img src="IMG\Vetores\Close_EscLog.png" class="nav navbar-nav" id="lgpr" width="80px" height="30px">
    <ul>
        <a href="Close_GuardRp02.php">
            <li>
                <input type="button" value="Guarda-Roupa" class="btn btn-outline-primary">
            </li>
        </a>
        <a href="Close_Estudio2.php">
            <li>
                <input type="button" value="Estúdio" class="btn btn-outline-danger">
            </li>
        </a>
        <a href="PHP/Sair.php">
            <li >
                <input type="button" value="Sair" class="btn btn-outline-dark">
            </li>
        </a>
    </ul>
  </nav>
</header>
<br><br>
<center><h1 style="font-size: 90px;" id="tt">Desapegos</h1><br>
<h6 class="text-muted">Olá, quer dizer que você está com uma roupa que ja não usa mais e não sabe o que fazer com ela?<br>
Nós da equipe Close separamos algumas informações sobre instituições que podem te ajudar com isso.<br>
É só rolar pra baixo e checar o que elas têm pra te oferecer.</h6>
<br><br><br>
<hr style="height: 2px; background-color: rgb(201, 198, 198); width: 90%; opacity: 30%;">
<br><br>
<div class="container">
    <div class="row">
        <div class="col-lg-4">
            <img class="rounded-circle" src="IMG/Icones/gv.png" alt="imagem ilustrativa com uma bandeira brasileira 
            minimalista e os dizeres 'Governo do Brasil' para representar os diversos governos nacionais" width="200"
             height="200" style="border: 5px solid #393841;">
            <h2 id="t1">Iniciativas Governamentais</h2>
            <p id="b1">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
        </div>
        <div class="col-lg-4">
            <img class="rounded-circle" src="IMG/Icones/rlg.png" alt="icone minimalista com simbolos que representam 
            diversos tipos fé diferentes para representar religião" width="200" height="200" 
            style="border: 5px solid #393841;">
            <h2 id="t2">Instituições Religiosas</h2>
            <p id="b2">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
        </div>
        <div class="col-lg-4">
            <img class="rounded-circle" src="IMG/Icones/ex.png" alt="imagem do brasão (lado da medalha) para representar
             o exército brasileiro" width="200" height="200" style="border: 5px solid #393841;">
            <h2 id="t3">Exército</h2>
            <p id="b3">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
        </div>
    </div>
</div><br>
<div class="container" style="padding-left: 50px;">
    <div class="row justify-content-around">
        <div class="col-lg-4" >
            <img class="rounded-circle" src="IMG/Icones/ong.png" alt="icone ilustrativo de uma mão segurando um megafone para
            representar ONGs" width="200" height="200" style="border: 5px solid #393841;">
            <h2 id="t4">ONGs</h2>
            <p id="b4">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
        </div>
        <div class="col-lg-4">
            <img class="rounded-circle" src="IMG/Icones/mny.png" alt="icone ilustrativo de uma mão segurando um saco de dinheiro 
            para representar as trocas comerciais" width="200" height="200" style="border: 5px solid #393841;">
            <h2 id="t5">Trocas Comerciais</h2>
            <p id="b5">Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod. Nullam id dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
        </div>
    </div>
</div></center><br>
<footer>
    <nav class="navbar navbar-default" role="navigation" id="rodp">
    <center>
        <ul>
            <li>
                <a href="Close_SbrNs.php">SOBRE NÓS E CONTATO</a>
            </li>
        </ul>
  </center>
</nav>
</footer>
</body>
</html>