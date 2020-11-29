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
                header("location: Close_Log02.php");
                exit;
            }
			require_once("Conexao.php");
            
                $id = $_POST['id_user'];
                $titulo = $_POST['titulo'];
                $descricao = $_POST['descricao'];
                $arquivo = $_FILES['arquivo'];
                $sql = "CALL Novo_Look('$id','$titulo','$descricao')";
                $resultado = mysqli_query($connect, $sql);
                $dados1 = mysqli_fetch_array($resultado);
                $id = $dados1['MAX(IdLook)'];
                mysqli_next_result($connect);
                for ($cont = 0; $cont < count($arquivo['name']); $cont++) {
            
                    $destino = "../Fotos_Looks/" . $arquivo['name'][$cont];
                
                    if (move_uploaded_file($arquivo['tmp_name'][$cont], $destino)) {
                        
                            $nome_final = $arquivo['name'][$cont];
                            echo $nome_final;
                        $query = mysqli_query($connect, "CALL Nova_Foto('$id', '$nome_final')");
                        
                    
                        
                    } else {
                        echo "oooooooo";
                    }
                }
		?>
		
	</body>
</html>
