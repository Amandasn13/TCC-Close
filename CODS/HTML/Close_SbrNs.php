<?php
require_once 'PHP/Conexao.php';
require_once 'PHP/funcoes_usuario.php';
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
    <title>Sobre Nós</title>
    <!--Abaixo: conexão com as folhas de estilo de bootstrap e de css pessoal/nosso-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="CSS\Close_SbrN.css" rel="stylesheet">
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
            document.getElementById("jb").style.background= "#424242";
            document.getElementById("subs").style.color= "azure";
        }
        if(h == '#fcfcff'){
            document.getElementById("tt").style.color= "#070B19";
            document.getElementById("jb").style.background= "#e91449";
            document.getElementById("subs").style.color= "azure";
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
        <a href="Close_Estudio2.php">
            <li>
                <input type="button" value="Estúdio" class="btn btn-outline-danger">
            </li>
        </a> 
        <a href="Close_GuardRp02.php">
            <li>
            <input type="button" value="Guarda-Roupa" class="btn btn-outline-primary">
            </li>
        </a>
        <a href="Close_Desp.php">
            <li>
                <input type="button" value="Desapegos" class="btn btn-outline-success">
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
<center><h1 style="font-size: 90px;" id="tt">Sobre Nós</h1>
    <h3 class="pb-3 mb-4 font-italic text-muted">Close: projeto e equipe</h3>
<br><br>
<hr style="height: 2px; background-color: rgb(201, 198, 198); width: 90%; opacity: 30%;">
<br>
<div class="d-flex" style="margin-left: 210px;">
    <div class="dropdown mr-1">
        <button type="button" class="btn btn-light dropdown-toggle" href="#jb" 
        style="background-color: #FFBD00; color:azure;">
            Projeto
        </button>
    </div>
    <div class="dropdown mr-1">
        <button type="button" class="btn btn-light" id="dropdownMenuOffset" data-toggle="dropdown"
         aria-haspopup="true" aria-expanded="false" data-offset="10,20"
          style="background-color: #f85d10; color: azure;">
              Programadores Front-end
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset" 
            style="background-color: #f85d10; width: 1230px; height: 650px; margin-right: 245px;
            margin-top: 455px;"><br>
            <div class="container">
                <div class="row justify-content-around">
                    <div class="col-lg-4" id="infos" style="color: azure;">
                        <center><img class="rounded-circle" src="IMG/Caps_Desenvolvedores/Amanda2.jpg"
                             alt="Generic placeholder image" width="250" height="250" 
                             style="border: 7px whitesmoke solid;" id="FM1"><br><br>
                        <h2 id="N1">Amanda da Silva Nunes</center></h2>
                        <p id="D1"><center>Aluna do ensino médio técnico, tem preferência por desenvolvimento 
                            front-end e visual em geral, mas já trabalhou com back-end e banco de dados. Gosta 
                            das coisas no controle, geralmente ajuda no planejamento e organização do grupo além 
                            de suas próprias tarefas. Sempre disposta a ajudar, sabe trabalhar em grupo e procura
                             manter dinâmicas tanto pessoais quanto para o coletivo.
                        </center></p>
                    </div>
                    <div class="col-lg-4" id="infos" style="color: azure;">
                        <center><img class="rounded-circle" src="IMG/Caps_Desenvolvedores/Vini.jpeg" 
                            alt="Generic placeholder image"width="250" height="250" 
                            style="border: 7px whitesmoke solid;" id="FM2"><br><br>
                        <h2 id="N2">Vinicius de Lima Santana</center></h2>
                        <p id="D2"><center>Aluno do ensino médio e técnico; tem preferência por desenvolvimento
                             front-end e design no geral, se adapta em diferentes formas de projeto. Faz as coisas
                              de forma responsável, ajuda nas definições estéticas e nas decisões coletivas do 
                              grupo. Está sempre disposto a ajudar o grupo da melhor forma possível, e se mostrou adaptável
                              também a situações problemáticas e inesperadas.</center></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dropdown mr-1">
        <button type="button" class="btn btn-light" id="dropdownMenuOffset" data-toggle="dropdown" 
        aria-haspopup="true" aria-expanded="false" data-offset="10,20" 
        style="background-color: #e91449; color: azure;">
              Programadores Back-end
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset" 
            style="background-color: #e91449; width: 1230px; height: 650px; margin-right: 460px;
            margin-top: 455px;"><br>
            <div class="container">
                <div class="row justify-content-around">
                    <div class="col-lg-4" id="infos" style="color: azure;">
                        <center><img class="rounded-circle" src="IMG/Caps_Desenvolvedores/Mancusi3.jpeg" 
                            alt="Generic placeholder image" width="250"
                        height="250" style="border: 7px whitesmoke solid;" id="FM1"><br><br>
                        <h2 id="N1">Guilherme Mancusi Simões</center></h2>
                        <p id="D1" ><center>Aluno do ensino médio e técnico, tem maior interesse por desenvolvimento 
                            front-end e visual, está responsável pelo back-end (PHP). É persistente, quando as coisas 
                            ficam difíceis e os códigos não funcionam, se desmotiva mas não desiste, volta e conserta, 
                            não tem medo de pedir ajuda e sempre cumpre com seus prazos, é prestativo e ajuda sempre que possível.
                        </center></p>
                    </div>
                    <div class="col-lg-4" id="infos" style="color: azure;">
                        <center><img class="rounded-circle" src="IMG/Caps_Desenvolvedores/joão.PNG" 
                            alt="Generic placeholder image"width="250"
                        height="250" style="border: 7px whitesmoke solid;" id="FM2"><br><br>
                        <h2 id="N2">João Victor Rodrigues Xavier</center></h2>
                        <p id="D2"><center>Aluno do ETIM de Informática da ETEC Osasco II; responsável por 
                            realizar back-end das páginas WEB, além de participar ativamente de todas as discussões 
                            decisões sobre o projeto. É prestativo, bom ouvinte, paciente e sempre aberto à discussões: 
                            nunca nega ouvir o conselho de ninguém e está sempre disposto a ajudar aqueles que necessitam 
                            e não tem orgulho ao reconhecer que precisa de ajuda em certos momentos.</center></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dropdown mr-1">
        <button type="button" class="btn btn-light" id="dropdownMenuOffset" data-toggle="dropdown" 
        aria-haspopup="true" aria-expanded="false" data-offset="10,20" 
        style="background-color: #860e86; color: azure;">
              Gerente de Banco de dados
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset" 
        style="background-color:#860e86; width: 1230px;
         height: 450px; margin-right: 665px; margin-top: 455px;"><br>
            <div class="container">
                <div class="row justify-content-around" style="color: azure;">
                    <div class=" col-4">
                            <img class="rounded-circle" src="IMG/Caps_Desenvolvedores/Pedro.PNG" 
                        alt="Generic placeholder image" width="300" height="300" 
                        style="border: 7px whitesmoke solid;" id="FM1">
                    </div>
                    <div class="col-4 form-group">
                        <h2 id="N1"><center>Pedro Henrique Pereira Lemos</center></h2>
                        <center><p id="D1">Cursando ETIM - Informática, foi responsável pela análise de cenários, 
                            regras de negócio, confecção de diagramas UML, modelagem e implementação de dados. 
                            Sempre disposto a ajudar da melhor forma possível, sabe trabalhar em grupo e possui 
                            domínio das ferramentas do pacote office, além de linguagens e frameworks para 
                            programação back-end.</p></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="dropleft mr-1">
        <button type="button" class="btn btn-light " id="dropdownMenuOffset" 
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-offset="10,20"
        style="background-color: #198bd8; color: azure;">
              Documentadores
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuOffset" 
        style="background-color:#198bd8; width: 1230px;
         height: 600px; margin-right: 895px; margin-top: 50px;"><br>
            <div class="container">
                <div class="row justify-content-around">
                    <div class="col-lg-4" id="infos" style="color: azure;">
                        <center><img class="rounded-circle" src="IMG/Caps_Desenvolvedores/Cicero.jpeg" 
                            alt="Generic placeholder image" width="250"
                        height="250" style="border: 7px whitesmoke solid;" id="FM1"><br><br>
                        <h2 id="N1">Cícero Monael Dias Pessoa Nunes</center></h2>
                        <center><p id="D1">Aluno do ensino médio integrado ao técnico. Tem preferência por desenvolvimento front-end e visual, já trabalhou com back-end e banco de dados e também está responsável pela documentação do projeto. É uma pessoa esforçada, perfeccionista e que gosta de tudo muito bem desenvolvido.</p></center>
                    </div>
                    <div class="col-lg-4" id="infos" style="color: azure;">
                        <center><img class="rounded-circle" src="IMG/Caps_Desenvolvedores/Clara2.jpeg" 
                            alt="Generic placeholder image"width="250"
                        height="250" style="border: 7px whitesmoke solid;" id="FM2"><br><br>
                        <h2 id="N2">Maria Clara Muniz da Silva</center></h2>
                        <center><p id="D2">Aluna do ensino médio e técnico; mostra preferência por documentação e programação 
                            para aplicativos mobile. É perfeccionista, gosta que tudo esteja sob controle e quando inicia algo 
                            não para até dar certo, gosta de trabalhar em grupo mas não de tomar toda a responsabilidade pra sí. </p></center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section>
    
    <br>
    <div class="jumbotron" style="width: 90%; background-color: #252424; color: azure;" id="jb">
        <div class="form-group" id="primor">
            <center><img src="IMG\Vetores\Close_DbLog (1).png" width="350px" height="400px" 
            style="margin-left: 145px; margin-right: 140px;" id="crx1"></center>
            <br><br>
            <p id="subs">Criado como um simples trabalho de conclusão de curso, o planejamento do projeto foi iniciado 
                ainda no fim de 2018, o software foi desenvolvido por 7 amigos e programado durante o período
                 pandemico de 2020. Atualmente, projeto Close é também o resultado de meses de trabalho e 
                 superação coletiva, a fim de presentear um público com uma ferramenta útil e prática para seu 
                 dia-a-dia.<br>
                Esperamos que você goste e aproveite sua experiencia nesse trabalho que foi pensado visando seu 
                conforto e usabilidade das melhores formas possíveis.
                <br><br>
                No caso de dúvidas ou sugestões, é só entrar em contato com <b>close.co.ofc@gmail.com</b>
                 </p><br>
        </div>
    </div>
    
    
</section>

</center>
<footer>
    <nav class="navbar navbar-default" role="navigation" id="rodp">
</nav>
</footer>
</body>
</html>