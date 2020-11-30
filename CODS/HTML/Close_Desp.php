<?php
require_once 'PHP/Conexao.php';
require_once 'PHP/Login_Cadastro.php';
session_start();
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
                document.getElementById("t4").style.color= "azure";
                document.getElementById("t5").style.color= "azure";
                document.getElementById("b1").style.color= "azure";
                document.getElementById("b2").style.color= "azure";
                document.getElementById("b4").style.color= "azure";
                document.getElementById("b5").style.color= "azure";
            }
            if(h == '#fcfcff'){
                document.getElementById("tt").style.color= "#070B19";
                document.getElementById("t1").style.color= "#070B19";
                document.getElementById("t2").style.color= "#070B19";
                document.getElementById("t4").style.color= "#070B19";
                document.getElementById("t5").style.color= "#070B19";
                document.getElementById("b1").style.color= "#151515";
                document.getElementById("b2").style.color= "#151515";
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
    <div class="row justify-content-around">
        <div class="col-lg-4">
            <img class="rounded-circle" src="IMG/Icones/gv.png" alt="imagem ilustrativa com uma bandeira brasileira 
            minimalista e os dizeres 'Governo do Brasil' para representar os diversos governos nacionais" width="200"
             height="200" style="border: 5px solid #393841;">
            <h2 id="t1">Iniciativas Governamentais</h2>
            <p id="b1" style="text-align: justify;">Como exemplos de ações de instituições Governamentais relacionadas ao desapegos de roupas temos a Campanha do Agasalho que incentiva a doação de roupas, agasalhos e cobertores por parte da população e empresas durante os meses de
             outono e inverno, quando a temperatura é menor. O exército quem funciona como uma central de triagem das roupas, onde grupo de voluntários recebe as peças e as separa entre homens, mulheres e crianças. Todas as roupas são lavadas e passadas e os voluntários também fazem 
             a montagem de kits para as famílias que serão beneficiadas. Os pontos de coletas variam em cada estado a maior parte se encontram em escolas, postos de gasolina e de saúde e em alguns supermercados. Existem também estados que disponibilizam uma troca beneficiente direta.</p>
        </div>
        <div class="col-lg-4">
            <img class="rounded-circle" src="IMG/Icones/mny.png" alt="icone ilustrativo de uma mão segurando um saco de dinheiro 
            para representar as trocas comerciais" width="200" height="200" style="border: 5px solid #393841;">
            <h2 id="t5">Trocas <br> Comerciais</h2>
            <p id="b5" style="text-align: justify;">O quesito "Trocas Comerciais" diz respeito às relações de compra e venda - que se estendem desde domínios físicos até os virtuais. Além de lojas de grife, o terrítório nacional também apresenta um número crescente de brechós: somente entre os anos de 2010  e 2015, essas lojas - que compram roupas usadas para revender por preços geralmente menores e/ou mais acessíveis do que seus originais - tiveram um crescimento de 22,2%. 
            No meio virtual existem dois tipos de comércios voltados à moda: os que só permitem que o usuário compre roupas, e os que permitem que o usuário não só compre como também venda peças próprias - esses sites geralmente pedem uma taxa porcentual do valor da venda para sua manuntenção ou uma taxa mensal; o parâmetro varia de acordo ao domínio.</p>
        </div>
    </div>
    </div>
</div><br>
<div class="container" style="padding-left: 50px;">
    <div class="row justify-content-around">
        <div class="col-lg-4" >
            <img class="rounded-circle" src="IMG/Icones/ong.png" alt="icone ilustrativo de uma mão segurando um megafone para
            representar ONGs" width="200" height="200" style="border: 5px solid #393841;">
            <h2 id="t4">ONGs</h2>
            <p id="b4" style="text-align: justify;">Em relação á doação de  roupas para as ONGS, o ideal é verificar com a instituição, pelo telefone ou e-mail, quais as necessidades atuais de doação. Para entregar os objetos normalmente não é necessário marcar hora. Geralmente
                 as instituições não buscam doações na casa dos doadores, sendo necessário entregar direto na instituição. Um exemplo de ONG atuante no Brasil é a AACD, que recebe doação de roupas, faz a triagem de todas as peças recebidas e encaminham 
                 para cianças e adolescentes portadores de deficiências, de acordo com tamanho e demandas identificadas.</p>
        </div>
        <div class="col-lg-4">
            <img class="rounded-circle" src="IMG/Icones/rlg.png" alt="icone minimalista com simbolos que representam 
            diversos tipos fé diferentes para representar religião" width="200" height="200" 
            style="border: 5px solid #393841;">
            <h2 id="t2">InstituiçõesReligiosas</h2>
            <p id="b2" style="text-align: justify;">As doações no Brasil voltadas à instituições religiosas consistem, em sua maioria, na doação de roupas, onde as peças são levadas para a igreja e então direcionadas a famílias carentes e de baixa renda. Um bom exemplo de tais ações, é a entidade cristã " Exército da Salvação", fundada na Europa mas atualmente está presente no mundo todo, onde seu principal objetivo é arrecadar doações, em sua maioria roupas, com intuito de encaminhar as mesmas à pessoas necessitadas.
            Outro exemplo de doação recebido por essas instituições religiosas é o dízimo, que consiste na doação de dinheiro à essas igrejas. De acordo com pesquisas, no ano de 2019 às igrejas tanto católicas quanto evangélicas, movimentaram cerca de R$21,5 bilhões de reais.</p>
        </div>
</div></center><br>
<footer>
    <nav class="navbar navbar-default" role="navigation" id="rodp">
    <center>
        <ul>
            <li>
                <a href="Close_SbrNs.php"  style="font-size: 25px;">SOBRE NÓS E CONTATO</a>
            </li>
        </ul>
  </center>
</nav>
</footer>
</body>
</html>