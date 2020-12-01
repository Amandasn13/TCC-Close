<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
	</head>
	</body>
		<?php
			include_once("Conexao.php");
			require_once 'funcoes_usuario.php';
			session_start();
			if(!isset($_SESSION['IdUsuario']))
			{
				header("location: ../Close_Log02.php");
				exit;
			}else{
			$id = $_POST['id_user']; 
			$arquivo 	= $_FILES['arquivo']['name'];
			
			//Pasta onde o arquivo vai ser salvo
			$_UP['pasta'] = '../Fotos_Perfis/';
			
			//Tamanho máximo do arquivo em Bytes
			$_UP['tamanho'] = 1024*1024*100; //5mb
			
			//Array com a extensões permitidas
			$_UP['extensoes'] = array('png', 'jpg', 'jpeg');
			
			//Renomeiar
			$_UP['renomeia'] = false;
			
			//Array com os tipos de erros de upload do PHP
			$_UP['erros'][0] = 'Não houve erro';
			$_UP['erros'][1] = 'O arquivo no upload é maior que o limite do PHP';
			$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especificado no HTML';
			$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
			$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
			
			//Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
			if($_FILES['arquivo']['error'] != 0){
				die("Não foi possivel fazer o upload, erro: <br />". $_UP['erros'][$_FILES['arquivo']['error']]);
				exit; //Para a execução do script
			}
			
			//Faz a verificação da extensao do arquivo
			$extensao =  strtolower(@end(explode('.', $_FILES['arquivo']['name'])));
			if(array_search($extensao,  $_UP['extensoes'])=== false){		
				$_SESSION['msg'] = "<div class='alert alert-warning' id='msg-alert1' style='position: fixed; margin-top: 5px; bottom: 80%;
                                      right: 20px; border-left: 7px solid #F1C40F;'>
                                          <span class='fa fa-exclamation-circle'></span>
                                          <!--Na linha acima a class indica qual o icone a ser utilizado você pode conferir todos os icones disponiveis em: https://fontawesome.com/v4.7.0/icons/ -->
                                          <span class='msg'>Extensão inválida! Por favor escolha uma foto </span>
                                          <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='padding-left: 9px; padding-bottom:9px;'>
                                              <span aria-hidden='true' onclick='this.parentElement.style.display='none';'>&times;</span>
                                          </button>
                                      </div>";
					echo "<script language=java script type= 'text/javascript'>
					window.location.href = '../Close_Estudio2.php'
				</script>";
			}
			
			//Faz a verificação do tamanho do arquivo
			else if ($_UP['tamanho'] < $_FILES['arquivo']['size']){
				$_SESSION['msg'] = "<div class='alert alert-warning' id='msg-alert1' style='position: fixed; margin-top: 5px; bottom: 80%;
                                      right: 20px; border-left: 7px solid #F1C40F;'>
                                          <span class='fa fa-exclamation-circle'></span>
                                          <!--Na linha acima a class indica qual o icone a ser utilizado você pode conferir todos os icones disponiveis em: https://fontawesome.com/v4.7.0/icons/ -->
                                          <span class='msg'>Foto com tamanho muito grande! Escolha uma com tamanho menor </span>
                                          <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='padding-left: 9px; padding-bottom:9px;'>
                                              <span aria-hidden='true' onclick='this.parentElement.style.display='none';'>&times;</span>
                                          </button>
                                      </div>";
					echo "<script language=java script type= 'text/javascript'>
					window.location.href = '../Close_Estudio2.php'
				</script>";
			}
			
			//O arquivo passou em todas as verificações, hora de tentar move-lo para a pasta foto
			else{
				//Primeiro verifica se deve trocar o nome do arquivo
				if($_UP['renomeia'] == true){
					//Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
					$nome_final = time().'.jpg';
				}else{
					//mantem o nome original do arquivo
					$nome_final = $_FILES['arquivo']['name'];
				}
				//Verificar se é possivel mover o arquivo para a pasta escolhida
				if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta']. $nome_final)){
					//Upload efetuado com sucesso, exibe a mensagem
					$query = mysqli_query($connect, "CALL AlterarFt_Usuario('$id', '$nome_final')");
					$_SESSION['msg'] = "<div class='alert alert-success' id='msg-alert1' style='position: fixed; margin-top: 5px; bottom: 80%;
                                      right: 20px; border-left: 7px solid #58D68D;'>
                                          <span class='fa fa-check-circle'></span>
                                          <!--Na linha acima a class indica qual o icone a ser utilizado você pode conferir todos os icones disponiveis em: https://fontawesome.com/v4.7.0/icons/ -->
                                          <span class='msg'>Foto do perfil alterada com sucesso! </span>
                                          <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='padding-left: 9px; padding-bottom:9px;'>
                                              <span aria-hidden='true' onclick='this.parentElement.style.display='none';'>&times;</span>
                                          </button>
                                      </div>";
					echo "<script language=java script type= 'text/javascript'>
					window.location.href = '../Close_Estudio2.php'
				</script>";
							
				}else{
					//Upload não efetuado com sucesso, exibe a mensagem
					$_SESSION['msg'] = "<div class='alert alert-danger' id='msg-alert1' style='position: fixed; margin-top: 5px; bottom: 85%;
                                      right: 20px; border-left: 7px solid #C0392B ;'>
                                          <span class='fa fa-frown-o'></span>
                                          <!--Na linha acima a class indica qual o icone a ser utilizado você pode conferir todos os icones disponiveis em: https://fontawesome.com/v4.7.0/icons/ -->
                                          <span class='msg'>Não foi possível alterar a foto de perfil! </span>
                                          <button type='button' class='close' data-dismiss='alert' aria-label='Close' style='padding-left: 9px; padding-bottom:9px;'>
                                              <span aria-hidden='true' onclick='this.parentElement.style.display='none';'>&times;</span>
                                          </button>
                                      </div>";
					echo "<script language=java script type= 'text/javascript'>
					window.location.href = '../Close_Estudio2.php'
				</script>";
				}
			}
			
		}
		?>
		
	</body>
</html>
