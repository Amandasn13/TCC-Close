<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
	</head>
	</body>
        <?php
            require_once 'Login_Cadastro.php';
            session_start();
            if(!isset($_SESSION['IdUsuario']))
            {
                header("location: Close_Log.php");
                exit;
            }
            $id = $_SESSION['IdUsuario'];
            $resultado = mysqli_query($connect, $sql);
            $dados = mysqli_fetch_array($resultado);
            

            $categoria = $_POST['categoria'];
            $tipo = $_POST['tipo'];
            $descricao = $_POST['descricao'];
            $cor = $_POST['cor'];
            $tamanho = $_POST['tamanho'];
            $marca = $_POST['marca'];
            $material = $_POST['material'];
            $titulo = $_POST['titulo'];
            
            
            
            $marca = $_POST['marca'];
            

			include_once("Conexao.php");
            $id = $_POST['id_user']; 
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
				echo "
				
					<script type=\"text/javascript\">
						alert(\"A imagem não foi cadastrada extesão inválida. Porfavor, selecione uma foto!\");
					</script>
				";
			}
			
			//Faz a verificação do tamanho do arquivo
			else if ($_UP['tamanho'] < $_FILES['arquivo']['size']){
				echo "
					
					<script type=\"text/javascript\">
						alert(\"Arquivo muito grande.\");
					</script>
				";
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
					$query = mysqli_query($connect, "INSERT INTO Roupa (Foto, Titulo, Tipo, Marca, Tamanho, Cor, Descricao, fk_Usuario_IdUsuario, Categoria, Material) VALUES ('$nome_final', '$titulo', '$tipo', '$marca', '$tamanho', '$cor','$descricao', '$id','$categoria', '$material')");
					header("location: config.php");	
					echo "
												
						<script type=\"text/javascript\">
							alert(\"Imagem cadastrada com Sucesso.\");
						</script>
					";
				}else{
					//Upload não efetuado com sucesso, exibe a mensagem
					echo "
						
						<script type=\"text/javascript\">
							alert(\"Imagem não foi cadastrada com Sucesso.\");
						</script>
					";
				}
			}
			
			
		?>
		
	</body>
</html>