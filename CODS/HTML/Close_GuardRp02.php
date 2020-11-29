<?php
require_once 'PHP/Conexao.php';
require_once 'PHP/funcoes_roupa.php';
if(!isset($_SESSION['IdUsuario']))
{
    header("location: Close_Log02.php");
    exit;
}else{
 //logo aqui, criada uma forma de armazenar todos os dados do usuario em uma variavel.
$id = $_SESSION['IdUsuario'];
$sql = "CALL Buscar_Usuario('$id')";
$resultado = mysqli_query($connect, $sql);
$dados1 = mysqli_fetch_array($resultado);
mysqli_free_result($resultado);
mysqli_next_result($connect); 
$r = new Roupa;
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Guarda-Roupa</title>
    <!--Abaixo: conexão com as folhas de estilo de bootstrap e de css pessoal/nosso-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="CSS\Close_Gal2.css" rel="stylesheet">
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
            document.getElementById("grpr").style.color= "azure";
            document.getElementById("subs").style.color= "azure";
        }
        if(h == '#fcfcff'){
            document.getElementById("tt").style.color= "#070B19";
            document.getElementById("grpr").style.color= "#151515";
            document.getElementById("subs").style.color= "#070B19";
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
        <a href="Close_Desp.php">
            <li>
                <input type="button" value="Desapegos" class="btn btn-outline-success">
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
<section>
    <center><h1 style="font-size: 90px;" id="tt">Guarda-Roupa</h1>
    <br>
    <p id="grpr"> Bem-vinde/a/o ao Guarda-Roupa, aqui você pode checar todas suas roupas cadastradas até agora</p>
    <br>
    <center><button data-toggle="modal" data-target="#ModPs" href="#ModPs" class="btn btn-primary">
        Passo a passo<a id="psps"></a></button></center>
        <br>
    <hr style="height: 2px; background-color: rgb(201, 198, 198); width: 60%; opacity: 30%;"></center>
    <br>
    <center><h3 id="subs"> O que deseja fazer agora?</h3><br></center>

<center>
        <ul class="nav" role="tablist" style="margin-left: 410px; margin-right: 0px;" id="separador">
            <li role="presentation" class="active" style="padding-left: 5px; padding-right: 5px;">
                <a href="#GdRp" role="tab" data-toggle="tab" class="btn btn-outline-secondary" id="pth1">
                    Ver Roupas<a href="#GdRp"></a></a>
            </li>
            <li role="presentation" style="padding-left: 5px; padding-right: 5px;" id="CR">
                <a data-toggle="tab" role="tab" id="CdRp">
                    <button data-toggle="modal" data-target="#ModCadRp" href="#ModCadRp" class="btn btn-outline-secondary">
                    Cadastrar Roupas</button></a>
            </li>
            <li role="presentation" style="padding-left: 5px; padding-right: 5px;">
                <a href="#EdEm" role="tab" data-toggle="tab">
                    <button data-toggle="modal" data-target="#ModCadLk" href="#ModCadLk" class="btn btn-outline-secondary">
                    Cadastrar Looks</button></a>
            </li>
            <li role="presentation" style="padding-left: 5px; padding-right: 5px;">
                <a href="#Look" role="tab" data-toggle="tab" class="btn btn-outline-secondary" id="pth">Ver Looks</a>
            </li>
        </ul></center>


        
<script>
//Códigos para alterar o estilo quando clicar "Ver Looks"
    document.getElementById("pth").onclick = function() {
                ChangePathLk()
                };

function ChangePathLk() {
  $("path").attr("d", "M0,64L40,58.7C80,53,160,43,240,53.3C320,64,400,96,"
  +"480,133.3C560,171,640,213,720,202.7C800,192,880,128,960,128C1040,128,1120,192,1200,224C1280,"
    +"256,1360,256,1400,256L1440,256L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,"
    +"960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,"
    +"40,320L0,320Z");

    var _currentFill = "#e7008a";
    $svg = $("#wv");
    $("#wvp", $svg).attr('style', "fill:"+_currentFill);
    $("#ses2").attr('style', "background-color:"+_currentFill);
}

//Códigos para alterar o estilo quando clicar "Ver Roupas"
document.getElementById("pth1").onclick = function() {
                ChangePathGr()
                };

function ChangePathGr() {
  $("path").attr("d", "M0,256L48,229.3C96,203,192,149,288,154.7C384,160,480,224,"
        +"576,218.7C672,213,768,139,864,128C960,117,1056,171,1152,197.3C1248,224,1344,224,1392,224L1440,224L1440,"
        +"320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,"
        +"288,320C192,320,96,320,48,320L0,320Z");

    var _currentFill = "#ffd700";
    $svg = $("#wv");
    $("#wvp", $svg).attr('style', "fill:"+_currentFill);
    $("#ses2").attr('style', "background-color:"+_currentFill);
}



//Códigos do/para modal passo a passo
$('#psps').click(function(e){
  var $target = $('html,body');
  $target.animate({scrollTop: $target.height()}, 500);
});

</script>

    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" id="wv">
        <path fill="#ffd700" fill-opacity="1" d="M0,256L48,229.3C96,203,192,149,288,154.7C384,160,480,224,
        576,218.7C672,213,768,139,864,128C960,117,1056,171,1152,197.3C1248,224,1344,224,1392,224L1440,224L1440,
        320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,
        288,320C192,320,96,320,48,320L0,320Z" id="wvp"></path>
    </svg>
   
</section>
<section style="background-color: #ffd700; color: whitesmoke;" id="ses2">
    <center>
    <div class="input-group" style="width: 70%;">
        <select class="custom-select" id="inputGroupSelect04" aria-label="Exemplo de select com botão addon" rows="5">
          <option selected>Filtrar organização das peças</option>
          <option value="1">Cadastros recentes</option>
          <option value="2">Ordem alfabética A-Z</option>
          <option value="3">Ordem alfabética Z-A</option>
        </select>
        <div class="input-group-append">
          <button class="btn btn-primary" type="button">Filtrar</button>
        </div>
    </div><br><br>

    <div class="container-fluid">
        <div class="tab-content">
          <!--Editar foto-->
            <div id="GdRp" role="tabpanel" class="tab-pane fade in active">
                <div style="max-height: 765px; overflow: auto;">
                    <!--Grid do Guarda-Roupa começa aqui-->
                    <div class="album py-5 ">
                        <div class="container">
                          <div class="row">
                                <?php

                                    if(!isset($_SESSION['IdUsuario']))
                                    {
                                        header("location: /Close_Log02.php");
                                        exit;
                                    }
                                        $idusuario = $dados1['IdUsuario'];
                                        $sql = "CALL Buscar_Roupas('$idusuario',1)";
                                                $resultado = mysqli_query($connect, $sql);
                                                $total = mysqli_affected_rows($connect);
                                                mysqli_free_result($resultado);
                                                mysqli_next_result($connect);
                                                if($total > 0){
                                                    $resultado = mysqli_query($connect, $sql);
                                                while($dados = mysqli_fetch_array($resultado)){
                                                    $album[] = $dados; 
                                                };
                                    
                                ?>
                                <tr>
                                    <?php
                                        $cont = 0; 
                                        foreach($album as $foto){
                                            
                                        $cont++;
                                        
                                    ?>
                                    <td>
                                        <div class="col-md-4">
                                            <div class="card mb-4 shadow-sm" id="pcrp">
                                                <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;
                                                fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width:
                                                100%; display: block;" src="<?php echo"Fotos_Roupas/".$foto["Foto"].''; ?>" data-target="#RpMod<?php echo $foto['IdRoupa'];?>" data-holder-rendered="true" data-toggle="modal" role="dialog">
                                            
                                            </div><!--Fecha card-->
                                        </div><!--Fecha componente da grid (alinhamento)-->
                                    </td>
                                    <!-- V. SEÇÃO DE MODAIS - Modal Roupas-->
                                    <div class="modal fade bd-example-modal-lg" tabindex="-1"  aria-labelledby="myLargeModalLabel" aria-hidden="true" id="RpMod<?php echo $foto['IdRoupa'];?>" style="max-height: 1200px;">
                                        <div class="modal-dialog modal-lg">
                                        <div class="modal-content" style="background-color: rgb(17, 14, 14);">
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li role="presentation" class="active" style="padding-right: 30px; padding-left: 210px; margin-top: 7px; margin-bottom: 7px;">
                                                        <a href="#VrFt<?php echo $foto['IdRoupa'];?>" role="tab" data-toggle="tab" 
                                                        style="color: whitesmoke; text-decoration: none;">Ver Peça</a>
                                                    </li>
                                                    <li role="presentation" style="padding-right: 30px; margin-top: 7px; margin-bottom: 7px;">
                                                        <a href="#EdIn<?php echo $foto['IdRoupa'];?>" data-toggle="tab" role="button" 
                                                        style="color: whitesmoke; text-decoration: none;">Alterar Dados</a>
                                                    </li>
                                                    <li role="presentation" style="padding-right: 30px; margin-top: 7px; margin-bottom: 7px;">
                                                        <a href="#TkFt<?php echo $foto['IdRoupa'];?>" role="tab" data-toggle="tab" 
                                                        style="color: whitesmoke; text-decoration: none;">Trocar Foto</a>
                                                    </li>
                                                    <li role="presentation" style="padding-right: 5px;  margin-top: 7px; margin-bottom: 7px;">
                                                        <a href="#ApDds<?php echo $foto['IdRoupa'];?>" role="tab" data-toggle="tab" style="color: whitesmoke; text-decoration: none;">Apagar Peça</a>
                                                    </li>
                                                </ul>
                                                <!--Divs de Conteúdo de cada Aba de navegação-->
                                                <div class="container">
                                                    <div class="tab-content">
                                                        <!--Ver foto-->
                                                        <div id="VrFt<?php echo $foto['IdRoupa'];?>" role="tabpanel" class="tab-pane fade in active" height="920px">
                                                            <header>
                                                                <div class="container">
                                                                    <div class="row">
                                                                        <h5 name="unm" class="col" style="color: azure;">@<?php echo $dados1['Nome_de_Usuario'];?></h5>
                                                                        <h5 style="color: azure; font-style: bold;">>></h5>
                                                                        <h5 name="rnm" class="col-6" style="color: azure;"><?php echo $foto['Titulo'];  ?></h5>
                                                                        <a class="btn btn-outline-light popover-test col dropdown-toggle" data-toggle="dropdown" href="#" title="Descrição da peça" role="button" aria-haspopup="true" aria-expanded="false" style="font-style: bold; width: 70px;">↡</a>
                                                                        <div class="dropdown-menu" style="width: 400px; margin-right: 200px; background-size: cover; padding-left: 5px; padding-right: 5px; background-image: url(IMG/fnd.png);">
                                                                            <center><h3>Outras informações</h3></center>
                                                                            <center><div style="background-color: white; width: 350px; border-radius: 10px; border: 2px solid;">
                                                                                <p><?php   echo $foto['Categoria'];?><?php   echo $foto['Tipo'];?> de <?php   echo $foto['Material'];?>, tamanho 
                                                                                <?php   echo $foto['Tamanho'];?> e cor <?php   echo $foto['Cor'];?>. <br>
                                                                                <b>Marca:</b> <?php   echo $foto['Marca'];?>.
                                                                            </p>
                                                                            </div><br>
                                                                            <div style="background-color: white; width: 350px; height:150px; max-height: 200px;
                                                                             border-radius: 10px; border: 2px solid;">
                                                                                <center><h4>Descrição:</h4></center>
                                                                                <div class="dropdown-divider"></div>
                                                                                <div data-spy="scroll" style="overflow: auto;">
                                                                                    <p style="text-align: justify; padding: 5px;"><?php   echo $foto['Descricao'];?></p>
                                                                                </div>
                                                                            </div></center><br>
                                                                        </div>                        
                                                                    </div>
                                                                </div>
                                                            </header>
                                                            <img src="<?php echo"Fotos_Roupas/".$foto["Foto"].'';?>" alt="" width="680px" height="680px" id="uimg"><br><br>
                                                        </div>
                                                        <!--Apagar Roupa-->
                                                        <div id="ApDds<?php echo $foto['IdRoupa'];?>" role="tabpanel" class="tab-pane fade in">
                                                            <br><center><form method="post" name="apagarfoto">
                                                                <h5 style="color:wheat;">Deseja mesmo apagar a peça e todas suas informações? 
                                                                Essa ação não podera ser desfeita no futuro</h5><br>
                                                                <input type="hidden" name="idroupaa"value="<?php echo $foto['IdRoupa'];?>">
                                                                <input type="submit" value="Sim, desejo apagar" class="btn btn-primary"></center><br>
                                                                <?php
                                                                    if(isset($_POST['idroupaa']))
                                                                    {
                                                                        $id = addslashes($_POST['idroupaa']);
                                                                                        
                                                                                    

                                                                        $u->conexao("Tiffanny", "localhost","root","");
                                                                        if($r->msgErro == "")
                                                                        {
                                                                            if($r->apagarfoto($id))
                                                                            {
                                                                                echo "<script language=javascript type= 'text/javascript'>
                                                                                    window.alert('Roupa apagada com sucesso!')
                                                                                    </script>";
                                                                                echo "<script language=java script type= 'text/javascript'>
                                                                                    window.location.href = 'Close_GuardRp02.php'
                                                                                    </script>";
                                                                            }else{
                                                                                echo "Não foi possivel apagar!";

                                                                            }
                                                                        }else{
                                                                            echo "Erro: ".$r->msgErro;
                                                                        }
                                                                    }
                                                                ?>
                                                            </form>
                                                        </div>
                                                        <!--Trocar Peça-->
                                                        <div id="TkFt<?php echo $foto['IdRoupa'];?>" role="tabpanel" class="tab-pane fade in">
                                                            <br><center>
                                                            <div><!-- Campo Arquivo/Imagem-->
                                                                <form method="post" name="editarfoto" enctype="multipart/form-data" action="PHP/atualizarfotoroupa.php" class="px-4 py-3" id="est-f"> 
                                                                    <input type="hidden" name="id_roupa" value="<?php echo $foto['IdRoupa'];?>">
                                                                    <label for="imgpc1<?php echo $foto['IdRoupa'];?>" style="color: azure; margin-bottom:2px;">É só selecionar o novo arquivo abaixo:<br>
                                                                    <input type="file" id="imgpc1<?php echo $foto['IdRoupa'];?>" name="arquivo<?php echo $foto['IdRoupa'];?>" 
                                                                        onchange="previewImagem<?php echo $foto['IdRoupa'];?>()">
                                                                    <center> <img name="img<?php echo $foto['IdRoupa'];?>" id="uimg" class="ov1" width="500px" height="500px"></center><br>
                                                                    </label><br>
                                                                    <input type="submit" value="Confirmar" class="btn btn-primary">
                                                                    <script language='javascript' type='text/javascript'>
                                                                        function previewImagem<?php echo $foto['IdRoupa'];?>() {
                                                                            var imagem = document.querySelector ('input[name=arquivo<?php echo $foto['IdRoupa'];?>]').files[0]; 
                                                                            var preview = document.querySelector ('img[name=img<?php echo $foto['IdRoupa'];?>]');
                                                                                                                            
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
                                                                </form> 
                                                            </div></center>
                                                        </div>
                                                        <!--Editar Roupa-->
                                                        <div id="EdIn<?php echo $foto['IdRoupa'];?>" role="tabpanel" class="tab-pane fade in"><!--Conteúdo prinipal da aba principal-->
                                                            <center><br>
                                                           
                                                                <h6 style="color:wheat;"> *você pode alterar só uma caracterísca da peça ou até mais,
                                                                    apenas preencha os campos que desejar e selecione "confirmar".
                                                                </h6><br>
                                                                <div class="container">

                                                                             
                                                                           
                                                                    <form method="post" name="editarroupa">
                                                                        <!--Campo Nome-->
                                                                        <input type="hidden" name="idroupa" value="<?php echo $foto['IdRoupa'];?>"> 
                                                                        <label for="nmpc" style="color: azure;">É só digitar o novo nome abaixo:</label><br><br>
                                                                        <input type="text" id="nmpc" class="form-control" name="nomepeca" style="width: 230px; margin-left: 1px;" placeholder="Digite aqui" value="<?php echo $foto['Titulo'];?>"> 
                                                                    
                                                                        
                                                                        <br>
                                                                    <div class="row justify-content-around" style="color: azure;">
                                                                        <div class="col-4">
                                                                            <div class="row justify-content-center">
                                                                                <label for="cat_roupa" class="col-4">Tipo:</label>
                                                                                <input type="text" list="tipo" class="col-4 col-sm-10 form-control" id="tip_roupa" name="tipo"   placeholder="Tipo de roupa (ex: calça)" maxlength="100" required value="<?php echo $foto['Tipo'];?>">
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
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <div class="row justify-content-center">
                                                                                <label for="cat_roupa" class="col-4">Categoria:</label>
                                                                                <input type="text" list="cat" class="col-4 col-sm-10 form-control" id="cat_roupa" name="categoria" placeholder="Ex: Acessório" maxlength="100" required value="<?php echo $foto['Categoria'];?>">
                                                                                <datalist id="cat">
                                                                                    <option value="Acessórios"></option>
                                                                                    <option value="Calçados"></option>
                                                                                    <option value="Moda Intima"></option>
                                                                                    <option value="Vestimenta Superior"></option>
                                                                                    <option value="Vestimenta Inferior"></option>
                                                                                </datalist>
                                                                            </div><br>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row justify-content-around" style="color: azure;">
                                                                        <div class="col-4">
                                                                            <div class="row justify-content-center">
                                                                                <label for="tamanho_roupa" class="col-4">Tamanho:</label>
                                                                                <input type="text" class="col-4 col-sm-10 form-control" id="tamanho_roupa" name="tamanho" placeholder="Tamanho da roupa" value="<?php echo $foto['Tamanho'];?>">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <div class="row justify-content-center">
                                                                                <label for="cor_roupa" class="col-4">Cor:</label>
                                                                                <input type="text" class="col-4 col-sm-10 form-control" id="cor_roupa" name="cor" placeholder="Digite a cor da roupa" required value="<?php echo $foto['Cor'];?>">
                                                                            </div><br>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row justify-content-around" style="color: azure;">
                                                                        <div class="col-4">
                                                                            <div class="row justify-content-center">
                                                                                <label for="marc_roupa" class="col-4">Marca:</label>
                                                                                <input type="text" class="col-4 col-sm-10 form-control" id="marc_roupa" name="marca" placeholder="Marca" value="<?php echo $foto['Marca'];?>">
                                                                            </div><br>  
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <div class="row justify-content-center">
                                                                                <label for="mat_roupa" class="col-4">Material:</label>
                                                                                <input type="text" class="col-4 col-sm-10 form-control" id="mat_roupa" name="material" placeholder="Material da roupa" value="<?php echo $foto['Material'];?>">
                                                                            </div><br>
                                                                        </div>
                                                                    </div>
                                                                </div><br>
                                                                    <!--Campo descrição-->
                                                                        <div class="input-group">
                                                                            <div class="input-group-prepend">
                                                                                <span class="input-group-text" for="descpc">É só digitar a nova descrição abaixo:</span>
                                                                            </div>
                                                                            <textarea class="form-control" aria-label="Com textarea" maxlenght="250" id="descpc" style="width: 200px;" 
                                                                                name="descrpeca" placeholder="Digite aqui" value="<?php echo $foto['Descricao'];?>"></textarea>
                                                                        </div> 
                                                                <br>
                                                                <input type="submit" value="Confirmar" class="btn btn-primary">
                                                                <?php
                                                                    if(isset($_POST['idroupa']))
                                                                    {
                                                                    $id = addslashes($_POST['idroupa']);
                                                                    $titulo = addslashes($_POST['nomepeca']);
                                                                    $tipo = addslashes($_POST['tipo']);
                                                                    $categoria = addslashes($_POST['categoria']);
                                                                    $tamanho = addslashes($_POST['tamanho']);
                                                                    $cor = addslashes($_POST['cor']);
                                                                    $marca = addslashes($_POST['marca']);
                                                                    $material = addslashes($_POST['material']);
                                                                    $descricao = addslashes($_POST['descrpeca']);
                                                                    


                                                                    
                                                                

                                                                        $r->conexao("Tiffanny", "localhost","root","");
                                                                        if($r->msgErro == "")
                                                                        {
                                                                            if($r->editartitulo($id, $titulo, $categoria, $tipo, $cor, $descricao, $tamanho, $marca, $material))
                                                                            {
                                                                            echo "<script language=javascript type= 'text/javascript'>
                                                                            window.alert('Informações alteradas com sucesso!')
                                                                            </script>";
                                                                            echo "<script language=java script type= 'text/javascript'>
                                                                                window.location.href = 'Close_GuardRp02.php'
                                                                                </script>";
                                                                            }else{
                                                                                echo "Não foi possivel editar!";
    

                                                                            }
                                                                        }else
                                                                        {
                                                                            echo "Erro: ".$r->msgErro;
                                                                        }
                                                                    }
                                                                ?>
                                                            </form>    
                                                            </center><br><br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>    
                                    <?php
                                        if($cont == 3){
                                            echo"</tr>";
                                            echo"<tr>";
                                            $cont = 0;
                                        } 
                                        }
                                    ?>
                                </tr>
                                <?php 
                                        }else{
                                        echo'                            <div class="col-md-4">
                                        <div class="card mb-4 shadow-sm" id="pcrp">
                                            <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;
                                            fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width:
                                            100%; display: block;" src="IMG/Samples/IMG00.png" data-target="RpMod" data-holder-rendered="true">
                                        </div><!--Fecha card-->
                                    </div><!--Fecha componente da grid (alinhamento)-->
                                    <div class="col-md-4">
                                        <div class="card mb-4 shadow-sm" id="pcrp">
                                            <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;
                                            fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width:
                                            100%; display: block;" src="IMG/Samples/IMG5.png" data-target="RpMod" data-holder-rendered="true">
                                        </div><!--Fecha card-->
                                    </div><!--Fecha componente da grid (alinhamento)-->
                                    <div class="col-md-4">
                                        <div class="card mb-4 shadow-sm" id="pcrp">
                                            <img class="card-img-top" data-src="holder.js/100px225?theme=thumb&amp;bg=55595c&amp;
                                            fg=eceeef&amp;text=Thumbnail" alt="Thumbnail [100%x225]" style="height: 225px; width:
                                            100%; display: block;" src="IMG/Samples/IMG6.png" data-target="RpMod" data-holder-rendered="true">
                                        </div><!--Fecha card-->
                                    </div>';
                                    }
                                ?>               
                            </div>
                        </div>
                    </div>
                    <!--Grid do Guarda-Roupa termina aqui-->
                </div>
            </div>
            <div id="Look" role="tabpanel" class="tab-pane fade in active">
                <div style="color: whitesmoke;">
                    <div style="max-height: 765px; overflow: auto;">
                        <!--Grid da Seção de Looks começa aqui-->
                        <div class="album py-5 ">
                            <div class="container">
                              <div class="row">
                                <div class="col">
                                        <button class="btn btn-dark" style="width: 350px;" data-toggle="modal"
                                        data-target="#LkMod"> @nomelook </button>
                                </div><!--Fecha componente da grid (alinhamento)-->
                                <div class="col">
                                        <button class="btn btn-dark" style="width: 350px;" data-toggle="modal"
                                        data-target="#LkMod"> @nomelook </button>
                                </div><!--Fecha componente da grid (alinhamento)-->
                                <div class="col">
                                        <button class="btn btn-dark" style="width: 350px;" data-toggle="modal"
                                        data-target="#LkMod"> @nomelook </button>
                                </div><!--Fecha componente da grid (alinhamento)-->
                              </div>
                            </div>
                        </div>
                        <!--Grid do Guarda-Roupa termina aqui-->
                    </div>
                </div>
            </div>
        </div>
    </div>    

    </center>
    <!--Começo do rodapé da página-->
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
</section>


<!--Modal Cad de Roupas-->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModCadRp">
    <div class="modal-dialog modal-xl">
      <div class="modal-content" style="background-color: rgb(17, 14, 14); color: azure;">
        <header><center><h2 style="color: azure;"> Cadastro de roupas</h2></header>
        <div>
            <form method="post" class="px-4 py-3" action="PHP/cadastrarfotoroupas.php" id="est-f" enctype="multipart/form-data">
                <br><h4>Por favor, preencha as lacunas abaixo com os dados necessários para o cadastro da peça de roupa</h4></center><br>
                <div class="container">    
                    <div class="row justify-content-around">
                        <div class="col-4">
                            <div class="row justify-content-center">
                            <label for="cat_roupa" class="col-4">Categoria:</label>
                            <input type="text" class="col-4 col-sm-10" id="cat_roupa" name="categoria" placeholder="Ex: Acessório" maxlength="100" required>
                            </div><br>
                            <div class="row justify-content-center">
                            <label for="cat_roupa" class="col-4">Tipo:</label>
                            <input type="text" list="tipo" class="col-4 col-sm-10" id="tip_roupa" name="tipo"   placeholder="Tipo de roupa (ex: calça)" maxlength="100" required>
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
                            <input type="text" class="col-4 col-sm-10" id="cor_roupa" name="cor" placeholder="Digite a cor da roupa" required>
                            </div><br>
                            <div class="row justify-content-center">
                            <label for="tamanho_roupa" class="col-4">Tamanho:</label>
                            <input type="text" class="col-4 col-sm-10" id="tamanho_roupa" name="tamanho" placeholder="Tamanho da roupa">
                            </div>
                        </div><br>
                        <div class="col-4">
                            <div class="row justify-content-center">
                            <label for="marc_roupa" class="col-4">Marca:</label>
                            <input type="text" class="col-4 col-sm-10" id="marc_roupa" name="marca" placeholder="Marca">
                            </div><br>
                            <div class="row justify-content-center">
                            <label for="mat_roupa" class="col-4">Material:</label>
                            <input type="text" class="col-4 col-sm-10" id="mat_roupa" name="material" placeholder="Material da roupa">
                            </div><br>
                            <div class="row justify-content-center">
                            <label for="tit_roupa" class="col-4">Título:</label>
                            <input type="text" class="col-4 col-sm-10" id="tit_roupa" name="titulo" placeholder="Dê um título pra essa roupa">
                            </div><br><br>
                            <div class="row justify-content-center">
                            <label for="arquivo" class="col-4" style="color: yellow;">Imagem (clique aqui)</label>
                            <input type="hidden" name="id_user" value="<?php Echo $dados1['IdUsuario']; ?>"class="form-control" required>
                            <input type="file" placeholder="Coloque aqui" name="arquivo" id="arquivo"> 
                            </center></div><br>
                        </div>   
                        <center><div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text btn-light" for="descpc2">Descrição da peça (opcional):</span>
                            </div>
                            <textarea class="form-control" aria-label="Com textarea" maxlenght="250" id="descpc2" name="descricao" placeholder="Digite uma descrição aqui"></textarea>
                        </div></center>
                    </div>
                </div><br><br>
                <center><input type="submit" class="btn btn-primary" value="Confirmar"><br><br></center>
                <br>
            </form>
        </div>
      </div>
    </div>
</div>

<!--Modal Cadastro de Looks-->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModCadLk">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" style="background-color: rgb(17, 14, 14); color: azure;">
            <header><center><h2 style="color: azure;"> Cadastro de looks</h2></center></header>
            <div>
                <form method="post" class="px-4 py-3" action="PHP/cadastrarfotolooks.php" id="est-f" enctype="multipart/form-data">
                    <br><h4>Por favor, preencha as lacunas abaixo com os dados necessários para o cadastro da peça de roupa</h4></center><br>
                    <div class="container">    
                        <div class="row justify-content-around">
                            <div class="col-4">
                                <div class="row justify-content-center">
                                    <label for="cat_roupa" class="col-4">Nome/Título:</label>
                                    <input type="text" class="col-4 col-sm-10" id="cat_roupa" name="titulo" placeholder="Digite o título do look aqui" maxlength="100" required>
                                </div><br>
                            </div>
                            <div class="col-4">
                                <div class="row justify-content-center">
                                    <label for="arquivo[]" class="col-4" style="color: yellow; align-items: center;"> Escolha a(s) imagem(s) (clique aqui)</label>
                                    <input type="hidden" name="id_user" value="<?php Echo $dados1['IdUsuario']; ?>"class="form-control">
                                    <input type="file" placeholder="Coloque aqui" name="arquivo[]" id="arquivo[]" multiple="multiple" required max="6" accept="image/*"> 
                                </div><br>
                            </div>
                        </div><br>
                        <div class="row justify-content-around">
                            <div class="col-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text btn-light" for="descpc2">Descrição do Look (opcional):</span>
                                    </div>
                                    <textarea class="form-control" aria-label="Com textarea" maxlenght="250" width="100px" id="descpc2" name="descricao" placeholder="Digite uma descrição aqui"></textarea>
                                </div>
                            </div>
                          
                        </div>
                    </div>
                    <br><br>
                    <center><input type="submit" class="btn btn-primary" value="Confirmar" name="submit"><br><br></center>
                    <br>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modais de Passo a Passo-->
<div class="modal fade bd-example-modal-lg" style="background-color: black; opacity: 90%;" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="ModPs">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: transparent; color: rgb(251, 255, 9);  border-style: none;">
            <div class="modal-body" style="position: relative;">
                <div class="modal-header" style="border-bottom: none;">
                    <center><h4 style="padding-left: 100px;">Olá! Esse é seu Guarda-Roupa, para aprender um pouco mais sobre como ele funciona e como
                        usá-lo é só seguir as dicas abaixo</center></h4><br>
                        <button style="padding-left: 100px; margin-right: 10px;" type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" style="background-color: #E61818; color: white;">&times;</span>
                        </button>
                </div>
                <img src="IMG\psps1.png" width= "1200px" height="600px"
                 style="position: absolute; left:50%; top:50%; margin-top: -10px; margin-left:-600px;">
            </div>
           </div> 
        </div>
    </div>
</div>

<!--Modal de visualização e edição de Looks-->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="LkMod">
    <div class="modal-dialog modal-xl" style="max-height: 515px;">
      <div class="modal-content" style="background-color: rgb(17, 14, 14);">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active" style="padding-right: 30px; padding-left: 210px; margin-top: 7px; margin-bottom: 7px;">
                    <a href="#VrLk" role="tab" data-toggle="tab" style="color: whitesmoke; text-decoration: none;">Ver Look</a>
                </li>
                <li role="presentation" style="padding-right: 30px; margin-top: 7px; margin-bottom: 7px;">
                    <a href="#EdLk" data-toggle="tab" role="button" style="color: whitesmoke; text-decoration: none;">Alterar Dados</a>
                </li>
                <li role="presentation" style="padding-right: 5px;  margin-top: 7px; margin-bottom: 7px;">
                    <a href="#ApLk" role="tab" data-toggle="tab" style="color: whitesmoke; text-decoration: none;">Apagar Look</a>
                </li>
            </ul>
            <!--Divs de Conteúdo de cada Aba de navegação-->
            <div class="container-fluid">
                <div class="tab-content">
                    <!--Ver foto-->
                    <div id="VrLk" role="tabpanel" class="tab-pane fade in active">
                        <header>
                            <div class="container">
                                <div class="row">
                                    <h5 name="unm" class="col" style="color: azure;">@nome_usuario</h5>
                                    <h5 style="color: azure; font-style: bold; padding: 2px;">>></h5>
                                    <h5 name="rnm" class="col-6" style="color: azure;">@nome_roupa</h5>
                                    <a class="btn btn-outline-light popover-test col dropdown-toggle"
                                    data-toggle="dropdown" href="#" title="Descrição da peça" role="button"
                                    aria-haspopup="true" aria-expanded="false" style="font-style: bold; width:
                                    70px;">↡</a>
                                    <div class="dropdown-menu" style="width: 500px;">
                                        <a class="dropdown-item" href="#"><h4>Descrição</h4></a>
                                        <div class="dropdown-divider"></div>
                                        <div class="blog-post" style="width: inherit;">
                                            <p class="mb-0" href="#" style="margin: 10px;">
                                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus illum, aut, vitae provident tempora porro, dicta vero rerum saepe iusto quasi voluptate dolore nesciunt odio eum laborum hic repudiandae voluptas?
                                            </p>
                                        </div>
                                        <a class="dropdown-item" href="#"><h4>Tags</h4></a>
                                        <div class="dropdown-divider"></div>
                                        <div class="blog-post" style="width: inherit;">
                                            <p class="mb-0" href="#" style="margin: 10px;">
                                                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus illum, aut, vitae provident tempora porro, dicta vero rerum saepe iusto quasi voluptate dolore nesciunt odio eum laborum hic repudiandae voluptas?
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </header> 
                        <div class="gallery" id="gallery" style="margin: 10px;">
                            <!-- Grid column -->
                            <div class="mb-3 pics animation all 2">
                              <img class="img-fluid" src="IMG\Samples\IMG1.png" alt="Card image cap">
                            </div>
                            <!-- Grid column -->
                          
                            <!-- Grid column -->
                            <div class="mb-3 pics animation all 1">
                              <img class="img-fluid" src="IMG\Samples\IMG2.png" alt="Card image cap">
                            </div>
                            <!-- Grid column -->
                          
                            <!-- Grid column -->
                            <div class="mb-3 pics animation all 1">
                              <img class="img-fluid" src="IMG\Samples\IMG3.png" alt="Card image cap">
                            </div>
                            <!-- Grid column -->
                          
                            <!-- Grid column -->
                            <div class="mb-3 pics animation all 2">
                              <img class="img-fluid" src="IMG\Samples\IMG4.png" alt="Card image cap">
                            </div>
                            <!-- Grid column -->
                          
                            <!-- Grid column -->
                            <div class="mb-3 pics animation all 2">
                              <img class="img-fluid" src="IMG\Samples\IMG5.png" alt="Card image cap">
                            </div>
                            <!-- Grid column -->
                          
                            <!-- Grid column -->
                            <div class="mb-3 pics animation all 1">
                              <img class="img-fluid" src="IMG\Samples\IMG6.png" alt="Card image cap">
                            </div>
                        </div>
                    </div>
                    <!--Apagar Roupa-->
                    <div id="ApLk" role="tabpanel" class="tab-pane fade in">
                        <br><center><h5 style="color:wheat;">Deseja mesmo apagar o look e todas suas informações? 
                            Essa ação não podera ser desfeita no futuro</h5><br>
                                <!--<input type="hidden" value="<?php Echo $dados5["Titulo"]; ?>" name="tit_roupa">
                                <input type="hidden" value="<?php Echo $dados5["IdRoupa"]; ?>" name="id_roupa">-->
                                <input type="submit" value="Sim, desejo apagar" class="btn btn-primary"></center><br>
                                <!--PHP de Apagar dados do guarda roupa:
                                    
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
                                ?>-->
                    </div>
                    <!--Editar Look-->
                    <div id="EdLk" role="tabpanel" class="tab-pane fade in"><!--Conteúdo prinipal da aba principal-->
                        <center><br>
                            <h6 style="color:wheat;"> *você pode alterar só uma caracterísca do look ou até mais,
                                 apenas preencha os campos que desejar e selecione "confirmar".
                            </h6><br>
                            <div class="container">
                                <div class="row justify-content-around" style="color: whitesmoke; font-style: bold;">
                                    <div class="col-4"><!--Campo Nome-->
                                        <form method="post" name="editartitulo">
                                            <!--<input type="hidden" value="<?php Echo $dados4["IdRoupa"]; ?>" name="id_roupa">-->
                                            <label for="nmpc">É só digitar o novo nome abaixo:</label><br><br>
                                            <input type="text" id="nmpc" name="nomepeca" style="width: 230px; margin-left: 1px;" placeholder="Digite aqui">  
                                            <!--<?php
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
                                            ?>-->
                                        </form>
                                    </div>
                                    <div class="col-4"><!-- Campo Arquivo/Imagem-->
                                        <form method="post" name="editarfoto" enctype="multipart/form-data" action="PHP/atualizarfotoroupa.php"> 
                                            <!--<input type="hidden" value="<?php Echo $dados4["IdRoupa"]; ?>" name="id_roupa">-->
                                            <label for="imgpc">É só selecionar o(s) novo(s) arquivo(s) abaixo:<br>
                                            <input type="file" id="imgpc" name="imgpeca" multiple/>
                                            <p style="color:yellow;">Clique aqui para selecionar arquivo</p></label><br>
                                        </form> 
                                    </div>
                                </div><br>
                                <div class="row justify-content-around" style="color: whitesmoke; font-style: bold;">
                                    <div class="col-4"><!--Campo descrição-->
                                        <form method="post" name="editardescricao">
                                            <!--<input type="hidden" value="<?php Echo $dados4["IdRoupa"]; ?>" name="id_roupa">-->
                                            <label for="descpc">É só digitar a nova descrição abaixo:</label><br><br>
                                            <input type="textarea" maxlenght="250" id="descpc" style="width: 230px;" name="descrpeca" placeholder="Digite aqui">
                                            <!--<?php
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
                                            ?>-->
                                        </form>
                                    </div>
                                    <div class="col-4"><!-- Campo tags-->
                                        <label for="tagpc">É só digitar as novas tags abaixo:</label><br><br>
                                        <input type="textarea" id="tagpc" name="tagspeca" style="width: 230px;" placeholder="Digite aqui">
                                    </div>
                                </div>
                            </div><br><br>
                            <input type="submit" value="Confirmar" class="btn btn-primary">
                        </center><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FIM DA SEÇÃO DE MODAIS-->
</body>
</html>
                                                        <?php }?>