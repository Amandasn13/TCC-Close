<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
	</head>
	</body>
        <?php
		require_once 'Conexao.php';
            require_once 'Login_Cadastro.php';
            session_start();
            if(!isset($_SESSION['IdUsuario']))
            {
                header("location: Close_Log.php");
                exit;
            }
        
            

            $id = $_POST['id_roupa'];
          
            
            
            
            

			include_once("Conexao.php");
            
			$arquivo 	= $_FILES['arquivo']['name'];
			
			//Pasta onde o arquivo vai ser salvo
			$_UP['pasta'] = '../Fotos_Roupas/';
			
			//Tamanho máximo do arquivo em Bytes
			$_UP['tamanho'] = 1024*1024*100; //5mb
			
			//Array com a extensões permitidas
			$_UP['extensoes'] = array('png', 'jpg', 'jpeg', 'gif');
			
			//Renomeiar
			$_UP['renomeia'] = false;
			
			//Array com os tipos de erros de upload do PHP
			$_UP['erros'][0] = 'Não houve erro';
			$_UP['erros'][1] = "<script language=javascript type= 'text/javascript'>
			window.alert('O aqrquivo no upload é maior do que o limete do PHP.');
			window.location.href = '../Close_GuardRp.php'
			</script>";
			$_UP['erros'][2] = "<script language=javascript type= 'text/javascript'>
			window.alert('O arquivo ultrapassa o tamanho especificado no HTML.');
			window.location.href = '../Close_GuardRp.php'
			</script>";
			$_UP['erros'][3] = "<script language=javascript type= 'text/javascript'>
			window.alert('Ocorreu algum erro e o upload do arquivo foi feito parcialmente, tente novamente.');
			window.location.href = '../Close_GuardRp.php'
			</script>";
			$_UP['erros'][4] = "<script language=javascript type= 'text/javascript'>
			window.alert('Por favor, selecione alguma foto antes de clicar em cadastrar.');
			window.location.href = '../Close_GuardRp.php'
			</script>";
			
			//Verifica se houve algum erro com o upload. Sem sim, exibe a mensagem do erro
			if($_FILES['arquivo']['error'] != 0){
				die("Não foi possivel fazer o upload, erro: <br />". $_UP['erros'][$_FILES['arquivo']['error']]);
				exit; //Para a execução do script
			}
			
			//Faz a verificação da extensao do arquivo
			$extensao =  strtolower(@end(explode('.', $_FILES['arquivo']['name'])));
			if(array_search($extensao,  $_UP['extensoes'])=== false){		
				echo "<script language=javascript type= 'text/javascript'>
                            window.alert('Extensão inválida, por favor selecione uma foto.')
							</script>";
					echo "<script language=java script type= 'text/javascript'>
					window.location.href = '../Close_GuardRp.php'
				</script>";
			}
			
			//Faz a verificação do tamanho do arquivo
			else if ($_UP['tamanho'] < $_FILES['arquivo']['size']){
				echo "<script language=javascript type= 'text/javascript'>
                            window.alert('Foto com tamanho muito grande! Escolha uma com tamanho menor.')
							</script>";
					echo "<script language=java script type= 'text/javascript'>
					window.location.href = '../Close_GuardRp.php'
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
					$query = mysqli_query($connect, "UPDATE  Roupa SET Foto='$nome_final' WHERE IdRoupa = '$id'");
					
					echo "<script language=javascript type= 'text/javascript'>
					window.alert('Imagem da roupa atualizada com sucesso!')
					</script>";
					echo "<script language=java script type= 'text/javascript'>
					window.location.href = '../Close_GuardRp.php'
				</script>";
		
                    
				}else{
					//Upload não efetuado com sucesso, exibe a mensagem
					echo "<script language=javascript type= 'text/javascript'>
					window.alert('Não foi possível cadastrar essa roupa.')
					</script>";
			echo "<script language=java script type= 'text/javascript'>
			window.location.href = '../Close_GuardRp.php'
		</script>";
				}
			}
			
			
		?>
		
	</body>
</html>
